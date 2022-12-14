<template>
    <center class = "conForIcRazd">
        <h1 class="section-header">Разделы по&nbsp;курсу</h1>
        <RouterLink v-for="(item, i) in sections" :key="i"  v-bind:to="item.url">	
            <div class="icRazd">
                <div class="inside">
                    <div class="insideCell">
                        <img :src="item.img" @:mouseover="imgMouseover(i)" v-on:mouseout="imgMouseout(i)">
                        <br>
                        {{item.name}}
                    </div>
                </div>
            </div>
        </RouterLink>
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

/*Для документа главная страница*/
.icRazd {
	display:inline-block;
	width:200px;
	height:200px;
	background-color:white;
	/*border-radius:7px;*/
	/*border:black solid 2px;*/
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

.icRazd .inside {
	display:table;
	width:100%;
	height:100%;
}

.icRazd .insideCell {
	display:table-cell;
	vertical-align:middle;
	height:100%;
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
<!-- 
        <a href="/section_2">	
            <div class="icRazd">    
                <div class="inside">
                    <div class="insideCell">
                        <img src="/myfiles/02_econ_red.webp"><br>
                        Экономика
                    </div>
                </div>
            </div>
        </a>
        <a href="/section_3">	
            <div class="icRazd">
                <div class="inside">
                    <div class="insideCell">
                        <img src="/myfiles/03_soc_otn_red.webp"><br>
                        Социальные отношения
                    </div>
                </div>
            </div>
        </a>
        <a href="/section_4">	
            <div class="icRazd">
                <div class="inside">
                    <div class="insideCell">
                        <img src="/myfiles/04_polit_red.webp"><br>
                        Политика
                    </div>
                </div>
            </div>
        </a>
        <a href="/section_5">	
            <div class="icRazd">
                <div class="inside">
                    <div class="insideCell">
                        <img src="/myfiles/05_pravo_red.webp"><br>
                        Право
                    </div>
                </div>
            </div>
        </a>

 -->
