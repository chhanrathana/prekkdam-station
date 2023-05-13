<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoanDailyControllerTest extends TestCase
{

    public function testCreate()
    {
        // $this->call('POST', route('loan.daily.create'));

        // $this->assertViewHas('posts');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStore()
    {
        $response = $this->get('/');
        // $this->client->request('GET', 'posts');

        $response->assertStatus(200);
    }
}
