<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use League\Flysystem\Config;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void {
        parent::setUp();
        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
        $this->artisan('db:seed');
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserCanLoginWithValidCredentials()
    {
        $response = $this->json('POST', route('login'), [
            'email' => 'admin@localhost',
            'password' => 'root12'
        ]);

        $response
            ->assertSuccessful()
            ->assertJsonStructure([
                'access_token', 'token_type', 'expires_in'
            ]);
    }

    public function testUserCannotLoginWithInvalidCredentials() {
        $response = $this->json('POST', route('login'), [
            'email' => 'admin@localhost',
            'password' => '123321'
        ]);

        $response
            ->assertUnauthorized()
            ->assertJsonStructure([
                'error'
            ]);
    }

    public function testUserCanLogout() {
        $user = User::where('email', 'admin@localhost')->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->json('POST', route('logout'), [], ['Authorization' => 'Bearer ' . $token]);
        $response
            ->assertSuccessful()
            ->assertExactJson([
                'message' => 'Successfully logged out'
            ]);
    }

    public function testUserCanRefreshToken() {
        $user = User::where('email', 'admin@localhost')->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->json('POST', route('refresh'), [], ['Authorization' => 'Bearer ' . $token]);

        $response
            ->assertSuccessful()
            ->assertJsonStructure([
                'access_token', 'token_type', 'expires_in'
            ]);
   }

    public function testUserCanGetHisDataWithValidToken() {
        $user = User::where('email', 'admin@localhost')->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->json('POST', route('me'), [], ['Authorization' => 'Bearer ' . $token]);
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'name' => $user->name,
                'email' => $user->email,
            ]);
    }
}
