<template>
	
	<video id="video" class="video-js vjs-default-skin vjs-big-play-centered vjs-16-9" controls preload="auto" data-setup='{"fluid": true, "preload":"auto"}'>
		<source type="video/mp4"> </source>
	</video>

</template>


<script>
	
	export default {

		props: {
			videoUid: null,
			videoUrl: null,
			thumbnailUrl: null,

		}


	}
</script>