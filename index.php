<?php

require __DIR__.'/lib/base.php';

F3::set('CACHE',FALSE);
F3::set('DEBUG',3);
F3::set('UI','ui/');

$movies = array(
	1 => array(
		'title' => "Solaris",
		'description' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
	),
	2 => array(
		'title' => "Moon",
		'description' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
	),
	3 => array(
		'title' => "Sunshine",
		'description' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
	),
);

F3::route('GET /',
	function() use(&$movies) {
		F3::set('items',$movies);
		
		F3::set('page','jqm_page.htm');
		F3::set('content','home.htm');
		echo Template::serve('layout_jqm.htm');
	}
);

F3::route('GET /item/@id',
	function() use(&$movies) {
		$id = F3::get('PARAMS["id"]');
		F3::set('item',$movies[$id]);
		
		F3::set('content','item.htm');
		echo Template::serve('jqm_page.htm');
	}
);

F3::run();

?>
