<?php
class EventsTableSeeder extends Seeder {

    public function run()
    {
		DB::table('events')->delete();
		
		Event_info::create(array(
			'name'			=> 'Santa Barbara Fash 14',
			'location'		=> 'Santa Barbar, CA',
			'company_id'	=> '1',
			'start_date'	=> '2014-01-02',
			'end_date'		=> '2014-01-05'
		));
		Event_info::create(array(
			'name'			=> 'Comicon 2014',
			'location'		=> 'Los Angelos, CA',
			'company_id'	=> '1',
			'start_date'	=> '2014-01-07',
			'end_date'		=> '2014-01-010'
		));
		Event_info::create(array(
			'name'			=> 'NAPO 2014',
			'location'		=> 'Salt Lake City, UT',
			'company_id'	=> '1',
			'start_date'	=> '2014-02-02',
			'end_date'		=> '2014-02-05'
		));
    }

}
