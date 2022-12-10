<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PurchaseController
 */
class PurchaseControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $purchases = Purchase::factory()->count(3)->create();

        $response = $this->get(route('purchase.index'));

        $response->assertOk();
        $response->assertViewIs('purchase.index');
        $response->assertViewHas('purchases');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('purchase.create'));

        $response->assertOk();
        $response->assertViewIs('purchase.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PurchaseController::class,
            'store',
            \App\Http\Requests\PurchaseStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $quantity = $this->faker->randomFloat(/** float_attributes **/);
        $unite_price = $this->faker->randomFloat(/** float_attributes **/);
        $supplier = Supplier::factory()->create();

        $response = $this->post(route('purchase.store'), [
            'quantity' => $quantity,
            'unite_price' => $unite_price,
            'supplier_id' => $supplier->id,
        ]);

        $purchases = Purchase::query()
            ->where('quantity', $quantity)
            ->where('unite_price', $unite_price)
            ->where('supplier_id', $supplier->id)
            ->get();
        $this->assertCount(1, $purchases);
        $purchase = $purchases->first();

        $response->assertRedirect(route('purchase.index'));
        $response->assertSessionHas('purchase.id', $purchase->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $purchase = Purchase::factory()->create();

        $response = $this->get(route('purchase.show', $purchase));

        $response->assertOk();
        $response->assertViewIs('purchase.show');
        $response->assertViewHas('purchase');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $purchase = Purchase::factory()->create();

        $response = $this->get(route('purchase.edit', $purchase));

        $response->assertOk();
        $response->assertViewIs('purchase.edit');
        $response->assertViewHas('purchase');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PurchaseController::class,
            'update',
            \App\Http\Requests\PurchaseUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $purchase = Purchase::factory()->create();
        $quantity = $this->faker->randomFloat(/** float_attributes **/);
        $unite_price = $this->faker->randomFloat(/** float_attributes **/);
        $supplier = Supplier::factory()->create();

        $response = $this->put(route('purchase.update', $purchase), [
            'quantity' => $quantity,
            'unite_price' => $unite_price,
            'supplier_id' => $supplier->id,
        ]);

        $purchase->refresh();

        $response->assertRedirect(route('purchase.index'));
        $response->assertSessionHas('purchase.id', $purchase->id);

        $this->assertEquals($quantity, $purchase->quantity);
        $this->assertEquals($unite_price, $purchase->unite_price);
        $this->assertEquals($supplier->id, $purchase->supplier_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $purchase = Purchase::factory()->create();

        $response = $this->delete(route('purchase.destroy', $purchase));

        $response->assertRedirect(route('purchase.index'));

        $this->assertModelMissing($purchase);
    }
}
