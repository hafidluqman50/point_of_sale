import * as mutations from './mutations-type'
import axios from 'axios'

export default {
	[mutations.LOAD_STATE] (state) {
		state.isLoading = true
	},
	[mutations.TAMPIL_MENU] (state) {
		axios.get('/data-menu')
			 .then((response) => {
				state.dataMenu  = response.data
				state.isLoading = false
			})
	},
	[mutations.PILIH_MENU] (state,data_menu) {
		state.singleData          = data_menu
		// state.showModal.modalMenu = true
	},
	[mutations.PESAN_MENU] (state,data_menu) {
		data_menu.banyak_pesan = state.menuInput.banyak_pesan
		data_menu.sub_total    = state.menuInput.banyak_pesan * data_menu.harga_menu
		data_menu.keterangan   = state.menuInput.keterangan

		state.dataPesanan.total_harga+=data_menu.sub_total
		state.dataPesanan.pesanan.push(data_menu)

		state.menuInput.banyak_pesan = null
		state.menuInput.keterangan   = null
	},
	[mutations.CARI_MENU] (state,data_cari) {
		axios.get('/data-menu/cari', {
			params:{
				cari_menu:data_cari
			}
		})
		.then(response => {
			state.dataMenu  = response.data
			state.isLoading = false
		})
	},
	[mutations.UBAH_PESANAN] (state,data_menu) {
		state.menuInput.banyak_pesan = data_menu.banyak_pesan
		state.menuInput.keterangan   = data_menu.keterangan
		state.showModal.modalMenu    = true
	},
	[mutations.CHECKOUT_PESANAN] (state) {
		if (state.dataPesanan.pesanan.length != 0) {
			state.showModal.modalBayar = true
		}
		else {
			console.log('kosong bos');
		}
	},
	[mutations.PROSES_BAYAR] (state) {
		state.loadSend = true
		axios.post('/data-menu/checkout',{
			total_harga:state.dataPesanan.total_harga,
			total_bayar:state.dataPesanan.total_bayar,
			// kembalian:state.dataPesanan.kembalian,
			keterangan:state.dataPesanan.keterangan,
			pesanan:state.dataPesanan.pesanan
		})
		.then(response => {
			state.dataPesanan.total_harga = null
			state.dataPesanan.total_bayar = null
			// state.dataPesanan.kembalian   = null
			state.dataPesanan.pesanan     = []
			state.loadSend                = false
			state.showModal.modalBayar	  = false
			console.log(response.data)
		})
		.catch(e => {
			console.log(e)
		})
	},
	[mutations.GET_PEMBAYARAN] (state) {
		axios.get('/data-pembayaran')
			 .then(response => {
			 	state.dataPembayaran = response.data
			 	state.isLoading = false
			 })
	},
	[mutations.SHOW_MODAL] (state) {
		state.showModal = true
	},
	[mutations.CLOSE_MODAL] (state) {
		state.showModal = false
	},
	[mutations.CLOSE_PESAN] (state) {
		state.menuInput.banyak_pesan = null
		state.menuInput.keterangan   = null
	}
}