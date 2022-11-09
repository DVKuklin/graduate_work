

<template>
    <h1>Это header</h1>
    <!-- <RouterLink to="/page_01">page_01</RouterLink>
    <br/>
    <RouterLink to="/page_02">Страница 2</RouterLink> -->
    sdf
    <Sdf>333333333333</Sdf>
    <ThePage_03>fffffffffff</ThePage_03>
</template>

<script>
import Page_01 from "./Page_01.vue";
import Page_02 from "./Page_02.vue";
import ThePage_03 from "./somDir/ThePage_03.vue";
import Sdf from "./somDir/Sdf.vue";
import { RouterLink, RouterView } from 'vue-router';

export default {
    components: {
        Sdf
    }
}
</script>