<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    const SESSION_NAME = 'test_user_id';

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_user()
    {
        $response = $this->graphQL('
            mutation {
                createUser (
                    name:"John Smith"
                    email:"john.smith@gmail.com"
                    date_of_birth:"1996-01-31"
                    is_active:true
                    phone_numbers:[
                        {
                            phone_number:"36701234567"
                            is_default:true
                        },
                        {
                            phone_number:"36201234567"
                            is_default:false
                        }
                    ]
                ) {
                    id
                }
            }
        ');

        $user_id = $response->json("data.createUser.id");
        $response->assertJson([
            'data' => [
                'createUser' => [
                    'id' => $user_id,
                ]
            ]
        ]);
    }

    public function test_user_list()
    {
        $response = $this->graphQL('
            query {
              users (
                orderBy:{
                  column:"id"
                  order:DESC
                }
              ) {
                name
                email
              }
            }
        ')->assertJson([
            'data' => [
                'users' => [
                    [
                        'name' => 'John Smith',
                        'email' => 'john.smith@gmail.com',
                    ]
                ]
            ]
        ]);
    }
}
