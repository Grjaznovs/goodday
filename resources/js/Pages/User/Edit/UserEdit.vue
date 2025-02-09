<template>
    <DialogModal :show="modalShow" @close="closeModal">
        <template #title>
            {{ $t('user.edit.title') }} {{ user.name }}
        </template>

        <template #content>
            <fieldset>
                <label class="flex border-b pb-3">
                    <span class="w-full font-semibold text-gray-900">{{ $t('user.role') }}</span>
                </label>

                <span v-for="(role, key) in user.roles" v-bind:key="'row_' + key">
                    <label class="flex border-b pb-3">
                        <span class="w-full ms-2 text-sm text-gray-600">{{ role.name }}</span>
                        <span class="w-full text-right">
                            <Checkbox v-model:checked="role.checked" />
                        </span>
                    </label>
                </span>
            </fieldset>
        </template>

        <template #footer>
            <SecondaryButton @click="closeModal">
                {{ $t('permission.btn.cancel') }}
            </SecondaryButton>

            <PrimaryButton
                class="ms-3"
                :class="{ 'opacity-25': loading }"
                :disabled="loading"
                @click="submit"
            >
                {{ $t('permission.btn.store') }}
            </PrimaryButton>
        </template>
    </DialogModal>
</template>

<script src="./UserEdit.js" />
