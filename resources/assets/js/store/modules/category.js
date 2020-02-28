const state = () => ({

	categories: []
})
const getters = {

	allCategories: state => state.categories
}
const actions = {

	async getCategories({ commit })
	{
		const response = await axios.get('api/categories');
		commit('setCategories', response.data.options)
	}
}
const mutations = {

	setCategories: (state, categories) => (state.categories = categories)
}

export default {

	state: state(),
	getters,
	actions,
	mutations
}