<?php

	date_default_timezone_set('Asia/Shanghai');

	/**
	 * Construct single Sweet, transform from Twitter API
	 * @param array $tweet
	 * @param boolean $position (left: FALSE, right: TRUE)
	 * @return array
	 */
	function construct($tweet, $position = FALSE) {

		// Display time
		$current = strtotime($tweet['created_at']);

		$date_format = date('z', $current) === date('z', time()) ? 'G:i' : 'j M';

		if (date('Y', $current) !== date('Y', time())) {
			$date_format .= ' y';
		}

		// Basic Structure
		$output = array(
			'position' => $position ? 'right' : 'left',
			'id' => $tweet['id_str'],
			'rel_time' => date($date_format, $current),
			'abs_time' => date('G:i - j M y', $current),
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

		// Detect Twitter photos
		if (!empty($tweet['entities']['media'])) {
			foreach ($tweet['entities']['media'] as $m) {
				$output['photo'] = $m['media_url'];

				$output['text'] = str_replace($m['url'], NULL, $output['text']);
			}
		}

		// Replace links and detect Instagram photos
		if (!empty($tweet['entities']['urls'])) {
			$u_search = array();
			$u_replace = array();

			foreach ($tweet['entities']['urls'] as $u) {
				$u_search[] = $u['url'];
				$u_replace[] = '<a href="'.$u['expanded_url'].'">'.$u['display_url'].'</a>';

				if (preg_match_all('#instagr\.am\/p\/([_-\d\w]+)#i', $u['expanded_url'], $matches, PREG_PATTERN_ORDER) > 0) {
					foreach ($matches[1] as $match) {
						$output['photo'] = sprintf('http://instagr.am/p/%s/media/?size=l', $match);
					}
				}
			}

			$output['text'] = trim(str_replace($u_search, $u_replace, $tweet['text']));
		}

		// Construct retweeted status
		if (isset($tweet['retweeted_status'])) {
			$output['retweeted'] = construct($tweet['retweeted_status'], TRUE);
		}

		return $output;

	}

	/**
	 * Minus one from Twitter ID
	 * @param string $id
	 * @return string
	 */
	function minus_one($id) {
		$last = strlen($id) - 1;
		$id[$last] = $id[$last] - 1;
		return $id;
	}