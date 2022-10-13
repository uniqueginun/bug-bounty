<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

const props = defineProps({
    service: Object
})

const allowedAttach = 'application/x-zip-compressed'

const form = useForm({
    details: '',
    attachment: null
})

const handleFileUpload = event => {
    const file = event.target.files[0]

    if (file.type !== allowedAttach) {
        event.target.value = null
        event.target.files = null
        return
    }

    form.attachment = file
}

const submit = () => {
    form.post(route('submittion.product.details', props.service.uuid), {
        preserveScroll: true
    })
}

</script>

<template>

    <Head :title="`Submit a report to ${service.product_name}`" />

    <AuthenticatedLayout>

        <template #aside>
            <form v-if="service.status==='pending'" @submit.prevent="submit" class="space-y-8 divide-y divide-gray-200">
                <div class="space-y-8 divide-y divide-gray-200">
                    <div class="sm:col-span-6">
                        <label for="details" class="block text-sm font-medium text-gray-700">Details</label>
                        <div class="mt-1">
                            <textarea id="details" v-model="form.details" rows="6" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                        </div>
                    </div>
                </div>
                <div class="space-y-8 divide-y divide-gray-200">
                    <div class="sm:col-span-6">
                        <label for="attachments" class="block text-sm font-medium text-gray-700">Attachment (Zip files)</label>
                        <div class="mt-1">
                            <input id="attachments" type="file" :accept="allowedAttach" v-on:change="handleFileUpload" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <div class="flex justify-end">
                        <button type="button"
                            class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Cancel</button>
                        <button type="submit"
                            class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
                    </div>
                </div>
            </form>
        </template>

        <div class="space-y-8 divide-y divide-gray-200">
            <div>
                <div>
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Product Details</h3>
                    <p class="mt-1 text-sm text-gray-500">read details carefully before you submit a report</p>
                </div>

                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="product-name" class="block text-sm font-medium text-gray-700">Product
                            Name</label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="text" id="product-name" readonly :value="service.product_name"
                                class="block w-full min-w-0 flex-1 rounded-none rounded-r-md bg-gray-100 border-gray-200 sm:text-sm">
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <div class="mt-1">
                            <textarea id="description" readonly
                                class="block w-full min-w-0 flex-1 rounded-none rounded-r-md bg-gray-100 border-gray-200 sm:text-sm">{{ service.description }}</textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="Severity" class="block text-sm font-medium text-gray-700">Severity</label>
                        <div class="mt-1">
                            <fieldset>
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <input id="low" name="severity" :checked="service.severity === 'low'"
                                            value="low" type="radio"
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <label for="low"
                                            class="ml-3 block text-sm font-medium text-gray-700">Low</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="medium" name="severity" :checked="service.severity === 'medium'"
                                            value="medium" type="radio"
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <label for="medium"
                                            class="ml-3 block text-sm font-medium text-gray-700">Medium</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="high" name="severity" :checked="service.severity === 'high'"
                                            value="high" type="radio"
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                        <label for="high"
                                            class="ml-3 block text-sm font-medium text-gray-700">High</label>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="Severity" class="block text-sm font-medium text-gray-700">Links</label>
                        <div class="mt-1">
                            <div v-for="link, of service.links" :key="link" class="grid grid-cols-3 gap-6">
                                <div class="col-span-3 sm:col-span-2">
                                    <div class="mt-1 flex">
                                        <a :href="link" target="_blank" class="underline text-gray-900">{{ link
                                        }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
