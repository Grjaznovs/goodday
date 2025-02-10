import AppLayout from '@/Layouts/AppLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DeleteIcon from '@/Components/Icon/DeleteIcon.vue';
import EditIcon from '@/Components/Icon/EditIcon.vue';
import MessageBox from "@/Components/MessageBox.vue";
import EditSectionPage from "@/Pages/SectionPage/EditSectionPage.vue";
import { router } from "@inertiajs/vue3";

export default {
    name: 'SectionPage',

    props: {
        value: Object,
        title: {
            type: String,
            default: null
        },
        route: {
            type: String,
            default: null
        },
        isManage: {
            type: Boolean,
            default: false
        }
    },
    emits: ["update", "destroy"],

    components: {
        AppLayout,
        SecondaryButton,
        PrimaryButton,
        DeleteIcon,
        EditIcon,
        MessageBox,
        EditSectionPage
    },

    data() {
        return {
            content: (this.value.data === null) ? [] : this.value.data,
            modalShow: false,
            maxWidth: '2xl',
            loading: false,
        }
    },

    computed: {
        isAdmin() {
            const role = this.$page.props.auth.user.roles.find(el => el['name'] == 'Admin');
            return role !== undefined;
        }
    },

    methods: {
        add () {
            this.$refs.runModalAddSectionPage.show();
        },

        edit (elData) {
            this.$refs.runModalEditSectionPage.show(elData);
        },

        create (form) {
            return new Promise((resolve, reject) => {
                axios.post(this.route, form)
                    .then(response => {
                        this.reloadPage()
                        resolve();
                    }).catch(error => {
                    reject(error.status);
                }).finally(() => this.loading = false);
            });
        },

        update (form) {
            return new Promise((resolve, reject) => {
                axios.put(`${this.route}/${form.id}`, form)
                    .then(response => {
                        this.reloadPage()
                        resolve();
                    }).catch(error => {
                    reject(error.status);
                }).finally(() => this.loading = false);
            });
        },

        destroy (id) {
            return new Promise((resolve, reject) => {
                axios.delete(`${this.route}/${id}`)
                    .then(response => {
                        this.reloadPage()
                        resolve();
                    }).catch(error => {
                    reject(error.status);
                }).finally(() => this.loading = false);
            });
        },

        sendMessage(id, approved = false) {
            if (approved) {
                this.destroy(id)
            } else {
                this.$refs.destroyMsgBox.show(
                    id,
                    this.$t('section.page.destroy.title'),
                    this.$t('section.page.destroy.msg'),
                    'md',
                    'text-xl'
                );
            }
        },

        reloadPage () {
            router.visit(this.route, {
                except: ['value'],
            });
        }
    },
}
