<template>
    <center>
        <h3>
            Вы авторизованы как {{userName}} 
            <span v-if="isLogin">
                <img class="btn-logout" @click="logout()" src="/myfiles/logout.svg" width="20">
            </span>.
        </h3>

        <div class="form">

            <div class="text-right caption_1">
                Логин:
            </div>
            <div class="text-left input_1">
                <input id="authName" type = "text" />
            </div>

            <div class="text-right caption_2">
                Пароль:
            </div>
            <div class="text-left input_2">
                <input id="authPass" type = "password" />
            </div>

            <div class="center button_submit">
                <button @click="login">Авторизоваться</button>
            </div>
        </div>
        
    </center>

</template>

<script>
    import {baseUrl} from '../services/config.js';
    import axios from 'axios';

    

    export default {
        name: 'About',
        data() {
            return {
                userName:'',
                isLogin: false,
            }
        },
        created() {
            axios.defaults.headers.common['Authorization'] = 'Bearer '+localStorage.getItem('token');
            axios
                .get(baseUrl+'/api/get_user_name')
                .then(response => { 
                    console.log(response);
                    this.userName = response.data;
                    this.isLogin = true;
                })
                .catch(error => {
                    this.userName = "Гость";
                });
        },
        methods:{
            async login() {
                let errors = [];
                if (authName.value==''){
                    errors.push('Поле Логин является обязательным.')
                }

                if (authPass.value==''){
                    errors.push('Поле Пароль является обязательным.')
                }
                
                if (errors.length != 0) {
                    alert(errors.join(' '));
                    return;
                }

                axios.post(baseUrl + '/api/login',{
                    name: authName.value,
                    password: authPass.value
                })
                    .then(response => {
                        if (response.data.status=="success") {
                            console.log("success");
                            console.log(response.data.token);
                            localStorage.setItem('token',response.data.token);
                            alert('Вы успешно авторизованы');
                            this.isLogin = true;
                            this.userName = response.data.user_name;
                        } else {
                            alert(response.data.message);
                        }
                    })
                    .catch(error => {
                        alert('Что то не так. Ошибка: '+ error);
                    });
            },

            logout() {

                axios.defaults.headers.common['Authorization'] = 'Bearer '+localStorage.getItem('token');
                axios
                    .get(baseUrl+'/api/logout')
                    .then(response => { 
                        console.log(response);
                        this.userName = "Гость";
                        this.isLogin = false;
                    })
                    .catch(error => {
                        console.log('Что то не так. Ошибка: ' + error)
                    });
            }
        }
    }
</script>

<style scoped>
    .btn-logout {
        cursor:pointer;
        transform: translateY(4px);
    }

    .form {
        display:grid;
    }

    .form div {
        margin: 4px;
    }

    .caption_1 {
        grid-column: 1/2;
        grid-row: 1/2;
    }

    .input_1 {
        grid-column: 2/3;
        grid-row: 1/2;
    }

    .caption_2 {
        grid-column: 1/2;
        grid-row: 2/3;
    }

    .input_2 {
        grid-column: 2/3;
        grid-row: 2/3;
    }

    .button_submit {
        grid-column: 1/3;
        grid-row: 3/4;
    }

    .text-left {
        text-align: left;
    }

    .text-right {
        text-align: right;
    }

    .center {
        text-align: center;
    }
</style>