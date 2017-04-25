<?php snippet('header') ?>

<div id="container">

<div id="page-content" class="project-page" data-id="<?= $page->hash() ?>">

<section class="contained lead">
	<?php echo $page->text()->kirbytext() ?>
</section>

</div>

<?php snippet('footer') ?>

</div>