<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps({
  stats: Array,
});
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <div>
      <h3 class="text-lg font-medium leading-6 text-gray-900">Product Stats</h3>

      <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
        <div
          v-for="item in stats"
          :key="item.status"
          class="
            relative
            overflow-hidden
            rounded-lg
            bg-white
            px-4
            pt-5
            pb-12
            shadow
            sm:px-6 sm:pt-6
          "
        >
          <dt>
            <p class="truncate text-sm font-medium text-gray-500">
              {{ item.status }}
            </p>
          </dt>
          <dd class="flex items-baseline pb-6 sm:pb-7">
            <p class="text-2xl font-semibold text-gray-900">
              {{ item.status_count }}
            </p>
            <div
              class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6"
            >
              <div class="text-sm">
                <Link
                  :href="route('products.index', { status: item.status })"
                  class="font-medium text-indigo-600 hover:text-indigo-500"
                >
                  View all<span class="sr-only">
                    {{ item.status_count }} stats</span
                  ></Link
                >
              </div>
            </div>
          </dd>
        </div>
      </dl>
    </div>
  </AuthenticatedLayout>
</template>
