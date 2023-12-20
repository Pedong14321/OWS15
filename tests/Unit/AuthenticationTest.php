<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\Admin;


class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    /** @test */

    use RefreshDatabase;

    /** @test */
    public function it_logs_in_an_admin()
    {
        // Assuming you have an admin in the database
        $admin = Admin::factory()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // Act as the admin user
        $this->actingAs($admin, 'admin');

        // Attempt to access the admin_dashboard route
        $response = $this->get(route('admin_dashboard'));

        $response->assertStatus(200); // Adjust the expected status code as needed

        $response = $this->assertAuthenticatedAs($admin, 'admin');
    }

    

}
