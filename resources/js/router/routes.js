export default [
    {
        path: 'admin/login',
        name: 'admin/login',
        component: () => import('../views/pages/account/login'),
        meta: {guest: true},
    },
    // {
    //     path: '/register',
    //     name: 'register',
    //     component: () => import('../views/pages/account/register'),
    //     meta: {guest: true},
    // },
    // {
    //     path: '/forgot-password',
    //     name: 'Forgot-password',
    //     component: () => import('../views/pages/account/forgot-password'),
    //     meta: {guest: true},
    // },
    // {
    //     path: '/logout',
    //     name: 'logout',
    //     meta: {
    //         authRequired: true,
    //         beforeResolve(routeTo, routeFrom, next) {
    //             if (process.env.VUE_APP_DEFAULT_AUTH === "firebase") {
    //                 store.dispatch('auth/logOut')
    //             } else {
    //                 store.dispatch('authfack/logout')
    //             }
    //             const authRequiredOnPreviousRoute = routeFrom.matched.some(
    //                 (route) => route.push('/login')
    //             )
    //             // Navigate back to previous page, or home as a fallback
    //             next(authRequiredOnPreviousRoute ? { name: 'home' } : { ...routeFrom })
    //         },
    //     },
    // },
    {
        path: '/admin',
        name: 'admin/home',
        meta: {
            authRequired: true,
        },
        component: () => import('../views/pages/dashboard/index')
    },
    {
        path: 'admin/calendar',
        name: 'admin/Calendar',
        meta: {
            authRequired: true,
        },
        component: () => import('../views/pages/calendar/index')
    },
    {
        path: 'admin/ecommerce/products',
        name: 'admin/products',
        meta: {authRequired: true},
        component: () => import('../views/pages/ecommerce/products')
    },
    {
        path: 'admin/ecommerce/product-detail',
        name: 'admin/productDetail',
        meta: {authRequired: true},
        component: () => import('../views/pages/ecommerce/product-detail')
    },
    {
        path: 'admin/ecommerce/orders',
        name: 'admin/Orders',
        meta: {authRequired: true},
        component: () => import('../views/pages/ecommerce/orders')
    },
    {
        path: 'admin/ecommerce/customers',
        name: 'admin/Customers',
        meta: {authRequired: true},
        component: () => import('../views/pages/ecommerce/customers')
    },
    {
        path: 'admin/ecommerce/add-product',
        name: 'admin/Add-product',
        meta: {authRequired: true},
        component: () => import('../views/pages/ecommerce/add-product')
    },
    {
        path: 'admin/recoverPassword',
        name: 'admin/recoverPassword',
        meta: {authRequired: true},
        component: () => import('../views/pages/sample-auth/recoverpwd-1')
    },
    {
        path: 'admin/pages/starter',
        name: 'admin/Starter',
        meta: {authRequired: true},
        component: () => import('../views/pages/utility/starter')
    },
    {
        path: '/pages/error-500',
        name: 'Error-500',
        meta: {authRequired: true},
        component: () => import('../views/pages/utility/error-500')
    },
    {
        path: '/icons/font-awesome',
        name: 'Font Awesome 5',
        meta: {authRequired: true},
        component: () => import('../views/pages/icons/font-awesome/index')
    },
    {
        path: '/icons/dripicons',
        name: 'Dripicons',
        meta: {authRequired: true},
        component: () => import('../views/pages/icons/dripicons')
    },
    {
        path: '/icons/material-design',
        name: 'Material Design',
        meta: {authRequired: true},
        component: () => import('../views/pages/icons/materialdesign/index')
    },
    {
        path: '/icons/remix',
        name: 'Remix Icons',
        meta: {authRequired: true},
        component: () => import('../views/pages/icons/remix/index')
    },
    {
        path: '/ui/buttons',
        name: 'Buttons',
        meta: {authRequired: true},
        component: () => import('../views/pages/ui/buttons')
    },
    {
        path: '/ui/alerts',
        name: 'Alerts',
        meta: {authRequired: true},
        component: () => import('../views/pages/ui/alerts')
    },
    {
        path: '/ui/grid',
        name: 'Grid',
        meta: {authRequired: true},
        component: () => import('../views/pages/ui/grid')
    },
    {
        path: '/ui/cards',
        name: 'Cards',
        meta: {authRequired: true},
        component: () => import('../views/pages/ui/cards')
    },
    {
        path: '/ui/carousel',
        name: 'Carousel',
        meta: {authRequired: true},
        component: () => import('../views/pages/ui/carousel')
    },
    {
        path: '/ui/dropdowns',
        name: 'Dropdowns',
        meta: {authRequired: true},
        component: () => import('../views/pages/ui/dropdowns')
    },
    {
        path: '/ui/images',
        name: 'Images',
        meta: {authRequired: true},
        component: () => import('../views/pages/ui/images')
    },
    {
        path: '/ui/modals',
        name: 'Modals',
        meta: {authRequired: true},
        component: () => import('../views/pages/ui/modals')
    },
    {
        path: '/ui/rangeslider',
        name: 'Range - slider',
        meta: {authRequired: true},
        component: () => import('../views/pages/ui/rangeslider')
    },
    {
        path: '/ui/progressbar',
        name: 'Progressbar',
        meta: {authRequired: true},
        component: () => import('../views/pages/ui/progressbars')
    },
    {
        path: '/ui/sweet-alert',
        name: 'Sweet-alert',
        meta: {authRequired: true},
        component: () => import('../views/pages/ui/sweet-alert')
    },
    {
        path: '/ui/tabs-accordion',
        name: 'Tabs & Accordion',
        meta: {authRequired: true},
        component: () => import('../views/pages/ui/tabs-accordions')
    },
    {
        path: '/ui/typography',
        name: 'Typography',
        meta: {authRequired: true},
        component: () => import('../views/pages/ui/typography')
    },
    {
        path: '/ui/video',
        name: 'Video',
        meta: {authRequired: true},
        component: () => import('../views/pages/ui/video')
    },
    {
        path: '/ui/general',
        name: 'General',
        meta: {authRequired: true},
        component: () => import('../views/pages/ui/general')
    },
    {
        path: '/ui/lightbox',
        name: 'Lightbox',
        meta: {authRequired: true},
        component: () => import('../views/pages/ui/lightbox')
    },
    {
        path: '/ui/notification',
        name: 'Notification',
        meta: {authRequired: true},
        component: () => import('../views/pages/ui/notification')
    },
    {
        path: '/ui/rating',
        name: 'Rating',
        meta: {authRequired: true},
        component: () => import('../views/pages/ui/rating')
    },
    {
        path: '/ui/session-timeout',
        name: 'Session Timeout',
        meta: {authRequired: true},
        component: () => import('../views/pages/ui/session-timeout')
    },
    {
        path: '/form/elements',
        name: 'Form Elements',
        meta: {authRequired: true},
        component: () => import('../views/pages/forms/elements')
    },
    {
        path: '/form/validation',
        name: 'Form validation',
        meta: {authRequired: true},
        component: () => import('../views/pages/forms/validation')
    },
    {
        path: '/form/advanced',
        name: 'Form Advanced',
        meta: {authRequired: true},
        component: () => import('../views/pages/forms/advanced')
    },
    {
        path: '/form/editor',
        name: 'CK Editor',
        meta: {authRequired: true},
        component: () => import('../views/pages/forms/ckeditor')
    },
    {
        path: '/form/uploads',
        name: 'File Uploads',
        meta: {authRequired: true},
        component: () => import('../views/pages/forms/uploads')
    },
    {
        path: '/form/wizard',
        name: 'Form Wizard',
        meta: {authRequired: true},
        component: () => import('../views/pages/forms/wizard')
    },
    {
        path: '/form/mask',
        name: 'Form Mask',
        meta: {authRequired: true},
        component: () => import('../views/pages/forms/mask')
    },
    {
        path: '/tables/basic',
        name: 'Basic Tables',
        meta: {authRequired: true},
        component: () => import('../views/pages/tables/basictable')
    },
    {
        path: '/tables/advanced',
        name: 'Advanced Tables',
        meta: {authRequired: true},
        component: () => import('../views/pages/tables/advancedtable')
    },
    {
        path: '/charts/apex',
        name: 'Apex chart',
        meta: {authRequired: true},
        component: () => import('../views/pages/charts/apex')
    },
    {
        path: '/charts/chartjs',
        name: 'Chartjs chart',
        meta: {authRequired: true},
        component: () => import('../views/pages/charts/chartjs/index')
    },
    {
        path: '/charts/chartist',
        name: 'Chartist chart',
        meta: {authRequired: true},
        component: () => import('../views/pages/charts/chartist')
    },
    {
        path: '/charts/echart',
        name: 'Echart chart',
        meta: {authRequired: true},
        component: () => import('../views/pages/charts/echart/index')
    },
    {
        path: '/maps/google',
        name: 'Google Maps',
        meta: {authRequired: true},
        component: () => import('../views/pages/maps/google')
    },
    {
        path: '/maps/leaflet',
        name: 'Leaflet Maps',
        meta: {authRequired: true},
        component: () => import('../views/pages/maps/leaflet/index')
    },
    {
        path: '*',
        name: 'NotFound',
        component: {
            //TODO implement 404 redirect (with Laravel unauth header?)
            template: `<div>Not Found 404</div>`
        }
    },
]
