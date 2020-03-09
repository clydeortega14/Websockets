const state = () => ({

	token: null,
	user: {},
	user_post: []
})
const getters = {
	getToken : (state) => state.token,
	getUserPosts: state => state.user_post,
	getUser: state => state.user,
	loggedIn : (state) => (state.token !== null),
};
const actions = {

	destroyToken(context){

		if(context.getters.loggedIn){

			return new Promise((resolve, reject) => {

				axios.post('api/logout')
				.then(response => {
					context.commit('destroy')
					resolve(response)

				}).catch(error => {

					console.log(error)
					reject(error)
				})

			});
		}
	}
};
const mutations = {
	setAccessToken : (state, token) => (state.token = token),
	setUserPosts: (state, posts) => (state.user_post = posts),
	setUser: (state, user) => (state.user = user),
	destroy(state)
	{
		state.token = null
		state.user = {}
		state.user_posts = []
	}
};


export default {

	state: state(),
	getters,
	actions,
	mutations
}