<?php snippet('header') ?>

<div id="container">

<div id="page-content" class="project-page">

<div class="contained">
	
	<div id="project-infos" class="cf center">
		<h1><?= $page->title()->html() ?></h1>
		
		<?php if($page->categories()->isNotEmpty()): ?>

		<div class="project-categories">
			<?php foreach ($page->categories()->split(',') as $key => $cat): ?>
				<span><?= ucfirst ($cat) ?></span>
			<?php endforeach ?>
		</div>

		<?php endif ?>

		<?php if($page->readmore()->isNotEmpty()): ?>

			<div class="project-description readmore" event-target="readmore">
				<?= $page->text()->kt() ?>
				<div class="project-readmore">
					<?= $page->readmore()->kt() ?>
				</div>
			</div>

		<?php else: ?>

			<div class="project-description">
				<?= $page->text()->kt() ?>
			</div>

		<?php endif ?>
	</div>

	<div id="project-content" class="cf">

		<?php $sliderStart = false ?>
		
		<?php foreach($page->builder()->toStructure() as $section): ?>

			<?php if($section->_fieldset() == 'slidersection' && !$sliderStart): ?>
				<section class="slider-section">
				<?php $sliderStart = true ?>
			<?php elseif($sliderStart && $section->_fieldset() != 'slidersection'): ?>
				</section>
				<?php $sliderStart = false ?>
			<?php endif ?>

			<?php if($section->new()->bool()): ?>
				</section>
				<section class="slider-section">
				<?php $sliderStart = true ?>
			<?php endif ?>

			<?php snippet('sections/' . $section->_fieldset(), array('data' => $section)) ?>
			

		<?php endforeach ?>

	</div>

</div>

</div>

</div>

<?php snippet('footer') ?>