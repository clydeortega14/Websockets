<template>
	<div>
		<b-container>
			<b-row>
				<b-col>
					<b-form @submit.prevent="addNewComment">

						<b-form-group>
							<b-form-textarea placeholder="Add a comment" v-model="form.comment"></b-form-textarea>
						</b-form-group>

						<b-button type="submit" size="md" variant="primary" squared class="float-right">Comment</b-button>
					</b-form>
				</b-col>
			</b-row>
		</b-container>
	</div>
</template>

<script>
	
	export default {
		name: "AddComment",
		data(){

			return {

				form: {
					comment: ''
				}
			}
		},
		props: ["post"],
		methods: {
			addNewComment(){
				axios.post(`${window.location.origin}/api/post/${this.post.id}/comment`, {
					comment: this.form.comment
				}).then(response => {

					this.post.comments.push(response.data)
				})
				.catch(error => console.log(error))
				this.form.comment = '';
			}
		}
	}
</script>