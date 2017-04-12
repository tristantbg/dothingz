<section class="image-section">

	<?php 
	$image = $data->picture()->toFile();
	$srcset = '';
	for ($i = 500; $i <= 2500; $i += 500) $srcset .= resizeOnDemand($image, $i) . ' ' . $i . 'w,';
	?>

	<img 
	src="<?= resizeOnDemand($image, 100) ?>" 
	data-src="<?= resizeOnDemand($image, 1500) ?>" 
	data-srcset="<?= $srcset ?>" 
	data-sizes="auto" 
	data-optimumx="1.5" 
	class="lazyimg lazyload" 
	alt="<?= $page->title()->html().' — © '.$site->title()->html(); ?>" 
	width="100%" height="auto">
	<noscript>
		<img src="<?= resizeOnDemand($image, 1500) ?>" alt="<?= $page->title()->html().' - © '.$site->title()->html() ?>" width="100%" height="auto" />
	</noscript>
	
</section>