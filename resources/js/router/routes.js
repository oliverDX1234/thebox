export default [
    //Account routes
    {
        path: "/admin/login",
        name: "admin-login",
        component: () => import("../views/pages/account/login"),
        meta: { guest: true },
    },

    {
        path: "/admin/forgot-password",
        name: "forgot-password",
        component: () => import("../views/pages/account/forgot-password"),
        meta: { guest: true },
    },
    {
        path: "/password/reset",
        name: "reset-password",
        component: () => import("../views/pages/account/reset-password"),
        meta: { guest: true },
    },

    //Dashboard
    {
        path: "/admin",
        name: "admin-dashboard",
        meta: {
            admin: true,
        },
        component: () => import("../views/pages/dashboard/index"),
    },

    //Calendar
    {
        path: "/admin/calendar",
        name: "admin-calendar",
        meta: {
            admin: true,
        },
        component: () => import("../views/pages/calendar/index"),
    },

    //Users
    {
        path: "/admin/users/",
        name: "admin-show-users",
        meta: { admin: true },
        component: () => import("../views/pages/users/users"),
    },

    {
        path: "/admin/user/",
        name: "admin-new-user",
        meta: { admin: true },
        component: () => import("../views/pages/users/user"),
    },

    {
        path: "/admin/user/:id",
        name: "admin-edit-user",
        meta: { admin: true },
        component: () => import("../views/pages/users/user"),
    },

    //Suppliers
    {
        path: "/admin/suppliers/",
        name: "admin-show-suppliers",
        meta: { admin: true },
        component: () => import("../views/pages/suppliers/suppliers"),
    },

    {
        path: "/admin/supplier/",
        name: "admin-new-supplier",
        meta: { admin: true },
        component: () => import("../views/pages/suppliers/supplier"),
    },

    {
        path: "/admin/supplier/:id",
        name: "admin-edit-supplier",
        meta: { admin: true },
        component: () => import("../views/pages/suppliers/supplier"),
    },

    //Categories
    {
        path: "/admin/categories/",
        name: "admin-show-categories",
        meta: { admin: true },
        component: () => import("../views/pages/categories/categories"),
    },
    //Filters
    {
        path: "/admin/filtersAndAttributes",
        name: "admin/filtersAndAttributes",
        meta: { admin: true },
        component: () => import("../views/pages/filters/filtersAndAttributes"),
    },
    //Products
    {
        path: "/admin/products",
        name: "admin/products",
        meta: { admin: true },
        component: () => import("../views/pages/products/products"),
    },
    {
        path: "/admin/ecommerce/product-detail",
        name: "admin/productDetail",
        meta: { admin: true },
        component: () => import("../views/pages/ecommerce/product-detail"),
    },
    {
        path: "/admin/ecommerce/orders",
        name: "admin/Orders",
        meta: { admin: true },
        component: () => import("../views/pages/ecommerce/orders"),
    },
    {
        path: "/admin/ecommerce/add-product",
        name: "admin/Add-product",
        meta: { admin: true },
        component: () => import("../views/pages/ecommerce/add-product"),
    },
    {
        path: "/admin/pages/starter",
        name: "admin/Starter",
        meta: { admin: true },
        component: () => import("../views/pages/utility/starter"),
    },
    {
        path: "/admin/icons/font-awesome",
        name: "admin/Font Awesome 5",
        meta: { admin: true },
        component: () => import("../views/pages/icons/font-awesome/index"),
    },
    {
        path: "/admin/icons/dripicons",
        name: "admin/Dripicons",
        meta: { admin: true },
        component: () => import("../views/pages/icons/dripicons"),
    },
    {
        path: "/admin/icons/material-design",
        name: "admin/Material Design",
        meta: { admin: true },
        component: () => import("../views/pages/icons/materialdesign/index"),
    },
    {
        path: "/admin/icons/remix",
        name: "admin/Remix Icons",
        meta: { admin: true },
        component: () => import("../views/pages/icons/remix/index"),
    },
    {
        path: "/admin/ui/buttons",
        name: "admin/Buttons",
        meta: { admin: true },
        component: () => import("../views/pages/ui/buttons"),
    },
    {
        path: "/admin/ui/alerts",
        name: "admin/Alerts",
        meta: { admin: true },
        component: () => import("../views/pages/ui/alerts"),
    },
    {
        path: "/admin/ui/grid",
        name: "admin/Grid",
        meta: { admin: true },
        component: () => import("../views/pages/ui/grid"),
    },
    {
        path: "/admin/ui/cards",
        name: "admin/Cards",
        meta: { admin: true },
        component: () => import("../views/pages/ui/cards"),
    },
    {
        path: "/admin/ui/carousel",
        name: "admin/Carousel",
        meta: { admin: true },
        component: () => import("../views/pages/ui/carousel"),
    },
    {
        path: "/admin/ui/dropdowns",
        name: "admin/Dropdowns",
        meta: { admin: true },
        component: () => import("../views/pages/ui/dropdowns"),
    },
    {
        path: "/admin/ui/images",
        name: "admin/Images",
        meta: { admin: true },
        component: () => import("../views/pages/ui/images"),
    },
    {
        path: "/admin/ui/modals",
        name: "admin/Modals",
        meta: { admin: true },
        component: () => import("../views/pages/ui/modals"),
    },
    {
        path: "/admin/ui/rangeslider",
        name: "admin/Range - slider",
        meta: { admin: true },
        component: () => import("../views/pages/ui/rangeslider"),
    },
    {
        path: "/admin/ui/progressbar",
        name: "admin/Progressbar",
        meta: { admin: true },
        component: () => import("../views/pages/ui/progressbars"),
    },
    {
        path: "/admin/ui/sweet-alert",
        name: "admin/Sweet-alert",
        meta: { admin: true },
        component: () => import("../views/pages/ui/sweet-alert"),
    },
    {
        path: "/admin/ui/tabs-accordion",
        name: "admin/Tabs & Accordion",
        meta: { admin: true },
        component: () => import("../views/pages/ui/tabs-accordions"),
    },
    {
        path: "/admin/ui/typography",
        name: "admin/Typography",
        meta: { admin: true },
        component: () => import("../views/pages/ui/typography"),
    },
    {
        path: "/admin/ui/video",
        name: "admin/Video",
        meta: { admin: true },
        component: () => import("../views/pages/ui/video"),
    },
    {
        path: "/admin/ui/general",
        name: "admin/General",
        meta: { admin: true },
        component: () => import("../views/pages/ui/general"),
    },
    {
        path: "/admin/ui/lightbox",
        name: "admin/Lightbox",
        meta: { admin: true },
        component: () => import("../views/pages/ui/lightbox"),
    },
    {
        path: "/admin/ui/notification",
        name: "admin/Notification",
        meta: { admin: true },
        component: () => import("../views/pages/ui/notification"),
    },
    {
        path: "/admin/ui/rating",
        name: "admin/Rating",
        meta: { admin: true },
        component: () => import("../views/pages/ui/rating"),
    },
    {
        path: "/admin/ui/session-timeout",
        name: "admin/Session Timeout",
        meta: { admin: true },
        component: () => import("../views/pages/ui/session-timeout"),
    },
    {
        path: "/admin/form/elements",
        name: "admin/Form Elements",
        meta: { admin: true },
        component: () => import("../views/pages/forms/elements"),
    },
    {
        path: "/admin/form/validation",
        name: "admin/Form validation",
        meta: { admin: true },
        component: () => import("../views/pages/forms/validation"),
    },
    {
        path: "/admin/form/advanced",
        name: "admin/Form Advanced",
        meta: { admin: true },
        component: () => import("../views/pages/forms/advanced"),
    },
    {
        path: "/admin/form/editor",
        name: "admin/CK Editor",
        meta: { admin: true },
        component: () => import("../views/pages/forms/ckeditor"),
    },
    {
        path: "/admin/form/uploads",
        name: "admin/File Uploads",
        meta: { admin: true },
        component: () => import("../views/pages/forms/uploads"),
    },
    {
        path: "/admin/form/wizard",
        name: "admin/Form Wizard",
        meta: { admin: true },
        component: () => import("../views/pages/forms/wizard"),
    },
    {
        path: "/admin/form/mask",
        name: "admin/Form Mask",
        meta: { admin: true },
        component: () => import("../views/pages/forms/mask"),
    },
    {
        path: "/admin/tables/basic",
        name: "admin/Basic Tables",
        meta: { admin: true },
        component: () => import("../views/pages/tables/basictable"),
    },
    {
        path: "/admin/tables/advanced",
        name: "admin/Advanced Tables",
        meta: { admin: true },
        component: () => import("../views/pages/tables/advancedtable"),
    },
    {
        path: "/admin/charts/apex",
        name: "admin/Apex chart",
        meta: { admin: true },
        component: () => import("../views/pages/charts/apex"),
    },
    {
        path: "/admin/charts/chartjs",
        name: "admin/Chartjs chart",
        meta: { admin: true },
        component: () => import("../views/pages/charts/chartjs/index"),
    },
    {
        path: "/admin/charts/chartist",
        name: "admin/Chartist chart",
        meta: { admin: true },
        component: () => import("../views/pages/charts/chartist"),
    },
    {
        path: "/admin/charts/echart",
        name: "admin/Echart chart",
        meta: { admin: true },
        component: () => import("../views/pages/charts/echart/index"),
    },
    {
        path: "/admin/maps/google",
        name: "admin/Google Maps",
        meta: { admin: true },
        component: () => import("../views/pages/maps/google"),
    },
    {
        path: "/admin/maps/leaflet",
        name: "admin/Leaflet Maps",
        meta: { admin: true },
        component: () => import("../views/pages/maps/leaflet/index"),
    },
    {
        path: "/404",
        name: "404",
        meta: { authRequired: true },
        component: () => import("../views/pages/error-404"),
    },
    {
        path: "/admin/*",
        name: "NotFound",
        component: {
            component: () => import("../views/pages/maps/leaflet/index"),
        },
    },
];
