<section class="images-section">

	<?php 
	$thumb = 1500;
	$image = $data->picture()->toFile();
	$srcset = '';
	$cropratio = $data->cropratio();
	$ratio = explode('_', $cropratio);
	if ($cropratio != 'original') {
		$src = $image->focusCrop($thumb, (intval($ratio[1])/intval($ratio[0]))*$thumb)->url();
		//for ($i = 500; $i <= 2500; $i += 500) $srcset .= $image->focusCrop($i, (intval($ratio[1])/intval($ratio[0]))*$i)->url() . ' ' . $i . 'w,';
	} else {
		$src = resizeOnDemand($image, $thumb);
		for ($i = 500; $i <= 2500; $i += 500) $srcset .= resizeOnDemand($image, $i) . ' ' . $i . 'w,';

	}

	$image2 = $data->picture2()->toFile();
	$srcset2 = '';
	if ($cropratio != 'original') {
		$src2 = $image2->focusCrop($thumb, (intval($ratio[1])/intval($ratio[0]))*$thumb)->url();
		//for ($i = 500; $i <= 2500; $i += 500) $srcset2 .= $image2->focusCrop($i, (intval($ratio[1])/intval($ratio[0]))*$i)->url() . ' ' . $i . 'w,';
	} else {
		$src2 = resizeOnDemand($image2, $thumb);
		for ($i = 500; $i <= 2500; $i += 500) $srcset2 .= resizeOnDemand($image2, $i) . ' ' . $i . 'w,';

	}
	?>
	
	<div class="span-1-2">
		<img 
		data-src="<?= $src ?>" 
		data-srcset="<?= $srcset ?>" 
		data-sizes="auto" 
		data-optimumx="1.5" 
		class="lazyimg lazyload lazypreload" 
		alt="<?= $page->title()->html().' — © '.$site->title()->html(); ?>" 
		width="100%" height="auto">
		<noscript>
			<img src="<?= resizeOnDemand($image, 1500) ?>" alt="<?= $page->title()->html().' - © '.$site->title()->html() ?>" width="100%" height="auto" />
		</noscript>
	</div>

	<div class="span-1-2">
		<img 
		data-src="<?= $src2 ?>" 
		data-srcset="<?= $srcset2 ?>" 
		data-sizes="auto" 
		data-optimumx="1.5" 
		class="lazyimg lazyload lazypreload" 
		alt="<?= $page->title()->html().' — © '.$site->title()->html(); ?>" 
		width="100%" height="auto">
		<noscript>
			<img src="<?= resizeOnDemand($image2, 1500) ?>" alt="<?= $page->title()->html().' - © '.$site->title()->html() ?>" width="100%" height="auto" />
		</noscript>
	</div>
	
</section>