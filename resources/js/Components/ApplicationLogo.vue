<script setup>
import { Link } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Link :href="route('home')">
        <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
            alt="Your Company">
    </Link>
</template>
