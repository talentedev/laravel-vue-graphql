<template>
    <el-container>
        <el-aside width="240px">
            <side-bar></side-bar>
        </el-aside>
        <el-container>
            <el-main>
                <slot></slot>
            </el-main>
        </el-container>
    </el-container>
</template>

<script>
import SideBar from './SideBar';

export default {
    name: 'AdminWrapper',
    components: {
        SideBar
    }
}
</script>