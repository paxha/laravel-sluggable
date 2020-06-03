<?php

namespace Sluggable\Tests\Unit;

use Sluggable\Tests\Models\Role;
use Sluggable\Tests\Models\User;
use Sluggable\Tests\TestCase;

class SluggableTest extends TestCase
{
    public function testDefaultSlugable()
    {
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        for ($i = 0; $i < 12; $i++) {
            if ($i === 0) {
                $this->assertDatabaseHas('users', [
                    'slug' => 'john-doe',
                ]);
            } else {
                $this->assertDatabaseHas('users', [
                    'slug' => 'john-doe-' . $i,
                ]);
            }
        }

        User::create([
            'first_name' => 'John'
        ]);

        User::create([
            'first_name' => 'John'
        ]);

        User::create([
            'first_name' => 'John'
        ]);

        for ($i = 0; $i < 3; $i++) {
            if ($i === 0) {
                $this->assertDatabaseHas('users', [
                    'slug' => 'john',
                ]);
            } else {
                $this->assertDatabaseHas('users', [
                    'slug' => 'john-' . $i,
                ]);
            }
        }

    }

    public function testManualSlugable()
    {
        Role::create([
            'name' => 'Super Admin',
        ]);

        $this->assertDatabaseHas('roles', [
            'role_slug' => 'super_admin',
        ]);

        Role::create([
            'name' => 'Super Admin',
        ]);

        $this->assertDatabaseHas('roles', [
            'role_slug' => 'super_admin_1',
        ]);

        $role = new Role();
        $role->name = 'Super Admin';
        $role->save();

        $this->assertDatabaseHas('roles', [
            'role_slug' => 'super_admin_2',
        ]);
    }
}
