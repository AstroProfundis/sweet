<?php

	include_once('config.php');
	include_once('libs/twitter.php');
	include_once('common.php');

	$max_id = isset($_GET['max_id']) ? minus_one($_GET['max_id']) : NULL;
	$content = array();

	/*
		if (!is_null($max_id)) {
			echo json_encode(array());exit;
		}
		
		$data = json_decode(file_get_contents('data_1.json'), TRUE);

		foreach ($data as $tweet) {
			$content[$tweet['id_str']] = construct($tweet);
		}

		$data = json_decode(file_get_contents('data_2.json'), TRUE);

		foreach ($data as $tweet) {
			$content[$tweet['id_str']] = construct($tweet, TRUE);
		}

		krsort($content);

		response(array_values($content));
	*/

	$connection = new TwitterOAuth($config['consumer_key'], $config['consumer_secret'], $config['access_token'], $config['access_token_secret']);

	$post_data = array(
		'scree1n_name' => $config['user_a'],
		'count' => $config['count'],
		'since_id' => $config['since_id'],
		'include_rts' => true,
		'include_entities' => true,
		'exclude_replies' => true,
	);

	if (!is_null($max_id)) {
		$post_data['max_id'] = $max_id;
	}

	$timeline = $connection->get('statuses/user_timeline', $post_data);

	if (isset($timeline['error'])) {
		response(array(
			'error' => $timeline['error'],
		), 404);
	}

	if (!empty($timeline)) {
		foreach ($timeline as $tweet) {
			$content[$tweet['id_str']] = construct($tweet);
		}
	}

	$post_data['screen_name'] = $config['user_b'];

	$timeline = $connection->get('statuses/user_timeline', $post_data);

	if (isset($timeline['error'])) {
		response(array(
			'error' => $timeline['error'],
		), 404);
	}

	if (!empty($timeline)) {
		foreach ($timeline as $tweet) {
			$content[$tweet['id_str']] = construct($tweet, TRUE);
		}
	}

	krsort($content);

	response(array_values($content));
