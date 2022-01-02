<template>
    <div id="app">
        <router-view />
    </div>
</template>

<script>
import appConfig from "@/app.config";
import {mapActions} from "vuex";

export default {
  name: "app",
  page: {
    // All subcomponent titles will be injected into this template.
    titleTemplate(title) {
      title = typeof title === "function" ? title(this.$store) : title;
      return title ? `${title} | ${appConfig.title}` : appConfig.title;
    }
  },
  methods:{
    ...mapActions({ checkUsersSession: 'auth/checkSession'}),
  }
};
</script>
