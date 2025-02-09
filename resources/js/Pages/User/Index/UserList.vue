<template>
    <AppLayout title="Role">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="text-left bg-green-100 pt-2 pl-2">
                        <b>{{ $t('user.title') }}</b>
                    </div>
                    <Tableview :fields = tableHeaders :items = users.data>
                        <template v-slot:activity="{data}">
                            <span v-if="data.activity" class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-green-600/20 ring-inset">Yes</span>
                            <span v-else class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-red-600/10 ring-inset">No</span>
                        </template>

                        <template v-slot:role="{data}">
                            <template v-for="(row, index) in data.roles" :key="index">
                                {{ row.name }}<template v-if="index + 1 < data.roles.length">, </template>
                            </template>
                        </template>

                        <template v-slot:action="{data}">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" @click="openRole(data.id)">
                                {{ $t('user.btn.edit') }}
                            </a>
                        </template>
                    </Tableview>
                </div>
            </div>
        </div>
    </AppLayout>

    <UserEdit ref="runModalUser" @userOnEdit="reloadPage" />
</template>

<script src="./UserList.js" />
