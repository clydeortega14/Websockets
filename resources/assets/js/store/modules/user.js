import axios from 'axios';
import localforage from '../../libraries/localforage';

const state = {
	token: localStorage.getItem('access_token') || null
};
const getters = {
	getToken (state)
	{
		return state.token
	},
	loggedIn(state)
	{
		return state.token !== null
	}
};
const actions = {

	retrieveToken({ commit }, credentials){

		return new Promise((resolve, reject) => {

			axios.post('http://realtime.test/api/login', {

				username: credentials.username,
				password: credentials.password

			}).then(response => {
				let data = response.data
				let access_token = response.data.user_data.token.access_token

				console.log(access_token)
				localStorage.setItem('access_token', access_token)
				commit('setAccessToken', access_token)
				resolve(response)

			}).catch(error => {

				console.log(error)

				reject(response)
			})
		});
	},
	destroyToken(context){

		axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token

		if(context.getters.loggedIn){

			return new Promise((resolve, reject) => {

				axios.post('api/logout')
				.then(response => {

					localStorage.removeItem('access_token')
					context.commit('destroyToken')
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
	destroyToken(state){
		state.token = null
	}
};


export default {

	state,
	getters,
	actions,
	mutations
}