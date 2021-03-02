<template>
	<div>
		<div class="container-fluid" style="padding-top:.6%;" :class="{'is-blur':showModal}">
			<div class="row">
				<div class="col-md-9">
					<div class="card m-0">
						<div class="card-body scrollable-content">
		        			<div class="d-flex justify-content-center align-items-center" style="height:100%" v-if="loadItem">
								<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
									<span class="sr-only">Loading...</span>
								</div>
		        			</div>
			        		<div class="row" v-else>
			        			<div class="d-flex justify-content-center align-items-center" style="height:100%" v-if="listItem == null || listItem.length == 0">
			        				<div>
			        					<h5>Tidak Ada Menu</h5>
			        				</div>
			        			</div>
								<menu-item v-for="itemJual in listItem.data_item" :itemJual="itemJual" :key="itemJual.id" v-else></menu-item>
			        		</div>	
						</div>
						<div class="card-footer d-flex justify-content-center align-items-center" style="padding-bottom:">
							<nav aria-label="page navigation example" v-if="listItem.length == 0">
								<ul class="pagination" style="margin:0;">
									<li class="page-item"><button class="page-link" href="#">Previous</button></li>
									<div>
										<li class="page-item active"><button class="page-link" href="#">1</button></li>
									</div>
									<li class="page-item"><button class="page-link" href="#">Next</button></li>
								</ul>
							</nav>
							<nav aria-label="page navigation example" v-else>
								<ul class="pagination">
									<li class="page-item"><button class="page-link" href="#" :disabled="pageItemPosition == 1" @click="pageItem(pageItemPosition-1)">Previous</button></li>
										<div v-for="count in listItem.count">
											<li :class="`page-item ${pageItemPosition == count ? 'active' : ''}`">
												<button class="page-link" href="#" :disabled="pageItemPosition == count" @click="pageItem(count)">{{count}}</button>
											</li>
										</div>
									<li class="page-item"><button class="page-link" href="#" :disabled="pageItemPosition == listItem.count" @click="pageItem(pageItemPosition+1)">Next</button></li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card m-0">
						<div class="card-header bg-light">
							<div class="row">
								<div class="col-md-4 no-padding tagihan-menu" @click="openModal('tagihanModal'); tampilTagihan(1)">
									<span class="fas fa-bars"></span> Tagihan
								</div>
								<div class="col-md-8 no-padding">
									<p class="card-text" style="margin:0;" align="center"><b>PESANAN</b></p>
								</div>
							</div>
						</div>
						<div class="card-body checkout">
							<table width="100%">
								<tr v-for="(item, index) in dataPesanan.menu" :key="index">
									<td style="font-size:18px;" @click="ubahMenu({item,index})"><b>{{ item.nama_item }}</b>
										<tr v-if="item.varian_pilih !== null && item.varian_pilih !== undefined">
											<td style="font-size:15px;">{{ item.varian_pilih.namaVarian }} : {{ item.varian_pilih.hargaVarian | formatRupiah }}</td>
										</tr>
										<tr v-if="item.keterangan !== null || item.keterangan !== undefined">
											<td style="font-size:15px;">{{ item.keterangan }}</td>
										</tr>
									</td>
									<td>{{ item.banyak_pesan}}x</td>
									<td>{{ item.sub_total | formatRupiah }}</td>
									<td><button class="close" @click="hapusMenu({index,item})">X</button></td>
								</tr>
							</table>
						</div>
						<div class="card-footer" align="center">
							<button class="btn btn-danger" @click="destroyMenu();">
								<b>Hapus Semua</b>
							</button>
							<h5><b>Total Harga : {{ dataPesanan.total_harga | formatRupiah }}</b></h5>
							<button class="btn btn-success" ref="checkoutAct" target-modal="checkoutMenu" @click="checkoutModal();">
								<b>CHECKOUT</b>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- MODAL MENU TAMBAH -->
		<vue-modal :idModal="'modalMenuItem'">
			<template v-slot:modal-header>
				<div class="vue-modal-title">
					<p><b>{{ singleData != null ? singleData.nama_item : '' }}</b></p>
				</div>
				<div class="vue-modal-close">
					<button class="btn btn-dark" @click="closeMenu('modalMenuItem')">Close</button>
				</div>
			</template>
			<div v-if="singleData != null">
				<div class="form-group" v-if ="singleData.varian != null && singleData.varian.length != 0">
					<label for="">Varian</label>
					<div class="d-flex flex-wrap">
						<div style="margin-right:2%;" v-for="varian in singleData.varian">
							<button :class="`btn btn-md btn${menuInput.varian_pilih != null ? (menuInput.varian_pilih.namaVarian == varian.nama_varian ? '-' : '-outline-') : '-outline-'}dark`" @click="VarianAct({namaVarian:varian.nama_varian,hargaVarian:varian.harga_varian})">{{ varian.nama_varian }}</button>
						</div>
					</div>
					<hr>
				</div>
			</div>
			<div class="form-group">
				<label for="">Jumlah</label>
				<input type="number" name="jumlah" class="form-control" placeholder="Jumlah Menu" v-model="menuInput.banyak_pesan">
			</div>
			<hr>
			<div class="form-group">
				<label for="">Keterangan</label>
				<input type="text" name="keterangan" class="form-control" placeholder="Keterangan Menu" v-model="menuInput.keterangan">
			</div>
			<hr>
			<template v-slot:modal-footer>
				<button class="btn btn-primary float-md-right" @click="pesanMenu({singleData,menuInput});">PESAN MENU</button>
			</template>
		</vue-modal>
		<!-- END MODAL MENU TAMBAH -->
		<!-- MODAL MENU EDIT -->
		<vue-modal :idModal="'modalEditMenu'">
			<template v-slot:modal-header>
				<div class="vue-modal-title">
					<p><b>{{ singleData != null ? singleData.nama_menu : '' }}</b></p>
				</div>
				<div class="vue-modal-close">
					<button class="btn btn-dark" @click="closeMenu('modalEditMenu')">Close</button>
				</div>
			</template>
			<div v-if="singleData != null">
				<div class="form-group" v-if ="singleData.varian != null && singleData.varian.length != 0">
					<label for="">Varian</label>
					<div class="d-flex flex-wrap">
						<div style="margin-right:2%;" v-for="varian in singleData.varian">
							<button :class="`btn btn-md btn${menuInput.varian_pilih != null ? (menuInput.varian_pilih.namaVarian == varian.nama_varian ? '-' : '-outline-') : '-outline-'}dark`" @click="VarianAct({namaVarian:varian.nama_varian,hargaVarian:varian.harga_varian})">{{ varian.nama_varian }}</button>
						</div>
					</div>
					<hr>
				</div>
			</div>
			<div class="form-group">
				<label for="">Jumlah</label>
				<input type="number" name="jumlah" class="form-control" placeholder="Jumlah Menu" v-model="menuInput.banyak_pesan">
			</div>
			<hr>
			<div class="form-group">
				<label for="">Keterangan</label>
				<input type="text" name="keterangan" class="form-control" placeholder="Keterangan Menu" v-model="menuInput.keterangan">
			</div>
			<hr>
			<template v-slot:modal-footer>
				<button class="btn btn-warning float-md-right" @click="updateMenu(menuInput)">UBAH MENU</button>
			</template>
		</vue-modal>
		<!-- END MODAL MENU EDIT -->
		<!-- MODAL CHECKOUT -->
		<vue-modal :idModal="'checkoutMenu'">
			<template v-slot:modal-header>
				<div class="vue-modal-title">
					<p><b>CHECKOUT</b></p>
				</div>
				<div class="vue-modal-close">
					<button class="btn btn-dark" @click="closeModal('checkoutMenu')">Close</button>
				</div>
			</template>
			<p><b>Harga Total : {{ dataPesanan.total_harga | formatRupiah }}</b></p>
			<button :class="`btn btn-outline-success ${bayarNanti ? '' : 'active'}`" @click="bayarNantiAct(false)">Bayar Sekarang</button>
			<button :class="`btn btn-outline-info ${bayarNanti ? 'active' : ''}`" @click="bayarNantiAct(true)">Bayar Nanti</button>
			<hr>
			<div :class="{'is-hide':bayarNanti}">
				<label for="">Metode Bayar</label>
				<div class="form-group">
					<button :class="`btn btn-outline-primary ${isKredit ? '' : 'active'}`" @click="bayarKartuAct(false)">Tunai</button>
					<button :class="`btn btn-outline-primary ${isKredit ? 'active' : ''}`" @click="bayarKartuAct(true)">Kartu Debit/Kredit</button>
				</div>
				<hr>
				<div v-if="isKredit == false">
					<div class="form-group">
						<label for="">Jumlah Bayar</label>
						<money class="form-control" name="jumlah_bayar" v-model="dataPesanan.total_bayar" v-bind="money">
						</money>
					</div>
					<hr>
				</div>
				<div v-else>
					<input type="hidden" :value="dataPesanan.total_harga">
				</div>
			</div>
			<div :class="`form-group ${bayarNanti == false ? 'is-hide' : ''}`">
				<label for="">Nama Customer</label>
				<input type="text" name="nama_customer" class="form-control" v-model="dataPesanan.nama_customer" placeholder="Isi Nama Customer">
			</div>
			<div class="form-group">
				<label for="">Keterangan</label>
				<input type="text" name="ket_bayar" class="form-control" v-model="dataPesanan.keterangan">
			</div>
			<hr>
			<div v-if="bayarNanti">
				<input type="hidden" :value="dataPesanan.ket_bayar = 'bayar-nanti'">
				<input type="hidden" :value="dataPesanan.status_transaksi = 'belum-bayar'">
			</div>
			<div v-else>
				<input type="hidden" :value=" dataPesanan.ket_bayar = 'bayar-sekarang'">
				<input type="hidden" :value=" dataPesanan.status_transaksi = 'sudah-bayar'">
			</div>
			<template v-slot:modal-footer>
				<div v-if="loadSend == false">
					<button class="btn btn-primary float-md-right" v-if="bayarNanti == false" @click="prosesBayar(dataPesanan)">Proses</button>
					<button class="btn btn-primary float-md-right" v-else @click="prosesTagihan(dataPesanan)">Simpan Tagihan</button>
				</div>
				<div class="spinner-border" role="status" v-else></div>
			</template>
		</vue-modal>
		<!-- END MODAL CHECKOUT -->
		<!-- MODAL TAGIHAN -->
		<vue-modal :idModal="'tagihanModal'">
			<template v-slot:modal-header>
				<div class="vue-modal-title">
					<p><b>TAGIHAN</b></p>
				</div>
				<div class="vue-modal-close">
					<button class="btn btn-dark" @click="closeModal('tagihanModal');">Close</button>
				</div>
			</template>
			<div :class="`${showDetailBill ? 'is-hide' : ''}`">
				<div class="row">
					<div class="col-md-4">	
						<div class="form-group">
							<input type="text" class="form-control" v-model="cariTagihan" placeholder="Cari Tagihan">
						</div>
					</div>
					<div class="col-md-4">
						<button class="btn btn-primary" @click="cariTagihanAct({cari_tagihan:cariTagihan,page:1})"><span class="fas fa-search"></span></button>
					</div>
				</div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>No.</th>
							<th>Nama Customer</th>
							<th>Total Tagihan</th>
							<th>Keterangan</th>
							<th>#</th>
						</tr>
					</thead>
					<tbody>
						<tr v-if="loadBill">
							<td align="center" colspan="5">
			        			<div class="d-flex justify-content-center align-items-center" style="height:100%">
									<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
										<span class="sr-only">Loading...</span>
									</div>
			        			</div>
							</td>
						</tr>
						<tr v-else-if="listTagihan.data_tagihan.length == 0 && loadBill == false">
							<td align="center" colspan="5">
								Tidak Ada Data
							</td>
						</tr>
						<tr v-for="(item,index) in listTagihan.data_tagihan" :key="index" v-else>
							<td>{{ index+1 }}</td>
							<td>{{ item.nama_customer }}</td>
							<td>{{ item.total_tagihan | formatRupiah }}</td>
							<td>{{ item.keterangan }}</td>
							<td>
								<button class="btn btn-info" disabled="disabled" v-if="loadDetailBill == item.id_tagihan">
  									<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  									Loading...
								</button>
								<button class="btn btn-info" @click="tampilTagihanDetail({id_tagihan:item.id_tagihan,page:1}); getIdTagihan(item.id_tagihan)" v-else>
									Lihat List Tagihan
								</button>
								<button class="btn btn-danger">
									Hapus
								</button>
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="5">
								<!-- <div class="d-flex align-items-center justify-content-center"> -->
								<nav aria-label="page navigation example" v-if="listTagihan.data_tagihan.length == 0">
									<ul class="pagination" style="margin:0;">
										<li class="page-item"><button class="page-link" href="#">Previous</button></li>
										<div>
											<li class="page-item active"><button class="page-link" href="#">1</button></li>
										</div>
										<li class="page-item"><button class="page-link" href="#">Next</button></li>
									</ul>
								</nav>
								<nav aria-label="page navigation example" v-else>
									<ul class="pagination">
										<li class="page-item"><button class="page-link" href="#" :disabled="pageBillPosition == 1" @click="pageBill(pageBillPosition-1)">Previous</button></li>
											<div v-for="count in listTagihan.count">
												<li :class="`page-item ${pageBillPosition == count ? 'active' : ''}`">
													<button class="page-link" href="#" :disabled="pageBillPosition == count" @click="pageBill(count)">{{count}}</button>
												</li>
											</div>
										<li class="page-item"><button class="page-link" href="#" :disabled="pageBillPosition == listTagihan.count" @click="pageBill(pageBillPosition+1)">Next</button></li>
									</ul>
								</nav>
								<!-- </div> -->
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<div :class="`${showDetailBill ? '' : 'is-hide'}`">
				<button class="btn btn-default" @click="hideDetailBill(); removeIdTagihan()"><span class="fa fa-arrow-left"></span> Kembali</button>
				<!-- <hr> -->
				<!-- <h6>Total Tagihan : </h6> -->
				<hr>
				<div class="row">
					<div class="col-md-4">
						<button class="btn btn-success" disabled="disabled" v-if="loadDetailBill == id_tagihan">
							<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
							Loading...
						</button>
						<button class="btn btn-success" style="margin-bottom:10px;" @click="bayarSemuaTagihan(id_tagihan)" v-else>
							Bayar Semua
						</button>
					</div>
					<div class="col-md-4">	
						<div class="form-group">
							<input type="search" class="form-control" v-model="cariDetailTagihan" placeholder="Cari Tagihan">
						</div>
					</div>
					<div class="col-md-4">
						<button class="btn btn-primary" @click="cariTagihanDetailAct({id_tagihan:id_tagihan,cari:cariDetailTagihan,page:1})"><span class="fas fa-search"></span></button>
					</div>
				</div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>No.</th>
							<th>Tanggal Tagihan</th>
							<th>Nama Item</th>
							<th>Banyak Pesan</th>
							<th>Sub Total</th>
							<th>Varian</th>
							<th>Keterangan</th>
							<th>#</th>
						</tr>
					</thead>
					<tbody>
						<tr v-if="loadDetailBill == 'cari'">
							<td align="center" colspan="8">
			        			<div class="d-flex justify-content-center align-items-center" style="height:100%">
									<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
										<span class="sr-only">Loading...</span>
									</div>
			        			</div>
							</td>
						</tr>
						<tr v-for="(item,index) in listDetailTagihan.data_detail_tagihan" :key="index" v-else>
							<td>{{ index+1 }}</td>
							<td>{{ item.tgl_tagihan | formatDate }}</td>
							<td>{{ item.nama_item }}</td>
							<td>{{ item.banyak_pesan }}</td>
							<td>{{ item.sub_total | formatRupiah }}</td>
							<td>{{ item.varian }}</td>
							<td>{{ item.keterangan }}</td>
							<td>
								<button class="btn btn-success" @click="bayarTagihan(item)">Bayar</button>
								<button class="btn btn-danger">Delete</button>
							</td>
						</tr>
						<tr>
							<td colspan="8">
								<nav aria-label="page navigation example" v-if="listDetailTagihan.data_detail_tagihan.length == 0">
									<ul class="pagination" style="margin:0;">
										<li class="page-item"><button class="page-link" href="#">Previous</button></li>
										<div>
											<li class="page-item active"><button class="page-link" href="#">1</button></li>
										</div>
										<li class="page-item"><button class="page-link" href="#">Next</button></li>
									</ul>
								</nav>
								<nav aria-label="page navigation example" v-else>
									<ul class="pagination">
										<li class="page-item"><button class="page-link" href="#" :disabled="pageDetailBillPosition == 1" @click="pageDetailBill(pageDetailBillPosition-1)">Previous</button></li>
											<div v-for="count in listDetailTagihan.count">
												<li :class="`page-item ${pageDetailBillPosition == count ? 'active' : ''}`">
													<button class="page-link" href="#" :disabled="pageDetailBillPosition == count" @click="pageDetailBill(count)">{{count}}</button>
												</li>
											</div>
										<li class="page-item"><button class="page-link" href="#" :disabled="pageDetailBillPosition == listDetailTagihan.count" @click="pageDetailBill(pageDetailBillPosition+1)">Next</button></li>
									</ul>
								</nav>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</vue-modal>
		<!-- END MODAL TAGIHAN -->
	</div>
