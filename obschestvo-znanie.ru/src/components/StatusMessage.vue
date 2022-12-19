<template>
    <div v-if="status == 'notAuth'" class = "mesage">
        Для Вас контент данной страницы недоступен. Если Вы не авторизованы, пожалуйста авторизутесь на <RouterLink to="/avt/">странице авторизации.</RouterLink>
    </div>
    <div v-if="status == 'notAllowed'" class = "mesage">
        Для Вас контент данной страницы недоступен.
    </div>
    <div v-if="status == 'notFound'" class = "mesage">
        Страница не найдена.
    </div>
</template>

<script>
    export default {
        name: "StatusMessage",
        props: ['status']
    }
</script>

<style scoped>
    .mesage a {
        color:rgb(163,239,239);
    }

    .mesage a:visited {
        color:rgb(163,239,239);
    }

    .mesage {
        width:400px;
        margin-left:auto;
        margin-right:auto;
        text-align:center;
        margin-top:30px;
        margin-bottom:30px;
    }
</style>