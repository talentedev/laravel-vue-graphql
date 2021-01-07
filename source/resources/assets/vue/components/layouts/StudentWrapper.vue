<template>
    <div>
        <nav-bar></nav-bar>
        <el-main>
            <slot></slot>
        </el-main>
    </div>
</template>

<script>
import NavBar from './NavBar';

export default {
    name: 'StudentWrapper',
    components: {
        NavBar
    }
}
</script>