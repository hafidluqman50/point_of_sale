import * as mutations from './mutations-type'
import { EventBus } from '../event-bus'

export default {
	loadState(context,param) {
		context.commit(mutations.LOAD_STATE,param)
	},
	loadSend(context,param) {
		context.commit(mutations.LOAD_SEND,param)
	},
	openModal(context,target_modal) {
		context.commit(mutations.OPEN_MODAL)
		EventBus.$emit('modalOpen',target_modal)
	},
	closeModal(context,target_modal) {
		context.commit(mutations.CLOSE_MODAL)
		EventBus.$emit('modalClose',target_modal)
	},
	clearPesanMenu(context) {
		context.commit(mutations.CLEAR_PESAN_MENU)
	},
	tampilItemJual(context) {
		context.dispatch('loadState')

		axios.get('/data-item-jual')
			 .then((response) => {
			 	console.log(response.data)
				context.commit(mutations.TAMPIL_ITEM_JUAL,response.data)
				context.dispatch('loadState',false)
			})
	},
	pilihItem(context,data_menu) {
		context.commit(mutations.PILIH_ITEM,data_menu)
	},
	listPesanan(context) {
		axios.get('/list-item')
			 .then((response) => {
			 	let list_menu = response.data
				context.commit(mutations.LIST_PESANAN,list_menu)
			 })
	},
	varianPush(context,param) {
		let clone = {...param}

		context.commit(mutations.VARIAN_PUSH,clone)
	},
	pesanMenu(context,data_input) {
		let clone      = {...data_input}
		let data_pesan = clone.singleData
		let menu_input = clone.menuInput

		data_pesan.id_list      = '_' + Math.random().toString(36).substr(2, 9)
		data_pesan.banyak_pesan = menu_input.banyak_pesan
		data_pesan.keterangan   = menu_input.keterangan
		data_pesan.varian_pilih = menu_input.varian_pilih
		if (menu_input.varian_pilih != null || menu_input.varian_pilih != undefined) {
			data_pesan.sub_total = (menu_input.banyak_pesan * data_pesan.harga_item) + menu_input.varian_pilih.hargaVarian
		}
		else {
			data_pesan.sub_total = menu_input.banyak_pesan * data_pesan.harga_item
		}

		axios.get('/tambah-list-menu', {
			params:{
				data_pesan:data_pesan
			}
		}).then((mantul) => {
			console.log(mantul)
		})

		context.commit(mutations.PESAN_MENU,data_pesan)
		context.dispatch('clearPesanMenu')
		context.dispatch('closeModal','modalMenuItem')
	},
	ubahMenu(context,payload) {
		context.commit(mutations.UBAH_MENU,payload)
		context.dispatch('openModal','modalEditMenu')
	},
	updateMenu(context,data_update) {
		let clone = {...data_update}
		const {varian_pilih,harga_item,banyak_pesan} = clone

		if (varian_pilih !== null && varian_pilih !== undefined) {
			let hargaVarian = varian_pilih.hargaVarian

			clone.sub_total = harga_item * banyak_pesan + hargaVarian
		}
		else {
			clone.sub_total = harga_item * banyak_pesan
		}

		context.commit(mutations.UPDATE_MENU,clone)
		
		axios.get('/update-list-menu',{
			params:{
				data_update:clone
			}
		})

		context.dispatch('clearPesanMenu')
		context.dispatch('closeModal','modalEditMenu')
	},
	hapusMenu(context,data) {
		axios.get('/hapus-list-menu',{
			params:{
				id_list:data.item.id_list
			}
		}).then((response) => {
			console.log(response.data)
		})
		context.commit(mutations.HAPUS_MENU,data.index)
	},
	destroyMenuAct(context) {
		axios.get('/destroy-list-menu')
		.then((response) => {
			console.log(response.data)
		})
		.catch((e) => {
			console.log(e)
		})

		context.commit(mutations.DESTROY_MENU_ACT)
	},
	cariMenu(context,input_cari) {
		if (input_cari != null || input_cari !== undefined) {
			context.dispatch('loadState')
			axios.get('/data-item-jual/cari', {
				params:{
					cari_item:input_cari
				}
			})
			.then(response => {
				context.dispatch('loadState',false)
				context.commit(mutations.CARI_ITEM,response.data)
			})
		}
	},
	closeMenu(context,modal) {
		context.dispatch('clearPesanMenu')
		context.dispatch('closeModal',modal)
	},
	prosesBayar(context,dataPesanan) {
		context.dispatch('loadSend')

		axios.post('/data-item-jual/checkout',{
			total_harga:dataPesanan.total_harga,
			total_bayar:dataPesanan.total_bayar,
			// kembalian:dataPesanan.kembalian,
			keterangan:dataPesanan.keterangan,
			status_transaksi:dataPesanan.status_transaksi,
			ket_bayar:dataPesanan.ket_bayar,
			menu:dataPesanan.menu
		})
		.then(response => {
			context.commit(mutations.PROSES_BAYAR)
			context.dispatch('loadSend',false)
			context.dispatch('closeModal','checkoutMenu')
		})
		.catch(e => {
			console.log(e)
		})
	},
	prosesTagihan(context,dataPesanan) {
		context.dispatch('loadSend')

		axios.post('/data-item-jual/tagihan-proses',{
			total_harga:dataPesanan.total_harga,
			nama_customer:dataPesanan.nama_customer,
			keterangan:dataPesanan.keterangan,
			menu:dataPesanan.menu
		})
		.then(response => {
			context.commit(mutations.PROSES_TAGIHAN)
			context.dispatch('loadSend',false)
			context.dispatch('closeModal','checkoutMenu')
		})
		.catch(e => {
			console.log(e)
		})
	},
	getPembayaran(context,page) {
		// let dataBayar = null
		// if (dataBayar == null) {
		console.log(page)
		context.dispatch('loadState')
		axios.get('/data-pembayaran',{
			params:{
				page:page
			}
		}).then(response => {
			 	context.dispatch('loadState',false)
				context.commit(mutations.GET_PEMBAYARAN,response.data)
			})
		// }
		// else {
		// 	context.commit(mutations.GET_PEMBAYARAN,dataBayar)
		// }
		// console.log(dataBayar)
	}
}
