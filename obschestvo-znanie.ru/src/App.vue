<template>
<div id="conForAll">
    <div>
		<Header></Header>
		<BreadCrumbs v-if="isTheme"></BreadCrumbs>
			<main>
				<div id="conForContent">
					<RouterView></RouterView>
				</div>
		
			</main>
	</div>


	<div>
		<BreadCrumbs v-if="isTheme"></BreadCrumbs>
		<Footer></Footer>
	</div>
</div>	
</template>

<script>
import { RouterLink, RouterView } from 'vue-router'
import Header from './components/includes/Header/Header.vue'
import Footer from './components/includes/Footer.vue';
import BreadCrumbs from './components/BreadCrumbs.vue';

export default {
	components: {
		Header, Footer, BreadCrumbs
	},
	data() {
		return {
			isTheme: false,
		};
	},
	created() {
		
    },
	mounted() {

	},
	watch: {
		$route (to, from){
			if (this.$route.meta.isTheme) {
				this.isTheme = true
			} else {
				this.isTheme = false
			}
		}
    },

}


</script>



<style scoped>
#conForAll {
	/*background-color:rgb(3,50,203);*/
	max-width:1000px;
	margin-left:auto;
	margin-right:auto;
	color:white;
	display:flex;
	height:100%;
	flex-direction:column;
	justify-content: space-between;
	padding:0 10px;
}

#conForContent {
    padding:10px;
}

main {

}
</style>
