<?php

	include_once('config.php');
	include_once('libs/twitter.php');
	include_once('common.php');

	$max_id = isset($_GET['max_id']) ? minus_one($_GET['max_id']) : NULL;

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

	$post_data = array(
		'screen_name' => $config['user_a'],
		'count' => $config['count'],
		'since_id' => $config['since_id'],
		'include_rts' => true,
		'include_entities' => true,
		'exclude_replies' => true,
	);

	if (!is_null($max_id)) {
		$post_data['max_id'] = $max_id;
	}

	$timeline_a = $connection->get('statuses/user_timeline', $post_data);

	$post_data['screen_name'] = $config['user_b'];

	$timeline_b = $connection->get('statuses/user_timeline', $post_data);

	$content = array();
	
	foreach ($timeline_a as $tweet) {
		$content[$tweet['id_str']] = construct($tweet);
	}

	foreach ($timeline_b as $tweet) {
		$content[$tweet['id_str']] = construct($tweet, TRUE);
	}

	krsort($content);

	echo json_encode(array_values($content));
