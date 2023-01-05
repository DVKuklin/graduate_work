<template>
    <div class="breadCrumbs">
        <RouterLink to="/">Главная</RouterLink>
        <span> → </span>
        <RouterLink v-bind:to="sectionURL">{{sectionName}}</RouterLink>
        <span> → </span>
        {{themeName}}
    </div>
</template>

<script>
    import axios from "axios";
    import {baseUrl} from '../services/config.js';

    export default {
        name: "BreadCrumbs",
        data() {
            return {
                isDataLoad: false,
                sectionURL: '',
                sectionName: '',
                themeName: ''
            }
        },
        created() {
            let str = this.$route.path.slice(1,this.$route.path.length);
            let urls = str.split("/");

            let data={
                section_url: urls[0],
                theme_url: urls[1]
            }

            axios.post(baseUrl+'/api/get_section_name_and_theme_name_by_url',data)
                .then(response => {
                    if (response.data.status = "success") {
                        this.isDataLoad = true;
                        this.sectionName = response.data.section_name;
                        this.themeName = response.data.theme_name;
                        this.sectionURL = '/'+urls[0];
                    }
                })
                .catch(error => {
                    console.log("Ошибка :"+error)
                });
        }

    }
</script>

<style scoped>
    .breadCrumbs {
        margin-bottom: 5px;
    }
    a {
        color:rgb(163,239,239);
    }
    .breadCrumbs a:visited {
        color: rgb(163,239,239);
    }
</style>