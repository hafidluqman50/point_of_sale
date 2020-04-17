export default {
	isLoading:false,
	loadSend:false,
	// showModal:{
	// 	modalMenu:false,
	// 	modalUbah:false,
	// 	modalBayar:false
	// },
	showModal:false,
	bayarNanti:false,
	dataMenu:null,
	dataPembayaran:[],
	dataPesanan:{
		total_harga:null,
		total_bayar:null,
		// kembalian:null,
		keterangan:null,
		pesanan:[],
	},
	menuInput:{
		varian:[],
		banyak_pesan:null,
		keterangan:null,
	},
	singleData:null
}