<script>
import simplebar from "simplebar-vue";
import {authMethods} from "../../state/helpers";
import {mapGetters} from "vuex";

export default {
    data(){
      return {
          search: null,
          searchResults: null,
          loading: false
      }
    },
    watch:{
      search(newValue, oldValue){
          if (this.timeout)
              clearTimeout(this.timeout);
          this.timeout = setTimeout(() => {

              this.searchFun(newValue);
          }, 1500)


      }
    },
    computed: {
        ...mapGetters({user: "auth/user"}),
    },
    components: {simplebar},
    methods: {
        ...authMethods,
        async attemptLogout() {
            await this.logout();
            await this.$router.push({name: 'admin-login'})
        },
        toggleMenu() {
            this.$parent.toggleMenu();
        },
        async searchFun(value){

            if(!value || value === ""){
                return;
            }

            this.loading = true

            this.$refs['modal'].show()

            let response = await this.$http.get("/api/search", {
                params: { value: value }
            });

            this.loading = false;

            this.searchResults = response.data
        },
        initFullScreen() {
            document.body.classList.toggle("fullscreen-enable");
            if (
                !document.fullscreenElement &&
                /* alternative standard method */ !document.mozFullScreenElement &&
                !document.webkitFullscreenElement
            ) {
                // current working methods
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                    document.documentElement.webkitRequestFullscreen(
                        Element.ALLOW_KEYBOARD_INPUT
                    );
                }
            } else {
                if (document.cancelFullScreen) {
                    document.cancelFullScreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen();
                }
            }
        },
        toggleRightSidebar() {
            this.$parent.toggleRightSidebar();
        },
    },
};
</script>

