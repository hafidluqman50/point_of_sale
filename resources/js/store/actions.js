import * as mutations from './mutations-type'
import { EventBus } from '../event-bus'

export default {
	backPage(context) {
		localStorage.setItem('menu','')
		context.commit(mutations.MENU_CLICKED)
		window.history.back()
	},
	sidebarToggle(context) {
		context.commit(mutations.SIDEBAR_TOGGLE)
	},
	closeTagihan(context) {
		context.dispatch('closeModal','tagihanModal')
		context.dispatch('hideDetailBill')
	},
	closeCheckoutMenu(context) {
		context.commit(mutations.CLOSE_CHECKOUT_MENU)
		context.dispatch('closeModal','checkoutMenu')
	},
	sidebarMenuLoad(context) {
		axios.get('/load-jenis-item')
		.then((response)=> {
			context.commit(mutations.SIDEBAR_MENU,response.data)
			context.commit(mutations.MENU_CLICKED)
		})
		.catch((e) => {
			console.log(e)
		})
	},
	jenisMenuClick(context,menu) {
		localStorage.setItem('menu',menu)

		context.commit(mutations.MENU_CLICKED)
		context.dispatch('tampilItemJual',1)
		context.dispatch('sidebarToggle')
	},
	loadItem(context,param) {
		context.commit(mutations.LOAD_ITEM,param)
	},
	loadSend(context,param) {
		context.commit(mutations.LOAD_SEND,param)
	},
	loadBill(context,param) {
		context.commit(mutations.LOAD_BILL,param)
	},
	loadDetailBill(context,param) {
		context.commit(mutations.LOAD_DETAIL_BILL,param)
	},
	loadDeleteBill(context,param) {
		context.commit(mutations.LOAD_DELETE_BILL,param)
	},
	loadDeleteDetailBill(context,param) {
		context.commit(mutations.LOAD_DELETE_DETAIL_BILL,param)
	},
	showDetailBill(context) {
		context.commit(mutations.SHOW_DETAIL_BILL)
	},
	hideDetailBill(context) {
		context.commit(mutations.HIDE_DETAIL_BILL)
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
	tampilItemJual(context,page) {
		let getJenis = localStorage.getItem('menu')
		context.dispatch('loadItem')

		axios.get('/data-item-jual',{
			params:{
				page:page,
				jenis_menu:getJenis
			}
		})
		.then((response) => {
			context.commit(mutations.TAMPIL_ITEM_JUAL,response.data)
			context.dispatch('loadItem',false)
		})
	},
	pilihItem(context,data_menu) {
		context.commit(mutations.PILIH_ITEM,data_menu)
	},
	listPesanan(context) {
		let pesanan = JSON.parse(localStorage.getItem('pesanan'))
		if (pesanan == null) {
			pesanan = {
				list_item:[],
				total_harga:0
			}
		}

		context.commit(mutations.LIST_PESANAN,pesanan)
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

		context.dispatch('clearPesanMenu')
		context.dispatch('closeModal','modalEditMenu')
	},
	hapusMenu(context,data) {
		context.commit(mutations.HAPUS_MENU,data.index)
	},
	destroyMenuAct(context) {
		context.commit(mutations.DESTROY_MENU_ACT)
	},
	cariItemAct(context,param) {
		if (param.cari != null || param.cari !== undefined) {
			let getJenis = localStorage.getItem('menu')

			context.dispatch('loadItem')
			context.commit(mutations.CARI_ITEM,param.cari)
			axios.get('/data-item-jual/cari', {
				params:{
					cari_item:param.cari,
					page:param.page,
					jenis_menu:getJenis
				}
			})
			.then(response => {
				context.dispatch('loadItem',false)
				context.commit(mutations.TAMPIL_ITEM_JUAL,response.data)
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
			kembalian:dataPesanan.kembalian,
			keterangan:dataPesanan.keterangan,
			status_transaksi:dataPesanan.status_transaksi,
			ket_bayar:dataPesanan.ket_bayar,
			menu:dataPesanan.menu
		})
		.then((response) => {
			localStorage.removeItem('pesanan')
			context.commit(mutations.PROSES_BAYAR)
			context.dispatch('loadSend',false)
			context.dispatch('closeModal','checkoutMenu')
			window.location.href = response.data.url_href
		})
		.catch((e) => {
			console.log(e)
		})
	},
	hitungKembalianAct(context,kembalian) {
		context.commit(mutations.HITUNG_KEMBALIAN_ACT,kembalian)
	},
	tampilTagihan(context,page) {
		axios.get('/data-item-jual/list-tagihan',{
			params:{
				page:page
			}
		})
		.then((response) => {
			context.dispatch('loadBill',false)
			context.commit(mutations.TAMPIL_TAGIHAN,response.data)
		})
		.catch((e) => {
			console.log(e)
		})
	},
	pilihTagihan(context,param) {
		context.commit(mutations.PILIH_TAGIHAN,param)
		context.dispatch('closeModal','tagihanModal')
		context.dispatch('openModal','checkoutMenu')
	},
	cariTagihanAct(context,param) {
		if (param.cari_tagihan != null || param.cari_tagihan !== undefined) {
			context.dispatch('loadBill')
			// context.commit(mutations.CARI_TAGIHAN,param.cari_tagihan)
			axios.get('/data-item-jual/list-tagihan/cari', {
				params:{
					cari_tagihan:param.cari_tagihan,
					page:param.page
				}
			})
			.then(response => {
				context.dispatch('loadBill',false)
				context.commit(mutations.TAMPIL_TAGIHAN,response.data)
			})
		}
	},
	clearModalTagihan(context) {
		context.commit(mutations.CLEAR_MODAL_TAGIHAN)
	},
	tampilTagihanDetail(context,param) {
		context.dispatch('loadDetailBill',param.id_tagihan)
		axios.get('/data-item-jual/list-tagihan/detail/'+param.id_tagihan,{
			params:{
				page:param.page
			}
		})
		.then((response) => {
			context.dispatch('loadDetailBill',null)
			context.dispatch('showDetailBill')
			context.commit(mutations.TAGIHAN_DETAIL,response.data)
		})
		.catch((e) => {
			console.log(e)
		})
	},
	cariTagihanDetailAct(context,param) {
		if (param.cari != null || param.cari !== undefined) {
			context.dispatch('loadDetailBill','cari')
			// context.commit(mutations.CARI_TAGIHAN,param.cari)
			axios.get('/data-item-jual/list-tagihan/detail/'+param.id_tagihan+'/cari', {
				params:{
					cari:param.cari,
					page:param.page
				}
			})
			.then(response => {
				context.dispatch('loadDetailBill',null)
				context.commit(mutations.TAGIHAN_DETAIL,response.data)
			})
		}
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
	bayarTagihan(context,data_tagihan) {
		let clone       = {...data_tagihan}

		const {id_tagihan_detail,id_item_jual,banyak_pesan,nama_item,sub_total} = clone
		let id_list = '_' + Math.random().toString(36).substr(2, 9)
		let split_varian = clone.varian.split(":")
		let varian_pilih = {namaVarian:split_varian[0], hargaVarian:split_varian[1]}

		if (split_varian[0] == null || split_varian[0] == "") {
			varian_pilih = null
		}

		let bayar_tagihan = {
			id_tagihan_detail,
			id_item_jual,
			id_list,
			banyak_pesan,
			nama_item,
			sub_total,
			varian_pilih				
		}
		// axios.get('/bayar-tagihan',{
		// 	params:{
		// 		bayar_tagihan:bayar_tagihan
		// 	}
		// })
		// .then((response) => {
		// 	console.log(response.data)
		// })
		// .catch((e) => {
		// 	console.log(e)
		// })
		
		context.commit(mutations.BAYAR_TAGIHAN,bayar_tagihan)
	},
	bayarSemuaTagihan(context, id_tagihan) {
		context.dispatch('loadDetailBill',id_tagihan)
		axios.get('/bayar-semua-tagihan',{
			params:{
				id_tagihan:id_tagihan
			}
		})
		.then((response) => {
			context.dispatch('closeModal','tagihanModal')
			context.dispatch('loadDetailBill',null)
			context.dispatch('hideDetailBill')
			context.commit(mutations.BAYAR_SEMUA_TAGIHAN,response.data)
		})
		.catch((e) => {
			console.log(e)
		})
	},
	hapusTagihan(context,param) {
		context.dispatch('loadDeleteBill',param.id_tagihan)
		axios.get('/data-item-jual/hapus-tagihan',{
			params:{
				id_tagihan:param.id_tagihan
			}
		})
		.then((response) => {
			context.dispatch('loadDeleteBill')
			// context.commit(mutations.HAPUS_TAGIHAN,param.id_tagihan)
			context.dispatch('tampilTagihan',param.page)
			console.log(response.data)
		})
		.catch((e) => {
			console.log(e)
		})
	},
	hapusTagihanDetail(context,tagihan) {
		context.dispatch('loadDeleteDetailBill',tagihan.id_tagihan_detail)
		axios.get('/data-item-jual/hapus-detail-tagihan',{
			params:{
				id_tagihan:tagihan.id_tagihan,
				id_tagihan_detail:tagihan.id_tagihan_detail
			}
		})
		.then((response) => {
			context.dispatch('loadDeleteDetailBill')
			context.dispatch('tampilTagihanDetail',tagihan.page)
		})
		.catch((e) => {
			console.log(e)
		})
	}
}
