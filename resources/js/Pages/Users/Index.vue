<template>
    <Head>
        <title>Users</title>
    </Head>

    <div class="flex justify-between">
        <div class="flex items-center">
            <h1 class="text-4xl font-bold">Users</h1>

            <Link href="/users/create" class="text-blue-500 text-sm ml-2"> New User </Link>
        </div>

        <input v-model="search" type="text" placeholder="Search..." class="border px-2 rounded-lg" />
    </div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" v-for="user in users.data"
                :key="user.id">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                    {{ user.name }}
                </th>
                <td class="px-6 py-4">
                    {{ user.email }}
                </td>
                <td class="px-6 py-4">
                    <Link
                        :href="`/users/${user.id}/edit`"
                        class="text-indigo-600 hover:text-indigo-900" />
                        Edit
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <Pagination :links="users.links"/>
    </div>

</template>

<script setup>
import Pagination from "../../Shared/Pagination";
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import debounce from "lodash/debounce";

let props = defineProps({
    users: Object,
    filters: Object
});

let search = ref(props.filters.search);

watch(search, debounce(function (value) {
    Inertia.get('/users', { search: value }, {
        preserveState: true,
        replace: true,
    });
}, 500));


</script>
