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
			<li class="spine">
				<a href="#" title="This is the Spine of Facebook Timline. You can Add Custom Events here"></a>
			</li>
			<li class="left">
				<i class="pointer"></i>
				<div class="content">
					<div class="story">
						<div class="profile">
							<a href="#"><img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-snc4/186035_897940273_1597318_q.jpg" width="32" height="32" alt=""></a>
							<div class="meta">
								<h4><a href="#">Vinay</a></h4>
								<p>20 hours ago via Twitter</p>
							</div>
										
						</div>
						<p> Just wow.. Harry potter and voldemort at #London2012 opening</p>
					</div>
					<ol class="actions">
						<li><a href="#">Like</a></li>
						<li><a href="#">Comment</a></li>
						<li><a href="#">@artminister on Twitter</a></li>
					</ol>
				</div>
			</li>
			<li class="highlight">
				<i class="pointer"></i>
				<div class="content">
					<div class="story">
						<div class="profile">
							<a href="#"><img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-snc4/186035_897940273_1597318_q.jpg" width="32" height="32" alt=""></a>
							<div class="meta">
								<h4><a href="#">Vinay</a></h4>
								<p>20 hours ago via Twitter</p>
							</div>
						</div>
						<p><strong>A highlighted story</strong></p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>
					<ol class="actions">
						<li><a href="#">Like</a></li>
						<li><a href="#">Comment</a></li>
						<li><a href="#">@artminister on Twitter</a></li>
					</ol>
				</div>
			</li>
			<li class="right">
				<i class="pointer"></i>
				<div class="content">
					<div class="story">
						<div class="profile">
							<a href="#"><img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-snc4/186035_897940273_1597318_q.jpg" width="32" height="32" alt=""></a>
							<div class="meta">
								<h4><a href="#">Vinay</a></h4>
								<p>20 hours ago via Twitter</p>
							</div>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
						<div class="photo">
							<img src="https://fbcdn-sphotos-a.akamaihd.net/hphotos-ak-ash3/c38.0.403.403/p403x403/148491_10150317604135274_5316342_n.jpg" alt="">
						</div>
					</div>
					<ol class="actions">
						<li><a href="#">Like</a></li>
						<li><a href="#">Comment</a></li>
						<li><a href="#">@artminister on Twitter</a></li>
					</ol>
				</div>
			</li>
			<li class="left">
				<i class="pointer"></i>
				<div class="content">
					<div class="story">
						<div class="profile">
							<a href="#"><img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-snc4/186035_897940273_1597318_q.jpg" width="32" height="32" alt=""></a>
							<div class="meta">
								<h4><a href="#">Vinay</a></h4>
								<p>20 hours ago via Twitter</p>
							</div>
						</div>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
						<p>laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					</div>
					<ol class="actions">
						<li><a href="#">Like</a></li>
						<li><a href="#">Comment</a></li>
						<li><a href="#">@artminister on Twitter</a></li>
					</ol>
				</div>
			</li>
		</ol>
	</div>
	
	<script src="http://lib.sinaapp.com/js/jquery/1.8/jquery.min.js"></script>
	<script src="handlebars.js"></script>
	<script src="script.js"></script>
	<script id="entry-template" type="text/x-handlebars-template">
		<li class="{{position}}}">
			<i class="pointer"></i>
			<div class="content">
				<div class="story">
					<div class="profile">
						<a href="#"><img src="{{user.avatar}}" alt=""></a>
						<div class="meta">
							<h4><a href="#">{{user.screen_name}}</a></h4>
							<p>20 hours ago via {{{source}}}</p>
						</div>
									
					</div>
					<p>{{text}}</p>
				</div>
				<ol class="actions">
					<li><a href="#">Like</a></li>
					<li><a href="#">Comment</a></li>
					<li><a href="#">@artminister on Twitter</a></li>
				</ol>
			</div>
		</li>
	</script>
</body>
</html>