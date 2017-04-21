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
	<!-- <div class="spinner">
		<svg class="circular" viewBox="25 25 50 50">
		<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
		</svg>
	</div> -->
</div>

<header>
	<a href="<?= $site->url() ?>" data-target="index">
		<div id="site-title">
			<div class="full">
			<svg class="logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 121"><path class="st0" d="M23.5 6.6c17 0 24.1 1.4 31.5 6.2 11 7.1 17.3 20.5 17.3 36.8 0 14.2-4.5 25.8-12.9 33.6-8.3 7.6-15.2 9.6-33.8 9.6H0V6.6h23.5zm-5.7 70.6h7.6c10.1 0 15.7-1.4 20-5.3 5.2-4.5 8.1-12.8 8.1-22.3 0-11.2-4.1-20-11.5-24.1-4.1-2.5-9.2-3.4-17.9-3.4h-6.3v55.1zM142 64.8c0 16.8-13.4 29.2-31.6 29.2-17.9 0-31.1-12.5-31.1-29.6 0-17 13.4-29.8 31.5-29.8 17.9 0 31.2 12.8 31.2 30.2zm-45-.5c0 8.5 5.9 14.8 13.9 14.8 7.5 0 13.4-6.5 13.4-14.7 0-8.5-5.8-15-13.6-15-7.8.1-13.7 6.5-13.7 14.9zm95.3-42.2h-16.5v70.6H158V22.1h-16.6V6.6h51v15.5zm23.1 20.3c5.8-5.3 11.4-7.7 17.8-7.7 7.6 0 14.7 4.1 17.8 10.3 1.9 4 2.5 7.4 2.5 15.5v32.3h-16.9v-30c0-8.9-3.2-13.3-9.8-13.3-7.1 0-11.4 5.4-11.4 14.3v28.9h-16.9V0h16.9v42.4zm67.4-27.7c0 5.4-4.5 9.8-10.1 9.8-5.5 0-9.9-4.4-9.9-9.9s4.5-10.1 10.1-10.1c5.5 0 9.9 4.6 9.9 10.2zm-1.7 78h-16.9V35.9h16.9v56.8zm27.7-49.6c5.7-6.2 10.7-8.5 18.2-8.5 8.4 0 15.2 3.9 17.8 10.2 1.6 3.7 2.2 8.3 2.2 15.6v32.3h-16.9V62.1c0-8.8-3-12.6-9.6-12.6-3.6 0-7.1 1.5-9.2 4-1.8 2.1-2.6 4.4-2.6 8.5v30.7h-16.9V35.9h16.9v7.2zM418.4 89c0 10.8-1.8 17.3-6.3 22.6-5.2 6.3-13.4 9.4-24.7 9.4-10.3 0-19-2.8-24.1-8-3.5-3.7-5-7.5-5.8-14.5h18.8c1.3 6.1 4.8 8.6 11.4 8.6 4.8 0 9-1.9 11.4-5.3 1.8-2.7 2.5-5.7 2.5-12.1V85c-5.2 5.7-10.2 7.9-17.7 7.9-16.1 0-27.6-11.9-27.6-28.8 0-17 11.5-29.6 27.2-29.6 7.2 0 12.7 2.3 18.1 7.6v-6.3h16.9V89zm-44.6-25.2c0 8.3 6.1 14.3 14.1 14.3 8.1 0 14.3-6.2 14.3-14.2 0-8.4-6.1-14.5-14.2-14.5-8.2.1-14.2 6-14.2 14.4zm82.3-12c-1.7-3.5-3.2-4.9-5.8-4.9-2.6 0-4.8 2.2-4.8 4.9s2.1 4.3 8 6.3c7 2.3 8.4 3 11.1 4.9 3.7 2.7 5.9 7.2 5.9 12.3 0 11.1-8.8 18.7-21.6 18.7-11.1 0-17.3-4.1-21.4-14.6l13.7-4.5c2.1 4.4 4.5 6.3 8 6.3 2.7 0 4.7-1.9 4.7-4.5 0-3.1-1.2-3.9-9.2-6.5-11-3.7-15.5-8.8-15.5-17.2 0-10.6 8.8-18.5 20.8-18.5 9.4 0 15.6 4.1 19.4 12.9l-13.3 4.4zM500 83.9c0 5.3-4.4 9.7-9.8 9.7-5.3 0-9.7-4.4-9.7-9.7 0-5.4 4.4-9.8 9.8-9.8s9.7 4.3 9.7 9.8z"/></svg>
			<img class="logo fallback" src="<?= url('assets/images/dothings_logo.png') ?>" alt="<?= $site->title()->html() ?>" width="100%" height="auto" />
			<img class="logo fallback secondary" src="<?= url('assets/images/dothings_logo_g.png') ?>" alt="<?= $site->title()->html() ?>" width="100%" height="auto" />
			</div>
			<div class="small">
				<svg id="logo_s_do" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 241.9 200.6"><path class="st0" d="M37.3 16.6c27 0 38.3 2.3 50 9.8 17.4 11.3 27.5 32.6 27.5 58.4 0 22.5-7.2 41-20.5 53.3-13.1 12.1-24.2 15.2-53.7 15.2H0V16.6h37.3zm-9 112.1h12.1c16 0 25-2.3 31.8-8.4C80.3 113.1 85 100 85 84.9c0-17.8-6.6-31.8-18.2-38.3-6.6-3.9-14.5-5.3-28.5-5.3h-10v87.4zM225.4 109c0 26.6-21.3 46.3-50.2 46.3-28.5 0-49.4-19.9-49.4-46.9s21.3-47.3 50-47.3c28.5 0 49.6 20.3 49.6 47.9zm-71.5-.8c0 13.5 9.4 23.6 22.1 23.6 11.9 0 21.3-10.2 21.3-23.4 0-13.5-9.2-23.8-21.5-23.8-12.5.1-21.9 10.3-21.9 23.6z"/></svg>
				<div id="logo_s_every">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 918 200.6"><path class="st0" d="M460.6 41.2h-26.2v112.1h-28.3V41.2h-26.4V16.6h80.9v24.6zm36.7 32.2c9.2-8.4 18-12.3 28.3-12.3 12.1 0 23.4 6.6 28.3 16.4 3.1 6.4 3.9 11.7 3.9 24.6v51.2H531v-47.5c0-14.1-5.1-21.1-15.6-21.1-11.3 0-18 8.6-18 22.7v45.9h-26.8V6.2h26.8v67.2zm107-43.9c0 8.6-7.2 15.6-16 15.6s-15.8-7-15.8-15.8 7.2-16 16-16 15.8 7.2 15.8 16.2zm-2.7 123.8h-26.8V63.1h26.8v90.2zm43.8-78.7c9-9.8 17-13.5 28.9-13.5 13.3 0 24.2 6.1 28.3 16.2 2.5 5.9 3.5 13.1 3.5 24.8v51.2h-26.8v-48.6c0-13.9-4.7-20.1-15.2-20.1-5.7 0-11.3 2.5-14.5 6.4-2.9 3.3-4.1 7-4.1 13.5v48.8h-26.8V63.1h26.8v11.5zm174 72.8c0 17.2-2.9 27.5-10 35.9-8.2 10-21.3 15-39.1 15-16.4 0-30.1-4.5-38.3-12.7-5.5-5.9-8-11.9-9.2-23h29.9c2 9.6 7.6 13.7 18 13.7 7.6 0 14.3-3.1 18-8.4 2.9-4.3 3.9-9 3.9-19.3v-7.4c-8.2 9-16.2 12.5-28.1 12.5-25.6 0-43.9-18.9-43.9-45.7 0-27 18.2-46.9 43.2-46.9 11.5 0 20.1 3.7 28.7 12.1v-10h26.8v84.2zm-70.7-40c0 13.1 9.6 22.7 22.3 22.7 12.9 0 22.7-9.8 22.7-22.5 0-13.3-9.6-23-22.5-23-13.1.1-22.5 9.5-22.5 22.8zm130.5-19.1c-2.7-5.5-5.1-7.8-9.2-7.8s-7.6 3.5-7.6 7.8 3.3 6.8 12.7 10c11.1 3.7 13.3 4.7 17.6 7.8 5.9 4.3 9.4 11.5 9.4 19.5 0 17.6-13.9 29.7-34.2 29.7-17.6 0-27.5-6.6-34-23.2l21.7-7.2c3.3 7 7.2 10 12.7 10 4.3 0 7.4-3.1 7.4-7.2 0-4.9-1.8-6.1-14.5-10.2-17.4-5.9-24.6-13.9-24.6-27.3 0-16.8 13.9-29.3 33-29.3 15 0 24.8 6.6 30.7 20.5l-21.1 6.9zM24.4 41.1c-.9-3.2-.2-3.9 2.3-4.8 10.8-4.2 31.2-8.6 45.9-10.4 3.4-.5 5.6.9 6.7 3.9 1.4 3.3 2.1 5.6 2.8 8.8.5 3.5-.4 4.9-3.9 5.6-7.3 1.5-16.4 3.5-24.9 5.7-1.8 6.8-4 14.6-6.2 22.8 4-1 8-1.7 12.3-2.3 3.5-.5 5.5.1 6.9 3.1 1.4 3.1 2.5 5.9 3.1 9.1.8 3.5-.1 4.6-3.5 5.7-8.1 2.4-17.1 5-24.9 7.8-1.3 5.1-2.6 10.3-3.6 15.1 6.5-1.9 12.2-3.2 19.1-4.4 3.5-.6 5.7 0 7.1 2.9 1.6 3.3 2.7 6.1 3.3 9.3.8 3.5.1 4.7-3.4 5.8-9 2.9-19.1 6.1-27.5 9.4-5.8 2.3-8.2 1.1-10.3-.8-2.3-1.7-4.2-3.3-7.1-6.3-2.2-2.2-3.4-5.7-2.9-10.3 1.9-14.6 8.5-43.6 13.6-65.5-2.1-2.8-4-7.4-4.9-10.2zm97 83.4c-2.1 4.9-4.6 6.1-9.4 4.9-4.8-1.2-8.9-2.9-13.5-5.2-4.9-2.6-7.3-8.4-7.8-12.4-3.2-22.3-4.5-50.9-5-80.4 0-3.7.7-5.1 4.2-5.4 3.7-.3 6.5 0 9.8 1 4 1.3 6 4 6.3 8.8 1 14 1.9 38 3.6 62 9.3-24.4 18.9-51.7 27-74.5 1.2-3.3 3.7-4.2 6.9-3.1 3.2 1.2 6.3 2.7 8.9 5 2.6 2.4 2.9 4.6 1.7 9.3-5.2 19.8-22.9 66.9-32.7 90zm38.1-95.9c-.9-3.2-.2-3.9 2.3-4.8 10.8-4.2 31.2-8.6 45.9-10.4 3.4-.5 5.6.9 6.7 3.9 1.4 3.3 2.1 5.6 2.8 8.8.5 3.5-.4 4.9-3.9 5.6-7.3 1.5-16.4 3.5-24.9 5.7-1.8 6.8-4 14.6-6.2 22.8 4-1 8-1.7 12.3-2.3 3.5-.5 5.5.1 6.9 3.1 1.4 3.1 2.5 5.9 3.1 9.1.8 3.5-.1 4.6-3.5 5.7-8.1 2.4-17.1 5-24.9 7.8-1.3 5.1-2.6 10.3-3.6 15.1 6.5-1.9 12.2-3.2 19.1-4.4 3.5-.6 5.7 0 7.1 2.9 1.6 3.3 2.7 6.1 3.3 9.3.8 3.5.1 4.7-3.4 5.8-9 2.9-19.1 6.1-27.5 9.4-5.8 2.3-8.2 1.1-10.3-.8-2.3-1.7-4.2-3.3-7.1-6.3-2.2-2.2-3.4-5.7-2.9-10.3 1.9-14.6 8.5-43.6 13.6-65.5-2.1-2.8-4-7.3-4.9-10.2zm71.5 85.3c-.7 3.5-1.7 4.2-5.2 3.7-3.5-.7-6.6-1.5-9-2.9-3.1-1.8-3.6-4.1-3.2-8.6 1.7-15.1 7.6-44 12.9-67.9-1.5-2.3-3.4-5.2-4.6-7.7-1.8-3.9-1.8-5.8 1.4-8.1 15-10.3 44.7-20.8 55.4-9.8 4.3 4.5 8.4 10.3 10.4 19.3 2 8.9-1.5 16.7-7.3 23.4-5.9 6.9-14.5 14-24.4 20.1 6 8.2 15.6 19.2 22.3 25.9 2.8 2.7 2.2 4.3.1 6.5-2.5 2.5-3.9 3-6.6 4-3 1.2-6.8 1.8-11.5-2-6.6-4.9-16.9-16.3-24-26.3-2.6 10.4-4.9 20.8-6.7 30.4zm12-52.4c18.3-9 29.4-24.8 27.6-29.8-1.1-3.6-10.4-3.6-20.2 2.4-2.4 7.8-4.7 17.3-7.4 27.4zm82.7 14c-2.5 11.3-4.8 22.3-6.6 32.1-.6 3.6-1.9 4.2-5.3 3.6-3.3-.7-7.3-1.9-10.3-3.9-2.9-2-3.8-4-3.1-8.8.9-7.4 2.7-17.9 4.8-29.3-4.2-18.9-9.8-41.8-13.7-57.5-.8-3.5-.1-4.7 3.2-5.5 3.5-.8 7.5-1.3 11-.8s4.9 2.3 6.3 6.7c2.4 7.9 5.4 19.9 8.2 32.5 7.3-13.7 14.6-28.1 21.2-41.4C343-.2 344.8-.7 348 1c3.2 1.7 5.8 3.4 8 5.9 2.4 2.7 2.2 4.8.5 9.4-4.5 11.3-18.6 37.5-30.8 59.2zM38.8 200.2c94.6-27.2 191-46.1 288-62.6 11.9-2 6.8-20.1-5-18.1-97 16.5-193.4 35.4-288 62.6-11.6 3.3-6.7 21.5 5 18.1z"/></svg>
				</div>
				<svg id="logo_s_dot" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30.9 200.6"><path class="st0" d="M30.9 139.4c0 8.4-7 15.4-15.6 15.4-8.4 0-15.4-7-15.4-15.4 0-8.6 7-15.6 15.6-15.6s15.4 6.8 15.4 15.6z"/></svg>
			</div>
		</div>
	</a>
</header>

<div id="wrapper">