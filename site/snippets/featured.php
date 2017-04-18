<section id="featured-projects">

<?php foreach ($page->featuredProjects()->toStructure() as $key => $p): ?>

	<?php $project = page($projectsPage.'/'.$p->fp()) ?>
	
	<?php if($project && $project->featured()->isNotEmpty()): ?>
	<?php $image = $project->featured() ?>
	<?php if($p->fpimage()->isNotEmpty()) $image = $p->fpimage() ?>

		<div class="featured-item lazyimg" data-flickity-bg-lazyload="<?= resizeOnDemand($image->toFile(), 3000) ?>">
			<div class="cta-button">
				<div class="contained">
					<a class="<?= $p->fpcolor() ?>" href="<?= $project->url() ?>" data-title="<?= $project->title()->html() ?>" data-target="page">
					<?php
					if ($p->fptext()->isNotEmpty()) {
						echo "<h3>".$p->fptext()->html()."</h3>";
					} else {
						echo "<h3>".$project->title()->html()."</h3>";
					}
					?>
					<span class="explore"><?= c::get('vars.explore') ?></span>
					</a>
				</div>
				
			</div>
		</div>

	<?php endif ?>

<?php endforeach ?>

<div class="clone cta-button"></div>
	
</section>
