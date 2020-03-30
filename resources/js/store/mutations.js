import * as mutations from './mutations-type'
import axios from 'axios'

export default {
	[mutations.TAMPIL_MENU] (state) {
		axios.get('/data-menu')
		.then((response) => {
			state.dataMenu  = response.data
			state.isLoading = false
		})
	},
	[mutations.PILIH_MENU] (state,data_menu) {
		state.singleData = data_menu
		state.showModal  = true
	},
	[mutations.PESAN_MENU] (state,data_menu) {
		data_menu.banyak_pesan = state.menuInput.banyak_pesan
		data_menu.sub_total    = state.menuInput.banyak_pesan * data_menu.harga_menu
		data_menu.keterangan   = state.menuInput.keterangan

		state.dataPesanan.total_harga+=data_menu.sub_total
		state.dataPesanan.pesanan.push(data_menu)

		state.menuInput.banyak_pesan = null
		state.menuInput.keterangan   = null
		state.showModal              = false
	},
	[mutations.UBAH_PESANAN] (state,data_menu) {
		state.menuInput.banyak_pesan = data_menu.banyak_pesan
		state.menuInput.keterangan   = data_menu.keterangan
		state.showModal              = true
	},
	[mutations.CHECKOUT_PESANAN] (state) {
		if (state.dataPesanan.pesanan.length != 0) {
			state.loadSend = true
			axios.post('/data-menu/checkout',{
				pesanan:state.dataPesanan.pesanan,
				total_harga:state.dataPesanan.total_harga
			})
			.then(response => {
				state.dataPesanan.total_harga = null
				state.dataPesanan.pesanan     = []
				state.loadSend                = false
				console.log(response.data)
			})
			.catch(e => {
				console.log(e)
			})
		}
		else {
			console.log('kosong bos');
		}
	},
	[mutations.SHOW_MODAL] (state) {
		state.showModal = true
	},
	[mutations.CLOSE_MODAL] (state) {
		state.showModal = false
	}
}