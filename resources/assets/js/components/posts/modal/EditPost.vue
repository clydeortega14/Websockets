<template>
	<div>
		<b-modal :id="'show-edit-post-'+post.id" title="Edit Post" size="lg">
			<b-form enctype="multipart/form-data">
					
					<b-form-group label="Select File:" label-for="files" label-cols-sm="2">
		    			<b-form-file accept="image/*" id="files" ref="files" multiple :file-name-formatter="formatNames" @change="handleFileUpload"></b-form-file>
		  			</b-form-group>


		  			<b-form-group>
						<b-form-textarea rows="6" max-rows="6" id="body" placeholder="Say something about this photos..." v-model="form.body"></b-form-textarea>
					</b-form-group>

					<post-image :post="post"></post-image>
			</b-form>

			<template v-slot:modal-footer>

				<b-button type="submit" variant="primary" squared class="float-right" @click.prevent="updatedPost(post)">
					Update
				</b-button>
			</template>
		</b-modal>
	</div>
</template>

<script>
	
	import { mapActions } from 'vuex';
	import FileFormat from '../../../mixins/File.js';

	export default {
		name: "EditPost",
		created(){

			this.form.body = this.post.body
		},
		mixins: [ FileFormat ],
		props: ["post"],
		methods: {

			...mapActions(['updatePost']),

			updatedPost(post){

				let payload = {

					id: post.id,
					title: post.title,
					body: this.form.body,
					category_id: post.category_id,
					files: post.file
				}

				this.updatePost(payload);
				// console.log(post)
			}
		}

	}
</script>