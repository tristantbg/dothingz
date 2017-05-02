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

	<div class="project-item">
		<a href="<?= $project->url() ?>" data-title="<?= $project->title()->html() ?>" data-target="page">
			<?php 
			$srcset = '';
			if ($image->isLandscape()) {
				$src = thumb($image, array('width' => 100, 'height' => 100*$ratio, 'crop' => true))->url();
				$datasrc = thumb($image, array('width' => 1500, 'height' => 1500*$ratio, 'crop' => true))->url();
				for ($i = 500; $i <= 1500; $i += 500) $srcset .= thumb($image, array('width' => $i, 'height' => $i*$ratio, 'crop' => true))->url() . ' ' . $i . 'w,';
			} else {
				$src = thumb($image, array('width' => 100, 'height' => 100/$ratio, 'crop' => true))->url();
				$datasrc = thumb($image, array('width' => 1500, 'height' => 1500/$ratio, 'crop' => true))->url();
				for ($i = 500; $i <= 1500; $i += 500) $srcset .= thumb($image, array('width' => $i, 'height' => $i/$ratio, 'crop' => true))->url() . ' ' . $i . 'w,';
			}
			
			?>

			<img 
			src="<?= $src ?>" 
			data-src="<?= $datasrc ?>" 
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


<?php endforeach ?>
	
</section>
