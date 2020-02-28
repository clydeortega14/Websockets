const state = () => ({

	token: null,
	name: null,
	user: {}
})
const getters = {
	getToken (state)
	{
		return state.token
	},
	getUser: state => state.user,
	getName(state)
	{
		return state.name
	},
	loggedIn(state)
	{
		return state.token !== null
	}
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
	setAccessToken (state, token) {
		state.token = token
	},
	setUser: (state, user) => (state.user = user),
	setName(state, name)
	{
		state.name = name
	},
	destroy(state)
	{
		state.name = null
		state.token = null
		state.user = {}
	}
};


export default {

	state: state(),
	getters,
	actions,
	mutations
}