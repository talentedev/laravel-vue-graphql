<template>
    <div class="side-bar">
        <div class="text-center mb-4">
            <img class="logo" src="images/Logo-white.svg">
        </div>
        <el-menu class="el-menu-vertical-demo">
            <el-submenu index="1">
                <template slot="title"><i class="el-icon-notebook-1"></i>Candidature</template>
                <el-menu-item :class="{'current': isRoute('file')}" @click="navigateToMenu('file')">
                    <i class="el-icon-document"></i>
                    <span>Mon dossier</span>
                </el-menu-item>
                <el-menu-item :class="{'current': isRoute('applications')}" @click="navigateToMenu('applications')">
                    <i class="el-icon-files"></i>
                    <span>Candidature</span>
                </el-menu-item>
            </el-submenu>
            <el-menu-item :class="{'current': isRoute('schools')}" @click="navigateToMenu('schools')">
                <i class="el-icon-school"></i>
                <span>Ecoles</span>
            </el-menu-item>
            <el-menu-item :class="{'current': isRoute('tranings')}" @click="navigateToMenu('tranings')">
                <i class="el-icon-edit-outline"></i>
                <span>Formations</span>
            </el-menu-item>
            <el-menu-item :class="{'current': isRoute('news')}" @click="navigateToMenu('news')">
                <i class="el-icon-news"></i>
                <span>Actualités</span>
            </el-menu-item>
            <el-menu-item :class="{'current': isRoute('messages')}" @click="navigateToMenu('messages')">
                <i class="el-icon-message"></i>
                <span>Messagerie</span>
            </el-menu-item>
        </el-menu>
    </div>
</template>

<script>
export default {
    name: 'sidebar',
    computed:{
        routeArr(){
            return this.$route.path.split('/')
        }
    },
    methods: {
        isRoute(route){
            return this.routeArr.includes(route)
        },
        navigateToMenu(rubrique) {
            this.$router.push('/admin/' + rubrique);
        }
    }
}
</script>