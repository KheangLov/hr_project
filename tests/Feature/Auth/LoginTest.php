<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Support\Authentication;

class LoginTest extends TestCase
{
    use DatabaseTransactions, Authentication;

    public function test_user_can_view_a_login_form()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    public function test_user_can_login()
    {
        $response = $this->authenticated()->get('/admin');
        $response->assertStatus(200);
        $this->assertAuthenticatedAs($this->user);
    }

    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $response = $this->authenticated()->get('/login');
        $response->assertRedirect('/home');
    }

    public function test_user_cannot_login_with_incorrect_password()
    {
        $response = $this
            ->withoutMiddleware()
            ->from('/login')
            ->post('/login', [
                'email' => $this->user->email,
                'password' => 'wrong_password',
            ]);
        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function test_allows_user_to_logout()
    {
        $this->withoutMiddleware()->authenticated();
        $this->post(route('logout'));
        $this->assertGuest();
    }

}
