import * as mutations from './mutations-type'
import { EventBus } from '../event-bus'

export default {
	loadState(context) {
		context.commit(mutations.LOAD_STATE)
	},
	openModal(context,target_modal) {
		context.commit(mutations.OPEN_MODAL)
		EventBus.$emit('modalOpen',target_modal)
	},
	closeModal(context,target_modal) {
		context.commit(mutations.CLOSE_MODAL)
		EventBus.$emit('modalClose',target_modal)
	},
	tampilMenu(context) {
		context.dispatch('loadState')
		context.commit(mutations.TAMPIL_MENU)
	},
	pilihMenu(context,data_menu) {
		context.commit(mutations.PILIH_MENU,data_menu)
	},
	pesanMenu(context,data_menu) {
		context.commit(mutations.PESAN_MENU,data_menu)
		context.dispatch('closeModal','modalMenuItem')
	},
	ubahMenu(context,payload) {
		console.log('data_menu',payload)
		context.commit(mutations.UBAH_MENU,payload)
		context.dispatch('openModal','modalEditMenu')
	},
	updateMenu(context,menu) {
		context.commit(mutations.UPDATE_MENU,menu)
		context.dispatch('closeModal','modalEditMenu')
	},
	hapusMenu(context,index_arr) {
		context.commit(mutations.HAPUS_MENU,index_arr)
	},
	cariMenu(context,input_cari) {
		if (input_cari != null || input_cari !== undefined) {
			context.dispatch('loadState')
			context.commit(mutations.CARI_MENU,input_cari)
		}
	},
	// closeMenu(context) {
	// 	context.commit(mutations.CLOSE_MENU)
	// },
	prosesBayar(context) {
		context.commit(mutations.PROSES_BAYAR)
		context.dispatch('closeModal','checkoutMenu')
	},
	getPembayaran(context) {
		context.dispatch('loadState')
		context.commit(mutations.GET_PEMBAYARAN)
	}
}
