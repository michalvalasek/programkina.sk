<?php

require __DIR__.'/lib/base.php';

F3::set('CACHE',FALSE);
F3::set('DEBUG',3);
F3::set('UI','ui/');

// Database connector
F3::set('DB',
	new DB(
		'mysql:host=localhost;port=3306;dbname=programkina',
		'root',
		''
	)
);

F3::set('WEEKDAYS', array(
	1 => 'Pondelok',
	2 => 'Utorok',
	3 => 'Streda',
	4 => 'Štvrtok',
	5 => 'Piatok',
	6 => 'Sobota',
	7 => 'Nedeľa',
));

// List of all upcomming events grouped by dates
F3::route('GET /',
	function() {
		$now = time();
		$events = DB::sql("SELECT * FROM dates JOIN events ON events.id=dates.event_id WHERE timestamp>{$now} GROUP BY event_id, date ORDER BY timestamp ASC");
		F3::set('events',$events);
		
		F3::set('page','jqm_page.htm');
		F3::set('content','home.htm');
		echo Template::serve('layout_jqm.htm');
	}
);

// Details of an event
F3::route('GET /event/@id',
	function() {
		$id = (int) F3::get('PARAMS["id"]');
		$events = DB::sql("SELECT * FROM events WHERE id={$id}");
		if (empty($events)) {
			//F3::reroute('/unknown_event'); // unnecessary HTTP redirect
			F3::set('content','unknown_event.htm'); // better to render the error page directly
		} else {
			F3::set('event',$events[0]);
			
			$dates = DB::sql("SELECT * FROM dates WHERE event_id={$id}");
			F3::set('dates',$dates);
			
			F3::set('content','event.htm');
		}
		
		echo Template::serve('jqm_page.htm');
	}
);

/*
F3::route('GET /unknown_event',
	function() {
		F3::set('content','unknown_event.htm');
		echo Template::serve('jqm_page.htm');
	}
);
*/

F3::run();

?>
