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
	pesanMenu(context,data_menu) {
		context.commit(mutations.PESAN_MENU,data_menu)
		context.dispatch('clearPesanMenu')
		context.dispatch('closeModal','modalMenuItem')
	},
	ubahMenu(context,payload) {
		context.commit(mutations.UBAH_MENU,payload)
		context.dispatch('openModal','modalEditMenu')
	},
	updateMenu(context,menu) {
		context.commit(mutations.UPDATE_MENU,menu)
		context.dispatch('clearPesanMenu')
		context.dispatch('closeModal','modalEditMenu')
	},
	hapusMenu(context,index_arr) {
		context.commit(mutations.HAPUS_MENU,index_arr)
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
	getPembayaran(context) {
		// let dataBayar = null
		// if (dataBayar == null) {
		context.dispatch('loadState')
		axios.get('/data-pembayaran')
			 .then(response => {
			 	// dataBayar = response.data
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
