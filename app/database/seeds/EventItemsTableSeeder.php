<?php
class EventItemsTableSeeder extends Seeder {

    public function run()
    {
		DB::table('event_items')->delete();
		
		Event_item::create(array(
			'event_id'	=> '1',
			'item_id'		=> '2'
		));
		Event_item::create(array(
			'event_id'	=> '1',
			'item_id'		=> '3'
		));
		Event_item::create(array(
			'event_id'	=> '2',
			'item_id'		=> '2'
		));
    }

}

