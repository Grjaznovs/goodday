import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { useVuelidate } from '@vuelidate/core'
import { required, maxLength } from "@vuelidate/validators";

const defaultEl = {
    id: null,
    title: null,
    description: null,
    text: null
}

export default {
    name: 'EditSectionPage',

    props: {
        value: {
            type: Object | Array,
            default: null
        },
        title: {
            type: String,
            default: null
        }
    },
    emits: ["update"],

    components: {
        DialogModal,
        SecondaryButton,
        PrimaryButton,
        InputError,
        TextInput,
        InputLabel
    },

    setup () {
        return { v$: useVuelidate() }
    },

    data() {
        return {
            form: (this.value === null) ? [] : this.value,
            modalShow: false,
            maxWidth: '2xl',
            loading: false,
        }
    },

    validations: {
        form: {
            title: { required, maxLengthValue: maxLength(100) },
            description: { required, maxLengthValue: maxLength(255) }
        }
    },

    methods: {
        async show (elData) {
            this.v$.$reset();
            if (elData) {
                this.form = this.BasicHelper.cloneObject(elData);
            } else {
                this.form = this.BasicHelper.cloneObject(defaultEl);
            }
            this.modalShow = true;
        },

        closeModal () {
            this.modalShow = false;
        },

        handleSubmit () {
            this.v$.$touch();
            if (this.v$.$invalid) return;
            this.$emit('update', this.form);
            this.closeModal();
        }
    },

    watch: {
        value () {
            if (this.form !== this.value) {
                this.form = this.value;
            }
        }
    }
}
