<template>
	<div>
		
	</div>
</template>

<script>
	export default {
		name: "Logout",
		created(){
			this.$store.dispatch('destroyToken')
			.then(res => {
				this.$router.push({ name: 'login' })
			})
		}
	}
</script>