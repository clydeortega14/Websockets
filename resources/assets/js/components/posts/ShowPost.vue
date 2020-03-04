<template>
	
	<div class="container">
		<div class="row justify-content-center">
			<b-col md="12">
				<add-post></add-post>
			</b-col>

			<div class="col-md-12" v-for="post in userPosts" :key="post.id">
				<b-card-group deck>
					<b-card
					:title="post.title"
					:img-src="post.file !== null ? baseUri+'/file/uploads/posts/'+post.file : 'https://picsum.photos/id/1/500/300'"
					img-alt="Image"
					img-top
					class="mt-3">
						<b-card-text>{{ post.body }}</b-card-text>
						<template v-slot:footer>
							<small class="text-muted">Posted on: {{ fullDate(post.created_at) }}</small>
						</template>
					</b-card>
					
				</b-card-group>
			</div>
		</div>
	</div>

</template>


<script>
	
	import { mapGetters, mapActions } from 'vuex';
	import DateFormat from '../../mixins/Date.js'

	export default {

		name : 'ShowPost',
		mixins: [ DateFormat ],
		computed: {

			...mapGetters(['userPosts']),
			baseUri()
			{
				return window.location.origin;
			}
		},
		methods: {
			...mapActions(['deletePost']),
			edit(post){
				bus.$emit('edit-post', post)
			}
		}

	}
</script>