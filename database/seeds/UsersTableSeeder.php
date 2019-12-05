<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'login' => 'super.admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => env('TEST_USER_NAME'),
            'email' => env('TEST_USER_EMAIL'),
            'login' => env('TEST_USER_LOGIN'),
            'password' => bcrypt(env('TEST_USER_PASSWORD')),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
