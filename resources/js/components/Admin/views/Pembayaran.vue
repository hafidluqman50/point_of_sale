<template>
	<div class="container-fluid" style="padding-top: .6%">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>Tanggal Bayar</th>
									<th>Total Harga</th>
									<th>Total Bayar</th>
									<th>Ket Bayar</th>
									<th>Status</th>
									<th>Keterangan</th>
									<th>#</th>
								</tr>
							</thead>
							<tbody>
								<tr v-if="isLoading">
									<td align="center" colspan="6">
					        			<div class="d-flex justify-content-center align-items-center" style="height:100%">
											<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
												<span class="sr-only">Loading...</span>
											</div>
					        			</div>
									</td>
								</tr>
								<tr v-else-if="transaksi.dataBayar.length == 0 && isLoading == false">
									<td align="center" colspan="6">
										Tidak Ada Data
									</td>
								</tr>
								<tr v-for="(bayar,key) in transaksi.dataBayar" v-else>
									<td>{{ key+1 }}</td>
									<td>{{ bayar.tanggal_transaksi | formatDate }}</td>
									<td>{{ bayar.total_harga | formatRupiah }}</td>
									<td>{{ bayar.total_bayar | formatRupiah }}</td>
									<td>{{ bayar.ket_bayar }}</td>
									<td>{{ bayar.status_transaksi }}</td>
									<td>{{ bayar.keterangan }}</td>
									<td>
										<!-- <router-link :to="{path:'/admin/kasir/pembayaran/detail/'+bayar.id_transaksi}"> -->
											<button class="btn btn-success" :disabled="bayar.status_transaksi == 'sudah-bayar'" @click="openModal('pembayaran')">Bayar</button>
										<!-- </router-link> -->
										<router-link :to="{path:'/admin/kasir/pembayaran/detail/'+bayar.id_transaksi}">
											<button class="btn btn-info">Detail</button>
										</router-link>
										<button class="btn btn-danger">Batal</button>
									</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="6">
										<nav aria-label="Page navigation example">
										  <ul class="pagination">
											 <li class="page-item"><button class="page-link" href="#" :disabled="pagePosition == 1" @click="pageSelect(pagePosition-1)">Previous</button></li>
										  	<div v-for="count in transaksi.count">
											    <li :class="`page-item ${pagePosition == count ? 'active' : ''}`"><button class="page-link" href="#" :disabled="pagePosition == count" @click="pageSelect(count)">{{count}}</button></li>
										  	</div>
											<li class="page-item"><button class="page-link" href="#" :disabled="pagePosition == transaksi.count" @click="pageSelect(pagePosition+1)">Next</button></li>
										  </ul>
										</nav>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<vue-modal :idModal="'pembayaran'">
					<template v-slot:modal-header>
						<div class="vue-modal-title">
							<p><b>CHECKOUT</b></p>
						</div>
						<div class="vue-modal-close">
							<button class="btn btn-dark" @click="closeModal('pembayaran')">Close</button>
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
		</div>	
	</div>
</template>

<script>
	import {mapGetters,mapActions} from 'vuex'
	import {Money} from 'v-money'

	export default {
		components: {Money},
		data() {
			return {
				pagePosition:null,
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
				'transaksi',
				'isLoading',
				'loadSend'
			])
		},
		methods: {
			...mapActions([
				'getPembayaran',
				'dataPesanan',
				'openModal',
				'closeModal'
			]),
			pageSelect:function(page) {
				this.pagePosition = page
				this.getPembayaran(page)
			},
			bayarKartuAct:function(param) {
				this.isKredit = param
			},
			bayarNantiAct:function(param) {
				this.bayarNanti = param
			}
		},
		mounted() {
			this.pageSelect(1)
		}
	}
</script>