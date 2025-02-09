import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import Checkbox from '@/Components/Checkbox.vue';

export default {
    name: 'Permission',

    components: {
        DialogModal,
        SecondaryButton,
        PrimaryButton,
        Checkbox
    },

    data() {
        return {
            sections: [],
            modalShow: false,
            maxWidth: '2xl',
            loading: false,
            roleId: null
        }
    },

    methods: {
        async show (roleId) {
            this.modalShow = true;
            this.roleId = roleId;
            const { data } = await this.getPermissions();
            data.sections.map((el) => {
                let manageDisabled = false;
                el.permissions.map((row) => {
                    row.checked = data.permissions.includes(row.name);
                    row.disabled = false;
                    if (manageDisabled) {
                        row.disabled = true;
                    }
                    if (el.code+'.view' === row.name) {
                        row.disabled = false;
                        if (!row.checked) {
                            manageDisabled = true;
                        }
                    }
                });
            });
            this.sections = data.sections;
        },

        closeModal () {
            this.modalShow = false;
        },

        submit () {
            return new Promise((resolve, reject) => {
                axios.post(route('permission.update', this.roleId), {
                    sections: this.sections
                }).then(response => {
                    if (response.data) {
                        this.closeModal();
                    }
                    resolve();
                }).catch(error => {
                    reject(error.status);
                }).finally(() => this.loading = false);
            });
        },

        getItemText(row) {
            let string = '';
            if (row) {
                const code = row.split('.');
                if (code.length > 0) {
                    string = this.$t('permission.' + code[code.length - 1]);
                }
            }
            return string;
        },

        updateValue(sectionId, permission) {
            const existSection = this.sections.find(el => el.id === sectionId);
            if (existSection !== undefined && existSection.code+'.view' === permission.name) {
                existSection.permissions.forEach((row, key) => {
                    if (row.name !== existSection.code+'.view') {
                        row.disabled = permission.checked;
                        if (permission.checked) {
                            row.checked = false;
                        }
                    }
                });
            }
        },

        async getPermissions() {
            return new Promise((resolve, reject) => {
                axios.get(`permission/${this.roleId}`)
                    .then(response => {
                        resolve(response.data);
                    }).catch(error => {
                        reject(error.status);
                    }).finally(() => this.loading = false);
            });
        },
    },
}
