<template>
	<div class="py-4">
		<b-container>
			<b-row>
				<b-col>
					<b-card no-body class="mb-3" v-for="(post, index) in getPosts" :key="index">
						<ul class="list-unstyled">
							<div class="d-flex justify-content-between">
								<div>
									<b-media tag="li" class="my-4">
										<template v-slot:aside>
											<b-img src="http://realtime.test/file/uploads/avatars/avatar-1.jpg" rounded="circle" width="50" height="50" class="ml-3"></b-img>
										</template>
										<h5 class="mt-0 mb-1">{{ post.user.name }} <br> <small class="text-muted">{{ fullDate(post.created_at) }} </small> </h5>
									</b-media>
								</div>
								<div class="mt-3 mr-4">
									<b-dropdown size="lg" variant="link" toggle-class="text-decoration-none" no-caret>
										<template v-slot:button-content>
											<i class="fas fa-ellipsis-h"></i>
										</template>

										<b-dropdown-item id="show-edit" @click="$bvModal.show('show-edit-post-'+post.id)">
											<i class="fa fa-edit"></i> 
											<span>Edit Post</span>
										</b-dropdown-item>
										<b-dropdown-item><i class="fa fa-trash"></i> <span>Delete Post</span></b-dropdown-item>
									</b-dropdown>

									<!-- EDIT POST MODAL -->
									<edit-post :post="post"></edit-post>
								</div>
							</div>
							
							<b-container>
								<b-row>
									<b-col>
										<p>{{ post.body }}</p>
									
										<post-image :post="post"></post-image>
										
										<br>
										<p v-if="post.likes.length > 0" class="text-muted"> {{ post.likes.length }}  people likes </p>
										<hr>
										<b-row class="mb-3">
											<b-col>
												<b-button type="submit" variant="light" size="sm" @click.prevent="likePost(post)">
													<i class="fa fa-thumbs-up"></i> 
													<span class="text-success">{{ post.likes.length }} likes</span>  
												</b-button> | 
												<b-button variant="light" size="sm">
													<i class="fa fa-comments"></i> 
													<span>{{ post.comments.length }} comments </span>
												</b-button>
											</b-col>
										</b-row>
										<hr>
										<!-- POST COMMENTS -->
										<post-comments :post="post"></post-comments>
									</b-col>
								</b-row>
							</b-container>
						</ul>
					</b-card>

				</b-col>
			</b-row>
		</b-container>
	</div>
</template>


<script>
	
	import { mapGetters, mapActions } from 'vuex';
	import DateFormat from '../../mixins/Date.js'
	import FileFormat from '../../mixins/File.js'

	export default {
		name : 'ShowPost',
		mixins: [ DateFormat, FileFormat ],
		computed: {

			...mapGetters(['getPosts', 'getUser']),
			
		},
		methods: {
			...mapActions(['deletePost', 'getAllPosts']),
			likePost(post)
			{
				axios.post('/api/like', { post_id : post.id })
				.then(response => {
					let data = response.data;

					if(data.status === false){
						post.likes = data.post.likes
					}else{

						post.likes.push(data.like)
					}
				})
				.catch(error => console.log(error))
			}
		},
		created(){

			this.getAllPosts()
		}

	}
</script>