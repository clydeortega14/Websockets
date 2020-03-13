<template>
	<div>
		<div v-if="post.file !== null">
			<div v-if="splitFiles(post).length > 1">
				<b-container fluid class="p-4">
					<b-row>
						<b-col>
							<b-img 
								v-for="(file, index) in splitFiles(post)" 
								:key="index" 
								thumbnail 
								fluid 
								:src=" `${baseUri}/file/uploads/posts/${file}` " 
								alt="Image 2" 
								height="250" 
								width="250"
								class="mr-2 mb-2">
									
							</b-img>
						</b-col>
					</b-row>
				</b-container>
			</div>
	
			<div v-else>
				<b-img 
					:src="`${baseUri}/file/uploads/posts/${post.file}`" 
					:alt="post.file" 
					center
					height="150" 
					width="150">
						
				</b-img>
			</div>
		</div>
		
		<div v-else>
			<b-img src="https://picsum.photos/1024/400/?image=41" fluid-grow alt="Responsive image" class="mb-3"></b-img>
		</div>
	</div>
</template>


<script>

	import FileFormat from '../../../mixins/File.js'
	
	export default {
		name: "PostImage",
		mixins: [ FileFormat ],
		props: ["post"],
		methods: {
			splitFiles(post)
			{
				return post.file.split("|");
			}
		}
	}
</script>