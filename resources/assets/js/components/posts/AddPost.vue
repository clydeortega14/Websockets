<template>
	<div class="py-4">

		<b-form @submit.prevent="addNewPost" enctype="multipart/form-data">
			<b-card class="mb-5">
				<b-form-group
					label="Categories"
					label-for="category_id">
					<b-form-select v-model="form.category_id" :options="allCategories"></b-form-select>
					
				</b-form-group>

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

				<div class="form-group">
					<input type="file" ref="file" id="file" @change="handleFileUpload">
				</div>
				<br>
				<div v-if="this.form.file !== '' ">
					<img :src="this.form.file" alt="..." width="300" height="300" class="img-circle">
				</div>

				<div class="float-right">
					<button type="submit" class="btn btn-primary">Create</button>
					<button type="button" class="btn btn-danger">Cancel</button>
				</div>
			</b-card>
		</b-form>
	</div>
</template>

<script>

	import { mapActions, mapGetters } from 'vuex'

	export default {
		name:"AddPost",
		data(){
			return {
				form: {
					id: null,
					category_id: null,
					title: '',
					body: '',
					file: ''
				},
				mode: 'creating',
			}
		},
		computed: mapGetters(['allCategories']),
		created(){
			this.getCategories()
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
			...mapActions(['addPost', 'updatePost', 'getCategories']),
			handleFileUpload(e){

				// this.form.file = this.$refs.file.files[0]
				//create new instance of file reader
				var fileReader = new FileReader()
				//read file reader as Data URL
				fileReader.readAsDataURL(e.target.files[0])
				//when the file reader loads
				fileReader.onload = (e) => {
					//assign the form.file to the event target result
					this.form.file = e.target.result
				}
			},
			addNewPost(){
				
				let formData = new FormData()
				formData.append('category_id', this.form.category_id)
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