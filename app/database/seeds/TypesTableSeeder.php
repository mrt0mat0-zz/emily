<?php
class TypesTableSeeder extends Seeder {

    public function run()
    {
		DB::table('types')->delete();
		
		Type::create(array(
			'name'			=> 'Banner (3x5)',
			'company_id'	=> '1'
		));
		Type::create(array(
			'name'			=> 'Pedestal',
			'company_id'	=> '1'
		));
    }

}