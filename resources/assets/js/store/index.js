import Vuex from 'vuex'
import Vue from 'vue'
import user from './modules/user.js'
import post from './modules/post.js'
import comment from './modules/comment.js'
import category from './modules/category.js'
import createPersistedState from 'vuex-persistedstate';

Vue.use(Vuex)

export default new Vuex.Store({

	modules: {
		user,
		post,
		comment,
		category
	},
	plugins: [createPersistedState()]
});