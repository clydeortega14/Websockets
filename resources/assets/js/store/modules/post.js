const state = () => ({

	posts: [],
})
const getters = {

	getPosts: state => state.posts 
}
const actions = {

	async getAllPosts({ commit })
	{
		let response = await axios.get('/api/post-all');

		commit('setPosts', response.data)
	},
	async addPost({ commit }, payload)
	{
		let response = await axios.post('/api/post-add', payload);
		commit('addPost', response.data)
	},
	async deletePost({ commit }, id){

		await axios.delete(`api/post-delete/${id}`);
		commit('deletePost', id);
	},
	async updatePost({ commit }, data){
		const response = await axios.post(`api/post-update/${data.id}`, data);
		// console.log(response.data)
		commit('updatePost', response.data)
	}
}
const mutations = {
	setPosts: (state, posts) => (state.posts = posts),

	destroyPost: (state) => (state.posts = []),

	addPost: (state, post) => state.posts.unshift(post), 

	deletePost: (state, id) => (state.posts = state.posts.filter(post => post.id !== id)),

	updatePost(state, data){
		console.log(data.user)
		/* find index of the current selected data */
		let index = state.posts.findIndex(post => post.id === data.id)

		if(index !== -1){

			// remove one item and replace that removed item to new item
			state.posts.splice(index, 1, data)
		}
	}
}


export default {
	state: state(),
	getters,
	actions,
	mutations
}