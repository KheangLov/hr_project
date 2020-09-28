<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_user_login()
    {
        $user = factory(User::class)->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->value('#email', $user->email)
                ->value('#password', '123456')
                ->click('button[type="submit"]')
                ->assertPathIs('/admin');
        });
    }

    // public function test_user_register()
    // {
    //     $user = factory(User::class)->create();
    //     $this->browse(function (Browser $browser) use ($user) {
    //         $browser->visit('/register');
    //     });
    // }
}
