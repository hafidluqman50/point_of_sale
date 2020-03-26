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
		state.dataPesanan.push(data_menu)
	},
	[mutations.SHOW_MODAL] (state) {
		state.showModal = true
	},
	[mutations.CLOSE_MODAL] (state) {
		state.showModal = false
	}
}