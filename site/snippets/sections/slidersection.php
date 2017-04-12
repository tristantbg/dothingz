<div class="gallery-cell">
	<?php 
	$image = $data->picture()->toFile();
	?>

	<img 
	src="<?= resizeOnDemand($image, 100) ?>" 
	data-flickity-lazyload="<?= resizeOnDemand($image, 1500) ?>"  
	class="lazyimg lazyload" 
	alt="<?= $page->title()->html().' — © '.$site->title()->html(); ?>" 
	width="100%" height="auto">
	<noscript>
		<img src="<?= resizeOnDemand($image, 1500) ?>" alt="<?= $page->title()->html().' - © '.$site->title()->html() ?>" width="100%" height="auto" />
	</noscript>
</div>