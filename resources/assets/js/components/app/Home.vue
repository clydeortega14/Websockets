<template>
	<div>
		<b-jumbotron>
		    <template v-slot:header>BloggiFy</template>

		    <template v-slot:lead>
		      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit aut deleniti distinctio praesentium doloremque ipsam. Nisi illum modi, nobis! Beatae nihil repellendus dolorum ut similique dicta culpa recusandae soluta molestias!
		    </template>

		    <hr class="my-4">

		    <p>
		      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio fugit tempore natus, eum. Iure quam beatae aperiam ad ea fugiat quod neque, praesentium provident dicta suscipit fugit, aliquid dignissimos possimus?
		    </p>

		    <b-button variant="primary" href="#">Do Something</b-button>
		    <b-button variant="success" href="#">Do Something Else</b-button>
		</b-jumbotron>
		
		<b-container fluid>
			<b-row>
				<b-col v-for="post in allPost" :key="post.id" sm="4" class="h-100">
					<!-- <b-card
						:title="post.title"
						class="mb-3 ml-3">

						<img :src="post.file !== null ? baseUri+'/file/uploads/posts/'+post.file : 'https://picsum.photos/id/1/600/300'" alt="..." class="img-fluid mx-auto d-block">

						<b-card-text>{{ post.body.substr(0, 200) }}</b-card-text>

						<b-button variant="primary" :to="{ name: 'comment-post', params: { id: post.id }}" size="sm">Read More <i class="fa fa-arrow-right"></i></b-button>

						<template v-slot:footer>
							<div class="d-flex justify-content-between">
								<div>	
									<p>Posted on {{ fullDate(post.created_at) }} by <a href="#">{{ post.user.name }}</a></p>
								</div>
								<div>
									<b-button variant="light" size="sm"><i class="fa fa-thumbs-up"></i> 0 Likes </b-button> |
									<b-button variant="light" size="sm"><i class="fa fa-comments"></i> {{ post.comments.length }} Comments </b-button>
								</div>
							</div>
						</template>
					</b-card> -->
				</b-col>
			</b-row>
		</b-container>
	</div>
</template>


<script>
	
	import { mapGetters } from 'vuex';
	import DateFormat from '../../mixins/Date.js'

	export default {
		name: "Home",
		mixins: [ DateFormat ],
		data(){
			return {

				fullname: '',
				allPost: []
			} 
		},
		computed: {
			...mapGetters(['getName']),
			baseUri()
			{
				return window.location.origin;
			}
		},
		created(){
			this.getAllPost()
		},
		methods: {
			getAllPost(){

				axios.get('api/post-all')
				.then(res => {
					this.allPost = res.data
				})
				.catch(error => console.log(error))
			}
		}
	}
</script>