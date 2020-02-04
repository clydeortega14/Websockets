<template>
	<div class="row">
		<div class="col-md-12">
			<h3>Users Lists</h3>
			<table class="table table-striped table-bordered">
				<thead>
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Registered</th>
							<th>Action</th>
						</tr>
					</thead>
				</thead>
				<tbody>
					<tr v-for="user in users" v-bind:key="user.id">
						<td>{{ user.id}}</td>
						<td>{{ user.name }}</td>
						<td>{{ user.email }}</td>
						<td>{{ user.created_at }}</td>
						<td>

							<b-button
								variant="info" 
								size="sm"
								v-b-modal.my-modal
								@click="showUser(user.id)"
								>
								<i class="fas fa-eye"></i>
							</b-button> |

							<button @click="$emit('del-user', user.id)" class="btn btn-danger btn-sm">
								<i class="fas fa-trash"></i>
							</button>
						</td>
					</tr>

					<b-modal
						id="my-modal"
						title="Edit User"
						size="md"
						no-fade
						ref="ref-modal"
						@ok="handleOk">

						<b-form>

							<b-form-group 

								id="input-group-1" 
								label="Name" 
								label-for="name">

								<b-form-input 
									id="email" 
									v-model="user.name" 
									type="text" 
									required 
									placeholder="Enter Name">
									
								</b-form-input>

							</b-form-group>

							<b-form-group 

								id="input-group-2" 
								label="Email" 
								label-for="email" 
								description="We'll never share your email with anyone else">

								<b-form-input 
									id="email"  
									v-model="user.email" 
									type="text" 
									required 
									placeholder="Enter Email">
										
								</b-form-input>

							</b-form-group>
						</b-form>

						<template v-slot:modal-footer="{ ok, cancel }">
					      
					      <b-button size="md" variant="danger" @click="cancel()">
					        Cancel
					      </b-button>

					      <!-- Emulate built in modal footer ok and cancel button actions -->
					      <b-button size="md" variant="info" @click="ok()" ref="btnEdit">
					        Save Changes
					      </b-button>
					    </template>
					</b-modal>
				</tbody>
			</table>
		</div>
	</div>

</template>

<script>
	
	export default {

		props : ["users"],
		data(){

			return {

				user : {

					id : '',
					name : '',
					email : '',
				}
			}
		},
		methods : {

			showUser(id){

				axios.get(`/api/user/${id}`)
					.then(res => {
						this.user.id = res.data.data.id;
						this.user.name = res.data.data.name;
						this.user.email = res.data.data.email;
					})
					.catch(error => console.log(error))
			},
			handleOk(){
				this.handleSubmit()
			},
			handleSubmit(){

				const newUser = {

					id : this.user.id,
					name : this.user.name,
					email : this.user.email
				}

				this.$emit('update-user', newUser)
				this.$root.$emit('bv::hide::modal', 'my-modal', '#btnEdit');
			}
		}
	}
</script>