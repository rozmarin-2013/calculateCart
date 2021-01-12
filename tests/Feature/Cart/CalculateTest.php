<?php

namespace Tests\Feature\Cart;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalculateTest extends TestCase
{
    const JSON_STRUCTURE_RESPONSE = [
        'checkoutPrice',
        'checkoutCurrency'
    ];

    const POST_DATA = [
        "items" => [
            "42" => [
                "currency" => "EUR",
                "price" => 49.99,
                "quantity" => 1
            ],
            "55" => [
                "currency" => "USD",
                "price" => 12,
                "quantity" => 3
            ]
        ],
        "checkoutCurrency" => "EUR"
    ];

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_isAssertJsonStructure()
    {
        $response = $this->postJson('/api/cart/calculate', self::POST_DATA);

        $response->assertOk();

        $response->assertJsonStructure([
            'success',
            'data' => self::JSON_STRUCTURE_RESPONSE,
            'message'
        ]);
    }

    public function testInvalidPostData()
    {
        $response = $this->postJson('/api/cart/calculate', [
            'items' => '',
            'checkoutCurrency' => ''
        ]);
        $response->assertStatus(422);
    }
}
