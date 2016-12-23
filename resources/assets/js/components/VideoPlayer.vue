<template>
	
	<video 
		id="video" 
		class="video-js vjs-default-skin vjs-big-play-centered vjs-16-9" 
		controls 
		preload="auto" 
		data-setup='{"fluid": true, "preload":"auto"}'
		v-bind:proster="thumbnailUrl"
		>
		
		<source type="video/mp4" v-bind:src="videoUrl"> </source>
	</video>

</template>


<script>
	
	import videojs from "video.js" ;

	export default {

		data() {
			return {

				player: null,
				duration: null,

			} 

		} ,

		methods: {

			hasHitQoutaView() {
				if(!this.duration) {
					return false ;
				}

				return Math.round(this.player.currentTime()) === Math.round((10 * this.duration) / 100 );
			}

		},

		props: {
			videoUid: null,
			videoUrl: null,
			thumbnailUrl: null

		} ,

		ready() {

			this.plyaer = videojs('video') ;
			this.player.on('loadedmetadata',()=> {

				this.duration = Math.round(this.player.duration() ) ;
			})
			setInterval(()=> {

				if(this.hasHitQoutaView()) {

					console.log('log a view') ;

				}

			},1000)
		}


	}
</script>