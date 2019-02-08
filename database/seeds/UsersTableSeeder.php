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
        $user = \App\User::create([
            'first_name'    =>  'super',
            'last_name'     =>  'admin',
            'email'         =>  'super_admin@app.com',
            'password'      =>  bcrypt('111111'),
        ]);// end of user

        $user->attachRole('super_admin');

    } // end of run

}//end of seeder
