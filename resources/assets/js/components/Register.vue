<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Register</div>

            <div class="card-body">
                <div class="alert alert-danger" v-if="has_error && !success">
                    <p v-if="error == 'registration_validation_error'">Validation error (s), please consult the message (s) below.</p>
                    <p v-else>Error, can not register for the moment. If the problem persists, please contact an administrator.</p>
                </div>

                <form autocomplete="off" @submit.prevent="register_teacher" method="post">

                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.name }">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" placeholder="Full Name" v-model="form.name">
                        <span class="help-block" v-if="has_error && registerError.name">{{ errors.name }}</span>
                    </div>
                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.email }">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="form.email">
                        <span class="help-block" v-if="has_error && errors.email">{{ errors.email }}</span>
                    </div>
                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.email }">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" class="form-control" placeholder="Phone" v-model="form.phone">
                        <span class="help-block" v-if="has_error && errors.phone">{{ errors.phone }}</span>
                    </div>

                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                        <label for="password">Password</label>
                        <input type="password" id="password" class="form-control" v-model="form.password">
                        <span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>
                    </div>

                    <div class="form-group" v-bind:class="{ 'has-error': has_error && errors.password }">
                        <label for="password_confirmation">Confirmation Password</label>
                        <input type="password" id="password_confirmation" class="form-control" v-model="form.password_confirmation">
                    </div>

                    <button type="submit" class="btn btn-default">Register</button>

                    <div class="form-group row" v-if="registerError">
                        <p class="error">
                            {{ registerError }}
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>


<script>
    import {register} from '../helpers/register';

    export default {
        name: "register",
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    phone: '',
                    password: '',
                    password_confirmation: '',
                },
                has_error: false,
                success: false,
                error: '',
                errors: {},
                error: null
            };
        },
        methods: {

            register_teacher() {
                this.$store.dispatch('register');

                register(this.$data.form)
                    .then((res) => {
                        //console.log(res);
                        //this.$store.commit("loginSuccess", res);
                        this.success = true
                        this.$router.push({name: 'login'});
                        //this.$router.push('/login');
                    })
                    .catch((error) => {
                        //console.log(error);
                        //this.$store.commit("registerFailed", {error});
                    });
            }
        },
        computed: {
            registerError() {
               // return this.$store.getters.registerError;
            }
        }
    }
</script>

