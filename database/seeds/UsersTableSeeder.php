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
        factory(App\User::class)->create([
            'name'     => 'Duy Nguyen',
            'email'    => 'duy@vietartisans.io',
            'password' => bcrypt('secret'),
        ]);
    }
}
