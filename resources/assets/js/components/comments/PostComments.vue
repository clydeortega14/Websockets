<template>
	<div>
		<h5 class="text-primary">Comments</h5>

		<b-media v-for="(comment, index) in post.comments" :key="index">
			<template v-slot:aside>
				<b-img src="http://realtime.test/file/uploads/avatars/avatar-1.jpg" rounded="0" width="50" height="50" class="ml-3"></b-img>
			</template>

			<h5 class="mt-0">{{ comment.user.name }}</h5>

			<p>{{ comment.comment }}</p>
		</b-media>
		<br>
		<add-comment :post="post"></add-comment>
	</div>
</template>

<script>
	
	export default {
		name: "PostComments",
		props: ["post"],
	}
</script>