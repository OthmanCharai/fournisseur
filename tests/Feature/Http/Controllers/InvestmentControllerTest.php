<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Investment;
use App\Models\Investor;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\InvestmentController
 */
class InvestmentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $investments = Investment::factory()->count(3)->create();

        $response = $this->get(route('investment.index'));

        $response->assertOk();
        $response->assertViewIs('investment.index');
        $response->assertViewHas('investments');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('investment.create'));

        $response->assertOk();
        $response->assertViewIs('investment.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InvestmentController::class,
            'store',
            \App\Http\Requests\InvestmentStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $filing_date = $this->faker->date();
        $amount = $this->faker->word;
        $cycle = $this->faker->word;
        $investor = Investor::factory()->create();

        $response = $this->post(route('investment.store'), [
            'filing_date' => $filing_date,
            'amount' => $amount,
            'cycle' => $cycle,
            'investor_id' => $investor->id,
        ]);

        $investments = Investment::query()
            ->where('filing_date', $filing_date)
            ->where('amount', $amount)
            ->where('cycle', $cycle)
            ->where('investor_id', $investor->id)
            ->get();
        $this->assertCount(1, $investments);
        $investment = $investments->first();

        $response->assertRedirect(route('investment.index'));
        $response->assertSessionHas('investment.id', $investment->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $investment = Investment::factory()->create();

        $response = $this->get(route('investment.show', $investment));

        $response->assertOk();
        $response->assertViewIs('investment.show');
        $response->assertViewHas('investment');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $investment = Investment::factory()->create();

        $response = $this->get(route('investment.edit', $investment));

        $response->assertOk();
        $response->assertViewIs('investment.edit');
        $response->assertViewHas('investment');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InvestmentController::class,
            'update',
            \App\Http\Requests\InvestmentUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $investment = Investment::factory()->create();
        $filing_date = $this->faker->date();
        $amount = $this->faker->word;
        $cycle = $this->faker->word;
        $investor = Investor::factory()->create();

        $response = $this->put(route('investment.update', $investment), [
            'filing_date' => $filing_date,
            'amount' => $amount,
            'cycle' => $cycle,
            'investor_id' => $investor->id,
        ]);

        $investment->refresh();

        $response->assertRedirect(route('investment.index'));
        $response->assertSessionHas('investment.id', $investment->id);

        $this->assertEquals(Carbon::parse($filing_date), $investment->filing_date);
        $this->assertEquals($amount, $investment->amount);
        $this->assertEquals($cycle, $investment->cycle);
        $this->assertEquals($investor->id, $investment->investor_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $investment = Investment::factory()->create();

        $response = $this->delete(route('investment.destroy', $investment));

        $response->assertRedirect(route('investment.index'));

        $this->assertModelMissing($investment);
    }
}
