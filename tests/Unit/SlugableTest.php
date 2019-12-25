<?php

namespace Slugable\Tests\Unit;

use Slugable\Tests\Models\Role;
use Slugable\Tests\Models\User;
use Slugable\Tests\TestCase;

class SlugableTest extends TestCase
{
    public function testDefaultSlugable()
    {
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe'
        ]);

        $this->assertDatabaseHas('users', [
            'slug' => 'john-doe'
        ]);

        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe'
        ]);

        $this->assertDatabaseHas('users', [
            'slug' => 'john-doe-1'
        ]);

        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe'
        ]);

        $this->assertDatabaseHas('users', [
            'slug' => 'john-doe-2'
        ]);
    }

    public function testManualSlugable()
    {
        Role::create([
            'name' => 'Super Admin'
        ]);

        $this->assertDatabaseHas('roles', [
            'role_slug' => 'super_admin'
        ]);

        Role::create([
            'name' => 'Super Admin'
        ]);

        $this->assertDatabaseHas('roles', [
            'role_slug' => 'super_admin_1'
        ]);

        Role::create([
            'name' => 'Super Admin'
        ]);

        $this->assertDatabaseHas('roles', [
            'role_slug' => 'super_admin_2'
        ]);
    }
}