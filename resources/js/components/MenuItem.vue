<template>
	<div class="col-xl-2 col-lg-3 col-md-4">
		<div class="card">
			<img class="card-img-top" :src="'/assets/foto_menu/'+menuMakan.foto_menu" alt="Card image tap" draggable="false">
			<div class="card-body">
				<h5 class="card-title"><b>{{ menuMakan.nama_menu }}</b></h5>
				<p class="card-text" style="margin-top:5px; margin-bottom:5px;">
					{{ menuMakan.harga_menu | formatRupiah }}
				</p>
				<span class="badge badge-success" v-if="menuMakan.status_menu == 'tersedia'" style="font-size:14px;">
					Tersedia
				</span>
				<span class="badge badge-danger" v-else style="font-size:14px;">
					Kosong
				</span>
			</div>
			<div class="d-flex justify-content-center card-footer bg-primary checkout-div" v-on:click="pilihMenu(menuMakan)">
				<p class="card-text">
					<b>PESAN</b>
				</p>
			</div>
		</div>	
	</div>
</template>

<script>
	import { mapActions } from 'vuex'

	export default {
		props:[
			'menuMakan'
		],
		methods: {
			...mapActions([
				'pilihMenu'
			])
		}
	}
</script>