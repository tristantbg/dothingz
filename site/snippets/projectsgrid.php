<section id="projects">

<?php foreach ($projects as $key => $project): ?>

	<?php if($project->featured()->isNotEmpty()): ?>
	<?php $image = $project->featured() ?>

	<div class="project-item col-1-3">
		<a href="<?= $project->url() ?>" data-title="<?= $project->title()->html() ?>" data-target="page">
			<img class="lazyimg lazyload lazypreload" data-srcset="<?= $image->toFile()->focusCrop(500,300)->url() ?> 500w, <?= $image->toFile()->focusCrop(1000,600)->url() ?> 1000w" data-optimumx="1.5" data-sizes="auto" alt="<?= $project->title()->html().' - © '.$site->title()->html() ?>">
			<h2><?= $project->title()->html() ?></h2>
			<p class="item-description">
				<?= $project->text()->html() ?>
			</p>
		</a>
	</div>

	<?php endif ?>

<?php endforeach ?>
	
</section>
