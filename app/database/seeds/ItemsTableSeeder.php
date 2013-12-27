<?php
class ItemsTableSeeder extends Seeder {

    public function run()
    {
		DB::table('items')->delete();
		
		Item::create(array('type_id'	=> '1'));
		Item::create(array('type_id'	=> '1'));
		Item::create(array('type_id'	=> '1'));
		Item::create(array('type_id'	=> '2'));
    }

}
