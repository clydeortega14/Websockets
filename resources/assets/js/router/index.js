import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const router = new VueRouter({
	mode: 'hash',
	routes : [
		{
			name: 'login',
			path: '/',
			component: require('../components/app/LoginComponent.vue').default,
			meta: {
				requiresVisitor: true
			}
		},

		{
			name: 'register',
			path: '/register',
			component: require('../components/app/Register.vue').default,
			meta: {
				requiresVisitor: true
			}
		},

		{
			name: 'home',
			path: '/home',
			component: require('../components/app/Home.vue').default,
			meta: {
				requiresAuth: true
			}
		},
		{
			name: 'logout',
			path: '/logout',
			component: require('../components/app/Logout.vue').default,
			meta: {
				requiresAuth: true
			}
		},
	],
})

export default router