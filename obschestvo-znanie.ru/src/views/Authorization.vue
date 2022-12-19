<template>
    <center>
        <h3>Вы находитесь на сайте как {{userName}}.</h3>
        <h4>Для авторизации (смены пользователя) заполните поля формы и нажмите кнопку "Авторизоваться"</h4>
        <!-- <form name = "ObZn_avt" action = "/ObZn_avt/ObZn_avt.php" method = "post" target="_self"> -->
        <table>
            <tr>
                <td align="right">
                    Логин:
                </td>
                <td align="left">
                    <input id="authName" type = "text" />
                </td>
            </tr>
            <tr>
                <td align="right">
                    Пароль:
                </td>
                <td align="left">
                    <input id="authPass" type = "password" />
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <button @click="authorizate">Авторизоваться</button>
                </td>
            </tr>
        </table>
            
        <!-- </form> -->
        
    </center>

</template>

<script>
    import { authorization } from '../services/methods.js';
    export default {
        name: 'About',
        data() {
            return {
                userName:'',
            }
        },
        created() {
            let userName = localStorage.getItem('userName');
            if (userName == undefined) {
                this.userName = 'Гость'
            } else {
                this.userName = userName
            }
        },
        methods:{
            async authorizate() {
                let name = authName.value;
                let pass = authPass.value;

                let res = await authorization(name,pass);

                if (res.data.status == 'success') {
                    localStorage.setItem('token', res.data.token);
                    localStorage.setItem('userName', name);
                    this.userName = name;
                    alert("Вы авторизовались успешно.")
                } else if (res.data.status == 'notfound') {
                    alert('Такой пользователь в базе не найден.');
                } else {
                    alert('Что то пошло не так :-(');
                }
            }
        }
    }
</script>