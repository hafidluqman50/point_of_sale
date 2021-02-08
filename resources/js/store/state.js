export default {
	loadItem:false,
	loadSend:false,
	loadBill:false,
	loadDetailBill:null,
	showDetailBill:false,
	showModal:false,
	// bayarNanti:false,
	listItem:null,
	transaksi:{
		count:null,
		dataBayar:[]
	},
	dataPesanan:{
		total_harga:0,
		total_bayar:0,
		// kembalian:null,
		keterangan:null,
		ket_bayar:null,
		status_transaksi:null,
		nama_customer:null,
		menu:[],
	},
	dataTagihan:[],
	dataDetailTagihan:[],
	menuInput:{
		varian_pilih:null,
		banyak_pesan:null,
		keterangan:null,
		sub_total:null,
		indexMenu:null,
	},
	singleData:null
}