<template>
    <AppLayout title="ShowSectionPage">
        <div class="bg-white py-2 sm:py-2">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="flex items-center mb-2">
                    <img src="https://pagedone.io/asset/uploads/1696244553.png" alt="Harsh image" class="rounded-lg w-full object-cover">
                </div>

                <time datetime="2020-03-16" class="text-gray-500">{{ blog.data.created_at }}</time>

                <section class="py-4">
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <div class="lg:justify-between gap-8">
                            <div class="block lg:text-left">
                                <h2 class="text-3xl font-bold text-gray-900 leading-[3.25rem] mb-2">{{ blog.data.title }}</h2>
                                <p class="text-gray-500 mb-5 max-lg:max-w-xl max-lg:mx-auto">
                                    {{ blog.data.text }}
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="relative mt-8 flex items-center gap-x-4">
                    <img src="https://images.unsplash.com/photo-1519244703995-f4e0f30006d5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="size-10 rounded-full bg-gray-50">
                    <div class="text-sm/6">
                        <p class="font-semibold text-gray-900">
                            <a href="#">
                                <span class="absolute inset-0"></span>
                                {{ blog.data.user.name }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script src="./ShowSectionPage.js" />
