<?php

namespace Tests\Feature\Api;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Support\ApiTrait;

class AuthTest extends TestCase
{
    use ApiTrait, DatabaseTransactions;

    public function test_login_with_wrong_password()
    {
        $user = factory(User::class)->create();
        $this->response = $this
            ->json(
                'POST',
                '/api/auth/login',
                [
                    'email' => $user->email,
                    'password' => 'wrong_password'
                ]
            );
        $this->assertApiFailForbidden();
    }


    public function test_api_admin_can_not_login()
    {
        $user = factory(User::class)->create([
            'role_id' => 1
        ]);
        $this->response = $this
            ->json('POST', '/api/auth/login',
            [
                'email' => $user->email,
                'password' => 'not4you'
            ]
        );
        $this->assertApiFailForbidden();
    }

    public function test_user_registration()
    {
        $user = factory(User::class)->make()->toArray();
        $this->response = $this
            ->json(
                'POST',
                '/api/auth/register', $user
            );
        $this->assertApiResponse($user);
    }

    public function test_refresh_token()
    {
        $this->response = $this->withHeaders(['Authorization' => 'Bearer ' . $this->authenticated()['token']])
            ->json('POST', 'api/auth/refresh');
        $this->assertApiSuccess([
            'status',
            'token',
            'expires_in',
            'data'
        ]);
    }

    public function test_user_send_mail_reset_password()
    {
        $user = factory(User::class)->create();
        $this->response = $this
            ->json(
                'POST',
                '/api/auth/recovery',
                [
                    'email' => $user->email
                ]
            );
        $this->assertApiSuccess();
    }
}
