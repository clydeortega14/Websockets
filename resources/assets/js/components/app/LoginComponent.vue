<template>
	<div>
		<b-container>
			<b-row no-gutters class="justify-content-md-center">
				<b-col sm="6">
					<b-card no-body class="login">
						<b-card-body>
							<b-row no-gutters class="justify-content-md-center">
								<b-col>
									<b-form @submit.prevent="login">
										<b-form-group label="Username / Email:" label-for="username">
											<b-form-input id="username" v-model="form.username" required placeholder="Enter your username / email" autocomplete></b-form-input>
										</b-form-group>

										<b-form-group label="Password:" label-for="input-password">
											<b-form-input id="input-password" type="password" placeholder="Enter your password" v-model="form.password" required autocomplete></b-form-input>
										</b-form-group>

										<b-button variant="info" block type="submit" squared>Login</b-button>
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
			login(){
				let payload = {
					grant_type: 'password',
					client_id: 7,
					client_secret: 'RELUu5x3T7UTW9dMNpBsyrkpFlpFqWcPX7uThIZE',
					username: this.form.username,
					password: this.form.password
				}

				axios.post('http://realtime.test/api/login', payload)
					.then(response => {

						console.log(response.data.user_data.user)
						
						this.$store.commit('setAccessToken', response.data.user_data.token.access_token)
						this.$store.commit('setUser', response.data.user_data.user)
						// this.$store.commit('setUserPosts', response.data.user_data.user_posts)

						this.$router.push({ name: 'home' })
						
					}).catch(error => console.log(error))
			}
		}
	}
</script>

<style scoped>
	.login {

		margin: 50px auto;
		margin-top: 100px;
	}

</style>