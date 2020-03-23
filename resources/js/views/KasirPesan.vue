<template>
	<div class="container-fluid" style="padding-top:1%;">
		<div class="row">
			<div class="col-md-9">
				<div class="card">
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
				<div class="card">
					<div class="card-header">
						<p class="card-text" style="margin:0;" align="center"><b>PESANAN</b></p>
					</div>
					<div class="card-body checkout">
						
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import { mapGetters,mapActions } from 'vuex'

	export default {
		computed: {
			...mapGetters([
				'dataMenu',
				'isLoading'
			])
		},
		methods: {
			...mapActions([
				'tampilMenu'
			])
		},
		mounted() {
			this.tampilMenu();
		}
	}
</script>