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
								<tr v-else-if="dataPembayaran.length == 0 && isLoading == false">
									<td align="center" colspan="6">
										Tidak Ada Data
									</td>
								</tr>
								<tr v-for="(bayar,key) in dataPembayaran" v-else>
									<td>{{ key+1 }}</td>
									<td>{{ bayar.tanggal_transaksi | formatDate }}</td>
									<td>{{ bayar.total_harga | formatRupiah }}</td>
									<td>{{ bayar.total_bayar | formatRupiah }}</td>
									<td>{{ bayar.ket_bayar }}</td>
									<td>{{ bayar.status_transaksi }}</td>
									<td>{{ bayar.keterangan }}</td>
									<td>
										<!-- <router-link :to="{path:'/admin/kasir/pembayaran/detail/'+bayar.id_transaksi}"> -->
											<button class="btn btn-success" :disabled="bayar.status_transaksi == 'sudah-bayar'">Bayar</button>
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
										    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
										    <li class="page-item active"><a class="page-link" href="#">1</a></li>
										    <li class="page-item"><a class="page-link" href="#">2</a></li>
										    <li class="page-item"><a class="page-link" href="#">3</a></li>
										    <li class="page-item"><a class="page-link" href="#">Next</a></li>
										  </ul>
										</nav>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<!-- <vue-modal :idModal="'bayarMenu'">
					<template v-slot:modal-header>
						<div class="vue-modal-title">
							<p><b>CHECKOUT</b></p>
						</div>
						<div class="vue-modal-close">
							<button class="btn btn-dark" @click="closeModal('bayarMenu')">Close</button>
						</div>
					</template>
					<p><b>Harga Total : {{ dataPesanan.total_harga | formatRupiah }}</b></p>
					<hr>
					<div>
						<label for="">Metode Bayar</label>
						<div class="form-group">
							<button class="btn btn-outline-primary active">Tunai</button>
							<button class="btn btn-outline-primary">Kartu Debit/Kredit</button>
						</div>
						<hr>
						<div class="form-group">
							<label for="">Jumlah Bayar</label>
							<input type="number" class="form-control" name="jumlah_bayar" v-model="dataPesanan.total_bayar">
						</div>
						<hr>
						<div class="form-group">
							<label for="">Keterangan</label>
							<input type="text" name="ket_bayar" class="form-control" v-model="dataPesanan.keterangan">
						</div>
						<hr>
					</div>
					<template v-slot:modal-footer>
						<button class="btn btn-primary float-md-right" v-if="loadSend == false" @click="prosesBayar(dataPesanan)">PROSES</button>
						<div class="spinner-border" role="status" v-else></div>
					</template>
				</vue-modal> -->
			</div>
		</div>	
	</div>
</template>

<script>
	import {mapGetters,mapActions} from 'vuex'

	export default {
		computed: {
			...mapGetters([
				'dataPembayaran',
				'isLoading'
			])
		},
		methods: {
			...mapActions([
				'getPembayaran'
			])
		},
		mounted() {
			this.getPembayaran()
		}
	}
</script>