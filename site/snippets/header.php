<!DOCTYPE html>
<html lang="en" class="no-js">
<head>

	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="dns-prefetch" href="//www.google-analytics.com">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="canonical" href="<?php echo html($page->url()) ?>" />
	<?php if($page->isHomepage()): ?>
		<title><?= $site->title()->html() ?></title>
	<?php else: ?>
		<title><?= $page->title()->html() ?> | <?= $site->title()->html() ?></title>
	<?php endif ?>
	<?php if($page->isHomepage()): ?>
		<?php if($site->seo()->empty()): ?>
			<meta name="description" content="<?= $site->description()->html() ?>">
		<?php else: ?>
			<meta name="description" content="<?= $site->seo()->html() ?>">
		<?php endif ?>
	<?php else: ?>
		<meta name="DC.Title" content="<?= $page->title()->html() ?>" />
		<?php if($page->text()->isNotEmpty()): ?>
			<meta name="description" content="<?= $page->text()->excerpt(250) ?>">
			<meta name="DC.Description" content="<?= $page->text()->excerpt(250) ?>"/ >
			<meta property="og:description" content="<?= $page->text()->excerpt(250) ?>" />
		<?php else: ?>
			<meta name="description" content="">
			<meta name="DC.Description" content=""/ >
			<meta property="og:description" content="" />
		<?php endif ?>
	<?php endif ?>
	<meta name="robots" content="index,follow" />
	<meta name="keywords" content="<?= $site->keywords()->html() ?>">
	<?php if($page->isHomepage()): ?>
		<meta itemprop="name" content="<?= $site->title()->html() ?>">
		<meta property="og:title" content="<?= $site->title()->html() ?>" />
	<?php else: ?>
		<meta itemprop="name" content="<?= $page->title()->html() ?> | <?= $site->title()->html() ?>">
		<meta property="og:title" content="<?= $page->title()->html() ?> | <?= $site->title()->html() ?>" />
	<?php endif ?>
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?= html($page->url()) ?>" />
	<?php if($page->content()->name() == "project"): ?>
		<?php if ($page->featured()->isNotEmpty()): ?>
			<meta property="og:image" content="<?= resizeOnDemand($page->image($page->featured()), 1200) ?>"/>
		<?php endif ?>
	<?php else: ?>
		<?php if($site->ogimage()->isNotEmpty()): ?>
			<meta property="og:image" content="<?= $site->ogimage()->toFile()->width(1200)->url() ?>"/>
		<?php endif ?>
	<?php endif ?>
	
	<?php if($site->seo()->empty()): ?>
		<meta itemprop="description" content="<?= $site->description()->html() ?>">
	<?php else: ?>
		<meta itemprop="description" content="<?= $site->seo()->html() ?>">
	<?php endif ?>
	
	<!-- <link rel="shortcut icon" href="<?php //url('assets/images/favicon.ico') ?>">
	<link rel="icon" href="<?php //url('assets/images/favicon.ico') ?>" type="image/x-icon"> -->

	<?php 
	echo css('assets/css/build/build.min.css');
	echo js('assets/js/vendor/modernizr.min.js');
	?>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?= url('assets/js/vendor/jquery.min.js') ?>">\x3C/script>')</script>

	<?php if(!$site->customcss()->empty()): ?>
		<style type="text/css">
			<?php echo $site->customcss()->html() ?>
		</style>
	<?php endif ?>

</head>
<body class="<?php e($page->isHomePage(), 'home', 'page') ?>">

<div id="outdated">
	<div class="inner">
	<p class="browserupgrade">You are using an <strong>outdated</strong> browser.
	<br>Please <a href="http://outdatedbrowser.com" target="_blank">upgrade your browser</a> to improve your experience.</p>
	</div>
</div>

<div class="loader">
	<div class="spinner">
		<svg class="circular" viewBox="25 25 50 50">
		<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
		</svg>
	</div>
</div>

