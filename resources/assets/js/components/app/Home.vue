<template>
	<div>
		<b-container>
			<b-row no-gutters class="justify-content-md-center">
				<b-col sm="8">
					<b-card v-for="post in allPost" :key="post.id"
						:title="post.title"
						img-src="https://picsum.photos/id/1/600/300"
						img-alt="image"
						img-top
						tag="article"
						class="mb-3 ml-3">

						<b-card-text>{{ post.body.substr(0, 200) }}</b-card-text>

						<b-button variant="primary" :to="{ name: 'comment-post', params: { id: post.id }}" size="sm">Read More <i class="fa fa-arrow-right"></i></b-button>

						<template v-slot:footer>
							<div class="d-flex justify-content-between">
								<div>	
									<p>Posted on {{ fullDate(post.created_at) }} by <a href="#">{{ post.user.name }}</a></p>
								</div>
								<div>
									<b-button variant="light" size="sm"><i class="fa fa-thumbs-up"></i> like </b-button> |
									<b-button variant="light" size="sm"><i class="fa fa-comments"></i> comments</b-button>
								</div>
							</div>
						</template>
					</b-card>
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