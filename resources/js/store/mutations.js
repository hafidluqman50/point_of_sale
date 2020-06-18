import * as mutations from './mutations-type'
import axios from 'axios'

export default {
	[mutations.LOAD_STATE] (state,param = true) {
		state.isLoading = param
	},
	[mutations.LOAD_SEND] (state,param = true) {
		state.loadSend = param
	},
	[mutations.TAMPIL_MENU] (state,data_menu) {
		state.dataMenu = data_menu
	},
	[mutations.PILIH_MENU] (state,data_menu) {
		state.singleData = data_menu
	},
	[mutations.PESAN_MENU] (state,data_menu) {
		console.log(data_menu)
		data_menu.banyak_pesan = state.menuInput.banyak_pesan
		data_menu.sub_total    = state.menuInput.banyak_pesan * data_menu.harga_menu
		data_menu.keterangan   = state.menuInput.keterangan

		state.dataPesanan.total_harga+=data_menu.sub_total
		state.dataPesanan.menu.push(data_menu)
		console.log(state.dataPesanan.menu)
	},
	[mutations.CARI_MENU] (state,data_cari) {
		state.dataMenu = data_cari
	},
	[mutations.UBAH_MENU] (state,payload) {
		state.menuInput.banyak_pesan = payload.item.banyak_pesan
		state.menuInput.keterangan   = payload.item.keterangan
		state.menuInput.harga_menu	 = payload.item.harga_menu
		console.log(payload.index)
		console.log(state.dataPesanan.menu)
		state.menuInput.indexMenu	 = payload.index
	},
	[mutations.UPDATE_MENU] (state,menu) {
		let indexMenu = state.menuInput.indexMenu

		state.dataPesanan.menu[indexMenu].banyak_pesan = state.menuInput.banyak_pesan
		state.dataPesanan.menu[indexMenu].keterangan   = state.menuInput.keterangan
		state.dataPesanan.total_harga-=state.dataPesanan.menu[indexMenu].sub_total

		state.dataPesanan.menu[indexMenu].sub_total    = state.menuInput.harga_menu * state.menuInput.banyak_pesan
		state.dataPesanan.total_harga+=state.dataPesanan.menu[indexMenu].sub_total
	},
	[mutations.HAPUS_MENU] (state,index_arr) {
		const dataPesanan = state.dataPesanan.menu
		
		const removePesanan = (data,index) => {
			state.dataPesanan.total_harga-=data[index].sub_total
			return data.slice(0,index).concat(data.slice(index+1,data.length))
		}

  		state.dataPesanan.menu = removePesanan(dataPesanan,index_arr)
	},
	[mutations.CLEAR_PESAN_MENU] (state) {
		state.menuInput.banyak_pesan = null
		state.menuInput.keterangan   = null
		state.menuInput.indexMenu    = null
	},
	// [mutations.CHECKOUT_PESANAN] (state) {
		// if (state.dataPesanan.menu.length != 0) {
		// 	state.showModal.modalBayar = true
		// }
		// else {
		// 	console.log('kosong bos');
		// }
	// },
	[mutations.PROSES_BAYAR] (state) {
		state.dataPesanan.total_harga  = null
		state.dataPesanan.total_bayar  = null
		// state.dataPesanan.kembalian = null
		state.dataPesanan.menu         = []
		state.loadSend                 = false
	},
	[mutations.GET_PEMBAYARAN] (state,data_bayar) {
		state.dataPembayaran = data_bayar
	},
	[mutations.OPEN_MODAL] (state) {
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