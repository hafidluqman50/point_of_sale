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
		state.dataPesanan.push(data_menu)

		state.menuInput.banyak_pesan = null
		state.menuInput.keterangan   = null
		state.showModal = false
	},
	[mutations.UBAH_PESANAN] (state,data_menu) {
		state.menuInput.banyak_pesan = data_menu.banyak_pesan
		state.menuInput.keterangan   = data_menu.keterangan
		state.showModal              = true
	},
	[mutations.SHOW_MODAL] (state) {
		state.showModal = true
	},
	[mutations.CLOSE_MODAL] (state) {
		state.showModal = false
	}
}