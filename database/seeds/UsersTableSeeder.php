<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'              =>      'John Smith',
            'email'             =>      'john_smith@examplemail.com',
            'username'          =>      'jsmith',
            'password'          =>      Hash::make('admin'),
            'remember_token'    =>      Str::random(64)
        ]);

        User::create([
            'name'              =>      'Alen Joe',
            'email'             =>      'alen_joe@examplemail.com',
            'username'          =>      'alenJoe',
            'password'          =>      Hash::make('root'),
            'remember_token'    =>      Str::random(64)
        ]);
    }
}
