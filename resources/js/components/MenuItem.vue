<template>
	<div class="col-xl-2 col-lg-2 col-md-2">
		<div class="card">
			<img class="card-img-top" :src="'/assets/foto_item/'+itemJual.foto_item" alt="Card image tap" draggable="false">
			<div class="card-body">
				<div class="label-item">
					<h5 class="card-title"><b>{{ itemJual.nama_item }}</b></h5>
				</div>
				<p class="card-text" style="margin-top:5px; margin-bottom:5px;">
					{{ itemJual.harga_item | formatRupiah }}
				</p>
				<span class="badge badge-success" v-if="itemJual.status_item == 'tersedia'" style="font-size:14px;">
					Tersedia
				</span>
				<span class="badge badge-danger" v-else style="font-size:14px;">
					Kosong
				</span>
			</div>
			<div class="d-flex justify-content-center card-footer bg-primary checkout-div" ref="menuItem" target-modal="modalMenuItem" v-on:click="pilihItem(itemJual); pesanModal()">
				<p class="card-text">
					<b>PESAN</b>
				</p>
			</div>
		</div>	
	</div>
</template>

<script>
	import { mapActions } from 'vuex'
	import { EventBus } from '../event-bus.js'

	export default {
		props:[
			'itemJual',
			'targetModal'
		],
		methods: {
			...mapActions([
				'pilihItem'
			]),
			pesanModal:function() {
				EventBus.$emit('modalOpen',this.$refs.menuItem.getAttribute('target-modal'))
			}
		}
	}
</script>