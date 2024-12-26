<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;

class LoginDanRegistrasiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_shows_login_view()
    {
        $response = $this->get('/'); // Route for login view
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function it_shows_registration_view()
    {
        $response = $this->get('/registrasi'); // Route for registration view
        $response->assertStatus(200);
        $response->assertViewIs('auth.registrasi');
    }

    /** @test */
    public function it_stores_a_new_user()
    {
        // Use the AnggotaFactory to generate user data
        $data = Anggota::factory()->make()->toArray(); // Generate fake data

        $response = $this->post('/registrasi/store', $data); // Route for store registration
        $this->assertDatabaseHas('anggota', [
            'nama' => $data['nama'],
            'username' => $data['username'],
        ]);
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function it_fails_to_store_invalid_user()
    {
        // Submit invalid registration data
        $response = $this->post('/registrasi/store', ['username' => 'Invalid User']);

        // Check for validation errors on the session
        $response->assertSessionHasErrors(['nama', 'alamat', 'noHP', 'username', 'password']);
    }

    /** @test */
    public function it_verifies_login_for_user()
    {
        // Create a user using the factory with matching credentials
        $anggota = Anggota::factory()->create([
            'username' => 'user',
            'password' => bcrypt('Password@123'), // Ensure this is the same as used in tests
            'role' => 'user',
        ]);

        $response = $this->post('/', [
            'username' => 'user',
            'password' => 'Password@123',
        ]);

        // Assert the user is redirected to the user dashboard
        $response->assertRedirect('/user/dashboard');
        $this->assertTrue(Auth::guard('user')->check());
    }

    /** @test */
    public function it_fails_verification_with_incorrect_credentials()
    {
        // Attempt login with incorrect credentials
        $response = $this->post('/', [
            'username' => 'wronguser',
            'password' => 'wrongpassword',
        ]);

        // Assert the user is back to the login page with an error message
        $response->assertRedirect(route('login'));
        $response->assertSessionHas('msg', 'Username atau password salah!');
        $this->assertFalse(Auth::guard('user')->check());
    }

    /** @test */
    public function it_logs_out_the_authenticated_user()
    {
        // Create and authenticate a user
        $anggota = Anggota::factory()->create([
            'username' => 'user',
            'password' => bcrypt('UserPass1!'),
        ]);

        Auth::login($anggota); // Log in the user

        // Execute the logout action
        $response = $this->get('/logout'); // Use a GET request for logout based on routing

        // Assert successful logout and redirection
        $response->assertRedirect(route('login'));
        $this->assertFalse(Auth::check());
    }
}
