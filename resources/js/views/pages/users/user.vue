<template>
  <div>

    <PageHeader
      :title="title"
      :items="items"
    />
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-4 col-md-12">
                <div class="mt-2">
                  <FileUpload :imageData="user.image"/>
                </div>
              </div>
              <div class="col-lg-8 col-md-12">
                <form
                  class="needs-validation"
                  @submit.prevent="formSubmit"
                >
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="validationCustom01">First name</label>
                        <input
                          id="validationCustom01"
                          v-model="user.first_name"
                          type="text"
                          class="form-control"
                          placeholder="First name"
                          value="Mark"
                          :class="{ 'is-invalid': submitted && $v.user.first_name.$error }"
                        />
                        <div
                          v-if="submitted && $v.user.first_name.$error"
                          class="invalid-feedback"
                        >
                          <span v-if="!$v.user.first_name.required">This value is required.</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="validationCustom02">Last name</label>
                        <input
                          id="validationCustom02"
                          v-model="user.last_name"
                          type="text"
                          class="form-control"
                          placeholder="Last name"
                          value="Otto"
                          :class="{ 'is-invalid': submitted && $v.user.last_name.$error }"
                        />
                        <div
                          v-if="submitted && $v.user.last_name.$error"
                          class="invalid-feedback"
                        >
                          <span v-if="!$v.user.last_name.required">This value is required.</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="validationCustom03">Email</label>
                        <input
                          id="validationCustom03"
                          v-model="user.email"
                          type="text"
                          class="form-control"
                          placeholder="Email"
                          :class="{ 'is-invalid': submitted && $v.user.email.$error }"
                        />
                        <div
                          v-if="submitted && $v.user.email.$error"
                          class="invalid-feedback"
                        >
                          <span v-if="!$v.user.email.required">This value is required.</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="validationCustom04">Phone</label>
                        <input
                          id="validationCustom04"
                          v-model="user.phone"
                          type="text"
                          class="form-control"
                          placeholder="Phone"
                          :class="{ 'is-invalid': submitted && $v.user.phone.$error }"
                        />
                        <div
                          v-if="submitted && $v.user.phone.$error"
                          class="invalid-feedback"
                        >
                          <span v-if="!$v.user.phone.required">This value is required.</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="validationCustom03">City</label>
                        <input
                          id="validationCustom03"
                          v-model="user.city"
                          type="text"
                          class="form-control"
                          placeholder="City"
                          :class="{ 'is-invalid': submitted && $v.user.city.$error }"
                        />
                        <div
                          v-if="submitted && $v.user.city.$error"
                          class="invalid-feedback"
                        >
                          <span v-if="!$v.user.city.required">This value is required.</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="validationCustom05">Address</label>
                        <input
                          id="validationCustom05"
                          v-model="user.address"
                          type="text"
                          class="form-control"
                          placeholder="Address"
                          :class="{ 'is-invalid': submitted && $v.user.address.$error }"
                        />
                        <div
                          v-if="submitted && $v.user.address.$error"
                          class="invalid-feedback"
                        >
                          <span v-if="!$v.user.address.required">This value is required.</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="validationCustom04">Gender</label>
                        <input
                          id="validationCustom04"
                          v-model="user.gender"
                          type="text"
                          class="form-control"
                          placeholder="Gender"
                          :class="{ 'is-invalid': submitted && $v.user.gender.$error }"
                        />
                        <div
                          v-if="submitted && $v.user.gender.$error"
                          class="invalid-feedback"
                        >
                          <span v-if="!$v.user.gender.required">This value is required.</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="validationCustom04">Date of birth</label>
                        <date-picker
                          v-model="user.dob"
                          :first-day-of-week="1"
                          confirm
                          value-type="format"
                          format='YYYY-MM-DD'
                          :class="{ 'is-invalid': submitted && $v.user.dob.$error }"
                        ></date-picker>

                        <div
                          v-if="submitted && $v.user.dob.$error"
                          class="invalid-feedback"
                        >
                          <span v-if="!$v.user.dob.required">This value is required.</span>
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-12">
                      <hr>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Change password</label>
                        <div>
                          <input
                            v-model="user.password"
                            type="password"
                            name="password"
                            class="form-control"
                            :class="{ 'is-invalid': submitted && $v.user.password.$error }"
                            placeholder="Password"
                          />
                          <div
                            v-if="submitted && $v.user.password.$error"
                            class="invalid-feedback"
                          >
                            <span v-if="!$v.user.password.required">This value is required.</span>
                            <span v-if="!$v.user.password.minLength">Password must be at least 6 characters.</span>
                          </div>
                        </div>
                        <div class="mt-2">
                          <input
                            v-model="user.confirmPassword"
                            type="password"
                            name="confirmPassword"
                            class="form-control"
                            :class="{ 'is-invalid': submitted && $v.user.confirmPassword.$error }"
                            placeholder="Re-Type Password"
                          />
                          <div
                            v-if="submitted && $v.user.confirmPassword.$error"
                            class="invalid-feedback"
                          >
                            <span v-if="!$v.user.confirmPassword.required">This value is required.</span>
                            <span v-else-if="!$v.user.confirmPassword.sameAsPassword">This value should be the same.</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-12">
                      <hr>
                    </div>
                  </div>

                  <button
                    class="btn btn-primary mt-2 float-right"
                    type="submit"
                  >Save User</button>
                </form>
              </div>
            </div>

          </div>
        </div>
        <!-- end card -->
      </div>
      <!-- end col -->
    </div>
    <!-- end row -->

  </div>
</template>

<script>
import {
  required,
  email,
  minLength,
  sameAs
} from "vuelidate/lib/validators";

import PageHeader from "@/components/page-header";
import FileUpload from '@/components/file-upload.vue'
import DatePicker from "vue2-datepicker";

export default {
  page: {
    title: "User",
    meta: [{ name: "New/Edit User", content: "Create or edit a user" }],
  },
  components: { PageHeader, FileUpload, DatePicker },
  data() {
    return {
      title: "New User",
      items: [
        {
          text: "Users",
          to: "/admin/users"
        },
        {
          text: "New User",
          active: true
        }
      ],
      user: {
        first_name: null,
        last_name: null,
        email: null,
        city: null,
        phone: null,
        role: null,
        address: null,
        gender: null,
        dob: null,
        password: null,
        confirmPassword: null,
        image: null
      },
      submitted: false,
    };
  },
  validations: {
    user: {
      first_name: { required },
      last_name: { required },
      city: { required },
      phone: { required },
      email: { required, email },
      address: { required },
      role: { required },
      gender: { required },
      dob: { required },
      password: { required, minLength: minLength(7) },
      confirmPassword: { required, sameAsPassword: sameAs("password") },
    },
  },
  methods: {
    formSubmit(e) {
      this.submitted = true;
      // stop here if form is invalid
      this.$v.$touch();

      console.log(this.user);
    },

    async loadUser() {

      let id = this.$route.params.id;

      try {
        let response = await this.$http.get(`/api/user/${id}`);
        this.user = response.data.payload.user;
      } catch (e) {
      }

    }
  },

  created() {

    if (this.$route.params.id) {
      this.title = "Edit User";
      this.items[1].text = "Edit User";
      this.loadUser();
    }
  }
};
</script>
