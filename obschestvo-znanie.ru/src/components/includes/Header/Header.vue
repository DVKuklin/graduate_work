<template>
	<header>

		<TopLogo></TopLogo>
		<TopNav></TopNav>

	</header>
</template>

<script>

import TopNav from './TopNav.vue';
import TopLogo from './TopLogo.vue';

export default {
    name: "Header",
    components: {
        TopNav,
		TopLogo
    },
}
</script>

<style scoped>

header {
	display:grid;
	grid-template-columns: 370px auto;
	width:100%;
	margin-top:10px;
}

@media screen and (max-width:771px){
	header {
		grid-template-columns: 100%;
	}
}






</style>