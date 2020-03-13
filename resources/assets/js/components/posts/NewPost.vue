<template>
	<div class="py-4">
		<b-container>
			<b-row>
				<b-col>
					<div>
						<b-img src="https://picsum.photos/1024/250/?image=985" fluid-grow alt="banner" class="mb-3"></b-img>
					</div>
					<hr>
					<b-row class="mb-3">
						<b-col sm="12">
							<b-button-group>

						    	<b-button variant="light">
						    		<i class="fa fa-address-book"></i>
						    		<span>Status</span>
						    	</b-button>

						    	<b-button variant="light" id="show-btn" @click="$bvModal.show('bv-modal-example')">
						    		<i class="fa fa-camera"></i>
						    		<span>Photo</span>
						    	</b-button>

						    	<b-button variant="light" id="show-btn" @click="$bvModal.show('bv-modal-example')">
						    		<i class="fa fa-video"></i>
						    		<span>Video</span>
						    	</b-button>

						    	<upload-file></upload-file>

						    </b-button-group>
						</b-col>
					</b-row>
					<hr>
					<b-row class="mb-3">	
						<b-col sm="12">
							<b-form>
								<b-form-group>
									<b-form-textarea placeholder="Whats on your mind?"></b-form-textarea>
								</b-form-group>

								<b-button variant="primary" class="float-right" squared size="md">Post</b-button>
							</b-form>
						</b-col>
					</b-row>
				</b-col>
			</b-row>
		</b-container>
	</div>
</template>

<script>
	
	export default {

		name: 'NewPost'
	}
</script>