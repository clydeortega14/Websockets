const state = () => ({

	token: null,
	name: null,
})
const getters = {
	getToken (state)
	{
		return state.token
	},
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
	setName(state, name)
	{
		state.name = name
	},
	destroy(state)
	{
		state.name = null
		state.token = null
	}
};


export default {

	state: state(),
	getters,
	actions,
	mutations
}