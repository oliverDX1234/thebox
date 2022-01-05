<script>
import {authMethods} from "@/state/helpers";
import {email, minLength, required, sameAs,} from "vuelidate/lib/validators";
import AuthService from "../../../services/authService";

export default {
    data() {
        return {
            email: "",
            password: "",
            confirmPassword: "",
            submitted: false,
        };
    },
    validations: {
        email: {required, email},
        password: {required, minLength: minLength(7)},
        confirmPassword: {required, sameAsPassword: sameAs("password")},
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
                try {
                    let response = await AuthService.resetPassword(
                        this.email,
                        this.password,
                        this.confirmPassword,
                        this.$route.query.token
                    );

                    this.makeToast("success", response.data.success);
                } catch (error) {
                    //TODO revisit to implement error handling/ unified response from
                    Object.keys(error.data.errors)
                        .forEach(errorKey => this.makeToast("danger", error.data.errors[errorKey][0]));
                }
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
                                                    <div class="form-group">
                                                        <label>E-Mail</label>
                                                        <div>
                                                            <input
                                                                v-model="email"
                                                                type="email"
                                                                name="email"
                                                                class="form-control"
                                                                :class="{
                                                                    'is-invalid':
                                                                        submitted &&
                                                                        $v.email
                                                                            .$error,
                                                                }"
                                                                placeholder="Enter a valid e-mail"
                                                            />
                                                            <div
                                                                v-if="
                                                                    submitted &&
                                                                    $v.email
                                                                        .$error
                                                                "
                                                                class="invalid-feedback"
                                                            >
                                                                <span
                                                                    v-if="
                                                                        !$v
                                                                            .email
                                                                            .required
                                                                    "
                                                                >This value
                                                                    is
                                                                    required.</span
                                                                >
                                                                <span
                                                                    v-if="
                                                                        !$v
                                                                            .email
                                                                            .email
                                                                    "
                                                                >This value
                                                                    should be a
                                                                    valid
                                                                    email.</span
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                        >New Password</label
                                                        >
                                                        <div>
                                                            <input
                                                                v-model="
                                                                    password
                                                                "
                                                                type="password"
                                                                name="password"
                                                                class="form-control"
                                                                :class="{
                                                                    'is-invalid':
                                                                        submitted &&
                                                                        $v
                                                                            .password
                                                                            .$error,
                                                                }"
                                                                placeholder="Password"
                                                            />
                                                            <div
                                                                v-if="
                                                                    submitted &&
                                                                    $v.password
                                                                        .$error
                                                                "
                                                                class="invalid-feedback"
                                                            >
                                                                <span
                                                                    v-if="
                                                                        submitted &&
                                                                        !$v
                                                                            .password
                                                                            .required
                                                                    "
                                                                >This value
                                                                    is
                                                                    required.</span
                                                                >
                                                                <span
                                                                    v-if="
                                                                        !$v
                                                                            .password
                                                                            .minLength
                                                                    "
                                                                >Password
                                                                    must be at
                                                                    least 7
                                                                    characters.</span
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label
                                                        >Confirm
                                                            Password</label
                                                        >
                                                        <input
                                                            v-model="
                                                                confirmPassword
                                                            "
                                                            type="password"
                                                            name="confirmPassword"
                                                            class="form-control"
                                                            :class="{
                                                                'is-invalid':
                                                                    submitted &&
                                                                    $v
                                                                        .confirmPassword
                                                                        .$error,
                                                            }"
                                                            placeholder="Re-Type Password"
                                                        />
                                                        <div
                                                            v-if="
                                                                submitted &&
                                                                $v
                                                                    .confirmPassword
                                                                    .$error
                                                            "
                                                            class="invalid-feedback"
                                                        >
                                                            <span
                                                                v-if="
                                                                    !$v
                                                                        .confirmPassword
                                                                        .required
                                                                "
                                                            >This value is
                                                                required.</span
                                                            >
                                                            <span
                                                                v-else-if="
                                                                    !$v
                                                                        .confirmPassword
                                                                        .sameAsPassword
                                                                "
                                                            >This value
                                                                should be the
                                                                same.</span
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
