import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


// ADMIN COMPONENT //
import MainAdmin from './components/Admin/Main'
import KasirMainAdmin from './components/Admin/views/KasirMain'
import PembayaranAdmin from './components/Admin/views/Pembayaran'
// END ADMIN COMPONENT //

// KASIR COMPONENT //
import MainKasir from './components/Kasir/Main'
import KasirMainKasir from './components/Kasir/views/KasirMain'
// END KASIR COMPONENT //

// const getPref = document.location.pathname
// const prefix  = getPref.slice(1,6)

const router = new VueRouter({
	mode:'history',
	routes: [
		{
			path:'/admin/kasir',
			component:MainAdmin,
			children: [
				{
					path:'',
					component:KasirMainAdmin
				},
				{
					path:'pembayaran',
					component:PembayaranAdmin
				}
			]
		},
		{
			path:'/kasir',
			component:MainKasir,
			children: [
				{
					path:'',
					component:KasirMainKasir
				},
			]
		}
	],
})

// router.beforeEach(transition => {
// 	router.app.loadState()
// 	transition.next()
// })

export default router