<template>
    <el-breadcrumb style="margin: 0 0 10px 0" separator="/">
        <el-breadcrumb-item v-if="bcItems.length === 1" :to="{ path: '/dashboard' }">Administration</el-breadcrumb-item>
        <template v-else v-for="item in bcItems">
            <el-breadcrumb-item :to="{ path: item.path }">
                <span @click="handleRouteError($event, item.path)">{{ item.name }}</span>
            </el-breadcrumb-item>
        </template>
    </el-breadcrumb>
</template>
<script>
export default {
    name: "Breadcrumb",
    data () {
        return {
            currentPath: null,
            bcItems: [],
            bcLabel: {
                'dashboard': 'Dashboard',
                'schools': 'Schools',
                'trainings': 'Trainings',
                'news': 'News',
            }
        }
    },
    created () {
        this.currentPath = this.$route.path
        this.analyzePath()
    },
    watch:{
        $route (to, from){
            this.currentPath = to.path
            this.analyzePath()
        }
    },
    methods: {
        analyzeName (str) {
            let res = str.charAt(0).toUpperCase() + str.substring(1).toLowerCase()
            res = res.replace(/-/g, ' ');
            return res
        },
        analyzePath () {
            if (this.currentPath) {
                let arr = this.currentPath.split('/')
                let filteredArr = arr.filter(name => (name !== "" && name !== '/'))
                this.bcItems = filteredArr.map(path => {
                    let index = this.currentPath.indexOf(path)
                    let name = path
                    if (path !== this.$route.params.id) {
                        name = this.bcLabel[path] || this.analyzeName(path)
                    }
                    return {
                        name: name,
                        path: this.currentPath.substr(0, index + path.length)
                    };
                })
                if (this.bcItems.length > 1) {
                    this.handleId()
                }
            }
        },
        handleId () {
            if (this.bcItems) {
                if (this.bcItems.length === 1) {
                    this.bcItems[0].path = this.bcItems[1].path
                    this.bcItems[1].name = "Dashboard"
                } else if (this.bcItems.length > 1) {
                    this.bcItems[0].path = this.bcItems[1].path
                    this.bcItems = this.bcItems.filter(item => item.name !== this.$route.params.id)
                }
            }
        },
        handleRouteError (event, path) {
            if (path === this.$route.path) {
                event.stopPropagation();
            }
        }
    }
};
</script>