const state = () => ({

	posts: [],
})
const getters = {

	userPosts(state){
		return state.posts
	}
}
const actions = {

	async addPost({ commit }, payload)
	{
		let response = await axios.post('api/post-add', payload);

		commit('addPost', response.data)
	},
	async deletePost({ commit }, id){

		await axios.delete(`api/post-delete/${id}`);
		commit('deletePost', id);
	},
	async updatePost({ commit }, data){
		const response = await axios.put(`api/post-update/${data.id}`, data);
		commit('updatePost', data)
	},
	getPost({ commit }, id){

		return new Promise((resolve, reject) => {
			axios.get(`api/post-edit/${id}`)
			.then(response => {
				commit('getPost', response.data)
				resolve(response.data)
			}).catch(error => {
				reject(error)
			})
		})
	}

}
const mutations = {
	setUserPosts(state, posts){
		state.posts = posts
	},
	destroyPost(state){
		state.posts = []
	},
	addPost(state, post){
		state.posts.unshift(post)
	},
	deletePost(state, id){
		state.posts = state.posts.filter(post => post.id !== id)
	},
	updatePost(state, data){

		/* find index of the current selected data */
		let index = state.posts.findIndex(post => post.id === data.id)

		if(index !== -1){

			// remove one item and replace that removed item to new item
			state.posts.splice(index, 1, data)
		}
	},
	getPost(state, id){
		state.posts = state.posts.filter(post => post.id === id)
	}
}


export default {
	state: state(),
	getters,
	actions,
	mutations
}