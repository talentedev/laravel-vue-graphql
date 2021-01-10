<template>
    <div>
        <el-form :model="school" label-width="120px" ref="schoolForm" :rules="rules">
            <el-form-item label="Name" prop="name">
                <el-input type="text" v-model="school.name" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item label="Description" prop="description">
                <el-input type="textarea"
                    :autosize="{ minRows: 5, maxRows: 10}"
                    v-model="school.description" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item label="Other information" prop="information">
                <el-input type="textarea"
                    :autosize="{ minRows: 5, maxRows: 10}"
                    v-model="school.information" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item label="Status" prop="active">
                <el-checkbox v-model="school.active">Active</el-checkbox>
            </el-form-item>
            <el-form-item>
            <div class="d-flex justify-content-end mt-4">
                <el-button plein @click="goBack()">Go Back</el-button>
                <el-button type="primary" @click="submitForm('schoolForm')">
                    {{ isCreation ? 'Create school' : 'Update school' }}
                </el-button>
            </div>
          </el-form-item>
        </el-form>
    </div>
</template>

<script>
import _ from "lodash";
import customValidator from "../../utils/validation-rules";

export default {
    name: 'School',
    data() {
        return {
            schoolID: null,
            school: {
                name: '',
                description: '',
                information: '',
                active: false
            },
            rules: {
                name: [
                    customValidator.getRule("requiredNoWhitespaces"),
                    customValidator.getRule("maxVarchar")
                ],
            }
        }
    },
    computed: {
        isCreation() {
            return _.isNil(this.$route.params.id);
        },
    },
    created() {
        this.schoolID = _.isNil(this.$route.params.id) ? null : parseInt(this.$route.params.id);
        if (_.isNil(this.schoolID)) {
            return;
        }

        this.getSchool(this.schoolID);
    },
    methods: {
        getSchool(schoolID) {
            const loading = this.$loading({ lock: true });
            this.$apollo
                .query({
                    query: require("../../graphql/school/school.gql"),
                    variables: {
                        id: schoolID
                    }
                })
                .then(response => {
                    if (response && response.data) {
                        this.school = response.data.school;
                    }
                })
                .finally(() => {
                    loading.close();
                });
        },
        submitForm(formName) {
            this.$refs[formName].validate(valid => {
                if (valid) {
                    const loading = this.$loading({ lock: true });
                    this.$apollo
                        .mutate({
                            mutation: require("../../graphql/school/saveSchool.gql"),
                            variables: {
                                input: {
                                    id: this.schoolID,
                                    name: this.school.name,
                                    description: this.school.description,
                                    information: this.school.information,
                                    video: '',
                                    active: this.school.active
                                }
                            }
                        })
                        .then(() => {
                            this.$router.push("/admin/schools");
                        }).
                        finally(() => {
                            loading.close();
                        });
                }
            });
        },
        goBack() {
            this.$router.push("/admin/schools");
        }
    }
}
</script>