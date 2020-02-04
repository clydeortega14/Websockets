<template>
	<div>
		<b-navbar toggleable="lg" type="light" variant="light">
			<b-navbar-brand href="#">Laravel Vue</b-navbar-brand>

			<b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

			<b-collapse id="nav-collapse" is-nav>
				<b-navbar-nav class="ml-auto">
					<b-nav-item><router-link to="/">Login</router-link></b-nav-item>
					<b-nav-item><router-link to="/register">Register</router-link></b-nav-item>
				</b-navbar-nav>
			</b-collapse>
		</b-navbar>
	</div>
</template>


<script>
	export default {
		name: 'NavBar'
	}
</script>