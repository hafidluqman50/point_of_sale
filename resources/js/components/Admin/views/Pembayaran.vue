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
									<!-- <th>Status</th> -->
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
									<td>{{ bayar.tanggal_transaksi }}</td>
									<td>{{ bayar.total_harga | formatRupiah }}</td>
									<td>{{ bayar.total_bayar | formatRupiah }}</td>
									<td>{{ bayar.keterangan }}</td>
									<td>
										<!-- <router-link :to="{path:'/admin/kasir/pembayaran/detail/'+bayar.id_transaksi}"> -->
											<button class="btn btn-success">Bayar</button>
										<!-- </router-link> -->
										<router-link :to="{path:'/admin/kasir/pembayaran/detail/'+bayar.id_transaksi}">
											<button class="btn btn-info">Detail</button>
										</router-link>
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