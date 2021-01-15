<template>
    <div class="administrators text-center">
        <h2>Training Courses</h2>
        <ApolloQuery
            :query="require('../../graphql/training/trainings.gql')"
            :variables="{
                school_id: schoolID
            }"
        >
            <template slot-scope="{ result:{ loading, error, data }, isLoading }">
                <div v-if="error">Une erreur est survenue !</div>
                <el-table
                    v-loading="isLoading === 1"
                    :data="tableData(data)"
                    style="width: 100%"
                    >
                    <el-table-column column-key="label" prop="label" label="Label"></el-table-column>
                    <el-table-column column-key="description" prop="description" label="Description"></el-table-column>
                    <el-table-column width="180px">
                        <template slot-scope="scope">
                            <el-button size="mini" type="primary" class="ml-0" @click="handleEdit(scope.$index, scope.row)">Edit</el-button>
                            <el-button size="mini" type="danger" class="ml-0" @click="handleDelete(scope.$index, scope.row)">Delete</el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </template>
        </ApolloQuery>
        <el-button type="primary" class="mt-2" @click="create()">Create training course</el-button>
    </div>
</template>

<script>
export default {
    name: 'trainings',
    computed: {
        schoolID() {
            return this.$store.getters['security/getUser'].school_id;
        },
    },
    methods: {
        tableData(data) {
            if (!_.isNil(data)) {
                return data.trainings;
            } else {
                return [];
            }
        },
        handleEdit(index, row) {
            //
        },
        handleDelete(index, row) {
            // 
        },
        create() {
            //
        }
    }
}
</script>