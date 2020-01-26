<?php

use Illuminate\Database\Seeder;
use App\UserLevel;

class UserLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserLevel::create([
            'username'          =>      'alenJoe'
        ]);

        UserLevel::create([
            'username'          =>      'jsmith'
        ]);
    }
}
