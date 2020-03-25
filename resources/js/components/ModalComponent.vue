<template>
	<div class="vue-modal" v-bind:class="{'show-modal':showModal}">
		<slot></slot>
	</div>
</template>

<script>
	export default {
		data: function() {
			return {
				showModal:false
			}
		},
		methods: {
			show_modal() {
				this.showModal = true
			},
			close_modal() {
				this.showModal = false
			}
		}
	}
</script>