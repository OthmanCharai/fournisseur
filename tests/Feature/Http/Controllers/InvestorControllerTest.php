<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Investor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\InvestorController
 */
class InvestorControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $investors = Investor::factory()->count(3)->create();

        $response = $this->get(route('investor.index'));

        $response->assertOk();
        $response->assertViewIs('investor.index');
        $response->assertViewHas('investors');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('investor.create'));

        $response->assertOk();
        $response->assertViewIs('investor.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InvestorController::class,
            'store',
            \App\Http\Requests\InvestorStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;
        $email = $this->faker->safeEmail;
        $phone = $this->faker->phoneNumber;
        $address = $this->faker->word;

        $response = $this->post(route('investor.store'), [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
        ]);

        $investors = Investor::query()
            ->where('name', $name)
            ->where('email', $email)
            ->where('phone', $phone)
            ->where('address', $address)
            ->get();
        $this->assertCount(1, $investors);
        $investor = $investors->first();

        $response->assertRedirect(route('investor.index'));
        $response->assertSessionHas('investor.id', $investor->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $investor = Investor::factory()->create();

        $response = $this->get(route('investor.show', $investor));

        $response->assertOk();
        $response->assertViewIs('investor.show');
        $response->assertViewHas('investor');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $investor = Investor::factory()->create();

        $response = $this->get(route('investor.edit', $investor));

        $response->assertOk();
        $response->assertViewIs('investor.edit');
        $response->assertViewHas('investor');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InvestorController::class,
            'update',
            \App\Http\Requests\InvestorUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $investor = Investor::factory()->create();
        $name = $this->faker->name;
        $email = $this->faker->safeEmail;
        $phone = $this->faker->phoneNumber;
        $address = $this->faker->word;

        $response = $this->put(route('investor.update', $investor), [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
        ]);

        $investor->refresh();

        $response->assertRedirect(route('investor.index'));
        $response->assertSessionHas('investor.id', $investor->id);

        $this->assertEquals($name, $investor->name);
        $this->assertEquals($email, $investor->email);
        $this->assertEquals($phone, $investor->phone);
        $this->assertEquals($address, $investor->address);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $investor = Investor::factory()->create();

        $response = $this->delete(route('investor.destroy', $investor));

        $response->assertRedirect(route('investor.index'));

        $this->assertModelMissing($investor);
    }
}
