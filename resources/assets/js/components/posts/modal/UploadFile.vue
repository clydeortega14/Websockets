<template>
	<div>
		<b-modal id="bv-modal-example" title="Upload Here" size="lg" hide-footer>
			<b-form enctype="multipart/form-data" @submit.prevent="submitPost">
				<!-- upload file form -->
				<b-form-group label="Select File:" label-for="files" label-cols-sm="2">
	    			<b-form-file accept="image/*" id="files" ref="files" multiple :file-name-formatter="formatNames" @change="handleFileUpload"></b-form-file>
	  			</b-form-group>

	  			<b-container fluid class="p-4" v-if="form.files.length > 0">
					<b-row>
						<b-col sm="12">
							<b-form-group>
								<b-form-textarea rows="6" max-rows="6" id="body" placeholder="Say something about this photos..." v-model="form.body"></b-form-textarea>
							</b-form-group>
						</b-col>

				    	<b-col v-for="(image, index) in images" :key="index" v-if="images.length !== 0">
				    		<b-img thumbnail fluid :src="image" alt="Image 2" height="100" width="100"></b-img>
				    	</b-col>
					</b-row>
					<br>
					<hr>
					<b-button type="submit" variant="primary" squared size="sm" class="float-right">
						<i class="fa.fa-check"></i>
						<span> Post </span>
					</b-button>
				</b-container>
			</b-form>
	 	</b-modal>
	</div>
</template>

<script>
	
	import { mapActions } from 'vuex';

	export default {
		data(){
			return {
				form: {
					files: [],
					body: ''
				},
				images: []
			}
		},
		methods: {
			...mapActions(['addPost']),
			formatNames(files){

				if(files.length === 1){
					return files[0].name
				}else{
					return files.length + ' files selected'
				}
			},
			handleFileUpload(e){

				let uploadFiles = e.target.files;
				
				for(let i = 0; i < uploadFiles.length; i++){
					this.form.files.push(uploadFiles[i])

					const file = URL.createObjectURL(uploadFiles[i])
					this.images.push(file)
				}
			},
			submitPost()
			{
				let formData = new FormData();

				for(let i = 0; i < this.form.files.length; i++){
					formData.append('files[]', this.form.files[i], this.form.files[i].name)
				}

				formData.append('title', 'Post Title')
				formData.append('body', this.form.body)
				formData.append('category_id', 1)

				this.addPost(formData)
			},
			getPreviewImage()
			{
				this.form.files.forEach((file, index) => {

					if(/\.(jpe?g|png|gif)$/i.test(file.name)){
						let reader = new FileReader()

						reader.onload = (e) => {
							this.$refs['image'+parseInt(index)][0].src = e.target.result
						}
						reader.readAsDataURL(file)
					}
				})
			}
		}
	}
</script>