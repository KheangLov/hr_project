<?php

namespace Tests\Unit;

use App\Department;
use App\Group;
use App\Position;
use App\Role;
use App\User;
use App\Unit;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class UserTest extends TestCase
{
    use WithFaker, DatabaseTransactions;

    public function test_table_users_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('users', [
                'id','name', 'email', 'password'
            ]),
            1
        );
    }

    public function test_user_belongs_to_relationships()
    {
        $unit = factory(Unit::class)->create();
        $group = factory(Group::class)->create();
        $position = factory(Position::class)->create();
        $user = factory(User::class)->create([
            'unit_id' => $unit->id,
            'group_id' => $group->id,
            'position_id' => $position->id
        ]);

         // Method 1: User exists in a role's user collections.
         $this->assertTrue($unit->users->contains($user));
         $this->assertTrue($group->users->contains($user));
         $this->assertTrue($position->users->contains($user));

         // Method 2: Count that a role users collection exists.
         $this->assertEquals(1, $unit->users->count());
         $this->assertEquals(1, $group->users->count());
         $this->assertEquals(1, $position->users->count());

         // Method 3: Users are related to roles and is a collection instance.
         $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $unit->users);
         $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $group->users);
         $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $position->users);
    }

    public function test_a_role_has_many_users()
    {
        $role = factory(Role::class)->create();
        $user = factory(User::class)->create([
            'role_id' => $role->id
        ]);

        // Method 1: User exists in a role's user collections.
        $this->assertTrue($role->users->contains($user));

        // Method 2: Count that a role users collection exists.
        $this->assertEquals(1, $role->users->count());

        // Method 3: Users are related to roles and is a collection instance.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $role->users);
    }

    public function test_user_belongs_to_department()
    {
        $department = factory(Department::class)->create();
        $user = factory(User::class)->create([
            'department_id' => $department->id
        ]);

        // Method 1: User exists in a role's user collections.
        $this->assertTrue($department->users->contains($user));

        // Method 2: Count that a role users collection exists.
        $this->assertEquals(1, $department->users->count());

        // Method 3: Users are related to roles and is a collection instance.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $department->users);
    }
}
