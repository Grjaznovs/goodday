<template>
    <AppLayout title="Role">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="text-left bg-green-100 pt-2 pl-2">
                        <b>{{ $t('role.title') }}</b>
                        <div class="text-sm">{{ $t('role.smallTitle') }}</div>
                    </div>

                    <Tableview :fields = tableHeaders :items = roles>
                        <template v-slot:action="{data}">
                            <a
                                href="#"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                @click="openPermissions(data.id)"
                            >
                                {{ $t('role.permissions') }}
                            </a>
                        </template>
                    </Tableview>
                </div>
            </div>
        </div>
    </AppLayout>

    <Permission ref="runModalPermission" />
</template>

<script src="./Role.js" />
