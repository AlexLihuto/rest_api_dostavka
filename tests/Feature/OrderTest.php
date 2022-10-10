<?php

namespace Tests\Feature;

use App\Http\Middleware\ApiAuthentication;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
/*    use RefreshDatabase;*/

    public function setUp():void {

        parent::setUp();

/*        $this->refreshDatabase();*/
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFalseAuthentication()
    {
        $response = $this->get('/');

        $response->assertStatus(401);
    }

    public function tesTrueAuthentication()
    {
        $response = $this->get('/', self::getToken());

        $response->assertStatus(200);
    }

    public function testAuthenticationOrders()
    {
        $response = $this->get('/api/v1/orders');

        $response->assertStatus(401);
    }

    public function testGetOrders()
    {
        $response = $this->get('/api/v1/orders', self::getToken());

        $response->assertStatus(200);
    }

    public function testCreateOrder() {

        $data = [];

        $response = $this->post('/api/v1/orders', $data, self::getToken());

        $response->assertStatus(422);

        $data = [
            'pointA' => 'ул.Воронянского 15 к.1',
            'pointB' => 'ул.Янки Купалы 57',
            'price' => '16',

        ];

        $response = $this->post('/api/v1/orders', $data, self::getToken());

        $response->assertStatus(201);
    }

    private static function getToken() {

        return [ApiAuthentication::API_KEY_HEADER => config('services.api.token')];
    }
}
