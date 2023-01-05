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
@media screen and (max-width: 958px) {

}


@media screen and (min-width: 958px) {

}


/*Здесь надо сделать так, что бы при малых разрешениях загловок раздела делался ниже логотипа*/
@media screen and (max-width: 600px) {

}

@media screen and (min-width: 600px) {

}


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