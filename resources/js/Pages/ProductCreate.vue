<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
    product_name: '',
    description: '',
    severity: 'low',
    links: ['']
});

const addLink = () => form.links.push('')

const removeIndex = index => form.links.splice(index, 1)

const submit = () => {
    form.post(route('products.store'), {
        onSuccess: () => {
            form.reset()
        },
    });
};

</script>

<template>

    <Head title="Create Product" />

    <AuthenticatedLayout>
        <form @submit.prevent="submit" class="space-y-8 divide-y divide-gray-200">
            <div class="space-y-8 divide-y divide-gray-200">
                <div>
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Submittion Form</h3>
                        <p class="mt-1 text-sm text-gray-500">Please fillout this form and we will review it within
                            approximately 48 hours</p>
                    </div>

                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="product-name" class="block text-sm font-medium text-gray-700">Product
                                Name</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="text" id="product-name" v-model="form.product_name"
                                    class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                            <InputError class="mt-2" :message="form.errors.product_name" />
                        </div>

                        <div class="sm:col-span-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <div class="mt-1">
                                <textarea id="description" v-model="form.description" rows="3"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>
                        </div>

                    </div>
                </div>

                <div class="pt-8">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Severity</h3>
                        <p class="mt-1 text-sm text-gray-500">choose from options below.</p>
                    </div>
                    <div class="mt-6">
                        <fieldset class="mt-6">
                            <div class="mt-4 space-y-4">
                                <div class="flex items-center">
                                    <input id="low" name="severity" v-model="form.severity" value="low" type="radio"
                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="low" class="ml-3 block text-sm font-medium text-gray-700">Low</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="medium" name="severity" v-model="form.severity" value="medium"
                                        type="radio"
                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="medium"
                                        class="ml-3 block text-sm font-medium text-gray-700">Medium</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="high" name="severity" v-model="form.severity" value="high" type="radio"
                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="high" class="ml-3 block text-sm font-medium text-gray-700">High</label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class="pt-8">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Links</h3>
                        <p class="mt-1 text-sm text-gray-500">You can add more than one links.</p>
                        <InputError class="mt-2" :message="form.errors.severity" />
                    </div>
                    <div v-for="(item, index) of form.links" :key="index" class="grid grid-cols-3 gap-6">
                        <div class="col-span-3 sm:col-span-2">
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="text" v-model="form.links[index]" required
                                    class="block w-full min-w-0 flex-grow rounded-none border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <button v-if="index===0" type="button" @click="addLink"
                                    class="rounded-none bg-white rounded-r-md border border-l-0 border-gray-300 py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-black"
                                        stroke="currentColor" viewBox="0 0 455 455" xml:space="preserve">
                                        <path d="M455 212.5H242.5V0h-30v212.5H0v30h212.5V455h30V242.5H455z" />
                                    </svg>
                                </button>

                                <button v-else type="button" @click="removeIndex(index)"
                                    class="rounded-none bg-white rounded-r-md border border-l-0 border-gray-300 py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 459.739 459.739"
                                    class="w-6 h-6 text-red-500"
                                        stroke="currentColor" xml:space="preserve">
                                        <path
                                            d="M229.869 0C102.917 0 0 102.917 0 229.869s102.917 229.869 229.869 229.869 229.869-102.917 229.869-229.869S356.821 0 229.869 0zm83.807 260.518H146.063c-16.926 0-30.649-13.723-30.649-30.649 0-16.927 13.723-30.65 30.649-30.65h167.613c16.925 0 30.649 13.723 30.649 30.65 0 16.926-13.724 30.649-30.649 30.649z" />
                                    </svg>
                                </button>
                            </div>
                            <InputError class="mt-2" :message="form.errors[`links.${index}`]" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <PrimaryButton :processing="form.processing">Submit</PrimaryButton>
                </div>
            </div>
        </form>

    </AuthenticatedLayout>
</template>
