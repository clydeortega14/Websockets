<template>
	<div class="py-4">
		<b-container>
			<b-row>
				<b-col sm="3">
					<b-card no-body>
						<b-card-body>
							<div>
								<b-img src="http://realtime.test/file/uploads/avatars/avatar-1.jpg" alt="image" rounded center></b-img>
							</div>
						</b-card-body>

						<b-list-group flush>
							<b-list-group-item href="#">
								<i class="fa fa-user"></i> Info
							</b-list-group-item>
							<b-list-group-item href="#">
								<i class="fa fa-users"></i> Friends ( 64 )
							</b-list-group-item>
							<b-list-group-item href="#">
								<i class="fa fa-comments"></i> Posts ( {{ userPosts.length }} )
							</b-list-group-item>
						</b-list-group>
					</b-card>
				</b-col>

				<b-col sm="9">
					
					<div class="d-flex justify-content-between">
						<div><h3>{{ getUser.name}}</h3></div>
						<div><b-button variant="light" size="sm"><i class="fa fa-edit"></i> Edit Profile </b-button></div>
					</div>

					<div>
						<p class="text-muted">
							<i class="fa fa-calendar"></i> Born on December 14, 1996 
							<i class="fa fa-school"></i> Went to Ipaglaban Elementary School 
							<i class="fa fa-heart"></i> Married
						</p>
					</div>
					<div>
						<b-img src="https://picsum.photos/1024/150/?image=40" fluid alt="banner" class="mb-3"></b-img>
					</div>
					<hr>
					<b-row class="mb-3">
						<b-col sm="12">
							<b-button-group>
						    	<b-button variant="light">
						    		<i class="fa fa-address-book"></i>
						    		<span>Status</span>
						    	</b-button>

						    	<b-button variant="light" id="show-btn" @click="$bvModal.show('bv-modal-example')">
						    		<i class="fa fa-camera"></i>
						    		<span>Photo</span>
						    	</b-button>

						    	<b-button variant="light" id="show-btn" @click="$bvModal.show('bv-modal-example')">
						    		<i class="fa fa-video"></i>
						    		<span>Video</span>
						    	</b-button>

						    	<b-modal id="bv-modal-example" hide-footer>
								    <template v-slot:modal-title>
								      	Update new post
								    </template>
								    <div class="d-block text-center">
								      <h3>Hello From This Modal!</h3>
								    </div>
								    <b-button class="mt-3" block @click="$bvModal.hide('bv-modal-example')">Close Me</b-button>
							 	</b-modal>

						    </b-button-group>
						</b-col>
					</b-row>
					<hr>
					<b-row class="mb-3">	
						<b-col sm="12">
							<b-form>
								<b-form-group>
									<b-form-textarea placeholder="Whats on your mind?"></b-form-textarea>
								</b-form-group>

								<b-button variant="primary" class="float-right" squared size="md">Post</b-button>
							</b-form>
						</b-col>
					</b-row>

					<b-card no-body class="mb-3" v-for="(post, index) in userPosts" :key="index">
						<ul class="list-unstyled">
							<b-media tag="li" class="my-4">
								<template v-slot:aside>
									<b-img src="http://realtime.test/file/uploads/avatars/avatar-1.jpg" rounded="circle" width="50" height="50" class="ml-3"></b-img>
								</template>
								<h5 class="mt-0 mb-1">{{ getUser.name }} <br> <small class="text-muted">{{ fullDate(post.created_at) }} </small> </h5>
							</b-media>
							
							<b-container>
								<b-row>
									<b-col>
										<h5>{{ post.title }}</h5>
										<div>
											<b-img :src="post.file !== null ? 'http://realtime.test/file/uploads/posts/'+post.file : 'https://picsum.photos/1024/400/?image=41'" fluid alt="Responsive image" class="mb-3"></b-img>
										</div>
										<p>{{ post.body }}</p>
										<br>
										<p v-if="post.likes.length > 0" class="text-muted"> {{ post.likes.length }} people likes </p>
										<hr>
										<b-row class="mb-3">
											<b-col>
												<b-button type="submit" variant="light" size="sm" @click.prevent="likePost(post)"><i class="fa fa-thumbs-up"></i> <span class="text-success">{{ post.likes.length }}</span> likes </b-button> | 
												<b-button variant="light" size="sm"><i class="fa fa-comments"></i> {{ post.comments.length }} comments </b-button>
											</b-col>
										</b-row>
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
	
	import { mapGetters, mapActions } from 'vuex'
	import DateFormat from '../../mixins/Date.js'

	export default {

		name: "Profile",
		data(){
			return {
				likes: 0
			}
		},
		mixins: [ DateFormat ],
		computed: {
			...mapGetters(['userPosts', 'getUser'])
		},
		methods: {
			...mapActions(['likePost'])
		}
	}
</script>