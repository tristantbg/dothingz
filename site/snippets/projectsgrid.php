<section id="projects">

<div class="gutter-sizer"></div>
<div class="grid-sizer"></div>

<?php
$index = 1; 
$hps = $projectsPage->highlightedprojects()->toStructure();
$hpArr = [];
foreach ($hps as $key => $hp) {
	array_push($hpArr, $hp->hpposition());
}
?>

<?php foreach ($projects as $key => $project): ?>

	<?php $highlight = array_search( strval($index), $hpArr ); ?>

	<?php if(strval($highlight) != ''): ?>

	<?php $hproject = page($projectsPage.'/'.$hps->nth($highlight)->hp()) ?>

	<div class="project-item highlight">
		<a href="<?= $hproject->url() ?>" data-title="<?= $hproject->title()->html() ?>" data-target="page">
			<div class="overlay">
				<div class="inner">
					<h2><?= $hproject->title()->html() ?></h2>
					<?php if($hproject->categories()->isNotEmpty()): ?>

					<div class="project-categories">
						<?php foreach ($hproject->categories()->split(',') as $key => $cat): ?>
							<span><?= ucfirst ($cat) ?></span>
						<?php endforeach ?>
					</div>

					<?php endif ?>
					<p class="item-description">
						<?= $hproject->text()->html() ?>
					</p>
				</div>
			</div>
		</a>
	</div>

	<?php endif ?>

	<?php if($project->featured()->isNotEmpty()): ?>

	<div class="project-item">
		<a href="<?= $project->url() ?>" data-title="<?= $project->title()->html() ?>" data-target="page">
			<?php 
			$image = $project->featured()->toFile();
			$srcset = '';
			for ($i = 500; $i <= 2000; $i += 500) $srcset .= resizeOnDemand($image, $i) . ' ' . $i . 'w,';
			?>

			<img 
			src="<?= resizeOnDemand($image, 100) ?>" 
			data-src="<?= resizeOnDemand($image, 1500) ?>" 
			data-srcset="<?= $srcset ?>" 
			data-sizes="auto" 
			data-optimumx="1.5" 
			class="lazyimg lazyload lazypreload" 
			alt="<?= $project->title()->html().' — © '.$site->title()->html(); ?>" 
			width="100%" height="auto">
			<div class="overlay">
				<div class="inner">
					<h2><?= $project->title()->html() ?></h2>
					<?php if($project->categories()->isNotEmpty()): ?>

					<div class="project-categories">
						<?php foreach ($project->categories()->split(',') as $key => $cat): ?>
							<span><?= ucfirst ($cat) ?></span>
						<?php endforeach ?>
					</div>

					<?php endif ?>
				</div>
			</div>
		</a>
	</div>

	<?php endif ?>

	<?php $index++ ?>

<?php endforeach ?>
	
</section>
