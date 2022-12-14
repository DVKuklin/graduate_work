<template>
    <BreadCrumbs v-bind:sectionURL="sectionURL"
                    v-bind:theme="theme"
                    v-bind:section="section"
    ></BreadCrumbs>

    <div v-if="isAuth" class="conForThem">
        <h3 align="center">{{theme}}</h3>
        <div v-for="(item, i) in paragraphs" :key="i">
            <div class="content" v-html="item.content"></div>
        </div>
    </div>

    <NotAuthMessage v-else></NotAuthMessage>

    <BreadCrumbs v-bind:sectionURL="sectionURL"
                    v-bind:theme="theme"
                    v-bind:section="section"
    ></BreadCrumbs>
</template>

<script>
    import BreadCrumbs from '../components/BreadCrumbs.vue';
    import NotAuthMessage from '../components/NotAuthMessage.vue';
    import { getParagraphsAndThemeByUrl } from '../services/methods.js';
    export default {
        name: 'Theme',
        components: {BreadCrumbs, NotAuthMessage},
        data() {
            return {
                paragraphs: [],
                theme: '',
                sectionURL:'',
                section:'',
                isAuth: 1
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
                    this.isAuth=false;
                } else if (data.data.status == 'success') {
                    this.sectionURL = "/"+urls[0];
                    this.paragraphs = data.data.paragraphs;
                    this.theme = data.data.theme;
                    this.section = data.data.section;
                    this.isAuth=true;
                    console.log(data.data);
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