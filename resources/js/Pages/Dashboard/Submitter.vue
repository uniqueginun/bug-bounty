<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';


const stats = [
  { name: 'Total Subscribers', stat: '71,897', previousStat: '70,946', change: '12%', changeType: 'increase' },
  { name: 'Avg. Open Rate', stat: '58.16%', previousStat: '56.14%', change: '2.02%', changeType: 'increase' },
  { name: 'Avg. Click Rate', stat: '24.57%', previousStat: '28.62%', change: '4.05%', changeType: 'decrease' },
]

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div>
            <h3 class="text-lg font-medium leading-6 text-gray-900">Product Stats</h3>
            <dl class="mt-5 grid grid-cols-1 divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow md:grid-cols-3 md:divide-y-0 md:divide-x">
            <div v-for="item in stats" :key="item.name" class="px-4 py-5 sm:p-6">
                <dt class="text-base font-normal text-gray-900">{{ item.name }}</dt>
                <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                    {{ item.stat }}
                </div>
                </dd>
            </div>
            </dl>
        </div>
    </AuthenticatedLayout>
</template>
