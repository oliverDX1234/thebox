<script>
import {authMethods} from "@/state/helpers";
import {email, required} from "vuelidate/lib/validators";
import AuthService from "../../../services/authService";

export default {
    data() {
        return {
            email: "",
            submitted: false,
        };
    },
    validations: {
        email: {required, email},
    },
    created() {
        document.body.classList.add("auth-body-bg");
    },
    methods: {
        ...authMethods,
        async tryToReset() {
            this.submitted = true;
            this.$v.$touch();

            if (!this.$v.$invalid) {

                await AuthService.forgotPassword(this.email);
            }
        },
    },
};
</script>

<template>
    <div>
        <div class="home-btn d-none d-sm-block">
            <a href="/">
                <i class="mdi mdi-home-variant h2 text-white"></i>
            </a>
        </div>
        <div>
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-lg-4">
                        <div
                            class="authentication-page-content p-4 d-flex align-items-center min-vh-100"
                        >
                            <div class="w-100">
                                <div class="row justify-content-center">
                                    <div class="col-lg-9">
                                        <div>
                                            <div class="text-center">
                                                <div>
                                                    <a href="/" class="logo">
                                                        <img
                                                            :src="
                                                                getImgUrl(
                                                                    '/logo-dark.png'
                                                                )
                                                            "
                                                            height="20"
                                                            alt="logo"
                                                        />
                                                    </a>
                                                </div>

                                                <h4 class="font-size-18 mt-4">
                                                    Reset Password
                                                </h4>
                                                <p class="text-muted">
                                                    Reset your password to
                                                    Nazox.
                                                </p>
                                            </div>

                                            <div class="p-2 mt-5">
                                                <form
                                                    class="form-horizontal"
                                                    @submit.prevent="tryToReset"
                                                >
                                                    <div
                                                        class="form-group auth-form-group-custom mb-4"
                                                    >
                                                        <i
                                                            class="ri-mail-line auti-custom-input-icon"
                                                        ></i>
                                                        <label for="useremail"
                                                        >Email</label
                                                        >
                                                        <input
                                                            v-model="email"
                                                            type="email"
                                                            class="form-control"
                                                            id="useremail"
                                                            placeholder="Enter email"
                                                            :class="{
                                                                'is-invalid':
                                                                    submitted &&
                                                                    $v.email.$error,
                                                            }"
                                                        />
                                                        <div
                                                            v-if="
                                                                submitted &&
                                                                $v.email.$error
                                                            "
                                                            class="invalid-feedback"
                                                        >
                                                            <span
                                                                v-if="
                                                                    !$v.email
                                                                        .required
                                                                "
                                                            >Email is
                                                                required.</span
                                                            >
                                                            <span
                                                                v-if="
                                                                    !$v.email
                                                                        .email
                                                                "
                                                            >Please enter
                                                                valid
                                                                email.</span
                                                            >
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="mt-4 text-center"
                                                    >
                                                        <button
                                                            class="btn btn-primary w-md waves-effect waves-light"
                                                            type="submit"
                                                        >
                                                            Reset
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="mt-5 text-center">
                                                <p>
                                                    Don't have an account ?
                                                    <router-link
                                                        tag="a"
                                                        to="/admin/login"
                                                        class="font-weight-medium text-primary"
                                                    >Log in
                                                    </router-link
                                                    >
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="authentication-bg">
                            <div class="bg-overlay"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
