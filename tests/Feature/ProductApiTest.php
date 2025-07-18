<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that GET /api/products returns a 200 status code and a valid JSON structure
     * when authenticated.
     */
    public function test_get_products_authenticated_returns_success_and_json_structure(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson('/api/products');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'price',
                    'stock',
                    'created_at',
                    'is_in_stock',
                ]
            ]
        ]);
    }
public function test_post_product_unauthenticated_returns_unauthorized(): void
    {
        $productData = [
            'name' => 'Test Product',
            'price' => 99.99,
            'stock' => 10,
        ];

        $response = $this->postJson('/api/products', $productData);

        $response->assertStatus(401);

        $response->assertJson(['message' => 'Unauthenticated.']);
    }

}
