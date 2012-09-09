<?php include_once('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $config['user_a']; ?> &hearts; <?php echo $config['user_b']; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	<link href="style.css" media="screen" rel="stylesheet" type="text/css" />
	<link rel="apple-touch-icon" href="img/touch-icon.png" />
</head>
<body class="index">
	<div class="container">
		<header class="head">
			<h1>Sweet Timeline</h1>
			<span class="between">between <a href="https://twitter.com/<?php echo $config['user_a']; ?>"><?php echo $config['user_a']; ?></a> <i>&hearts;</i> <a href="https://twitter.com/<?php echo $config['user_b']; ?>"><?php echo $config['user_b']; ?></a></span>
			<span class="since">since <i><?php echo $config['since_time']; ?></i></span>
			<a href="https://github.com/netputer/sweet" class="fork"><img src="img/fork.png" alt="Fork me on GitHub" /></a>
		</header>
		<section class="content">
			<ol class="timeline clearfix" id="timeline">

			</ol>
			<div class="loader" id="loader"></div>
		</section>
	</div>
	
	<script src="jquery.min.js"></script>
	<script src="handlebars.js"></script>
	<script src="script.js"></script>
	<script id="entry-template" type="text/x-handlebars-template">
		{{#each this}}
		<li class="{{position}}}" data-id="{{id}}">
			<i class="pointer"></i>
			<div class="content">
			{{#if retweeted}}
				<div class="avatar">
					<a href="https://twitter.com/{{retweeted.user.screen_name}}" title="@{{retweeted.user.screen_name}}"><img src="{{retweeted.user.avatar}}" alt=""></a>
				</div>
				<div class="text">{{{retweeted.text}}}</div>
				{{#if retweeted.photo}}
				<div class="photo"><img src="{{retweeted.photo}}" /></div>
				{{/if}}
				<div class="meta">
					<span class="time"><a href="https://twitter.com/{{retweeted.user.screen_name}}/status/{{retweeted.id}}" title="{{retweeted.abs_time}}">{{retweeted.rel_time}}</a></span> <span class="source">via {{{retweeted.source}}}</span>
				</div>
				<i class="retweeted"></i>
			{{else}}
				<div class="avatar">
					<a href="https://twitter.com/{{user.screen_name}}" title="@{{user.screen_name}}"><img src="{{user.avatar}}" alt=""></a>
				</div>
				<div class="text">{{{text}}}</div>
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