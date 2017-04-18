<section id="intro">

	<?php if(false)://if($projectsPage->recenttoggle()->bool()): ?>
		<?php
		$recentProject = $pages->find($projectsPage.'/'.$projectsPage->recentproject());

		if ($projectsPage->recentimage()->isNotEmpty()) {
			$recentImage = $projectsPage->recentimage()->toFile();
		}
		elseif ($recentProject && $recentProject->featured()->isNotEmpty()) {
			$recentImage = $recentProject->featured()->toFile();
		}
		?>
		<?php if(isset($recentImage)): ?>
		<div class="recent-project <?= $projectsPage->recentcolor() ?>">
			<a href="<?= $recentProject->url() ?>" data-title="<?= $recentProject->title()->html() ?>" data-target="page">
				<img class="lazyimg lazyload lazypreload" data-src="<?= $recentImage->focusCrop(600, 500)->url() ?>" width="100%" height="auto">
				<div class="cta-button">
					<h3>Recent Project</h3>
					<span class="explore"><?= c::get('vars.explore') ?></span>
				</div>
			</a>
		</div>
		<?php endif ?>

	<?php endif ?>

	<div class="intro-text center">
		
		<div class="lead">
			<?= $site->tagline()->kt() ?>
		</div>
		<div class="small my">
			<?= $site->description()->kt() ?>
		</div>
		<div class="readmore" event-target="footer"></div>

	</div>
	
</section>
