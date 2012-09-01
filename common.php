<?php

	/**
	 * 按要求将 Twiiter API 构建为 Sweet 所需格式
	 * @param array $tweet
	 * @param boolean $is_retweet
	 * @return array
	 */
	function construct($tweet, $is_retweet = FALSE) {

		$output = array(
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

		if (!empty($tweet['entities']['urls'])) {
			$u_search = array();
			$u_replace = array();

			foreach ($tweet['entities']['urls'] as $u) {
				$u_search[] = $u['url'];
				$u_replace[] = $u['expanded_url'];
			}

			$output['text'] = str_replace($u_search, $u_replace, $tweet['text']);
		}

		if ($is_retweet === FALSE && isset($tweet['retweeted_status'])) {
			$output['retweeted'] = construct($tweet['retweeted_status'], TRUE);
		}

		return $output;

	}
