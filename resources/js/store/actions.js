import * as mutations from './mutations-type'

export default {
	tampilMenu(context) {
		context.commit(mutations.TAMPIL_MENU)
	},
	pilihMenu(context,data_menu) {
		context.commit(mutations.PILIH_MENU,data_menu)
	},
	pesanMenu(context,data_menu) {
		context.commit(mutations.PESAN_MENU,data_menu)
	},
	showModal(context) {
		context.commit(mutations.SHOW_MODAL)
	},
	closeModal(context) {
		context.commit(mutations.CLOSE_MODAL)
	}
}
