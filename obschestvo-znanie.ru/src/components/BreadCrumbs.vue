<template>
    <div class="breadCrumbs">
        <RouterLink to="/">Главная</RouterLink>
        <span> → </span>
        <RouterLink v-bind:to="sectionURL">{{section}}</RouterLink>
        <span> → </span>
        {{theme}}
    </div>
</template>

<script>
    export default {
        name: "BreadCrumbs",
        props: [
            'sectionURL',
            'theme',
            'section'
        ]
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