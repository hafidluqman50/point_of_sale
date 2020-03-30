<template>
	<div class="vue-modal" v-bind:class="{'show-modal':showModal}">
		<div class="vue-modal-header bg-light d-flex">
			<div class="vue-modal-title">
				<p><b>{{ modalInfo }}</b></p>
			</div>
			<div class="vue-modal-close">
				<button class="btn btn-dark" @click="closeModal()">Close</button>
			</div>
		</div>
		<div class="vue-modal-body">
			<slot></slot>
		</div>
		<div class="vue-modal-footer bg-light">
			<slot name="modal-footer"></slot>
		</div>
	</div>
</template>

<script>
	import { mapGetters, mapActions } from 'vuex'
	export default {
		props: [
			'modalInfo'
		],
		computed: {
			...mapGetters([
				'showModal'
			])
		},
		methods: {
			...mapActions([
				'closeModal'
			])
		}
	}
</script>