<section id="featured-projects" class="animated contained">

<?php foreach ($page->featuredImages()->toStructure() as $key => $image): ?>

		<img class="featured-item lazyimg" src="<?= resizeOnDemand($image->toFile(), 2500) ?>" width="100%" height="auto">

<?php endforeach ?>
	
</section>
