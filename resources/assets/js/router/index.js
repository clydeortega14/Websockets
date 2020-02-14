import Vue from 'vue';
import VueRouter from 'vue-router';
import store from '../store';

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
		{
			name: 'posts',
			path: '/posts',
			component: require('../components/posts/ShowPost.vue').default,
			meta: {
				requiresAuth: true
			}
		},
		{
			name: 'comment-post',
			path: '/comment-post/:id',
			component: require('../components/posts/CommentPost.vue').default,
			meta: {
				requiresAuth: true
			}
		}
	],
})

/* FOR ROUTER NAVIGATION GUARDS */
router.beforeEach((to, from, next) => {

  if (to.matched.some(record => record.meta.requiresAuth)) {
    // this route requires auth, check if logged in
    // if not, redirect to login page.
    if (!store.getters.loggedIn) {
      next({
        name: 'login',
        // query: { redirect: to.fullPath }
      })
    } else {
      next()
    }
  } else if (to.matched.some(record => record.meta.requiresVisitor)) {
    // this route requires visitor, check if not logged in
    // if logged in, redirect to home page.
    if (store.getters.loggedIn) {
      next({
        name: 'home',
        // query: { redirect: to.fullPath }
      })
    } else {
      next()
    }
  }else {
    next() // make sure to always call next()!
  }
})

/* END ROUTER NAVIGATION GUARDS */

export default router