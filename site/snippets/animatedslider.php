<section id="featured-projects" class="animated contained">

<?php foreach ($page->featuredImages()->toStructure() as $key => $image): ?>

		<div class="featured-item lazyimg" style="background-image: url(<?= resizeOnDemand($image->toFile(), 2500) ?>)"></div>

<?php endforeach ?>
	
</section>
