import * as mutations from './mutations-type'
import { EventBus } from '../event-bus'

export default {
	loadState(context,param) {
		context.commit(mutations.LOAD_STATE,param)
	},
	loadSend(context,param) {
		context.commit(mutations.LOAD_SEND,param)
	},
	openModal(context,target_modal) {
		context.commit(mutations.OPEN_MODAL)
		EventBus.$emit('modalOpen',target_modal)
	},
	closeModal(context,target_modal) {
		context.commit(mutations.CLOSE_MODAL)
		EventBus.$emit('modalClose',target_modal)
	},
	clearPesanMenu(context) {
		context.commit(mutations.CLEAR_PESAN_MENU)
	},
	tampilMenu(context) {
		context.dispatch('loadState')

		axios.get('/data-menu')
			 .then((response) => {
				context.commit(mutations.TAMPIL_MENU,response.data)
				context.dispatch('loadState',false)
			})
	},
	pilihMenu(context,data_menu) {
		context.commit(mutations.PILIH_MENU,data_menu)
	},
	listPesanan(context) {
		axios.get('/list-menu')
			 .then((response) => {
			 	let list_menu = response.data
			 	console.log(list_menu)
				context.commit(mutations.LIST_PESANAN,list_menu)
			 })
	},
	pesanMenu(context,data_input) {
		let clone      = {...data_input}
		let data_menu  = clone.singleData
		let menu_input = clone.menuInput

		data_menu.id_list	   = '_' + Math.random().toString(36).substr(2, 9)
		data_menu.banyak_pesan = menu_input.banyak_pesan
		data_menu.sub_total    = menu_input.banyak_pesan * data_menu.harga_menu
		data_menu.keterangan   = menu_input.keterangan

		axios.get('/tambah-list-menu', {
			params:{
				data_menu:data_menu
			}
		}).then((mantul) => {
			console.log(mantul)
		})

		context.commit(mutations.PESAN_MENU,data_menu)
		context.dispatch('clearPesanMenu')
		context.dispatch('closeModal','modalMenuItem')
	},
	ubahMenu(context,payload) {
		console.log(payload)
		context.commit(mutations.UBAH_MENU,payload)
		context.dispatch('openModal','modalEditMenu')
	},
	updateMenu(context,data_update) {
		let clone = {...data_update}

		clone.sub_total = clone.harga_menu * clone.banyak_pesan
		axios.get('/update-list-menu',{
			params:{
				data_update:clone
			}
		})

		context.commit(mutations.UPDATE_MENU)
		context.dispatch('clearPesanMenu')
		context.dispatch('closeModal','modalEditMenu')
	},
	hapusMenu(context,data) {
		// console.log(data.item)
		axios.get('/hapus-list-menu',{
			params:{
				id_list:data.item.id_list
			}
		}).then((response) => {
			console.log(response.data)
		})
		context.commit(mutations.HAPUS_MENU,data.index)
	},
	cariMenu(context,input_cari) {
		if (input_cari != null || input_cari !== undefined) {
			context.dispatch('loadState')
			axios.get('/data-menu/cari', {
				params:{
					cari_menu:input_cari
				}
			})
			.then(response => {
				context.dispatch('loadState',false)
				context.commit(mutations.CARI_MENU,response.data)
			})
		}
	},
	closeMenu(context,modal) {
		context.dispatch('clearPesanMenu')
		context.dispatch('closeModal',modal)
	},
	prosesBayar(context,dataPesanan) {
		context.dispatch('loadSend')
		console.log(dataPesanan)

		axios.post('/data-menu/checkout',{
			total_harga:dataPesanan.total_harga,
			total_bayar:dataPesanan.total_bayar,
			// kembalian:dataPesanan.kembalian,
			keterangan:dataPesanan.keterangan,
			status_transaksi:dataPesanan.status_transaksi,
			ket_bayar:dataPesanan.ket_bayar,
			menu:dataPesanan.menu
		})
		.then(response => {
			context.commit(mutations.PROSES_BAYAR)
			context.dispatch('loadSend',false)
			context.dispatch('closeModal','checkoutMenu')
		})
		.catch(e => {
			console.log(e)
		})
	},
	getPembayaran(context,page) {
		// let dataBayar = null
		// if (dataBayar == null) {
		console.log(page)
		context.dispatch('loadState')
		axios.get('/data-pembayaran',{
			params:{
				page:page
			}
		}).then(response => {
			 	context.dispatch('loadState',false)
				context.commit(mutations.GET_PEMBAYARAN,response.data)
			})
		// }
		// else {
		// 	context.commit(mutations.GET_PEMBAYARAN,dataBayar)
		// }
		// console.log(dataBayar)
	}
}
