<template>
    <DialogModal :show="modalShow" :max-width="maxWidth" @close="closeModal">
        <template #title>{{ title }}</template>

        <template #content>
            <label :class="textSize">{{ message }}</label>
        </template>

        <template #footer>
            <SecondaryButton @click="closeModal">
                {{ $t('permission.btn.cancel') }}
            </SecondaryButton>

            <PrimaryButton
                class="ms-3"
                @click="confirm"
            >
                {{ $t('permission.btn.ok') }}
            </PrimaryButton>
        </template>
    </DialogModal>
</template>

<script>
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DialogModal from '@/Components/DialogModal.vue';

export default {
    name: 'MessageBox',
    emits: ["confirm"],

    components: {
        DialogModal,
        SecondaryButton,
        PrimaryButton,
    },

    data() {
        return {
            data: null,
            title: '',
            message: '',
            maxWidth: '2xl',
            textSize: '',
            modalShow: false,
        };
    },

    methods: {
        show (data, title, message, maxWidth = '2xl', textSize = '') {
            this.data = data;
            this.title = title;
            this.message = message;
            this.maxWidth = maxWidth;
            this.textSize = textSize;
            this.modalShow = true;
        },

        closeModal () {
            this.modalShow = false;
        },

        confirm () {
            this.$emit('confirm', this.data);
            this.modalShow = false;
        },
    }
}
</script>
