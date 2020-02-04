import axios from 'axios';
import localforage from '../../libraries/localforage';

const state = {
	token: localStorage.getItem('Realtime/access_token') || null
};
const getters = {
	getToken (state){
		return state.token
	}
};
const actions = {
	async retrieveToken({ commit }, payload){

		let response = await axios.post(`http://realtime.test/api/login`, payload);
		let accessToken = 'Bearer ' + response.data.access_token

		localforage.setItem('access_token', accessToken)
		commit('setAccessToken', accessToken)
	}

};
const mutations = {
	setAccessToken (state, token) {
		state.token = token
	}
};


export default {

	state,
	getters,
	actions,
	mutations
}