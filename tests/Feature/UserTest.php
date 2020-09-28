<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Support\Authentication;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions, Authentication;

    public function test_user_list()
    {
        $response = $this->withMiddleware()->authenticated()->get('/admin/staff/list');
        $response->assertStatus(200);
    }

    public function test_admin_can_edit_user()
    {
        $response = $this->authenticated($this->createAdmin())->get('/admin/user/edit/' . $this->user->id);
        $response->assertStatus(200);
    }

    public function test_admin_can_update_user()
    {
        $moreUser = factory(User::class)->make([
            '_token' => $this->csrf
        ])->toArray();
        $response = $this
            ->authenticated($this->createAdmin())
            ->put('/admin/user/update/' . $this->user->id, $moreUser);
        $response->assertStatus(302);
    }

    public function test_search_user()
    {
        $response = $this
            ->withoutMiddleware()
            ->authenticated()
            ->post('/admin/user/search', [
                'search' => 'lovsokheang'
            ]);

        $response->assertStatus(200);
    }

    public function test_admin_cannot_access_staff_list()
    {
        $response = $this
            ->authenticated($this->createAdmin())
            ->get('/admin/staff/list');
        $response->assertStatus(302);
    }

    public function test_normal_user_cannot_access_user_list()
    {
        $response = $this
            ->authenticated()
            ->get('/admin/user');
        $response->assertStatus(302);
    }
}
