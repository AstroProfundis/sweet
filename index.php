<?php

	require_once('config.php');
	require_once('libs/twitter.php');
	require_once('common.php');

	/*
	$connection = new TwitterOAuth($config['consumer_key'], $config['consumer_secret'], $config['access_token'], $config['access_token_secret']);

	$user_a = $connection->get('users/show', array(
		'screen_name' => 'NetPuter',
	));

	$user_b = $connection->get('users/show', array(
		'screen_name' => 'Regulusw',
	));
	*/

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sweet</title>
	<link href="style.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<body class="index">
	<div class="container">
		<ol class="timeline clearfix">
			
		</ol>
	</div>
	
	<script src="http://lib.sinaapp.com/js/jquery/1.8/jquery.min.js"></script>
	<script src="handlebars.js"></script>
	<script src="script.js"></script>
	<script id="entry-template" type="text/x-handlebars-template">
		{{#each this}}
		<li class="{{position}}}">
			<i class="pointer"></i>
			<div class="content">
			{{#if retweeted}}
				<div class="avatar">
					<a href="#"><img src="{{retweeted.user.avatar}}" alt=""></a>
				</div>
				<div class="tweet">{{retweeted.text}}</div>
				<div class="meta">
					<span class="time" title="{{retweeted.abs_time}}">{{retweeted.rel_time}}</span> <span class="source">via {{{source}}}</span>
				</div>
				<i class="retweeted"></i>
			{{else}}
				<div class="avatar">
					<a href="#"><img src="{{user.avatar}}" alt=""></a>
				</div>
				<div class="tweet">{{text}}</div>
				<div class="meta">
					<span class="time" title="{{abs_time}}">{{rel_time}}</span> <span class="source">via {{{source}}}</span>
				</div>
			{{/if}}
			</div>
		</li>
		{{/each}}
	</script>
</body>
</html>