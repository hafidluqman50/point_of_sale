<template>
	<button :class="{bclass}" @click="$emit('trigger')">
		<slot></slot>
	</button>
</template>

<script>
	export default {
		props:[
			'bclass'
		]
	}
</script>