<header>
	<a href="<?= $site->url() ?>" data-target="index">
		<div id="site-title">
			<svg class="logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 121"><path class="st0" d="M23.5 6.6c17 0 24.1 1.4 31.5 6.2 11 7.1 17.3 20.5 17.3 36.8 0 14.2-4.5 25.8-12.9 33.6-8.3 7.6-15.2 9.6-33.8 9.6H0V6.6h23.5zm-5.7 70.6h7.6c10.1 0 15.7-1.4 20-5.3 5.2-4.5 8.1-12.8 8.1-22.3 0-11.2-4.1-20-11.5-24.1-4.1-2.5-9.2-3.4-17.9-3.4h-6.3v55.1zM142 64.8c0 16.8-13.4 29.2-31.6 29.2-17.9 0-31.1-12.5-31.1-29.6 0-17 13.4-29.8 31.5-29.8 17.9 0 31.2 12.8 31.2 30.2zm-45-.5c0 8.5 5.9 14.8 13.9 14.8 7.5 0 13.4-6.5 13.4-14.7 0-8.5-5.8-15-13.6-15-7.8.1-13.7 6.5-13.7 14.9zm95.3-42.2h-16.5v70.6H158V22.1h-16.6V6.6h51v15.5zm23.1 20.3c5.8-5.3 11.4-7.7 17.8-7.7 7.6 0 14.7 4.1 17.8 10.3 1.9 4 2.5 7.4 2.5 15.5v32.3h-16.9v-30c0-8.9-3.2-13.3-9.8-13.3-7.1 0-11.4 5.4-11.4 14.3v28.9h-16.9V0h16.9v42.4zm67.4-27.7c0 5.4-4.5 9.8-10.1 9.8-5.5 0-9.9-4.4-9.9-9.9s4.5-10.1 10.1-10.1c5.5 0 9.9 4.6 9.9 10.2zm-1.7 78h-16.9V35.9h16.9v56.8zm27.7-49.6c5.7-6.2 10.7-8.5 18.2-8.5 8.4 0 15.2 3.9 17.8 10.2 1.6 3.7 2.2 8.3 2.2 15.6v32.3h-16.9V62.1c0-8.8-3-12.6-9.6-12.6-3.6 0-7.1 1.5-9.2 4-1.8 2.1-2.6 4.4-2.6 8.5v30.7h-16.9V35.9h16.9v7.2zM418.4 89c0 10.8-1.8 17.3-6.3 22.6-5.2 6.3-13.4 9.4-24.7 9.4-10.3 0-19-2.8-24.1-8-3.5-3.7-5-7.5-5.8-14.5h18.8c1.3 6.1 4.8 8.6 11.4 8.6 4.8 0 9-1.9 11.4-5.3 1.8-2.7 2.5-5.7 2.5-12.1V85c-5.2 5.7-10.2 7.9-17.7 7.9-16.1 0-27.6-11.9-27.6-28.8 0-17 11.5-29.6 27.2-29.6 7.2 0 12.7 2.3 18.1 7.6v-6.3h16.9V89zm-44.6-25.2c0 8.3 6.1 14.3 14.1 14.3 8.1 0 14.3-6.2 14.3-14.2 0-8.4-6.1-14.5-14.2-14.5-8.2.1-14.2 6-14.2 14.4zm82.3-12c-1.7-3.5-3.2-4.9-5.8-4.9-2.6 0-4.8 2.2-4.8 4.9s2.1 4.3 8 6.3c7 2.3 8.4 3 11.1 4.9 3.7 2.7 5.9 7.2 5.9 12.3 0 11.1-8.8 18.7-21.6 18.7-11.1 0-17.3-4.1-21.4-14.6l13.7-4.5c2.1 4.4 4.5 6.3 8 6.3 2.7 0 4.7-1.9 4.7-4.5 0-3.1-1.2-3.9-9.2-6.5-11-3.7-15.5-8.8-15.5-17.2 0-10.6 8.8-18.5 20.8-18.5 9.4 0 15.6 4.1 19.4 12.9l-13.3 4.4zM500 83.9c0 5.3-4.4 9.7-9.8 9.7-5.3 0-9.7-4.4-9.7-9.7 0-5.4 4.4-9.8 9.8-9.8s9.7 4.3 9.7 9.8z"/></svg>
			<img class="logo fallback" src="<?= url('assets/images/dothings_logo.png') ?>" alt="<?= $site->title()->html() ?>" width="100%" height="auto" />
			<img class="logo fallback secondary" src="<?= url('assets/images/dothings_logo_g.png') ?>" alt="<?= $site->title()->html() ?>" width="100%" height="auto" />
		</div>
	</a>
</header>

<div id="wrapper">