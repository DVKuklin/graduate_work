<template>
    <div class="topLog">
        <RouterLink to="/">
            <nobr class="topLogo-container">
                <img src="/myfiles/logoWhite.png"> 
                <div class = "logURL">
                    <b>ОБЩЕСТВОЗНАНИЕ</b>
                    <br>
                    <span class = "under">Курсы по подготовке</span>
                </div>
            </nobr>
        </RouterLink>
    </div>
</template>

<script>
    export default {
        name: "TopLogo"
    }
</script>

<style scoped>
    .topLog {
        font-size:1.4rem;
        /*margin-bottom:20px;*/
        text-align:left;
        /* padding-left:5px; */
        flex-basis: content;

        /*display:table-cell;*/
    }

    img {
        width:6.7rem;
        margin-right: 0.2rem;
    }

    .topLog a {
        color:white;
        text-decoration:none;
    }

    .topLog .logURL {
        display:inline-block;
        position:relative;
        bottom:1.1rem;
        line-height:0.8;
    }

    .topLog .logURL .under {
        font-size:1rem;
    }

    .topLog img {
        background:red;
    }

    @media screen and (max-width:400px){
        /* .topLogo-container {
            display:flex;
            flex-direction: column;
            justify-content: center;
        } */

        /* .topLog img {
            width: 60px;
        }

        .topLog .logURL .under {
        font-size:0.6em; 
        }*/

        /* img {
            width:2.2rem;
        }

        .topLog {
            font-size:1em;
        }

        .topLog .logURL {
            bottom: 0.3rem;
        } */
    }

</style>