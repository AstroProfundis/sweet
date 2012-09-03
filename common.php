<?php

	/**
	 * Construct single Sweet, transform from Twitter API
	 * @param array $tweet
	 * @param boolean $position (left: FALSE, right: TRUE)
	 * @return array
	 */
	function construct($tweet, $position = FALSE) {

		// Basic Structure
		$output = array(
			'position' => $position ? 'right' : 'left',
			'id' => $tweet['id_str'],
			'created_at' => $tweet['created_at'],
			'text' => $tweet['text'],
			'source' => $tweet['source'],
			'user' => array(
				'screen_name' => $tweet['user']['screen_name'],
				'name' => $tweet['user']['name'],
				'avatar' => $tweet['user']['profile_image_url'],
			),
			
			'retweeted' => NULL,
			'geo' => $tweet['geo'],
			'photo' => NULL,
		);

		// Replace links
		if (!empty($tweet['entities']['urls'])) {
			$u_search = array();
			$u_replace = array();

			foreach ($tweet['entities']['urls'] as $u) {
				$u_search[] = $u['url'];
				$u_replace[] = $u['expanded_url'];
			}

			$output['text'] = str_replace($u_search, $u_replace, $tweet['text']);
		}

		// Construct retweeted status
		if (isset($tweet['retweeted_status'])) {
			$output['retweeted'] = construct($tweet['retweeted_status'], TRUE);
		}

		return $output;

	}

