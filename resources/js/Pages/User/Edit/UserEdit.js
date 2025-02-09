import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import Checkbox from '@/Components/Checkbox.vue';

export default {
    name: 'UserEdit',

    emits: ['userOnEdit'],

    components: {
        DialogModal,
        SecondaryButton,
        PrimaryButton,
        Checkbox
    },

    data() {
        return {
            user: [],
            modalShow: false,
            maxWidth: '2xl',
            loading: false,
            userId: null
        }
    },

    methods: {
        async show (userId) {
            this.modalShow = true;
            this.userId = userId;
            const { data } = await this.getUser();
            this.user = data;
        },

        closeModal () {
            this.modalShow = false;
        },

        submit () {
            return new Promise((resolve, reject) => {
                axios.put(`user/${this.userId}`, {
                    user: this.user
                }).then(response => {
                    if (response.data) {
                        this.$emit('userOnEdit');
                        this.closeModal();
                    }
                    resolve();
                }).catch(error => {
                    reject(error.status);
                }).finally(() => this.loading = false);
            });
        },

        async getUser() {
            return new Promise((resolve, reject) => {
                axios.get(`user/${this.userId}/edit`)
                    .then(response => {
                        resolve(response.data);
                    }).catch(error => {
                    reject(error.status);
                }).finally(() => this.loading = false);
            });
        },
    },
}
