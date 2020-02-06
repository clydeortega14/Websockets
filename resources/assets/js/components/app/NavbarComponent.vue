<template>
	<div>
		<b-navbar toggleable="lg" type="light" variant="light">
			<b-navbar-brand href="#">Laravel Vue</b-navbar-brand>

			<b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

			<b-collapse id="nav-collapse" is-nav>
				<b-navbar-nav class="ml-auto">
					<b-nav-item :to="{ name: 'home' }">App</b-nav-item>
					<b-nav-item v-if="!loggedIn" :to="{ name: 'login' }">Login</b-nav-item>
					<b-nav-item v-if="!loggedIn" :to="{ name: 'register' }">Register</b-nav-item>
					<b-nav-item v-if="loggedIn" :to="{ name: 'logout' }">Logout</b-nav-item>
				</b-navbar-nav>
			</b-collapse>
		</b-navbar>
	</div>
</template>


<script>

	import { mapGetters } from 'vuex'

	export default {
		name: 'NavBar',
		computed: mapGetters(['loggedIn']),
	}
</script>