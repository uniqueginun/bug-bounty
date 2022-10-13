<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

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
            <form v-if="service.status==='pending'" @submit.prevent="submit" class="space-y-8 divide-y divide-gray-200">
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

        <div class="space-y-8 divide-y divide-gray-200">
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Product Details</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">read details carefully before you submit a report
                    </p>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Product Name</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ service.product_name }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Severity</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
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
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                {{ service.description }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Links</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">
                                    <li v-for="link, of service.links" :key="link"
                                        class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                        <div class="flex w-0 flex-1 items-center">
                                            <svg class="h-5 w-5 flex-shrink-0 text-gray-400"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span class="ml-2 w-0 flex-1 truncate">{{ link }}</span>
                                        </div>
                                        <div class="ml-4 flex-shrink-0">
                                            <a :href="link" target="_blank"
                                                class="font-medium text-indigo-600 hover:text-indigo-500">Visit</a>
                                        </div>
                                    </li>
                                </ul>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>