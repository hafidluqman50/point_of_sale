import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)



import KasirPesan from './views/KasirPesan'

const getPref = document.location.pathname
const prefix  = getPref.slice(1,6)

const router = new VueRouter({
	mode:'history',
	routes: [
		{
			path:'/'+prefix+'/kasir',
			name:'kasir-pesan',
			component:KasirPesan
		}
	],
})

export default router