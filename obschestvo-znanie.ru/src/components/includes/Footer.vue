<template>
    <footer>
		Разработка сайта <a href="http://dvkuklin.ru" target="_blank">DVKuklin@yandex.ru</a>
	</footer>
</template>

<script>
	export default {
		name: 'Footer',
		// components: {

		// },
		// data(){
		// 	return {
		// 		data: [],
		// 	}
		// },
		// async created(){

		// },
		// methods:{

		// }
	}
</script>

<style scoped>
footer {
	background-color:rgb(0,14,59);
	color:rgb(233,225,180);
	padding:5px;
	font-size: 0.7em;
	/* padding-bottom:5px;
	padding-left:5px; */
	/* position: fixed; */
	/* bottom: 0; */
	/* width: 100%; */
}

footer a:visited {
	color:rgb(179,250,253);
}

footer a {
	color:rgb(40,88,255);
}
</style>
