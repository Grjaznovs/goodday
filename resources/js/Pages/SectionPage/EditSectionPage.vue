<template>
    <DialogModal :show="modalShow" @close="closeModal">
        <template #title>{{ title }}</template>

        <template #content>
            <fieldset>
                <div class="py-2">
                    <InputLabel for="title" :value="$t('section.page.edit.title')" />
                    <TextInput
                        v-model.trim="form.title"
                        type="text"
                        class="mt-1 block w-full"
                        id="title"
                        autofocus
                        autocomplete="title"
                    />

                    <template v-if="v$.form.title.$error">
                        <InputError v-if="v$.form.title.required.$invalid" class="mt-2" :message="v$.form.title.required.$message" />
                        <InputError v-if="v$.form.title.maxLengthValue.$invalid" class="mt-2" :message="v$.form.title.maxLengthValue.$message" />
                    </template>
                </div>

                <div class="py-2">
                    <InputLabel for="description" :value="$t('section.page.edit.description')" />
                    <textarea v-model.trim="form.description" class="rounded-md mt-1 block w-full" id="description" />
                    <template v-if="v$.form.description.$error">
                        <InputError v-if="v$.form.description.required.$invalid" class="mt-2" :message="v$.form.description.required.$message" />
                        <InputError v-if="v$.form.description.maxLengthValue.$invalid" class="mt-2" :message="v$.form.description.maxLengthValue.$message" />
                    </template>
                </div>

                <div class="py-2">
                    <InputLabel for="text" :value="$t('section.page.edit.text')" />
                    <textarea v-model.trim="form.text" class="rounded-md mt-1 block w-full resize-y min-h-[200px]" id="text" />
                </div>
            </fieldset>
        </template>

        <template #footer>
            <SecondaryButton @click="closeModal">
                {{ $t('permission.btn.cancel') }}
            </SecondaryButton>

            <PrimaryButton class="ms-3" :class="{ 'opacity-25': loading }" :disabled="loading" @click="handleSubmit">
                {{ $t('permission.btn.store') }}
            </PrimaryButton>
        </template>
    </DialogModal>
</template>

<script src="./EditSectionPage.js" />
