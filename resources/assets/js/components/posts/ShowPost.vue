<template>
	
	<div class="container">
		<div class="row justify-content-center">
			<b-col md="12">
				<add-post></add-post>
			</b-col>

			<div class="col-md-12">
				<b-card :title="post.title" v-for="post in userPosts" :key="post.id" class="mt-3">
					<b-card-text>{{ post.body }}</b-card-text>
					<br>
					<b-card-text>Posted by: {{  getName }}</b-card-text>
					<b-card-text>Published on: {{ dateSlashedFormat(post.created_at) }}</b-card-text>

					<template v-slot:footer>
						<div class="float-right">
							<b-button-group>
								<b-button variant="primary" @click="edit(post)"><i class="fa fa-edit"></i> edit</b-button>
								<b-button variant="info" :to="{ name: 'comment-post', params: { id: post.id }}"><i class="fa fa-eye"></i> show</b-button>
								<b-button variant="danger" @click="deletePost(post.id)"><i class="fa fa-trash"></i> delete</b-button>
							</b-button-group>
						</div>
					</template>
				</b-card>
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

			...mapGetters(['userPosts', 'getName']),
		},
		methods: {
			...mapActions(['deletePost']),
			edit(post){
				bus.$emit('edit-post', post)
			}
		}

	}
</script>