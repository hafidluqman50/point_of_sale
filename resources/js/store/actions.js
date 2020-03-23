import * as mutations from './mutations-type'

export default {
	tampilMenu(context) {
		context.commit(mutations.TAMPIL_MENU)
	},
	pesanMenu(context,data_menu) {
		context.commit(mutations.PESAN_MENU,data_menu)
	}
}
