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
		context.dispatch('openModal')
		context.commit(mutations.PESAN_MENU,data_menu)
	},
	ubahPesanan(context,data_menu) {
		context.commit(mutations.UBAH_PESANAN,data_menu)
	},
	cariMenu(context,input_cari) {
		if (input_cari != null || input_cari !== undefined) {
			context.dispatch('loadState')
			context.commit(mutations.CARI_MENU,input_cari)
		}
	},
	closePesan(context) {
		context.commit(mutations.CLOSE_PESAN)
		context.dispatch('closeModal')
	},
	prosesBayar(context) {
		context.commit(mutations.PROSES_BAYAR)
	},
	getPembayaran(context) {
		context.dispatch('loadState')
		context.commit(mutations.GET_PEMBAYARAN)
	}
}
