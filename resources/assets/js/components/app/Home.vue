<template>
	<div>
		<b-container>
			<b-row no-gutters class="justify-content-md-center">
				<h2>Welcome, {{ getName }}</h2>
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