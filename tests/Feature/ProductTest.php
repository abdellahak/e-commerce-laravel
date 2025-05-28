<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_it_can_create_a_product(): void
    {
        $category = Category::create([
            "name" => "phones",
            "description" => "example of description"
        ]);
        $product = Product::create([
            "name" => "iphone",
            "price" => 999.99,
            "stock" => 15,
            "description" => "bla bla bla",
            "category_id" => $category->id
        ]);

        $this->assertDatabaseHas("products", [
            "name" => "iphone"
        ]);
    }

    public function test_it_can_update_a_product()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            "category_id" => $category->id
        ]);

        $product->update([
            "name" => "modified name"
        ]);

        $this->assertDatabaseHas("products", [
            "name" => "modified name"
        ]);
    }

    public function test_it_can_delete_a_product()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            "category_id" => $category->id
        ]);

        $product->delete();

        $this->assertDatabaseMissing("products", [
            "id" => $product->id
        ]);
    }

}
