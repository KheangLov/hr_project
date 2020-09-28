<?php
namespace Tests\Support;

use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Cast\Array_;

trait Authentication
{
    /** @var User $user **/
    protected $user;
    protected $admin;
    protected $csrf;

    /**
     * @before
     */
    public function setUpUser()
    {
        $this->afterApplicationCreated(function () {
            Session::start();
            $this->user = factory(User::class)->create();
            $this->csrf = csrf_token();
        });
    }

    public function createAdmin()
    {
        return factory(User::class)->create([
            'role_id' => 1
        ]);
    }

    public function authenticated(Authenticatable $user = null)
    {
        return $this->actingAs($user ?? $this->user);
    }

}
