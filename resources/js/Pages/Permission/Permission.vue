<template>
    <DialogModal :show="modalShow" @close="closeModal">

        <template #title>
            {{ $t('permission.title') }}
            <div class="text-sm">
                {{ $t('permission.smallTitle') }}
            </div>
        </template>

        <template #content>
            <fieldset v-for="(section, key) in sections" v-bind:key="'row_' + key">
                <label class="flex border-b pb-3">
                    <span class="w-full font-semibold text-gray-900">{{ section.name }}</span>
                </label>
                <span v-for="(permission, keys) in section.permissions" v-bind:key="'row_' + keys">
                    <label class="flex border-b pb-3">
                        <span class="w-full ms-2 text-sm text-gray-600">{{ getItemText(permission.name) }}</span>
                        <span class="w-full text-right">
                            <Checkbox
                                v-model:checked="permission.checked"
                                :disabled="permission.disabled"
                                @input="updateValue(section.id, permission)"
                            />
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

<script src="./Permission.js" />
