<template>
	<div>
		<b-container>
			<b-row no-gutters class="justify-content-md-center">
				<b-col sm="6">
					<b-card header="Login Here">
						<b-card-body>
							<b-row no-gutters class="justify-content-md-center">
								<b-col>
									<b-form @submit.prevent="login">
										<b-form-group label="Username / Email:" label-for="username">
											<b-form-input id="username" v-model="form.username" required placeholder="Enter your username / email"></b-form-input>
										</b-form-group>

										<b-form-group label="Password:" label-for="input-password">
											<b-form-input id="input-password" type="password" placeholder="Enter your password" v-model="form.password" required></b-form-input>
										</b-form-group>

										<b-button variant="info" block type="submit">Login</b-button>
									</b-form>
								</b-col>
							</b-row>
						</b-card-body>
					</b-card>
				</b-col>
			</b-row>
		</b-container>
	</div>
</template>

<script>
	
	import { mapActions } from 'vuex';

	export default {
		name: 'LoginComponent',
		data(){

			return {

				form: {

					username: '',
					password: '',
				}
			}
		},
		methods: {
			...mapActions(['retrieveToken']),
			login(){

				let payload = {

					username : this.form.username,
					password: this.form.password
				}

				this.retrieveToken(payload);

				this.form.username = ''
				this.form.password = ''
			}
		}
	}
</script>