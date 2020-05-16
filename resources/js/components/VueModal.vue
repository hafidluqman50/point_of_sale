<template>
	<div :class="`vue-modal ${modalAct ? 'show-modal' : ''}`">
		<div class="vue-modal-header bg-light d-flex">
			<slot name="modal-header"></slot>
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
	import { EventBus } from '../event-bus.js'

	export default {
		data() {
			return {
				modalAct:false
			}
		},
		props: [
			'idModal'
		],
		methods: {
			...mapActions([
				'openModal',
				'closeModal'
			])
		},
		mounted() {
			EventBus.$on('modalOpen',target => {
				if (target == this.idModal) {
					this.modalAct = true
					this.openModal()
				}
			})
			EventBus.$on('modalClose',target => {
				if (target == this.idModal) {
					this.modalAct = false
					this.closeModal()
				}
			})
		}
	}
</script>