<template>
    <el-header class="nav-bar" style="text-align: right;">
        <div class="d-flex justify-content-between">
            <div>
                <img class="logo" src="images/Logo.svg">
            </div>
            <el-menu class="el-menu-demo bg-transparent border-0" mode="horizontal">
                <el-submenu index="1">
                    <template slot="title">Candidatures</template>
                    <el-submenu index="1-1">
                        <template slot="title">Mon dossier</template>
                        <el-menu-item index="1-1-1">Informations de base</el-menu-item>
                        <el-menu-item index="1-1-2">Années Academiques</el-menu-item>
                        <el-menu-item index="1-1-3">Expérience</el-menu-item>
                    </el-submenu>
                    <el-submenu index="1-2">
                        <template slot="title">Candidatures</template>
                        <el-menu-item index="1-2-1">Suivi des candidatures</el-menu-item>
                    </el-submenu>
                </el-submenu>
                <el-menu-item index="2">Ecoles</el-menu-item>
                <el-menu-item index="3">Formation</el-menu-item>
                <el-menu-item index="4">Actualités</el-menu-item>
                <el-menu-item index="5">Messagerie</el-menu-item>
                <el-submenu index="6">
                    <template slot="title"><i class="el-icon-user"></i></template>
                    <el-menu-item index="6-1">Mon compte</el-menu-item>
                    <el-menu-item index="6-2" @click="performLogout">Deconnexion</el-menu-item>
                </el-submenu>
            </el-menu>
        </div>
    </el-header>
</template>

<script>
export default {
    name: 'NavBar',
    methods: {
        performLogout() {
            const loading = this.$loading({ lock: true });
            this.$store.dispatch("security/logout").then(() => {
                loading.close();
                this.$router.push({ path: "/connexion" });
            });
        }
    }
}
</script>