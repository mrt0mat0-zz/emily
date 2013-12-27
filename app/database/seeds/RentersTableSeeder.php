<?php
class RentersTableSeeder extends Seeder {

    public function run()
    {
		DB::table('renters')->delete();
		
		Renter::create(array(
			'name'			=> 'Sarah Evans',
			'company_id'	=> '1'
		));
		Renter::create(array(
			'name'			=> 'Charles Lenta',
			'company_id'	=> '1'
		));
    }

}