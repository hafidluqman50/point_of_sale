<template>
	<div>
		<div class="container-fluid" style="padding-top:.6%;" :class="{'is-blur':showModal}">
			<div class="row">
				<div class="col-md-9">
					<div class="card m-0">
						<div class="card-body scrollable-content">
		        			<div class="d-flex justify-content-center align-items-center" style="height:100%" v-if="isLoading">
								<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
									<span class="sr-only">Loading...</span>
								</div>
		        			</div>
			        		<div class="row" v-else>
			        			<div class="d-flex justify-content-center align-items-center" style="height:100%" v-if="dataMenu == null || dataMenu.length == 0">
			        				<div>
			        					<h5>Tidak Ada Menu</h5>
			        				</div>
			        			</div>
								<menu-item v-for="menuMakan in dataMenu" :menuMakan="menuMakan" :key="menuMakan.id" v-else></menu-item>
			        		</div>	
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="card m-0">
						<div class="card-header bg-light">
							<p class="card-text" style="margin:0;" align="center"><b>PESANAN</b></p>
						</div>
						<div class="card-body checkout">
							<table width="100%">
								<tr v-for="(item, index) in dataPesanan.menu" :key="index">
									<td style="font-size:18px;" @click="ubahMenu({item,index})"><b>{{ item.nama_menu }}</b>
										<tr v-if="item.keterangan != null || item.keterangan !== undefined">
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
							<h5><b>Total Harga : {{ dataPesanan.total_harga | formatRupiah }}</b></h5>
							<button class="btn btn-success" ref="checkoutAct" target-modal="checkoutMenu" @click="checkoutModal();">
								<b>CHECKOUT</b>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<vue-modal :idModal="'modalMenuItem'">
			<template v-slot:modal-header>
				<div class="vue-modal-title">
					<p><b>{{ singleData != null ? singleData.nama_menu : '' }}</b></p>
				</div>
				<div class="vue-modal-close">
					<button class="btn btn-dark" @click="closeMenu('modalMenuItem')">Close</button>
				</div>
			</template>
			<div class="form-group">
				<label for="">Varian</label>
				<div class="d-flex flex-wrap align-items-center justify-content-center">
					<div style="margin-right:3%;">
						<button class="btn btn-md btn-primary">Telor Setengah Matang</button>
					</div>
					<div style="margin-right:3%;">
						<button class="btn btn-md btn-primary">Telor Setengah Matang</button>
					</div>
					<div style="margin-right:3%;">
						<button class="btn btn-md btn-primary">Telor Setengah Matang</button>
					</div>
					<div style="margin-right:3%;">
						<button class="btn btn-md btn-primary">Telor Setengah Matang</button>
					</div>
					<div style="margin-right:3%;">
						<button class="btn btn-md btn-primary">Telor Setengah Matang</button>
					</div>
				</div>
			</div>
			<hr>
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
		<vue-modal :idModal="'modalEditMenu'">
			<template v-slot:modal-header>
				<div class="vue-modal-title">
					<p><b>{{ singleData != null ? singleData.nama_menu : '' }}</b></p>
				</div>
				<div class="vue-modal-close">
					<button class="btn btn-dark" @click="closeMenu('modalEditMenu')">Close</button>
				</div>
			</template>
			<div class="form-group">
				<label for="">Varian</label>
				<div class="d-flex flex-wrap align-items-center justify-content-center">
					<div style="margin-right:3%;">
						<button class="btn btn-md btn-primary">Telor Setengah Matang</button>
					</div>
					<div style="margin-right:3%;">
						<button class="btn btn-md btn-primary">Telor Setengah Matang</button>
					</div>
					<div style="margin-right:3%;">
						<button class="btn btn-md btn-primary">Telor Setengah Matang</button>
					</div>
					<div style="margin-right:3%;">
						<button class="btn btn-md btn-primary">Telor Setengah Matang</button>
					</div>
					<div style="margin-right:3%;">
						<button class="btn btn-md btn-primary">Telor Setengah Matang</button>
					</div>
				</div>
			</div>
			<hr>
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
				<button class="btn btn-primary float-md-right" v-if="loadSend == false" @click="prosesBayar(dataPesanan)">PROSES</button>
				<div class="spinner-border" role="status" v-else></div>
			</template>
		</vue-modal>
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
				// menu_input:{
				// 	jumlah:null,
				// 	keterangan:null
				// },
				bayarNanti:false,
				isKredit:false,
				money:{
					decimal:',',
					thousands:'.',
					prefix:'Rp. ',
					precision:2,
					masked:false
				}
			}
		},
		computed: {
			...mapGetters([
				'dataMenu',
				'isLoading',
				'loadSend',
				'showModal',
				'singleData',
				'dataPesanan',
				'menuInput',
				// 'bayarNanti'
			])
		},
		methods: {
			...mapActions([
				'openModal',
				'closeModal',
				'closeMenu',
				'tampilMenu',
				'pesanMenu',
				'checkoutPesanan',
				'listPesanan',
				'prosesBayar',
				'ubahMenu',
				'updateMenu',
				'hapusMenu'
			]),
			checkoutModal:function() {
				if (this.dataPesanan.menu.length != 0) {
					this.openModal('checkoutMenu')
				}
				else {
					console.log('Kosong Bos')
				}
			},
			ngetes:(index_arr) => {
				console.log(index_arr)
			},
			bayarKartuAct:function(param) {
				this.isKredit = param
			},
			bayarNantiAct:function(param) {
				this.bayarNanti = param
			}
		},
		mounted() {
			this.tampilMenu()
			this.listPesanan()
		},
	}
</script>