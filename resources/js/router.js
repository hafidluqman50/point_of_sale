import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


// ADMIN COMPONENT //
import MainAdmin from './components/Admin/Main'
import KasirMainAdmin from './components/Admin/views/KasirMain'
import KasirMakananAdmin from './components/Admin/views/KasirMakanan'
import KasirMinumanAdmin from './components/Admin/views/KasirMinuman'
// END ADMIN COMPONENT //

// KASIR COMPONENT //
import MainKasir from './components/Kasir/Main'
import KasirMainKasir from './components/Kasir/views/KasirMain'
import KasirMakananKasir from './components/Kasir/views/KasirMakanan'
import KasirMinumanKasir from './components/Kasir/views/KasirMinuman'
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
					path:'makanan',
					component:KasirMakananAdmin
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
				{
					path:'makanan',
					component:KasirMakananKasir
				},
				{
					path:'minuman',
					component:KasirMinumanKasir
				}
			]
		}
	],
})

export default router