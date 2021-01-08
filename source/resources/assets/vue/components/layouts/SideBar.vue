<template>
    <div class="side-bar d-flex align-items-start flex-column overflow-hidden">
        <div class="text-center mb-4 w-100">
            <img class="logo" src="images/Logo-white.svg">
        </div>
        <el-menu class="el-menu-vertical-demo bg-transparent pl-3 w-100">
            <el-menu-item :class="{'current': isRoute('dashboard')}" @click="navigateToMenu('dashboard')">
                <i class="el-icon-odometer"></i>
                <span>Dashboard</span>
            </el-menu-item>
            <el-menu-item v-if="isSuperAdmin" :class="{'current': isRoute('schools')}" @click="navigateToMenu('schools')">
                <i class="el-icon-school"></i>
                <span>Schools</span>
            </el-menu-item>
            <el-menu-item v-if="isSchoolAdmin" :class="{'current': isRoute('school-profile')}" @click="navigateToMenu('school-profile')">
                <i class="el-icon-school"></i>
                <span>My School</span>
            </el-menu-item>
            <el-menu-item :class="{'current': isRoute('tranings')}" @click="navigateToMenu('tranings')">
                <i class="el-icon-edit-outline"></i>
                <span>Traninings</span>
            </el-menu-item>
            <el-menu-item v-if="isSchoolAdmin" :class="{'current': isRoute('applications')}" @click="navigateToMenu('applications')">
                <i class="el-icon-files"></i>
                <span>Applications</span>
            </el-menu-item>
            <el-menu-item v-if="isSuperAdmin" :class="{'current': isRoute('administrators')}" @click="navigateToMenu('administrators')">
                <i class="el-icon-user"></i>
                <span>Administrators</span>
            </el-menu-item>
            <el-menu-item v-if="isSuperAdmin" :class="{'current': isRoute('news')}" @click="navigateToMenu('news')">
                <i class="el-icon-news"></i>
                <span>News</span>
            </el-menu-item>
            <el-menu-item :class="{'current': isRoute('messages')}" @click="navigateToMenu('messages')">
                <i class="el-icon-message"></i>
                <span>Messages</span>
            </el-menu-item>
        </el-menu>
        <div class="profile text-center mt-auto w-100">
            <div class="profile-img mb-2">
                <img src="/images/Profile.png">
            </div>
            <p class="text-white">{{ name }}</p>
            <i class="el-icon-switch-button" title="Logout" @click="performLogout"></i>
        </div>
    </div>
</template>

<script>
export default {
    name: 'sidebar',
    data() {
        return {
            name: ''
        }
    },
    computed:{
        routeArr() {
            return this.$route.path.split('/')
        },
        isSuperAdmin() {
            return this.$store.getters['security/isSuperAdmin'];
        },
        isSchoolAdmin() {
            return this.$store.getters['security/isSchoolAdmin'];
        }
    },
    created() {
        const user = this.$store.getters['security/getUser'];
        this.name = `${user.nom} ${user.prenom}`;
    },
    methods: {
        isRoute(route) {
            return this.routeArr.includes(route)
        },
        navigateToMenu(rubrique) {
            this.$router.push('/admin/' + rubrique);
        },
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