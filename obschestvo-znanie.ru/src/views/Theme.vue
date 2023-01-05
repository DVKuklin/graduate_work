<template>
    <div v-if="status == 'loading'"><span>Загрузка данных</span></div>
    <div v-if="status == 'success'" class="conForThem">
        <h3 align="center">{{theme}}</h3>
        <div v-for="(item, i) in paragraphs" :key="i">
            <div class="content" v-html="item.content"></div>
        </div>
    </div>

    <StatusMessage v-if="status == 'notAuth'" v-bind:status="status"></StatusMessage>
    <StatusMessage v-if="status == 'notAllowed'" v-bind:status="status"></StatusMessage>
    <StatusMessage v-if="status == 'notFound'" v-bind:status="status"></StatusMessage>

</template>

<script>
    import StatusMessage from '../components/StatusMessage.vue';
    import axios from 'axios';
    import {baseUrl} from '../services/config.js';


    import { getParagraphsAndThemeByUrl } from '../services/methods.js';
    export default {
        name: 'Theme',
        components: {StatusMessage},
        data() {
            return {
                paragraphs: [],
                theme: '',
                sectionURL:'',
                section:'',
                status: 'loading'
            }
        },
        async created() {
            axios.defaults.headers.common['Authorization'] = 'Bearer '+localStorage.getItem('token');

            let str = this.$route.path.slice(1,this.$route.path.length);
            let urls = str.split("/");
            let data = {
                section_url: urls[0],
                theme_url: urls[1]
            }


            axios
                .post(baseUrl+'/api/get_paragraps_by_section_and_theme_url',data)
                .then(response => { 
                    console.log(response.data.status+"sdfsdfsdf");
                    if (response.data.status == 'notAuth' || response.data.status == 'notAuth') {
                        this.status='notAuth';
                    } else if (response.data.status == 'success') {
                        this.paragraphs = response.data.paragraphs;
                        this.theme = response.data.theme;
                        this.status='success';

                    } else if (response.data.status == 'notAllowed') {
                        this.status='notAllowed';
                    } else if (response.data.status == 'notFound') {
                        this.status='notFound';
                    }
                })
                .catch(error => {
                    if (error.response.status === 401) {
                        this.status = 'notAuth';
                    }
                    console.log(error.response);
                });
        },
        methods: {
            async getData() {
                let str = this.$route.path.slice(1,this.$route.path.length);
                let urls = str.split("/");

                let data = await getParagraphsAndThemeByUrl(urls[0],urls[1]);

                if (data.status == 'notAuth' || data.data.status == 'notAuth') {
                    this.status='notAuth';

                    this.sectionURL = "/"+urls[0];
                    this.theme = data.data.theme;
                    this.section = data.data.section;
                } else if (data.data.status == 'success') {
                    this.sectionURL = "/"+urls[0];
                    this.paragraphs = data.data.paragraphs;
                    this.theme = data.data.theme;
                    this.section = data.data.section;
                    this.status='success';

                } else if (data.data.status == 'notAllowed') {
                    this.status='notAllowed';
                    this.sectionURL = "/"+urls[0];
                    this.theme = data.data.theme;
                    this.section = data.data.section;
                } else if (data.data.status == 'notFound') {
                    this.status='notFound';
                }
            }
        }
    }
</script>

<style scoped>
    .conForThem {
        background-color: white;
        color: black;
        padding: 10px;
        border-radius: 3px;
        margin-bottom: 5px;
    }

</style>