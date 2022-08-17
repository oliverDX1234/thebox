<script>
import PageHeader from "@/components/custom/page-header";


import Layout from "../../layouts/main";


/**
 * Starter page component
 */
export default {
    page: {
        title: "Starter page",
        meta: [{name: "description"}]
    },
    components: {PageHeader, Layout},
    data() {
        return {
            title: "Starter page",
            items: [
                {
                    text: "Utility",
                    href: "/"
                },
                {
                    text: "Starter page",
                    active: true
                }
            ]
        };
    }
};
</script>

<template>
    <Layout>
        <PageHeader :title="title" />
    </Layout>
</template>
