<section id="projects" class="contained">

<div class="gutter-sizer"></div>
<div class="grid-sizer"></div>

<?php
$ratio = 2/3;
$projects = $projectsPage->globalorder()->toStructure();
?>

	<?php foreach ($projects as $key => $entry): ?>
	<?php $project = page($projectsPage.'/'.$entry->project()->value());
		  if($project) {
			  $image = $project->featured()->toFile();
			  if ($entry->featuredimage()->isNotEmpty()) {
			  	$image = $projectsPage->image($entry->featuredimage()->value());
			  }
			} else {
				$image = false;
				echo '<h2 class="center">'.ucfirst($entry->project()->value()).' ID was not found.</h2>';
			}
	?>

	<?php if($entry->videofile()->isNotEmpty()): ?>

		<?php if($video = $entry->videofile()->toFile()): ?>

		<div class="project-item video">
			<video autoplay autobuffer loop>
				<source src="<?= $video->url() ?>" type="video/mp4">
			</video>
		</div>

		<?php endif ?>

	<?php elseif($project && $entry->highlight()->bool()): ?>

	<div class="project-item highlight">
		<a href="<?= $project->url() ?>" data-title="<?= $project->title()->html() ?>" data-target="page">
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
					<p class="item-description">
						<?= $project->text()->html() ?>
					</p>
				</div>
			</div>
		</a>
	</div>

	<?php elseif($image): ?>

	<?php 
	$srcset = '';
	if ($image->isLandscape()) {
		$datasrc = thumb($image, array('width' => 1000, 'height' => 1000*$ratio, 'crop' => true))->url();
	} else {
		$datasrc = thumb($image, array('width' => 1000, 'height' => 1000/$ratio, 'crop' => true))->url();
	}
	
	?>

	<div class="project-item<?php e($image->isLandscape(), ' landscape') ?> lazyimg lazyload lazypreload" data-bg="<?= $datasrc ?>">

		<a href="<?= $project->url() ?>" data-title="<?= $project->title()->html() ?>" data-target="page">
			
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


<?php endforeach ?>
	
</section>
