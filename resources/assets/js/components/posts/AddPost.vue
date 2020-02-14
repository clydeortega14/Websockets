<template>
	<div>
		<b-form @submit.prevent="addNewPost">
			<b-form-group
				label="Title"
				label-for="title">
				<b-form-input id="title" v-model="form.title" placeholder="Enter Title"></b-form-input>
			</b-form-group>


			<b-form-group
				label="Body"
				label-for="body">
				
				<b-form-textarea id="body" v-model="form.body" placeholder="Enter body" rows="6" max-rows="6"></b-form-textarea>
			</b-form-group>
			
			<div class="float-right">
				<b-button type="submit" variant="success">Submit</b-button>
				<b-button variant="danger">Cancel</b-button>
			</div>
		</b-form>
	</div>
</template>

<script>

	import { mapActions } from 'vuex'

	export default {
		name:"AddPost",
		data(){
			return {
				form: {
					id: null,
					title: '',
					body: ''
				},
				mode: 'creating',
			}
		},
		mounted(){

			bus.$on('edit-post', data => {
				
				this.mode = 'updating'
				this.form.id = data.id
				this.form.title = data.title,
				this.form.body = data.body
			})
		},
		methods: {
			...mapActions(['addPost', 'updatePost']),
			addNewPost(){

				if(this.mode === 'creating'){

					this.addPost({
						title: this.form.title,
						body: this.form.body
					})

				}else if(this.mode === 'updating'){
					
					this.updatePost({

						id: this.form.id,
						title: this.form.title,
						body: this.form.body
					})

					this.form.id = null,
					this.mode = 'creating'
				}

				this.form.title = ''
				this.form.body = ''
				
			}
		}
	}
</script>