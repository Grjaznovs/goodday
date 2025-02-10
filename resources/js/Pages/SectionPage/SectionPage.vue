<template>
    <AppLayout title="News">
        <template #header>
            <PrimaryButton class="ms-3" :class="{ 'opacity-25': loading }" :disabled="loading" @click="add()">
                {{ $t('section.page.btn.add') }}
            </PrimaryButton>
        </template>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <section class="text-gray-600 body-font">
                <h2 class="font-manrope text-4xl font-bold text-gray-900 text-center mb-16">{{ title }}</h2>

                <div class="flex flex-wrap -m-4">
                    <div class="p-4 md:w-1/3" v-for="(row, key) in content" v-bind:key="'row_' + key">
                        <div class="bg-white group cursor-pointer w-full max-lg:max-w-xl border border-gray-300 rounded-2xl p-5 transition-all duration-300 hover:border-indigo-600">
                            <div class="block">
                                <div class="flex items-center mb-6">
                                    <img src="https://pagedone.io/asset/uploads/1696244553.png" alt="Harsh image" class="rounded-lg w-full object-cover">
                                </div>

                                <div class="block">
                                    <h4 class="text-gray-900 font-medium leading-6 mb-4">{{ row.title }}</h4>

                                    <p class="text-gray-500 leading-6 mb-6 line-clamp-2">{{ row.description }}</p>

                                    <div class="flex items-center justify-between  font-medium">
                                        <h6 class="text-sm text-gray-500">{{ row.user.name }}</h6>
                                        <span class="text-sm text-indigo-600" v-if="($page.props.auth.user.id == row.user.id && isManage) || isAdmin">
                                            <SecondaryButton @click="edit(row)"><EditIcon /></SecondaryButton>
                                            <SecondaryButton @click="sendMessage(row.id)" class="ms-1"><DeleteIcon /></SecondaryButton>
                                        </span>
                                    </div>

                                    <a :href="route + '/' + row.id" class="cursor-pointer flex items-center gap-2 text-lg text-indigo-700 font-semibold">
                                        {{ $t('section.page.read.more') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </AppLayout>

    <EditSectionPage ref="runModalAddSectionPage" :title="$t(route + '.title.add')" @update="create"/>
    <EditSectionPage ref="runModalEditSectionPage" :title="$t(route + '.title.edit')" @update="update" />
    <MessageBox ref="destroyMsgBox" @confirm="sendMessage($event, 1)" />
</template>

<script src="./SectionPage.js" />
