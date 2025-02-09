<template>
    <AppLayout title="Blog">
        <template #header>
            <PrimaryButton
                class="ms-3"
                :class="{ 'opacity-25': loading }"
                :disabled="loading"
                @click="addBlog()"
            >
                {{ $t('blog.btn.add') }}
            </PrimaryButton>
        </template>

        <section class="py-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <SectionPage v-model="blog" />
            </div>
        </section>
    </AppLayout>

    <EditSectionPage
        v-model="form"
        ref="runModalSectionPage"
        :title="$t('blog.title.add')"
        @update="submit"
    />
</template>

<script src="./BlogList.js" />
