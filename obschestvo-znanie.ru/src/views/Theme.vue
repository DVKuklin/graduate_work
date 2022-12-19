<template>
    <BreadCrumbs v-bind:sectionURL="sectionURL"
                    v-bind:theme="theme"
                    v-bind:section="section"
    ></BreadCrumbs>

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



    <BreadCrumbs v-bind:sectionURL="sectionURL"
                    v-bind:theme="theme"
                    v-bind:section="section"
    ></BreadCrumbs>
</template>

<script>
    import BreadCrumbs from '../components/BreadCrumbs.vue';
    import StatusMessage from '../components/StatusMessage.vue';
    import { getParagraphsAndThemeByUrl } from '../services/methods.js';
    export default {
        name: 'Theme',
        components: {BreadCrumbs, StatusMessage},
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
            await this.getData();
        },
        methods: {
            async getData() {
                let str = this.$route.path.slice(1,this.$route.path.length);
                let urls = str.split("/");

                let data = await getParagraphsAndThemeByUrl(urls[0],urls[1]);
                
                console.log(data);

                if (data.status == 'notAuth' || data.data.status == 'notAuth') {
                    this.status='notAuth';
                    console.log(data.data.theme);
                    this.sectionURL = "/"+urls[0];
                    this.theme = data.data.theme;
                    this.section = data.data.section;
                } else if (data.data.status == 'success') {
                    this.sectionURL = "/"+urls[0];
                    this.paragraphs = data.data.paragraphs;
                    this.theme = data.data.theme;
                    this.section = data.data.section;
                    this.status='success';
                    // console.log(data.data);
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