<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import ProductsGrid from '@/Components/ProductsGrid.vue';
import { Inertia } from '@inertiajs/inertia';
import { ref } from 'vue';

defineProps({
    services: Object
})

const processing = ref(null)

const makeAction = (service, action) => {
    Inertia.post(route('analyst.services.action', { service: service.uuid }), { action }, {
        onBefore: () => processing.value = service.uuid,
        onFinish: () => processing.value = null
    })
}

</script>

<template>

    <Head title="Products" />

    <AuthenticatedLayout>

        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">Products</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all products Service Providers have submitted.</p>
                </div>
            </div>

            <ProductsGrid :services="services.data">
                <template v-slot:actions="prop" v-show="prop.service.status==='pending'">
                    <div v-if="processing !== prop.service.uuid">
                        <button class="m-2 p-3 text-white rounded bg-green-700"
                            @click="makeAction(prop.service, 'published')">Publish</button>
                        <button class="m-2 p-3 text-white rounded bg-red-700"
                            @click="makeAction(prop.service, 'rejected')">Reject</button>
                    </div>
                    <div v-else class="bg-green-800 rounded-lg text-white text-center text-sm">loading spinner...</div>
                </template>
            </ProductsGrid>

        </div>

    </AuthenticatedLayout>
</template>
