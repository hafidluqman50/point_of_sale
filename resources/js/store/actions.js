import * as mutations from './mutations-type'
import EventBus from '../event-bus'

export default {
	loadState(context) {
		context.commit(mutations.LOAD_STATE)
	},
	showModal(context) {
		context.commit(mutations.SHOW_MODAL)
	},
	closeModal(context) {
		context.commit(mutations.CLOSE_MODAL)
	},
	tampilMenu(context) {
		context.dispatch('loadState')
		context.commit(mutations.TAMPIL_MENU)
	},
	pilihMenu(context,data_menu) {
		context.commit(mutations.PILIH_MENU,data_menu)
	},
	pesanMenu(context,data_menu) {
		context.dispatch('showModal')
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
	checkoutPesanan(context) {
		context.commit(mutations.CHECKOUT_PESANAN)
	},
	prosesBayar(context) {
		context.commit(mutations.PROSES_BAYAR)
	},
	getPembayaran(context) {
		context.dispatch('loadState')
		context.commit(mutations.GET_PEMBAYARAN)
	}
}
