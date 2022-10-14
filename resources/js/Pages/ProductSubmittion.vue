<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ProductDetails from '@/Components/ProductDetails.vue';

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
        alert('uploaded file is invalid')
        event.target.value = null
        event.target.files = null
        return
    }

    form.attachment = file
}

const submit = () => {
    form.post(route('submittion.product.details', props.service.uuid), {
        preserveScroll: true,
        onSuccess: () => form.reset()
    })
}

</script>

<template>

    <Head :title="`Submit a report to ${service.product_name}`" />

    <AuthenticatedLayout>

        <template #aside>
            <form v-if="service.status==='published'" @submit.prevent="submit" class="space-y-8 divide-y divide-gray-200">
                <div class="space-y-8 divide-y divide-gray-200">
                    <div>
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Submit a report</h3>
                            <p class="mt-1 text-sm text-gray-500">This information will be displayed publicly so be
                                careful what you share.</p>
                        </div>

                        <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

                            <div class="sm:col-span-6">
                                <label for="details" class="block text-sm font-medium text-gray-700">Details</label>
                                <div class="mt-1">
                                    <textarea id="details" required v-model="form.details" rows="10"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Write a few sentences about your report.</p>
                                <InputError class="mt-2" :message="form.errors.details" />
                            </div>

                            <div class="sm:col-span-6">
                                <label for="cover-photo" class="block text-sm font-medium text-gray-700">
                                    Attachment
                                </label>
                                <div class="mt-1 flex justify-center rounded-md border-2 border-dashed px-6 pt-5 pb-6"
                                    :class="[form.attachment ? 'border-green-500' : 'border-gray-300']">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                            viewBox="0 0 48 48" aria-hidden="true">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="file-upload"
                                                class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500">
                                                <span>Upload a file</span>
                                                <input id="file-upload" :accept="allowedAttach" required
                                                    v-on:change="handleFileUpload" type="file" class="sr-only">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">Zip compressed up to 2MB</p>
                                        <p class="text-sm text-green-500" v-if="form.attachment">{{ form.attachment.name
                                        }}</p>
                                        <InputError class="mt-2" :message="form.errors.attachment" />
                                    </div>
                                </div>
                            </div>

                            <div class="sm:col-span-6">
                                <PrimaryButton class="w-full" :processing="form.processing">Submit report</PrimaryButton>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </template>

        <ProductDetails :service="service" />
    </AuthenticatedLayout>

</template>
