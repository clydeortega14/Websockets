const state = () => ({

	comments: []
})
const getters = {

	getComments(state){
		return state.comments
	}
}
const actions = {
	async fetchComments({ commit }, postId){
		const response = await axios.get(`api/post/${postId}/comments`)
		commit('setComments', response.data)
	},
	async addComment({ commit }, payload){
		const response = await axios.post(`api/post/${payload.id}/comment`, payload)
		commit('addComment', response.data)
	}
}
const mutations = {

	setComments(state, comments){
		state.comments = comments
	},
	addComment(state, comment){
		state.comments.push(comment)
	}
}

export default {
	state: state(),
	getters,
	actions,
	mutations
}