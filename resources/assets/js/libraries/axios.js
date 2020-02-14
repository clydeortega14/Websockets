import axios from 'axios';
import store from '../store'

axios.interceptors.request.use(
	request => {
		let access_token = store.getters['getToken']
		
		if(access_token){
			request.headers.common['Authorization'] = 'Bearer ' + access_token
		}
		request.headers.common['Accept'] = 'application/json'

		return request
	},
	error => { return Promise.reject(error)}
	)
axios.interceptors.response.use(
	response => { 
			return response
	},
	error => {
		if(error.response){
			console.log(error)
		}
	}
	)

export default axios