<template>
    <div class="home">
        <nav>
            <img class="logo" src="images/Logo.svg">
            <el-button
                class="text-bold text-uppercase btn-login"
                @click="login">se connecter</el-button>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'Home',
    data() {
        return {
            logo: null
        }
    },
    methods: {
        login() {
            this.$router.push({ path: "/connexion" });
        }
    }
}
</script>