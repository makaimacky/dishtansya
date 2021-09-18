<?php

namespace Tests\Feature;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class UserTest extends TestCase
{
    
    public function new_registration_of_users()
    {
        $response = $this->post('/register',[
            'name'=>'macky',
            'email'=>'macky.escasinas@gmail.com',
            'password'=>'test123',

        ]);

        $response->assertStatus(200);
    }
}
