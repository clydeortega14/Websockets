<template>
	<div>

		<b-form @submit.prevent="addNewPost" enctype="multipart/form-data">
			<b-card header="add new post" header-tag="header" footer-tag="footer" class="mb-5">
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

				<template v-slot:footer>
					<label>
						<i class="fa fa-camera"></i> Add Photo
						<input type="file" ref="file" id="file" style="visibility:hidden;" @change="handleFileUpload">
					</label>
					<div class="float-right">
						<b-button type="submit" variant="light">Submit</b-button>
						<b-button variant="light">Cancel</b-button>
					</div>
				</template>
			</b-card>
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
					body: '',
					file: ''
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
			handleFileUpload(){
				this.form.file = this.$refs.file.files[0]
			},
			addNewPost(){


				let formData = new FormData()
				formData.append('title', this.form.title)
				formData.append('body', this.form.body)
				formData.append('file', this.form.file)

				if(this.mode === 'creating'){

					this.addPost(formData)

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
				this.form.file = ''
				
			}
		}
	}
</script>