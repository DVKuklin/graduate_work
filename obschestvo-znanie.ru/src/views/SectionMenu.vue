<template>
	<h2>{{section}}</h2>
	<ul class="menuRazdela">
		<li v-for="(item, i) in themes" :key="i">
			<RouterLink v-bind:to="sectionURL+'/'+item.url">{{item.sort}}. {{item.name}}</RouterLink>
		</li>
	</ul>
</template>


<script>
	// import TheComponent from "../../services/methods.js";
	// import { baseUrlStorage } from '../../services/config.js';
	import { getThemesAndSectionBySectionUrl } from '../services/methods.js';

	export default {
		name: 'SectionMenu',
		components: {

		},
		data(){
			return {
				themes: [],
				section: '',
				sectionURL: this.$route.path
			}
		},
		created(){
			
		},
		methods:{
			async getPagesBySectionUrl(){
				let url = this.$route.path.slice(1,this.$route.path.length);
				let data = await getThemesAndSectionBySectionUrl(url);
				this.themes = data.data.themes;
				this.section = data.data.section;
			}
		},
		async mounted() {
			await this.getPagesBySectionUrl();
		}
	}
</script>

<style scoped>
.menuRazdela a:visited {
	color:white;
}

.menuRazdela a {
	color:rgb(163,239,239);
}


</style>
