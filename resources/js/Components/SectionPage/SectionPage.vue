<template>
    <div class="grid grid-cols-3 gap-4 py-4">
        <div
            v-for="(row, key) in value" v-bind:key="'row_' + key"
            class="bg-white group cursor-pointer w-full max-lg:max-w-xl border border-gray-300 rounded-2xl p-5 transition-all duration-300 hover:border-indigo-600"
        >
            <div class="block">
                <div class="flex items-center mb-6">
                    <img src="https://pagedone.io/asset/uploads/1696244553.png" alt="Harsh image" class="rounded-lg w-full object-cover">
                </div>

                <div class="block">
                    <h4 class="text-gray-900 font-medium leading-6 mb-4">{{ row.title }}</h4>

                    <p class="text-gray-500 leading-6 mb-6 line-clamp-2">{{ row.description }}</p>

                    <div class="flex items-center justify-between  font-medium">
                        <h6 class="text-sm text-gray-500">{{ row.user.name }}</h6>
                        <span class="text-sm text-indigo-600">
                            <SecondaryButton onclick="toggleModal(row.id)"><DeleteIcon /></SecondaryButton>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="./SectionPage.js" />
