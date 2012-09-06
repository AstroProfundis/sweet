<?php

	include_once('config.php');
	include_once('libs/twitter.php');
	include_once('common.php');

	// /*
	$data = json_decode(file_get_contents('data_1.json'), TRUE);

	foreach ($data as $tweet) {
		$content[$tweet['id_str']] = construct($tweet);
	}

	$data = json_decode(file_get_contents('data_2.json'), TRUE);

	foreach ($data as $tweet) {
		$content[$tweet['id_str']] = construct($tweet, TRUE);
	}

	krsort($content);

	echo json_encode(array_values($content));
	exit;
	// */

	$connection = new TwitterOAuth($config['consumer_key'], $config['consumer_secret'], $config['access_token'], $config['access_token_secret']);

	$timeline_a = $connection->get('statuses/user_timeline', array(
		'screen_name' => 'NetPuter',
		'count' => $config['count'],
		'since_id' => $config['since_id'],
		'include_rts' => 1,
		'include_entities' => 1,
	));

	$timeline_b = $connection->get('statuses/user_timeline', array(
		'screen_name' => 'Regulusw',
		'count' => $config['count'],
		'since_id' => $config['since_id'],
		'include_rts' => 1,
		'include_entities' => 1,
	));

	$content = array();
	
	foreach ($timeline_a as $tweet) {
		$content[$tweet['id_str']] = construct($tweet);
	}

	foreach ($timeline_b as $tweet) {
		$content[$tweet['id_str']] = construct($tweet);
	}

	krsort($content);

	echo json_encode(array_values($content));
