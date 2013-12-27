<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UsersTableSeeder');
		$this->call('ItemsTableSeeder');
		$this->call('EventsTableSeeder');
		$this->call('EventItemsTableSeeder');
		$this->call('RentersTableSeeder');
		$this->call('TypesTableSeeder');
		$this->call('CompaniesTableSeeder');
	}

}