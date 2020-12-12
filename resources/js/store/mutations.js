import * as mutations from './mutations-type'
import axios from 'axios'

export default {
	[mutations.LOAD_STATE] (state,param = true) {
		state.isLoading = param
	},
	[mutations.LOAD_SEND] (state,param = true) {
		state.loadSend = param
	},
	[mutations.TAMPIL_ITEM_JUAL] (state,data_item_jual) {
		state.listItem = data_item_jual
	},
	[mutations.PILIH_ITEM] (state,data_item) {
		state.singleData = data_item
	},
	[mutations.VARIAN_PUSH] (state,data_varian) {
		state.menuInput.varian_pilih = data_varian
	},
	[mutations.LIST_PESANAN] (state,data_menu) {
		state.dataPesanan.menu        = data_menu.list_item
		state.dataPesanan.total_harga = data_menu.total_harga
	},
	[mutations.PESAN_MENU] (state,data_menu) {
		let data_clone = {...data_menu}

		state.dataPesanan.total_harga+=data_menu.sub_total
		state.dataPesanan.menu.push(data_clone) 

		console.log(state.dataPesanan.menu)
	},
	[mutations.CARI_ITEM] (state,data_cari) {
		state.listItem = data_cari
	},
	[mutations.UBAH_MENU] (state,payload) {
		state.singleData             = payload.item
		state.menuInput.banyak_pesan = payload.item.banyak_pesan
		state.menuInput.varian_pilih = payload.item.varian_pilih
		state.menuInput.keterangan   = payload.item.keterangan
		state.menuInput.harga_item   = payload.item.harga_item
		state.menuInput.indexMenu    = payload.index
	},
	[mutations.UPDATE_MENU] (state,data_update) {
		const {indexMenu,banyak_pesan,varian_pilih,keterangan,harga_item,sub_total} = data_update

		state.dataPesanan.menu[indexMenu].banyak_pesan = banyak_pesan
		state.dataPesanan.menu[indexMenu].keterangan   = keterangan
		state.dataPesanan.menu[indexMenu].varian_pilih = varian_pilih

		state.dataPesanan.total_harga-=state.dataPesanan.menu[indexMenu].sub_total

		state.dataPesanan.menu[indexMenu].sub_total = sub_total

		state.dataPesanan.total_harga+=state.dataPesanan.menu[indexMenu].sub_total
	},
	[mutations.HAPUS_MENU] (state,index_arr) {
		const dataPesanan = state.dataPesanan.menu
		
		const removePesanan = (data,index) => {
			state.dataPesanan.total_harga-=data[index].sub_total
			return data.slice(0,index).concat(data.slice(index+1,data.length))
		}

  		state.dataPesanan.menu = removePesanan(dataPesanan,index_arr)
	},
	[mutations.DESTROY_MENU_ACT] (state) {
		state.dataPesanan.total_harga  = 0
		// state.dataPesanan.kembalian = null
		state.dataPesanan.menu         = []
		state.loadSend                 = false
	},
	[mutations.CLEAR_PESAN_MENU] (state) {
		state.menuInput.banyak_pesan = null
		state.menuInput.keterangan   = null
		state.menuInput.indexMenu    = null
		state.menuInput.varian_pilih = null
	},
	[mutations.PROSES_BAYAR] (state) {
		state.dataPesanan.total_harga  = 0
		state.dataPesanan.total_bayar  = 0
		// state.dataPesanan.kembalian = null
		state.dataPesanan.menu         = []
		state.loadSend                 = false
	},
	[mutations.PROSES_TAGIHAN] (state) {
		state.dataPesanan.total_harga   = 0
		// state.dataPesanan.kembalian  = null
		state.dataPesanan.menu          = []
		state.dataPesanan.nama_customer = null
		state.loadSend                  = false
	},
	// [mutations.PROSES_TAGIHAN] (state) {
	// 	state.data
	// }
	// [mutations.GET_PEMBAYARAN] (state,data_bayar) {
	// 	state.transaksi.dataBayar = data_bayar.pembayaran
	// 	state.transaksi.count     = data_bayar.count
	// },
	[mutations.OPEN_MODAL] (state) {
		state.showModal = true
	},
	[mutations.CLOSE_MODAL] (state) {
		state.showModal = false
	},
	[mutations.CLOSE_PESAN] (state) {
		state.menuInput.banyak_pesan = null
		state.menuInput.keterangan   = null
	}
}