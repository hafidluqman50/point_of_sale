<template>
	<aside :class="`sidebar-view ${active ? 'sidebar-active' : ''}`">
		<slot></slot>
	</aside>
</template>

<script>
  	import {mapGetters} from 'vuex'
	export default {
		props:[
			'active'
		],
		computed: {
			...mapGetters([
				'sidebarToggle'
			])
		}
	}
</script>