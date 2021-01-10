<template>
    <div class="schools text-center">
        <h2>Schools</h2>
        <ApolloQuery
            :query="require('../../graphql/school/schools.gql')"
        >
            <template slot-scope="{ result:{ loading, error, data }, isLoading }">
                <div v-if="error">Une erreur est survenue !</div>
                <el-table
                    v-loading="isLoading === 1"
                    :data="tableData(data)"
                    style="width: 100%"
                    >
                    <el-table-column column-key="name" prop="name" label="Name"></el-table-column>
                    <el-table-column column-key="description" prop="description" label="Description"></el-table-column>
                    <el-table-column column-key="information" prop="information" label="Information"></el-table-column>
                    <el-table-column column-key="active" prop="active" label="Status" width="80px" align="center">
                        <template slot-scope="scope">
                            <i v-if="scope.row.active==true" class="el-icon-circle-check h4 text-success"></i>
                            <i v-else class="el-icon-circle-close h4 text-danger"></i>
                        </template>
                    </el-table-column>
                    <el-table-column width="180px">
                        <template slot-scope="scope">
                            <el-button size="mini" type="primary" class="ml-0" @click="handleEdit(scope.$index, scope.row)">Edit</el-button>
                            <el-button size="mini" type="danger" class="ml-0" @click="handleDelete(scope.$index, scope.row)">Delete</el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </template>
        </ApolloQuery>
        <el-button type="primary" class="mt-2" @click="createSchool()">Create a school</el-button>
    </div>
</template>

<script>
import _ from "lodash";

export default {
    name: 'Schools',
    methods: {
        tableData(data) {
            if (!_.isNil(data)) {
                return data.fetchSchools;
            } else {
                return [];
            }
        },
        handleEdit(index, row) {
            this.$router.push("/admin/schools/detail/" + row.id);
        },
        handleDelete(index, row) {
            this.$confirm('Are you sure to delete it?')
                .then(() => {
                  this.$apollo.mutate({
                        mutation: require('../../graphql/school/deleteSchool.gql'),
                        variables: {
                            id: row.id
                        }
                    }).then(() => {
                        this.$router.go(0);
                    });
                })
        },
        createSchool() {
            this.$router.push("/admin/schools/detail");
        }
    }
}
</script>