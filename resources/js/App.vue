<template>
    <div id="app">
        <Layout v-if="showLayout">
            <router-view :key="$route.path"/>
        </Layout>

        <router-view :key="$route.path" v-else/>

    </div>
</template>

<script>
import appConfig from "@/app.config";
import {mapActions} from "vuex";
import Layout from "@/views/layouts/main";

export default {
  name: "app",
  components: { Layout },
  computed: {
    showLayout() {
      if (this.$route.path == "/") {
        return false;
      }

            var words = ['login', '/password/reset', 'forgot-password', "404"];

            if (RegExp(words.join('|')).test(this.$route.path)) {
                return false;
            }
            return true;
        }
    },
    page: {
        // All subcomponent titles will be injected into this template.
        titleTemplate(title) {
            title = typeof title === "function" ? title(this.$store) : title;
            return title ? `${title} | ${appConfig.title}` : appConfig.title;
        }
    },
    methods: {
    }
};
</script>
