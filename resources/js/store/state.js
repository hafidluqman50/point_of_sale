export default {
	sidebarToggle:false,
	sidebarMenu:[],
	menuClicked:null,
	loadItem:false,
	loadSend:false,
	loadBill:false,
	loadDetailBill:null,
	loadDeleteBill:null,
	loadDeleteDetailBill:null,
	showDetailBill:false,
	showModal:false,
	// bayarNanti:false,
	listItem:{
		count:null,
		data_item:[]
	},
	cariItem:null,
	transaksi:{
		count:null,
		dataBayar:[]
	},
	dataPesanan:{
		total_harga:0,
		total_bayar:0,
		kembalian:0,
		keterangan:null,
		ket_bayar:null,
		status_transaksi:null,
		nama_customer:null,
		menu:[],
	},
	listTagihan:{
		count:null,
		data_tagihan:[]
	},
	listDetailTagihan:{
		count:null,
		data_detail_tagihan:[]
	},
	menuInput:{
		varian_pilih:null,
		banyak_pesan:null,
		keterangan:null,
		sub_total:null,
		indexMenu:null,
	},
	singleData:null
}