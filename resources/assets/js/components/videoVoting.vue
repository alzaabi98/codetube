<template>
	
	<div class="video__voting">
		<a href="#" class="video__voting-button">

			<span class="glyphicon glyphicon-thumbs-up"></span>
			
		</a> 1 &nbsp;

		<a href="#" class="video__voting-button">

			<span class="glyphicon glyphicon-thumbs-down"></span>
			
		</a> 1
	</div>


</template>


<script>
	
	export default {

		data() {

			return {
				up: null,
				down:null,
				userVote: null,
				canVote: false,
			}
		} ,

		props: {

			videoUid : null
		}
	}
</script>