<template>
<div id="conForAll">
    <div>
		<Header></Header>
			
			<main>
				<div id="conForContent">
					<RouterView></RouterView>
				</div>
		
			</main>
	</div>



	<Footer></Footer>
</div>	
</template>

<script>
import { RouterLink, RouterView } from 'vue-router'
import Header from './components/includes/Header/Header.vue'
import Footer from './components/includes/Footer.vue'

export default {
	components: {
		Header, Footer
	},
	mounted() {
		//настройка подвала
		// window.addEventListener('resize',footerResize);
														
		// function footerResize() {
		// 	let f=document.getElementsByTagName('FOOTER');
		// 	let c = conForContent.getBoundingClientRect();
			
		// 	if ( c.bottom > (document.documentElement.clientHeight - f[0].offsetHeight) ) {
		// 		f[0].style.position = 'static';
		// 		f[0].style.width = 'auto';
		// 	} else {
		// 		f[0].style.position = 'fixed';
		// 		f[0].style.width = conForAll.offsetWidth - 5 + 'px';
		// 	}
		// }

		// footerResize();
		//End настройка подвала
	}
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
