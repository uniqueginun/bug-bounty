<script setup>
    import ProductStatus from '@/Components/ProductStatus.vue'

    defineProps({
        service: Object
    })
</script>

<template>
    <div class="space-y-8 divide-y divide-gray-200">
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Product Details</h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">read details carefully before you make any actions
                    </p>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Product Name</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{ service.product_name }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Product Status</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"><product-status :status="service.status">{{ service.status }}</product-status></dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Severity</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                <fieldset>
                                    <div class="space-y-4">
                                        <div class="flex items-center">
                                            <input id="low" disabled :checked="service.severity === 'low'"
                                                value="low" type="radio"
                                                class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="low"
                                                class="ml-3 block text-sm font-medium text-gray-700">Low</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="medium" disabled :checked="service.severity === 'medium'"
                                                value="medium" type="radio"
                                                class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="medium"
                                                class="ml-3 block text-sm font-medium text-gray-700">Medium</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="high" disabled :checked="service.severity === 'high'"
                                                value="high" type="radio"
                                                class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="high"
                                                class="ml-3 block text-sm font-medium text-gray-700">High</label>
                                        </div>
                                    </div>
                                </fieldset>
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                                {{ service.description }}
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
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
</template>
