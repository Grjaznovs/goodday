import AppLayout from '@/Layouts/AppLayout.vue';
import Tableview from "@/Components/Tableview/Tableview.vue";
import Permission from "@/Pages/Permission/Permission.vue";

export default {
    name: 'Role',
    props:{
        roles:Array,
    },

    components: {
        AppLayout,
        Tableview,
        Permission
    },

    computed: {
        tableHeaders() {
            const headers = [
                { key: 'name', label: this.$t('role.name') },
                { key: 'guard_name', label: this.$t('role.key') },
                { key: 'action', label: '', type: 'slot', slotcode: 'action' }
            ];

            return headers;
        }
    },

    methods: {
        openPermissions (roleId) {
            this.$refs.runModalPermission.show(roleId);
        }
    },
}
