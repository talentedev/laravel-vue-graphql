<template>
    <div>
        <nav>
            <img class="logo" src="images/Logo.svg">
        </nav>
        <div class="container connexion">
            <el-card class="box-card">
                <div class="text-center mb-4">
                    <h2>Connexion</h2>
                </div>
                <el-row class="d-flex justify-content-center">
                    <el-alert
                        v-if="hasError"
                        class="mb-3"
                        title="Login / Mot de passe incorrect"
                        type="error"
                        show-icon
                        :closable="false">
                    </el-alert>
                    <el-form :model="credentials" label-width="100px" label-position="left" ref="loginForm">
                        <el-form-item
                            label="Login"
                            prop="email"
                            :rules="[{ required: true, message: 'Merci de renseigner une adresse e-mail', trigger: 'blur' },{ type: 'email', message: 'Merci de renseigner une adresse e-mail valide', trigger: ['blur']}]"
                        >
                            <el-input class="block" type="email" v-model="credentials.email" autocomplete="on" placeholder="xxx@xxx.com"></el-input>
                        </el-form-item>
                        <el-form-item
                            label="Password"
                            prop="password"
                            :rules="[{ required: true, message: 'Merci de renseigner un mot de passe', trigger: 'blur' }]"
                        >
                            <el-input class="block" type="password" v-model="credentials.password" autocomplete="on"></el-input>
                        </el-form-item>
                        <div class="text-right mb-4">
                            <router-link class="d-block font-small" to="/forgot-password">Mot de passe oublié</router-link>
                        </div>
                        <el-form-item>
                            <el-button class="block border text-white text-uppercase" @click="submitForm('loginForm')">Connexion</el-button>
                        </el-form-item>
                    </el-form>
                </el-row>
            </el-card>
        </div>
    </div>
</template>

<script>
export default {
    name: 'connexion',
    data() {
        return {
            credentials: {
                email: "",
                password: ""
            }
        }
    },
    computed: {
        hasError() {
            return this.$store.getters["security/hasError"];
        }
    },
    methods: {
        submitForm(formName) {
            this.$refs[formName].validate(valid => {
                if (valid) {
                    let payload = this.$data.credentials,
                        redirect = this.$route.query.redirect;
                    const loading = this.$loading({ lock: true });
                    this.$store.dispatch("security/login", payload).then(() => {
                        loading.close();
                        if (!this.$store.getters["security/hasError"]) {
                            if (typeof redirect !== "undefined") {
                                this.$router.push({ path: redirect });
                            } else {
                                this.$router.push({ path: "/home" });
                            }
                        }
                    });
                }
                return valid;
            });
        }
    }
}
</script>