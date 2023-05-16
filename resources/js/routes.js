const WelcomePage = () => import('./components/Welcome.vue')
const ProductList = () => import('./components/product/List.vue')
const LocalProductList = () => import('./components/product-all/List.vue')
const OrderList = () => import('./components/orders/List.vue')
const OrderEdit = () => import('./components/orders/Edit.vue')

export const routesList = [
    {
        name: 'home',
        path: '/',
        component: WelcomePage
    },
    {
        name: 'productList',
        path: '/product',
        component: ProductList
    },
    {
        name: 'localProductList',
        path: '/local',
        component: LocalProductList
    },
    {
        name: 'orderList',
        path: '/order',
        component: OrderList
    },
    {
        name: 'orderEdit',
        path: '/order/:id/edit',
        component: OrderEdit
    }
]