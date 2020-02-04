<template>
	<div>
		<b-row no-gutters class="justify-content-md-center">
			<b-col sm="6">
				<b-card header="Register Here">
					<b-card-body>
						<b-row no-gutters class="justify-content-md-center">
							<b-col>
								<b-form @submit.prevent="register">
									<b-form-group label="Name / Fullname:" label-for="name">
										<b-form-input id="name" v-model="form.name" required placeholder="Enter your Name"></b-form-input>
									</b-form-group>

									<b-form-group label="Username / Email:" label-for="username">
										<b-form-input id="username" v-model="form.username" required placeholder="Enter your username / email"></b-form-input>
									</b-form-group>

									<b-form-group label="Password:" label-for="input-password">
										<b-form-input id="input-password" type="password" placeholder="Enter your password" v-model="form.password" required></b-form-input>
									</b-form-group>

									<b-form-group label="Confirm Password:" label-for="input-confirm-password">
										<b-form-input id="input-confirm-password" type="password" placeholder="Confirm password" v-model="form.confirm_password" required></b-form-input>
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
					username: '',
					password: '',
					confirm_password: ''
				}
			}
		},
		methods: {

			register(){
				console.log('register')
			}
		}
	}
</script>