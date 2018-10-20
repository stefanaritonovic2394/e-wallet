<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use App\Expense;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
//        $found_user = User::find(1);
//        $this->assertEquals('Stefan', $found_user->name = 'Stefan');

        $api = Expense::get_json_api('31.07.2018');
        $this->assertEquals('118.0603', $api->result->eur->sre);
//        $this->assertTrue($api);

//        $user = new User(['stefan', 'marko']);
//        $this->assertTrue($user->has('stefan'));

//        $allusers = User::all();
//        $this->assertTrue($allusers->has('stefan'));
//        $this->assertEquals('stefan', $allusers->takeOne());
//        $this->assertTrue($allusers, true);
    }
}
