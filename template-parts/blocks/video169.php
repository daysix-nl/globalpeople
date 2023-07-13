<div class="video169">
	<div class="thumbnail">
		<img class="thumb" src="<?=get_field('video_thumbnail')['sizes']['medium_large']?>" alt="video thumbnail">
		<button class="playVideo">
			<img src="/wp-content/uploads/2021/01/play-icon-red.svg" alt="play icon">
		</button> 
	</div>
	<div class="video">
		<?php if ( get_field('video_iframe') ) { ?>
			<iframe class="videoSrc" 
				data-src="<?=get_field('video_iframe')?>" frameborder="0" 
				allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
			</iframe>
		<?php } ?>

		<?php if ( get_field('video_upload') ) { ?>
			<video controls class="videoSrc" data-src="<?=get_field('video_upload')['url']?>"> </video>
		<?php } ?>

	</div> 
</div>

