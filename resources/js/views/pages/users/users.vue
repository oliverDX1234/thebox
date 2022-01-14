<script>
import PageHeader from "@/components/page-header";
import CustomTable from "@/components/CustomTable";
import UserService from "@/services/userService";
import Layout from "../../layouts/main";


/**
 * Customers Component
 */
export default {
    components: {
        CustomTable,
        Layout,
        PageHeader
    },
    data() {
        return {
            title: "Users",
            items: [
                {
                    text: "Users",
                    active: true

                }
            ],
            users: [],
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
                {key: "action"}


            ]
        };
    },

    created() {
        this.getUsers();
    },
    methods: {
        editUser(id) {
            this.$router.push('/admin/user/' + id);
        },
        async deleteUser(id) {
            let response = await UserService.deleteUser(id);
            let index = this.users.findIndex(user => user.id === parseInt(response))   // find the post index
            if (~index) // if the post exists in array
                this.users.splice(index, 1) //delete the post
        },
        async getUsers() {
            const users = await UserService.getUsers();
            this.users = users.map(x => {
                x.city = x.city.city_name_en;
                return x;
            })
        },
    }
};
</script>

<template>
    <Layout>
        <PageHeader
            :title="title"
            :items="items"
        />
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <a
                                href="javascript:void(0);"
                                class="btn btn-success mb-2"
                                @click="$router.push('/admin/user/')"
                            >
                                <i class="mdi mdi-plus mr-2"></i> New User
                            </a>
                        </div>
                        <custom-table @edit-item="editUser" @delete-item="deleteUser" :items="users" :fields="fields"/>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
