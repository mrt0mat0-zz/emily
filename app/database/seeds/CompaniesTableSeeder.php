<?php
class CompaniesTableSeeder extends Seeder {

    public function run()
    {
		DB::table('companies')->delete();
		
		Company::create(array(
			'name' => 'Lowkeyweb'
		));
    }

}