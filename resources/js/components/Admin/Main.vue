<template>
    <div class="wrapper">
		<navbar-component></navbar-component>
		<div class="content-wrapper">
			<div class="">
				<router-view></router-view>	
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		methods: {
			escModal() {
				// 
			}
		}
	}
</script>