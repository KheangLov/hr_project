<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    public function test_user_cannot_view_a_register_form()
    {
        $response = $this->get('/register');
        $response->assertStatus(404);
    }
}
