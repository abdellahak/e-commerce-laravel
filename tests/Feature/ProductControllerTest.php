<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_show_index_page(): void
    {
        Category::factory(5)->create();
        Product::factory(20)->create();

        $response = $this->get(route("products.index"));

        $response->assertStatus(200);
        $response->assertSee("Products list");
    }

    public function test_it_can_show_create_page(): void
    {
        Category::factory(10)->create();

        $response = $this->get(route("products.create"));

        $response->assertStatus(200);
    }

    public function test_it_can_store_a_product(): void
    {
        $category = Category::factory()->create();

        $response = $this->post(route("products.store"), [
            "name" => "iphone",
            "price" => 999.99,
            "stock" => 15,
            "description" => "bla bla bla",
            "category_id" => $category->id
        ]);

        $this->assertDatabaseHas("products", [
            "name" => "iphone"
        ]);
        $response->assertRedirect(route("products.index"));
    }

    public function test_it_can_show_product()
    {
        Category::factory(5)->create();
        $product = Product::factory()->create();

        $response = $this->get(route("products.show", $product->id));
        $response->assertStatus(200);
    }

    public function test_it_can_show_edit_product_page()
    {
        Category::factory()->create();
        $product = Product::factory()->create();

        $response = $this->get(route("products.edit", $product->id));

        $response->assertStatus(200);
    }

    public function test_it_can_update_a_product()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create();

        $response = $this->put(route("products.update", $product->id), [
            "name" => "iphone",
            "price" => 999.99,
            "stock" => 15,
            "description" => "bla bla bla",
            "category_id" => $category->id
        ]);

        $this->assertDatabaseHas("products", [
            "name" => "iphone"
        ]);
        $response->assertRedirect(route("products.index"));
    }

    public function test_it_can_delete_a_product(){
        $category = Category::factory()->create();
        $product = Product::factory([
            "name" => "9amija"
        ])->create();

        $response = $this->delete(route("products.destroy", $product->id));

        $this->assertDatabaseMissing("products", [
            "name" => "9amija"
        ]);
        $response->assertStatus(200);

    }
}
