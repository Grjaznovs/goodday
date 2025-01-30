import { Head } from '@inertiajs/vue3';
import Login from '@/Pages/Auth/Login.vue';
import Register from '@/Pages/Auth/Register.vue';

export default {
    name: 'Welcome',

    components: {
        Head,
        Login,
        Register
    },

    data() {
        return {
            activeMenu: 'Login'
        }
    },

    computed: {
        menuHeaders() {
            const headers = {
                Login: { key: 'code', label: 'Login' },
                Register: { key: 'code', label: 'Register' }
            };

            return headers;
        }
    },

    methods: {
        changeActiveMenu(name) {
            this.activeMenu = name;
        }
    }
}
