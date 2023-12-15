import Admin from './Components/Admin.vue';
import Custom from './Components/Custom.vue';

export default [{
        path: '/',
        name: 'dashboard',
        component: Admin,
        meta: {
            active: 'dashboard'
        },
    },
    {
        path: '/custom',
        name: 'custom',
        component: Custom
    }
];