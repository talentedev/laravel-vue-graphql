<template>
    <el-container>
        <el-aside width="240px">
            <side-bar></side-bar>
        </el-aside>
        <el-container>
            <el-main style="padding: 50px 50px 20px 30px;">
                <Breadcrumbs></Breadcrumbs>
                <el-card style="height: 95%;">
                    <slot></slot>
                </el-card>
            </el-main>
        </el-container>
    </el-container>
</template>

<script>
import SideBar from './SideBar';
import Breadcrumbs from '../partials/Breadcrumb';

export default {
    name: 'AdminWrapper',
    components: {
        SideBar,
        Breadcrumbs
    }
}
</script>