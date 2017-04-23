<section class="video-section">

	<?php 
	if ($data->videoexternal()->isNotEmpty()) {
		echo '<video class="js-player" poster="'.e($data->videoposter()->isNotEmpty(), $data->videoposter()).'" controls loop><source src="' . $data->videoexternal()  . '" type="video/mp4"></video>';
	}
	else if ($data->videofile()->isNotEmpty()) {
		echo '<video class="js-player" poster="'.e($data->videoposter()->isNotEmpty(), $data->videoposter()).'" controls loop><source src="' . $data->videofile()->toFile()->url()  . '" type="video/mp4"></video>';
	} else {
		$url = $data->videourl();
		$headers = get_headers('https://www.youtube.com/oembed?format=json&url=http://www.youtube.com/watch?v=' . $url);
		if(is_array($headers) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/',$headers[0]) : false) {
		// is youtube
			$videoID = $url;
			echo '<div class="js-player" data-type="youtube" data-video-id="' . $videoID  . '"></div>';
		} else {
		// should be vimeo
			$videoID = $url;
			echo '<div class="js-player" data-type="vimeo" data-video-id="' . $videoID  . '"></div>';
		}
	}

	?>
	
</section>