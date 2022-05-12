<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    use WithFaker;

    public function test_example_login()
    {
        $response = $this->json('POST', route('login'), ['email' => 'dwifebryansyah5@gmail.com' , 'password' => 'Dwigunn12'],[]);
        $response->assertStatus(200);
    }

    public function test_example_register()
    {
        $value = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique->safeEmail,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'api_token' => null
        ];

        $this->post(route('register'), $value)->assertStatus(200);
    }
}
