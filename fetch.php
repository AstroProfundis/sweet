<?php
	require('config.php');
	require('libs/twitter.php');
	require('common.php');

	$data = json_decode(file_get_contents('data_1.json'), TRUE);

	$content = array();
	
	foreach ($data as $d) {
		$content[] = construct($d);
	}

	echo json_encode($content);