<template>
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img
                                :src="getImgUrl('/logo-sm-dark.png')"
                                alt
                                height="22"
                            />
                        </span>
                        <span class="logo-lg">
                            <img
                                :src="getImgUrl('/logo-dark.png')"
                                alt
                                height="20"
                            />
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img
                                :src="getImgUrl('/logo-sm-light.png')"
                                alt
                                height="22"
                            />
                        </span>
                        <span class="logo-lg">
                            <img
                                :src="getImgUrl('/logo-light.png')"
                                alt
                                height="20"
                            />
                        </span>
                    </a>
                </div>

                <button
                    @click="toggleMenu"
                    type="button"
                    class="btn btn-sm px-3 font-size-24 header-item waves-effect"
                    id="vertical-menu-btn"
                >
                    <i class="ri-menu-2-line align-middle"></i>
                </button>

                <!-- App Search-->
                <form class="app-search d-none d-lg-block">
                    <div class="position-relative">
                        <input
                            type="text"
                            class="form-control"
                            v-model="search"
                            :placeholder="$t('navbar.search.text')"
                        />
                        <span class="ri-search-line"></span>
                    </div>
                </form>
            </div>

            <div class="d-flex">
                <div class="dropdown d-inline-block d-lg-none ml-2">
                    <button
                        type="button"
                        class="btn header-item noti-icon waves-effect"
                        id="page-header-search-dropdown"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <i class="ri-search-line"></i>
                    </button>
                    <div
                        class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                        aria-labelledby="page-header-search-dropdown"
                    >
                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Search ..."
                                    />
                                    <div class="input-group-append">
                                        <button
                                            class="btn btn-primary"
                                            type="submit"
                                        >
                                            <i class="ri-search-line"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="dropdown d-none d-lg-inline-block ml-1">
                    <button
                        type="button"
                        class="btn header-item noti-icon waves-effect"
                        @click="initFullScreen"
                    >
                        <i class="ri-fullscreen-line"></i>
                    </button>
                </div>

                <b-dropdown
                    right
                    menu-class="dropdown-menu-lg p-0"
                    toggle-class="header-item noti-icon"
                    variant="black"
                >
                    <template v-slot:button-content>
                        <i class="ri-notification-3-line"></i>
                        <span class="noti-dot"></span>
                    </template>
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0">
                                    {{
                                        $t("navbar.dropdown.notification.text")
                                    }}
                                </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small">{{
                                        $t("navbar.dropdown.notification.subtext")
                                    }}</a>
                            </div>
                        </div>
                    </div>
                    <simplebar style="max-height: 230px">
                        <a href class="text-reset notification-item">
                            <div class="media">
                                <div class="avatar-xs mr-3">
                                    <span
                                        class="avatar-title bg-primary rounded-circle font-size-16"
                                    >
                                        <i class="ri-shopping-cart-line"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">
                                        {{
                                            $t(
                                                "navbar.dropdown.notification.order.title"
                                            )
                                        }}
                                    </h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">
                                            {{
                                                $t(
                                                    "navbar.dropdown.notification.order.text"
                                                )
                                            }}
                                        </p>
                                        <p class="mb-0">
                                            <i
                                                class="mdi mdi-clock-outline"
                                            ></i>
                                            {{
                                                $t(
                                                    "navbar.dropdown.notification.order.time"
                                                )
                                            }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href class="text-reset notification-item">
                            <div class="media">
                                <img
                                    :src="getImgUrl('/users/avatar-3.jpg')"
                                    class="mr-3 rounded-circle avatar-xs"
                                    alt="user-pic"
                                />
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">
                                        {{
                                            $t(
                                                "navbar.dropdown.notification.james.title"
                                            )
                                        }}
                                    </h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">
                                            {{
                                                $t(
                                                    "navbar.dropdown.notification.james.text"
                                                )
                                            }}
                                        </p>
                                        <p class="mb-0">
                                            <i
                                                class="mdi mdi-clock-outline"
                                            ></i>
                                            {{
                                                $t(
                                                    "navbar.dropdown.notification.james.time"
                                                )
                                            }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href class="text-reset notification-item">
                            <div class="media">
                                <div class="avatar-xs mr-3">
                                    <span
                                        class="avatar-title bg-success rounded-circle font-size-16"
                                    >
                                        <i class="ri-checkbox-circle-line"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">
                                        {{
                                            $t(
                                                "navbar.dropdown.notification.item.title"
                                            )
                                        }}
                                    </h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">
                                            {{
                                                $t(
                                                    "navbar.dropdown.notification.item.text"
                                                )
                                            }}
                                        </p>
                                        <p class="mb-0">
                                            <i
                                                class="mdi mdi-clock-outline"
                                            ></i>
                                            {{
                                                $t(
                                                    "navbar.dropdown.notification.item.time"
                                                )
                                            }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href class="text-reset notification-item">
                            <div class="media">
                                <img
                                    :src="getImgUrl('/users/avatar-4.jpg')"
                                    class="mr-3 rounded-circle avatar-xs"
                                    alt="user-pic"
                                />
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">
                                        {{
                                            $t(
                                                "navbar.dropdown.notification.salena.title"
                                            )
                                        }}
                                    </h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">
                                            {{
                                                $t(
                                                    "navbar.dropdown.notification.salena.text"
                                                )
                                            }}
                                        </p>
                                        <p class="mb-0">
                                            <i
                                                class="mdi mdi-clock-outline"
                                            ></i>
                                            {{
                                                $t(
                                                    "navbar.dropdown.notification.salena.time"
                                                )
                                            }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </simplebar>
                    <div class="p-2 border-top">
                        <a
                            class="btn btn-sm btn-link font-size-14 btn-block text-center"
                            href="javascript:void(0)"
                        >
                            <i class="mdi mdi-arrow-right-circle mr-1"></i>
                            {{ $t("navbar.dropdown.notification.button") }}
                        </a>
                    </div>
                </b-dropdown>

                <b-dropdown
                    right
                    variant="black"
                    toggle-class="header-item"
                    class="d-inline-block user-dropdown"
                >
                    <template v-slot:button-content>
                        <img
                            class="rounded-circle header-profile-user"
                            :src="user.avatar"
                            alt="Header Avatar"
                        />
                        <span class="d-none d-xl-inline-block ml-1">{{
                                user.first_name
                            }}</span>
                        <i
                            class="mdi mdi-chevron-down d-none d-xl-inline-block"
                        ></i>
                    </template>
                    <!-- item-->
                    <router-link class="dropdown-item" :to="`/admin/user/${this.user.id}`">
                        <i class="ri-user-line align-middle mr-1"></i>
                        {{ $t("navbar.dropdown.kevin.list.profile") }}
                    </router-link>
                    <div class="dropdown-divider"></div>
                    <a
                        class="dropdown-item text-danger cursor-pointer"
                        @click="attemptLogout"
                    >
                        <i
                            class="ri-shut-down-line align-middle mr-1 text-danger"
                        ></i>
                        {{ $t("navbar.dropdown.kevin.list.logout") }}
                    </a>
                </b-dropdown>

                <div class="dropdown d-inline-block">
                    <button
                        type="button"
                        class="btn header-item noti-icon right-bar-toggle waves-effect toggle-right"
                        @click="toggleRightSidebar"
                    >
                        <i class="ri-settings-2-line toggle-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <b-modal
            ref="modal"
            scrollable
            :title="'Search results for: ' + search"
            title-class="font-18"
            @close="searchResults = null"
            hide-footer
        >
            <div v-if="loading">
                <b-spinner variant="primary" label="Spinning"></b-spinner>
            </div>

            <div v-if="!loading && (searchResults && !Object.keys(searchResults).length)">
                <p>No items were found for current search</p>
            </div>

            <div v-for="(value, key) in searchResults">
                <h6 class="text-capitalize">{{ key }}</h6>
                <hr>
                <div v-for="item in value">
                    <b-card v-if="key === 'users'" header-class="bg-transparent border-success" class="border border-success cursor-pointer" @click="$router.push(item.url)">
                        <b-card-title>
                            <p class="card-title font-size-17">{{ item.searchable.first_name }} {{ item.searchable.last_name }}</p>
                        </b-card-title>
                        <b-card-text>{{ item.searchable.email }}</b-card-text>
                        <b-card-text>{{ item.searchable.phone }}</b-card-text>
                        <b-card-text>{{ item.searchable.address }}</b-card-text>

                    </b-card>

                    <b-card v-if="key === 'suppliers'" header-class="bg-transparent border-success" class="border border-success cursor-pointer" @click="$router.push(item.url)">
                        <b-card-title>
                            <p class="card-title font-size-17">{{ item.searchable.name }}</p>
                        </b-card-title>
                        <b-card-text>{{ item.searchable.email }}</b-card-text>
                        <b-card-text>{{ item.searchable.phone }}</b-card-text>
                        <b-card-text>{{ item.searchable.address }}</b-card-text>

                    </b-card>

                    <b-card v-if="key === 'products'" header-class="bg-transparent border-success" class="border border-success cursor-pointer" @click="$router.push(item.url)">
                        <b-card-title>
                            <p class="card-title font-size-17">{{ item.searchable.name }}</p>
                        </b-card-title>
                        <b-card-text>{{ item.searchable.unit_code }}</b-card-text>
                        <b-card-text>{{ item.searchable.price }} MKD</b-card-text>
                    </b-card>

                    <b-card v-if="key === 'packages'" header-class="bg-transparent border-success" class="border border-success cursor-pointer" @click="$router.push(item.url)">
                        <b-card-title>
                            <p class="card-title font-size-17">{{ item.searchable.name }}</p>
                        </b-card-title>
                        <b-card-text>{{ item.searchable.unit_code }}</b-card-text>
                        <b-card-text>{{ item.searchable.price }} MKD</b-card-text>
                    </b-card>

                    <b-card v-if="key === 'couriers'" header-class="bg-transparent border-success" class="border border-success cursor-pointer" @click="$router.push(item.url)">
                        <b-card-title>
                            <p class="card-title font-size-17">{{ item.searchable.name }}</p>
                        </b-card-title>
                        <b-card-text>{{ item.searchable.email }}</b-card-text>
                        <b-card-text>{{ item.searchable.price }} MKD</b-card-text>

                    </b-card>

                    <b-card v-if="key === 'orders'" header-class="bg-transparent border-success" class="border border-success cursor-pointer" @click="$router.push(item.url)">
                        <b-card-title>
                            <p class="card-title font-size-17">{{ item.searchable.order_number }}</p>
                        </b-card-title>
                        <b-card-text>{{ item.searchable.total_price }}</b-card-text>
                        <b-card-text>{{ item.searchable.user_shipping_details.first_name }} {{ item.searchable.user_shipping_details.last_name }}</b-card-text>
                        <b-card-text>{{ item.searchable.user_shipping_details.email }}</b-card-text>
                        <b-card-text>{{ item.searchable.user_shipping_details.address }}</b-card-text>
                        <b-card-text>{{ item.searchable.user_shipping_details.phone }}</b-card-text>

                    </b-card>
                </div>
            </div>
        </b-modal>

    </header>
</template>

<style lang="scss" scoped>

.spinner-border{
    top: 50%;
}

.modal-header{
    background: #e8ecf4 !important;
}

.card-text{
    margin-bottom: 3px;
}

.notify-item {
    .active {
        color: #16181b;
        background-color: #f8f9fa;
    }
}
</style>
