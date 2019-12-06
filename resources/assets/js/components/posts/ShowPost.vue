<template>
	
		<b-form>
			<b-form-input
				type="hidden"
				id="post-id"
			>
				
			</b-form-input>


			<b-form-group>
				<b-form-textarea
					id="comment-body"
					name="body"
					v-model="commentBox"
					placeholder="Enter Your Comment">

				</b-form-textarea>
			</b-form-group>

		</b-form>

</template>


<script>
	export default {

		data(){

			return {

				comments : {},
				commentBox : '',
				user : ''
			}
		}
	}
</script>