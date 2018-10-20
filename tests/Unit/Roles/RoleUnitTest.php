<?php

namespace Tests\Unit\Roles;

use Tests\TestCase;
use App\Roles\Role;
use App\Repositories\RoleRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleUnitTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_can_create_a_role()
    {
        $data = [
            'name' => $this->faker->name,
        ];

        $roleRepo = new RoleRepository(new Role);
        $role = $roleRepo->createRole($data);

        $this->assertInstanceOf(Role::class, $role);
        $this->assertEquals($data['name'], $role->name);
    }

    /** @test */
    public function it_can_show_the_role()
    {
        $role = factory(Role::class)->create();
        $roleRepo = new RoleRepository(new Role);
        $found = $roleRepo->findRole($role->id);

        $this->assertInstanceOf(Role::class, $found);
        $this->assertEquals($found->name, $role->name);
    }

    /** @test */
    public function it_can_update_the_role()
    {
        $role = factory(Role::class)->create();

        $data = [
            'name' => "Test rola",
        ];

        $roleRepo = new RoleRepository($role);
        $update = $roleRepo->updateRole($data);

        $this->assertTrue($update);
        $this->assertEquals($data['name'], $role->name);
    }

    /** @test */
    public function it_can_delete_the_role()
    {
        $role = factory(Role::class)->create();

        $roleRepo = new RoleRepository($role);
        $delete = $roleRepo->deleteRole();

        $this->assertTrue($delete);
    }

}
