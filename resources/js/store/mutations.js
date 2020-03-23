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
	[mutations.PESAN_MENU] (state,data_menu) {
		console.log(data_menu)
		state.loadById = data_menu.id_menu_makan
		state.loadSend = true
	}
}