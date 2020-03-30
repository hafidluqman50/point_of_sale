<template>
	<div>
		<div class="container-fluid" style="padding-top:.6%;" v-bind:class="{'is-blur':showModal}">
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
								<menu-item v-for="menuMakan in dataMenu" :menuMakan="menuMakan" :key="menuMakan.id"></menu-item>
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
								<tr v-for="data_pesan in dataPesanan.pesanan">
									<td style="font-size:18px;"><b>{{ data_pesan.nama_menu }}</b>
										<tr v-if="data_pesan.keterangan != null || data_pesan.keterangan !== undefined">
											<td style="font-size:15px;">{{ data_pesan.keterangan }}</td>
										</tr>
									</td>
									<td>{{ data_pesan.banyak_pesan}}x</td>
									<td>{{ data_pesan.sub_total | formatRupiah }}</td>
								</tr>
							</table>
						</div>
						<div class="card-footer bg-success cursor-pointer" align="center" @click="checkoutPesanan()">
							<b v-if="loadSend == false">CHECKOUT</b>
							<div class="spinner-border" role="status" v-else></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<vue-modal :modalInfo="singleData != null ? singleData.nama_menu : ''">
			<div class="form-group">
				<label for="">Jumlah</label>
				<input type="number" name="jumlah" class="form-control" placeholder="Jumlah Menu" v-model="menuInput.banyak_pesan">
			</div>
			<div class="form-group">
				<label for="">Keterangan</label>
				<input type="text" name="keterangan" class="form-control" placeholder="Keterangan Menu" v-model="menuInput.keterangan">
			</div>
			<template v-slot:modal-footer>
				<button class="btn btn-primary float-md-right" @click="pesanMenu(singleData)">PESAN MENU</button>
			</template>
		</vue-modal>
	</div>
</template>

<script>
	import { mapGetters,mapActions } from 'vuex'

	export default {
		computed: {
			...mapGetters([
				'dataMenu',
				'isLoading',
				'loadSend',
				'showModal',
				'singleData',
				'dataPesanan',
				'menuInput'
			])
		},
		methods: {
			...mapActions([
				'tampilMenu',
				'pesanMenu',
				'checkoutPesanan'
			])
		},
		mounted() {
			this.tampilMenu()
		}
	}
</script>