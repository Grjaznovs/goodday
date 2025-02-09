<template>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-2 py-3" v-for="field in fields" v-bind:key="field.key">{{ field.label }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item, key) in items" v-bind:key="'row_' + key">
                <td class="px-2 py-2" v-for="field in fields" v-bind:key="field.key">
                    <slot v-if="field.type==='slot'" :name=field.slotcode v-bind="{ data:item }" />
                    <template v-else>
                        {{ item[field.key] }}
                    </template>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script src="./Tableview.js" />
