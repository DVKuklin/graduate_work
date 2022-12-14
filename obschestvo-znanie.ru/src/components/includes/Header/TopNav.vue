<template>
    <div class="button-menu">
        <img src="/myfiles/button_menu.svg" width="20" @click="buttonMenuClick">
    </div>
    <nav class="topNav">
        <ul class="desctopMenu">
            <li>
                <RouterLink to="/" title="Главная">Главная</RouterLink>
            </li>
            <li>
                <RouterLink to="/about/" title="О проекте">О проекте</RouterLink>
            </li>
            <li>
                <RouterLink to="/contacts/" title="Контакты">Контакты</RouterLink>
            </li>
            <li style="background-image: none">
                <RouterLink to="/avt/" title="Авторизация">Авторизация</RouterLink>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: 'TopNav',
    methods: {
        buttonMenuClick() {
            // alert(desctopMenu);
            let tN = document.querySelector('header .topNav');
            let btn = document.querySelector('header .button-menu img');

            if (tN.display=='hidden' || tN.display==undefined) {
                tN.display='show';
                tN.classList.add('topNav-open');
                tN.classList.remove('topNav-close');
                btn.src = "/myfiles/button_menu_close.svg";
            } else {
                tN.display='hidden';
                tN.classList.remove('topNav-open');
                tN.classList.add('topNav-close');
                btn.src = "/myfiles/button_menu.svg";
            }
        }
    }
}
</script>

<style scoped>
     .topNav {
        display:flex;
        justify-content: center;
        align-items: center;
    }   .desctopMenu {
        max-width: 501px;
        min-width: 444px;
        display: flex;
        justify-content: space-around;
        width: 90%;
        padding: 0;
        list-style-type: none;
        margin-block-start: 0px;
        margin-block-end: 0px;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        padding-inline-start: 0px;
    }

    .desctopMenu li {
        display:block;
        padding:0;
        margin: 0 7px;
    }

    .topNav li {

        font-size:1rem;

    }

    .topNav a {
        color:white;
        text-decoration:none;
        transition-property:color;
        transition-duration:2s;
    }

    .topNav a:hover {
        color:rgb(206,51,85);
    }
    .topNav .router-link-active  {
        color:rgb(206,51,85);
    }

    .button-menu {
        display:none;
        cursor: pointer;
    }

    .button-menu img:active {
        transform: translate(2px,2px);
    }


    @media screen and (max-width: 915px) {
    .desctopMenu {
        margin-bottom: 0px;
    }
}
    @media screen and (max-width: 500px) {

        .topNav {
            display:flex;
            height: 0px;
            overflow:hidden;
        }
        .desctopMenu {
            display:flex;
            flex-direction: column;
        }

        .topNav-open {
            animation-duration: 2s;
            animation-name: menu-open;
            animation-fill-mode:forwards;
        }

        @keyframes menu-open{
            from{
                height: 0px;
            }
            to{
                height: 7rem;
            }
        }
        .topNav-close {
            animation-duration: 2s;
            animation-name: menu-close;
            animation-fill-mode:forwards;
        }

        @keyframes menu-close{
            from{
                height: 7rem;
            }
            to{
                height: 0px;
            }
        }

        .desctopMenu li {
            text-align:center;
            margin: 4px 0;
        }
        .button-menu {
            display: block;
            text-align: right;
        }
    }

</style>