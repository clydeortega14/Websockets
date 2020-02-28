<template>
	<div>
		<b-navbar toggleable="lg" type="light" variant="light">
			<b-navbar-brand href="#">Social App</b-navbar-brand>

			<b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

			<b-collapse id="nav-collapse" is-nav>
				<b-navbar-nav class="ml-auto">
					<b-nav-item v-if="!loggedIn" :to="{ name: 'home' }">Home</b-nav-item>
					<b-nav-item v-if="loggedIn" :to="{ name: 'posts' }">Posts</b-nav-item>
					<b-nav-item v-if="!loggedIn" :to="{ name: 'login' }">Login</b-nav-item>
					<b-nav-item v-if="!loggedIn" :to="{ name: 'register' }">Register</b-nav-item>

					<b-nav-item-dropdown
						id="my-nav-dropdown"
						:text="getName" 
						v-if="loggedIn">

						<b-dropdown-item :to="{ name: 'profile', params: { id: getUser.id } }">Profile</b-dropdown-item>
						<b-dropdown-item>Settings</b-dropdown-item>
						<b-dropdown-divider></b-dropdown-divider>
						<b-dropdown-item :to="{ name: 'logout' }">Logout</b-dropdown-item>
					</b-nav-item-dropdown>
				</b-navbar-nav>
			</b-collapse>
		</b-navbar>
	</div>
</template>


<script>

	import { mapGetters } from 'vuex'

	export default {
		name: 'NavBar',
		computed: mapGetters(['loggedIn', 'getName', 'getUser']),
	}
</script>