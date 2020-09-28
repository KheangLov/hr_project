<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Support\ApiTrait;

class UserTest extends TestCase
{
    use ApiTrait, DatabaseTransactions;

    public function test_user_api_list_without_token()
    {
        $this->response = $this
            ->json('GET', '/api/auth/list');
        $this->assertApiFailUnauthorized();
    }

    public function test_user_api_list_with_wrong_token()
    {
        $this->response = $this->withHeaders(['Authorization' => "Bearer 123"])
            ->json('GET', '/api/auth/list');
        $this->assertApiFailUnauthorized();
    }

    public function test_user_api_list()
    {
        $this->response = $this->withHeaders(['Authorization' => "Bearer " . $this->authenticated()['token']])
            ->json('GET', '/api/auth/list');
        $this->assertApiSuccess();
    }

}
