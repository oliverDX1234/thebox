export const menuItems = [
    {
        id: 1,
        label: "menuitems.menu.text",
        isTitle: true,
    },
    {
        id: 2,
        label: "menuitems.dashboard.text",
        icon: "ri-dashboard-line",
        badge: {
            variant: "success",
            text: "menuitems.dashboard.badge",
        },
        link: "/admin",
    },
    {
        id: 3,
        label: "menuitems.calendar.text",
        icon: "ri-calendar-2-line",
        link: "/admin/calendar",
    },
    {
        id: 4,
        label: "menuitems.users.users",
        icon: "dripicons-user-group",
        subItems: [
            {
                id: 5,
                icon: "dripicons-user-group",
                label: "menuitems.users.all",
                link: "/admin/users/",
            },
            {
                id: 6,
                label: "menuitems.users.new",
                link: "/admin/user/",
            },
        ],
    },
    {
        id: 7,
        label: "menuitems.suppliers.suppliers",
        icon: "ri-truck-line",
        subItems: [
            {
                id: 8,
                icon: "dripicons-user-group",
                label: "menuitems.suppliers.all",
                link: "/admin/suppliers/",
            },
            {
                id: 9,
                label: "menuitems.suppliers.new",
                link: "/admin/supplier/",
            },
        ],
    },
    {
        id: 15,
        label: "menuitems.categories.categories",
        icon: "dripicons-checklist",
        link: "/admin/categories/",
    },
    {
        id: 20,
        label: "menuitems.filters.filtersAndAttributes",
        icon: "ri-filter-line",
        link: "/admin/filtersAndAttributes/",
    },
    {
        id: 13,
        label: "menuitems.ecommerce.text",
        icon: "ri-store-2-line",
        subItems: [
            {
                id: 14,
                label: "menuitems.ecommerce.list.products",
                subItems:[
                    {
                        label: "menuitems.ecommerce.list.all-products",
                        id: 50,
                        link: "/admin/products",
                    },
                    {
                        id: 17,
                        label: "menuitems.ecommerce.list.add-product",
                        link: "/admin/product",
                    },
                ]
            },
            {
                id: 14,
                label: "menuitems.ecommerce.list.packages",
                subItems:[
                    {
                        label: "menuitems.ecommerce.list.all-packages",
                        id: 50,
                        link: "/admin/packages",
                    },
                    {
                        id: 17,
                        label: "menuitems.ecommerce.list.add-package",
                        link: "/admin/package",
                    },
                ]
            },
            {
                id: 15,
                label: "menuitems.ecommerce.list.discounts",
                subItems: [
                    {
                        id: 17,
                        label: "menuitems.ecommerce.list.all-discounts",
                        link: "/admin/discounts",
                    },
                    {
                        id: 16,
                        label: "menuitems.ecommerce.list.add-discount",
                        link: "/admin/discounts/new",
                    },
                ]
            },
            {
                id: 15,
                label: "menuitems.ecommerce.list.couriers",
                subItems: [
                    {
                        id: 17,
                        label: "menuitems.ecommerce.list.all-couriers",
                        link: "/admin/couriers",
                    },
                    {
                        id: 16,
                        label: "menuitems.ecommerce.list.add-courier",
                        link: "/admin/couriers/new",
                    },
                ]
            },
            {
                id: 16,
                label: "menuitems.ecommerce.list.orders",
                link: "/admin/ecommerce/orders",
            },
        ],
    },
    {
        id: 18,
        isLayout: true,
    },
    {
        id: 36,
        label: "menuitems.components.text",
        isTitle: true,
    },
    {
        id: 37,
        label: "menuitems.uielements.text",
        icon: "ri-pencil-ruler-2-line",
        subItems: [
            {
                id: 38,
                label: "menuitems.uielements.list.alerts",
                link: "/admin/ui/alerts",
            },
            {
                id: 39,
                label: "menuitems.uielements.list.buttons",
                link: "/admin/ui/buttons",
            },
            {
                id: 40,
                label: "menuitems.uielements.list.cards",
                link: "/admin/ui/cards",
            },
            {
                id: 41,
                label: "menuitems.uielements.list.carousel",
                link: "/admin/ui/carousel",
            },
            {
                id: 42,
                label: "menuitems.uielements.list.dropdowns",
                link: "/admin/ui/dropdowns",
            },
            {
                id: 43,
                label: "menuitems.uielements.list.grid",
                link: "/admin/ui/grid",
            },
            {
                id: 44,
                label: "menuitems.uielements.list.images",
                link: "/admin/ui/images",
            },
            {
                id: 45,
                label: "menuitems.uielements.list.lightbox",
                link: "/admin/ui/lightbox",
            },
            {
                id: 46,
                label: "menuitems.uielements.list.modals",
                link: "/admin/ui/modals",
            },
            {
                id: 47,
                label: "menuitems.uielements.list.rangeslider",
                link: "/admin/ui/rangeslider",
            },
            {
                id: 48,
                label: "menuitems.uielements.list.sessiontimeout",
                link: "/admin/ui/session-timeout",
            },
            {
                id: 49,
                label: "menuitems.uielements.list.progressbar",
                link: "/admin/ui/progressbar",
            },
            {
                id: 50,
                label: "menuitems.uielements.list.sweetalert",
                link: "/admin/ui/sweet-alert",
            },
            {
                id: 51,
                label: "menuitems.uielements.list.tabs",
                link: "/admin/ui/tabs-accordion",
            },
            {
                id: 52,
                label: "menuitems.uielements.list.typography",
                link: "/admin/ui/typography",
            },
            {
                id: 53,
                label: "menuitems.uielements.list.video",
                link: "/admin/ui/video",
            },
            {
                id: 54,
                label: "menuitems.uielements.list.general",
                link: "/admin/ui/general",
            },
            {
                id: 55,
                label: "menuitems.uielements.list.rating",
                link: "/admin/ui/rating",
            },
            {
                id: 56,
                label: "menuitems.uielements.list.notifications",
                link: "/admin/ui/notification",
            },
        ],
    },
    {
        id: 57,
        label: "menuitems.forms.text",
        icon: "ri-eraser-fill",
        badge: {
            variant: "danger",
            text: "menuitems.forms.badge",
        },
        subItems: [
            {
                id: 58,
                label: "menuitems.forms.list.elements",
                link: "/admin/form/elements",
            },
            {
                id: 59,
                label: "menuitems.forms.list.validation",
                link: "/admin/form/validation",
            },
            {
                id: 60,
                label: "menuitems.forms.list.advanced",
                link: "/admin/form/advanced",
            },
            {
                id: 61,
                label: "menuitems.forms.list.editor",
                link: "/admin/form/editor",
            },
            {
                id: 62,
                label: "menuitems.forms.list.fileupload",
                link: "/admin/form/uploads",
            },
            {
                id: 63,
                label: "menuitems.forms.list.wizard",
                link: "/admin/form/wizard",
            },
            {
                id: 64,
                label: "menuitems.forms.list.mask",
                link: "/admin/form/mask",
            },
        ],
    },
    {
        id: 65,
        label: "menuitems.tables.text",
        icon: "ri-table-2",
        subItems: [
            {
                id: 66,
                label: "menuitems.tables.list.basic",
                link: "/admin/tables/basic",
            },
            {
                id: 67,
                label: "menuitems.tables.list.advanced",
                link: "/admin/tables/advanced",
            },
            // {
            //     id: 68,
            //     label: 'Responsive Table',
            //     link: '/admin/'
            // },
        ],
    },
    {
        id: 69,
        label: "menuitems.charts.text",
        icon: "ri-bar-chart-line",
        subItems: [
            {
                id: 70,
                label: "menuitems.charts.list.apex",
                link: "/admin/charts/apex",
            },
            {
                id: 71,
                label: "menuitems.charts.list.chartjs",
                link: "/admin/charts/chartjs",
            },
            {
                id: 72,
                label: "menuitems.charts.list.chartist",
                link: "/admin/charts/chartist",
            },
            {
                id: 73,
                label: "menuitems.charts.list.echart",
                link: "/admin/charts/echart",
            },
        ],
    },
    {
        id: 74,
        label: "menuitems.icons.text",
        icon: "ri-brush-line",
        subItems: [
            {
                id: 75,
                label: "menuitems.icons.list.remix",
                link: "/admin/icons/remix",
            },
            {
                id: 76,
                label: "menuitems.icons.list.materialdesign",
                link: "/admin/icons/material-design",
            },
            {
                id: 77,
                label: "menuitems.icons.list.dripicons",
                link: "/admin/icons/dripicons",
            },
            {
                id: 78,
                label: "menuitems.icons.list.fontawesome",
                link: "/admin/icons/font-awesome",
            },
        ],
    },
    {
        id: 79,
        label: "menuitems.maps.text",
        icon: "ri-map-pin-line",
        subItems: [
            {
                id: 80,
                label: "menuitems.maps.list.googlemap",
                link: "/admin/maps/google",
            },
            {
                id: 81,
                label: "menuitems.maps.list.leaflet",
                link: "/admin/maps/leaflet",
            },
        ],
    },
];
