<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'username' => 'fahad',
            'password' => Hash::make('12345'),
            'usertype' => 'admin',
            'userstatus' => 'active',
        ]);
    }
}
