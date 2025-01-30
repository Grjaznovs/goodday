<template>
    <Head title="Welcome" />

    <div class="grid grid-cols-2 gap-1 absolute top-0 right-0 pt-3 pr-3">
        <div
            v-for="(row) in menuHeaders"
            v-bind:key="row.code"
            @click="changeActiveMenu(row.label)"
            class=""
        >
            <a :class="'' + (row.label == activeMenu ? 'active' : '')" href="#" class="">
                {{ row.label }}
            </a>
        </div>
    </div>

    <component v-bind:is="activeMenu" />
</template>

<script src="./Welcome.js" />