</template>

<script>
	import { mapGetters,mapActions } from 'vuex'
	import { EventBus } from '../../../event-bus.js'
	import {Money} from 'v-money'

	export default {
		components: {Money},
		data() {
			return {
				pageItemPosition:null,
				pageBillPosition:1,
				pageDetailBillPosition:1,
				cariTagihan:null,
				cariDetailTagihan:null,
				bayarNanti:false,
				isKredit:false,
				money:{
					decimal:',',
					thousands:'.',
					prefix:'Rp. ',
					precision:2,
					masked:false
				},
				id_tagihan:null
			}
		},
		computed: {
			...mapGetters([
				'listItem',
				'loadItem',
				'loadSend',
				'loadBill',
				'loadDetailBill',
				'showDetailBill',
				'showModal',
				'singleData',
				'dataPesanan',
				'menuInput',
				'cariItem',
				'listTagihan',
				'listDetailTagihan'
			])
		},
		methods: {
			...mapActions([
				'openModal',
				'closeModal',
				'closeMenu',
				'tampilItemJual',
				'cariItemAct',
				'pesanMenu',
				'destroyMenuAct',
				'varianPush',
				'checkoutPesanan',
				'listPesanan',
				'tampilTagihan',
				'cariTagihanAct',
				'clearModalTagihan',
				'prosesBayar',
				'prosesTagihan',
				'tampilTagihanDetail',
				'cariTagihanDetailAct',
				'hideDetailBill',
				'bayarTagihan',
				'bayarSemuaTagihan',
				'ubahMenu',
				'updateMenu',
				'hapusMenu'
			]),
			pageItem:function(page) {
				this.pageItemPosition = page
				if (this.cariItem == null) {
					this.tampilItemJual(page)
				}
				else {
					let cariItem = this.cariItem
					this.cariItemAct({cari:cariItem,page:page})
				}
			},
			pageBill:function(page) {
				this.pageBillPosition = page
				if (this.cariTagihan == null) {
					this.tampilTagihan(page)
				}
				else {
					let cariTagihan = this.cariTagihan
					this.cariTagihanAct({cari:cariTagihan,page:page})
				}
			},
			pageDetailBill:function(page) {
				this.pageDetailBillPosition = page
				if (this.cariDetailTagihan == null) {
					this.tampilDetailTagihan(page)
				}
				else {
					let cariDetailTagihan = this.cariDetailTagihan
					this.cariTagihanDetailAct({cari:cariDetailTagihan,page:page})
				}
			},
			checkoutModal:function() {
				if (this.dataPesanan.menu.length != 0) {
					this.openModal('checkoutMenu')
				}
				else {
					console.log('Kosong Bos')
				}
			},
			destroyMenu:function() {
				this.destroyMenuAct();
			},
			ngetes:(index_arr) => {
				console.log(index_arr)
			},
			VarianAct:function(param) {
				this.varianPush(param)
			},
			bayarKartuAct:function(param) {
				this.isKredit = param
			},
			bayarNantiAct:function(param) {
				this.bayarNanti = param
			},
			getIdTagihan:function(param) {
				this.id_tagihan = param
			},
			removeIdTagihan:function() {
				if (this.id_tagihan != null) {
					this.id_tagihan = null
				}
			}
		},
		mounted() {
			this.pageItem(1)
			this.listPesanan()
		},
	}
</script>