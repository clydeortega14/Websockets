<template>
	<div class="modal fade modal-md" id="add-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  	<div class="modal-dialog" role="document">
		    <div class="modal-content">
		    	
		    	<div class="modal-header">
		        	<h5 class="modal-title" id="exampleModalLabel">Add new user</h5>
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">&times;</span>
		        	</button>
		    	</div>
				
				<form @submit="addUser">
					<div class="modal-body">
						<div class="form-group row">
							<label for="name" class="col-sm-4 col-form-label">Name</label>
						    <div class="col-sm-8">
						      <input type="text" v-model="name" class="form-control" placeholder="Enter Name">
						    </div>
						</div>

						<div class="form-group row">
							<label for="email" class="col-sm-4 col-form-label">Email</label>
						    <div class="col-sm-8">
						      <input type="email" v-model="email" class="form-control" placeholder="Enter Email">
						    </div>
						</div>

						<div class="form-group row">
							<label for="password" class="col-sm-4 col-form-label">Password</label>
						    <div class="col-sm-8">
						      <input type="password" v-model="password" class="form-control" placeholder="**********">
						    </div>
						</div>

						<div class="form-group row">
							<label for="confirmPass" class="col-sm-4 col-form-label">Confirm Password</label>
						    <div class="col-sm-8">
						      <input type="password" v-model="confirmPassword" class="form-control" placeholder="**********">
						    </div>
						</div>

				    </div>

				    <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-info">Save changes</button>
				    </div>
			    </form>
		    </div>
	  	</div>
	</div>
</template>


<script>
	
	export default {

		data(){

			return {

				name : '',
				email : '',
				password : '',
				confirmPassword : ''
				
			}
		},
		methods : {

			addUser(e){

				e.preventDefault();

				const newUser = {

					name : this.name, 
					email : this.email,
					password : this.password,
				}

				this.$emit('new-user', newUser);
				this.name = '';
				this.email = '';
				this.password = '';
				this.confirmPassword = '';
			}
		}


	}
</script>