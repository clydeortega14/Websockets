<template>
	<div>
		<b-container>
			<b-row no-gutters>
				<b-col md="12">
					<h1>{{ post.title }}</h1>
					by <span class="text-success">{{ post.user.name }}</span>
					<hr>
					<p>Posted on {{ fullDate(post.created_at) }}</p>
					<hr>
					<img src="https://picsum.photos/id/1/1100/300" alt="..." class="rounded">
					<hr>
					<p>{{ post.body }}</p>
				</b-col>
				
				<b-col md="12">
					<hr>
					<h3>Comments</h3>
					<br>
					<ul class="list-unstyled">
						<b-media tag="li" v-for="comment in getComments" :key="comment.id">
							<template v-slot:aside>
								<img class="mr-2 mb-3 rounded-circle" src="http://placeimg.com/50/50" alt="...">
							</template>
							<span class="mt-0 mb-1">{{ comment.user.name }}</span>
							<p>
								<small class="text-muted mr-2">{{ relativeDate(comment.created_at) }}</small> <br>	
								<span class="mb-0">{{ comment.comment }}</span>
							</p>
						</b-media>
					</ul>

					<b-form @submit.prevent="add">
						<b-form-group
							label-for="comment">
							
							<b-form-textarea id="comment" v-model="form.comment" placeholder="Enter your comment here..." rows="4" max-rows="6"></b-form-textarea>
						</b-form-group>

						<b-button type="submit" variant="primary">Add Comment</b-button>
					</b-form>
				</b-col>
			</b-row>
		</b-container>
	</div>
</template>

<script>
	
	import { mapGetters, mapActions } from 'vuex'
	import DateFormat from '../../mixins/Date.js'

	export default {
		name: "CommentPost",
		mixins: [ DateFormat ],
		data(){
			return { 

				post: {},
				form: {
					comment: ''
				}
			}
		},
		computed: {
			...mapGetters(['getComments']),
		},
		created(){
			//GET SINGLE POST
			this.getPost(this.$route.params.id).then(res => {
				this.post = res
				
			})
			// GET POST COMMENTS
			this.fetchComments(this.$route.params.id)
		},
		methods: {
			...mapActions(['fetchComments', 'addComment', 'getPost']),
			add(){

				let payload = {
					id: this.$route.params.id,
					comment: this.form.comment
				}

				this.addComment(payload)
				this.form.comment = ''
			}
		},

	}
</script>