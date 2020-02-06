<template>
	<div>
		<b-row no-gutters class="justify-content-md-center">
			<b-col sm="6">
				<b-card header="Register Here">
					<b-card-body>
						<b-row no-gutters class="justify-content-md-center">
							<b-col>
								<ul>
									<li v-for="error in errors">
										<p class="text-danger">{{ error }}</p>
									</li>
								</ul>

								<b-form @submit.prevent="register">
									<b-form-group label="Name / Fullname:" label-for="name">
										<b-form-input id="name" v-model="form.name" placeholder="Enter your Name" :state="nameState"></b-form-input>
									</b-form-group>

									<b-form-group label="Username / Email:" label-for="username">
										<b-form-input id="username" v-model="form.email" placeholder="Enter your username / email" :state="emailState"></b-form-input>
									</b-form-group>

									<b-form-group label="Password:" label-for="input-password">
										<b-form-input id="input-password" type="password" placeholder="Enter your password" v-model="form.password" :state="passwordState"></b-form-input>
									</b-form-group>

									<b-form-group label="Confirm Password:" label-for="input-confirm-password">
										<b-form-input id="input-confirm-password" type="password" placeholder="Confirm password" v-model="form.confirm_password" :state="confirmState"></b-form-input>
									</b-form-group>

									<b-button variant="info" block type="submit">Register Now</b-button>
								</b-form>
							</b-col>
						</b-row>
					</b-card-body>
				</b-card>
			</b-col>
		</b-row>
	</div>
</template>


<script>
	export default {
		name: "Register",
		data(){

			return {

				form: {
					name: '',
					email: '',
					password: '',
					confirm_password: ''
				},
				errors: [],
			}
		},
		computed : {

			nameState(){

				return this.form.name !== '' && this.form.name.length > 5 ? true : false
			},
			emailState(){

				return this.form.email === '' ? false : true
			},
			passwordState(){

				return this.form.password !== '' && this.form.password.length > 6 ? true : false
			},
			confirmState(){

				return this.confirm_password !== '' && (this.form.password !== '' && this.form.password === this.form.confirm_password) ? true : false
			}
		},
		methods: {
			
			register(){

				this.errors = [];

				if(this.nameState === false || this.emailState === false || this.passwordState === false || this.confirmState === false){

					this.errors.push("Please check the inputed values");

				}else{

					const payload = {
						name : this.form.name,
						email: this.form.email,
						password: this.form.password
					}

					return new Promise((resolve, reject) => {

						axios.post('http://realtime.test/api/register', payload)
						.then(response => {
							let data = response.data;
							
							if(data.status === false){

								this.errors.push(data.message);
							}else{

								this.$router.push({ name: 'login'});
								resolve(response)
							}

						}).catch(error => {
							console.log(error)
							reject(error)
						});

					})

					
					
				}
				
			}
		}
	}
</script>