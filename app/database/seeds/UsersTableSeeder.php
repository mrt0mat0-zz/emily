<?php
class UsersTableSeeder extends Seeder {

    public function run()
    {
		DB::table('users')->delete();
		
		User::create(array(
			'first_name'	=> 'Chris',
			'last_name'		=> 'Johnson',
			'password'		=> Hash::make('Password123'),
			'company_id'	=> '1',
			'email'			=> 'chris@lowkeyweb.com'
		));
		User::create(array(
			'first_name'	=> 'Emily',
			'last_name'		=> 'Tabaczynski',
			'password'		=> Hash::make('Password123'),
			'company_id'	=> '1',
			'email'			=> 'emily@lowkeyweb.com'
		));
    }

}

