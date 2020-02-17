<template>
	<div>
		<b-container>
			<b-row no-gutters class="justify-content-md-center">
				<b-col sm="8">

					<add-post></add-post>
					
					<b-card
						title="First Article"
						img-src="https://picsum.photos/id/1000/600/300"
						img-alt="image"
						img-top
						tag="article"
						class="mb-2 text-center">

						<b-card-text>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel unde inventore alias explicabo maiores velit pariatur obcaecati quas, aliquid, dicta. Doloribus nemo consequuntur eaque provident rem quibusdam nostrum, dolorum modi.
						</b-card-text>

						<b-button variant="outline-secondary" size="sm">Full Article</b-button>
					</b-card>
				</b-col>
			</b-row>
		</b-container>
	</div>
</template>


<script>
	
	import { mapGetters } from 'vuex';

	export default {
		name: "Home",
		data(){
			return {

				fullname: ''
			} 
		},
		computed: {
			...mapGetters(['getName']),
		},
	}
</script>