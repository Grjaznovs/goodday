import AppLayout from '@/Layouts/AppLayout.vue';
import Tableview from "@/Components/Tableview/Tableview.vue";
import UserEdit from "@/Pages/User/Edit/UserEdit.vue";
import { router } from '@inertiajs/vue3'

export default {
    name: 'UserList',
    props:{
        users: {
            type : Array
        }
    },

    components: {
        AppLayout,
        Tableview,
        UserEdit
    },

    computed: {
        tableHeaders() {
            const headers = [
                { key: 'name', label: this.$t('user.name') },
                { key: 'email', label: this.$t('user.email') },
                { key: 'activity', label: this.$t('user.activity'), type: 'slot', slotcode: 'activity' },
                { key: 'roles.name', label: this.$t('user.role'), type: 'slot', slotcode: 'role' },
                { key: 'action', label: '', type: 'slot', slotcode: 'action' }
            ];

            return headers;
        }
    },

    methods: {
        openRole (userId) {
            this.$refs.runModalUser.show(userId);
        },

        reloadPage () {
            router.visit('user', {
                except: ['users'],
            });
        }
    },
}
