<?php

namespace Tests\Unit\Users;

use Tests\TestCase;
use App\Users\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserUnitTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_can_create_a_user()
    {
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password,
            'remember_token' => str_random(50),
            'role_id' => random_int(1, 2),
            'currency_id' => random_int(1, 3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];

        $userRepo = new UserRepository(new User);
        $user = $userRepo->createUser($data);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['email'], $user->email);
        $this->assertEquals($data['password'], $user->password);
        $this->assertEquals($data['remember_token'], $user->remember_token);
        $this->assertEquals($data['role_id'], $user->role_id);
        $this->assertEquals($data['currency_id'], $user->currency_id);
        $this->assertEquals($data['created_at'], $user->created_at);
        $this->assertEquals($data['updated_at'], $user->updated_at);
    }

    /** @test */
    public function it_can_show_the_user()
    {
        $user = factory(User::class)->create();
        $userRepo = new UserRepository(new User);
        $found = $userRepo->findUser($user->id);

        $this->assertInstanceOf(User::class, $found);
        $this->assertEquals($found->name, $user->name);
        $this->assertEquals($found->email, $user->email);
        $this->assertEquals($found->password, $user->password);
        $this->assertEquals($found->remember_token, $user->remember_token);
        $this->assertEquals($found->role_id, $user->role_id);
        $this->assertEquals($found->currency_id, $user->currency_id);
        $this->assertEquals($found->created_at, $user->created_at);
        $this->assertEquals($found->updated_at, $user->updated_at);
    }

    /** @test */
    public function it_can_update_the_user()
    {
        $user = factory(User::class)->create();

        $data = [
            'name' => "Test",
            'email' => "test@gmail.com",
            'password' => "test345",
            'remember_token' => str_random(50),
            'role_id' => random_int(1, 2),
            'currency_id' => random_int(1, 3),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ];

        $userRepo = new UserRepository($user);
        $update = $userRepo->updateUser($data);

        $this->assertTrue($update);
        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['email'], $user->email);
        $this->assertEquals($data['password'], $user->password);
        $this->assertEquals($data['remember_token'], $user->remember_token);
        $this->assertEquals($data['role_id'], $user->role_id);
        $this->assertEquals($data['currency_id'], $user->currency_id);
        $this->assertEquals($data['created_at'], $user->created_at);
        $this->assertEquals($data['updated_at'], $user->updated_at);
    }

    /** @test */
    public function it_can_delete_the_user()
    {
        $user = factory(User::class)->create();

        $userRepo = new UserRepository($user);
        $delete = $userRepo->deleteUser();

        $this->assertTrue($delete);
    }

}
