import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const router = new VueRouter({
	mode: 'hash',
	routes : [
		{
			name: 'login',
			path: '/',
			component: require('../components/app/LoginComponent.vue').default
		},

		{
			name: 'register',
			path: '/register',
			component: require('../components/app/Register.vue').default
		},
	],
})

export default router