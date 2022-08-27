<template>
    <Layout>
        <PageHeader
            :title="title"
        />
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <a
                                href="javascript:void(0);"
                                class="btn btn-success mb-2"
                                @click="$router.push('/admin/users/new')"
                            >
                                <i class="mdi mdi-plus mr-2"></i> New User
                            </a>
                        </div>
                        <custom-table @edit-item="editUser"
                                      @delete-item="deleteUser"
                                      :search="true"
                                      :items="users"
                                      :filteringOptions="['roles', 'statuses']"
                                      :busy="busy"
                                      :filters="filters"
                                      :fields="fields"
                                      :actions="['delete', 'edit']"
                                      @filters-updated="filtersUpdated"
                        />
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
<script>
import PageHeader from "@/components/custom/page-header";
import CustomTable from "@/components/reusable/tables/CustomTable";
import UserService from "@/services/userService";
import Layout from "../../layouts/main";

export default {
    components: {
        CustomTable,
        Layout,
        PageHeader
    },
    data() {
        return {
            title: "Users",
            users: [],
            filters: null,
            busy: false,
            fields: [
                {key: "id", sortable: true, label: "ID"},
                {key: "first_name", sortable: true, label: "First Name"},
                {key: "last_name", sortable: true, label: "Last Name"},
                {key: "email", sortable: true, label: "Email"},
                {key: "phone", sortable: true, label: "Phone"},
                {key: "address", sortable: true, label: "Address"},
                {key: "city", sortable: true, label: "City"},
                {key: "gender", sortable: true, label: "Gender"},
                {key: "dob", sortable: true, label: "Date of birth"},
                {key: "roles", sortable: true, label: "Roles"},
                {key: "active", sortable: true, label: "Active"},
                {key: "action"}
            ]
        };
    },
    watch: {
        'filters': {
            deep: true,
            handler(filter) {

                this.$router.replace({
                    ...this.$route,
                    query: filter,
                }).catch(()=>{});

                this.getUsers();

            },
        },
    },
    created() {
        this.filters = this.$route.query;
    },
    methods: {
        editUser(id) {
            this.$router.push('/admin/user/' + id);
        },

        async deleteUser(id) {
            this.$swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Yes, delete it!"
            }).then(async result => {
                if (result.value) {
                    let response = await UserService.deleteUser(id);
                    let index = this.users.findIndex(user => user.id === parseInt(response))   // find the post index
                    if (~index) // if the post exists in array
                        this.users.splice(index, 1) //delete the post
                }
            });

        },

        async getUsers() {
            this.busy = true;

            const users = await UserService.getUsers(this.filters);
            this.users = users.map(x => {
                x.city = x.city.city_name_en;
                return x;
            })

            this.busy = false;
        },

        filtersUpdated(value){
            this.filters = value;
        }
    }
};
</script>
