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
					username: this.form.username,
					password: this.form.password
				}

				axios.post('http://realtime.test/api/login', payload)
					.then(response => {
						this.$store.commit('setAccessToken', response.data.user_data.token.access_token)
						this.$store.commit('setName', response.data.user_data.user.name)
						this.$store.commit('setUser', response.data.user_data.user)
						this.$store.commit('setUserPosts', response.data.user_data.user.posts)

						this.$router.push({ name: 'posts'})
						
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