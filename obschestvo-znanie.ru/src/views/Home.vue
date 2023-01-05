<template>
    <center class = "conForIcRazd">
        <h1 class="section-header">Разделы по курсу</h1>
        <div class="icons-container">
            <RouterLink v-for="(item, i) in sections" :key="i"  v-bind:to="item.url">	
                <div class="icRazd">

                        <div class="insideCell">
                            <img :src="item.img" @:mouseover="imgMouseover(i)" v-on:mouseout="imgMouseout(i)">
                            <br>
                            {{item.name}}
                        </div>

                </div>
            </RouterLink>
        </div>
    </center>
</template>



<script>
	// import TheComponent from "../../services/methods.js";
	// import { baseUrlStorage } from '../../services/config.js';
    import { getSections } from '../services/methods.js';
    import ApiError from '../components/ApiError.vue';
    import { baseUrlImages } from '../services/config.js';

	export default {
		name: 'Home',
		components: {
            ApiError
		},
		data(){
			return {
                sections: []
			}
		},
		async created(){
            this.sections = await this.getSections();
		},
        methods: {
            imgMouseover(i) {
                this.sections[i].img = this.sections[i].imgOver;
                
            },
            imgMouseout(i) {
                this.sections[i].img = this.sections[i].imgOut;
            },
            async getSections(){
                let res = await getSections();


                
                let sections = res.data.map(function(item, index) {
                        return {
                            id: item.id,
                            name: item.name,
                            url: item.url,
                            imgOut: baseUrlImages+item.image,
                            imgOver: baseUrlImages+item.imagehover,
                            img: baseUrlImages+item.image,
                        };
                });
                
                return sections;
            }
        }

	}
</script>

<style scoped>
.conForIcRazd {
	max-width:800px;
	margin-left:auto;
	margin-right:auto;
}

.icons-container {
    display:flex;
    flex-wrap: wrap;
    flex-direction: row;
    justify-content: center;
}
.icRazd {
	display:flex;
    justify-content: center;
    align-items: center;
	width:200px;
	height:200px;
	background-color:white;
	box-shadow:5px 5px 10px rgba(122,122,122,0.5);
	margin:10px;
	font-size:1.5em;
	padding:10px;
	cursor:pointer;
	transition-property:background-color;
	transition-duration:1.5s;
	color:rgb(47,58,95);
}

.icRazd:hover {
	background-color:rgb(234,239,255);
}

.icRazd .insideCell {
    text-align: center;
}

.icRazd a {
	color:black;
	text-decoration:none;
}

.icRazd a:visited {
	color:black;
}

/* @media screen and (max-width: 915px) {
    .section-header {
        margin-top: 0px;
    }
} */
</style>

