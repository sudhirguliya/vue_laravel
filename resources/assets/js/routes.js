import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/auth/Login.vue';
import CustomersMain from './components/customers/Main.vue';
import CustomersList from './components/customers/List.vue';
import NewCustomer from './components/customers/New.vue';
import Customer from './components/customers/View.vue';

import RoomsMain from './components/rooms/Main.vue';
import RoomsList from './components/rooms/List.vue';
import NewRoom from './components/rooms/New.vue';
import Room from './components/rooms/View.vue';

export const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            requiresAuth: false
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,

    },
    {
        path: '/students',
        name: 'students',
        component: CustomersMain,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/',
                component: CustomersList
            },
            {
                path: 'new',
                component: NewCustomer
            },
            {
                path: ':id',
                component: Customer
            }
        ]
    },
    {
        path: '/rooms',
        name: 'rooms',
        component: RoomsMain,
        meta: {
            requiresAuth: true
        },
        children: [
            {
                path: '/',
                component: RoomsList
            },
            {
                path: 'new',
                component: NewRoom
            },
            {
                path: ':id',
                component: Room
            }
        ]
    }
];