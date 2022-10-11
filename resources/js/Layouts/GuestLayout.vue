<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gray-50">

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <ApplicationLogo />

            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
                <slot name="title" />
            </h2>
        </div>

        <slot />
    </div>
</template>
