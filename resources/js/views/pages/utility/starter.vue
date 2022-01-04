<script>
 import PageHeader from "@/components/page-header";

/**
 * Starter page component
 */
export default {
  page: {
    title: "Starter page",
    meta: [{ name: "description" }]
  },
  components: {  PageHeader },
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
  <div> 
    <PageHeader :title="title" :items="items" />
  </div>
</template>