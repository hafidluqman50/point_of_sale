<template>
	<button :class="{bclass}" @click.native="showModal()">
		<slot>
			
		</slot>
	</button>
</template>

<script>
	export default {
		props:[
			'bclass',
			'targetmodal'
		],
		methods:{
			showModal:() => {
				// this.$emit('')
				//
			}
		}
	}
</script>