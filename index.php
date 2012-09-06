<?php

	include_once('config.php');
	include_once('libs/twitter.php');
	include_once('common.php');

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
					<a href="https://twitter.com/{{retweeted.user.screen_name}}"><img src="{{retweeted.user.avatar}}" alt=""></a>
				</div>
				<div class="tweet">{{{retweeted.text}}}</div>
				{{#if retweeted.photo}}
				<div class="photo"><img src="{{retweeted.photo}}" /></div>
				{{/if}}
				<div class="meta">
					<span class="time"><a href="https://twitter.com/{{retweeted.user.screen_name}}/status/{{retweeted.id}}" title="{{retweeted.abs_time}}">{{retweeted.rel_time}}</a></span> <span class="source">via {{{retweeted.source}}}</span>
				</div>
				<i class="retweeted"></i>
			{{else}}
				<div class="avatar">
					<a href="https://twitter.com/{{user.screen_name}}"><img src="{{user.avatar}}" alt=""></a>
				</div>
				<div class="tweet">{{{text}}}</div>
				{{#if photo}}
				<div class="photo"><img src="{{photo}}" /></div>
				{{/if}}
				<div class="meta">
					<span class="time"><a href="https://twitter.com/{{user.screen_name}}/status/{{id}}" title="{{abs_time}}">{{rel_time}}</a></span> <span class="source">via {{{source}}}</span>
				</div>
			{{/if}}
			</div>
		</li>
		{{/each}}
	</script>
</body>
</html>