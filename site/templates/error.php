<?php snippet('header') ?>

<div id="container">

<div id="page-content" class="project-page" data-id="<?= $page->hash() ?>">

<section class="contained lead center">
	<?php echo $page->text()->kirbytext() ?>
	<a href="<?= $site->url() ?>" data-target="index"><h5>Go back to projects</h5></a>
</section>

</div>

</div>

<?php snippet('footer') ?>