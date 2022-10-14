<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Head } from "@inertiajs/inertia-vue3";
import ProductsGrid from "@/Components/ProductsGrid.vue";

defineProps({
  services: Object,
});
</script>

<template>
  <Head title="Products" />

  <AuthenticatedLayout>
    <div class="px-4 sm:px-6 lg:px-8">
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
          <h1 class="text-xl font-semibold text-gray-900">Products</h1>
          <p class="mt-2 text-sm text-gray-700">
            A list of all products you have submitted.
          </p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
          <Link
            :href="route('products.create')"
            class="
              text-white
              bg-blue-700
              hover:bg-blue-800
              focus:ring-4 focus:outline-none focus:ring-blue-300
              font-medium
              rounded-lg
              text-sm
              px-5
              py-2.5
              text-center
              inline-flex
              items-center
              dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800
            "
          >
            Submit New
            <svg
              aria-hidden="true"
              class="ml-2 -mr-1 w-5 h-5"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                fill-rule="evenodd"
                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                clip-rule="evenodd"
              ></path>
            </svg>
          </Link>
        </div>
      </div>

      <ProductsGrid :services="services.data">
        <template v-slot:actions="prop">
          <Link
            v-if="prop.service.approved_submittions_count"
            :href="route('provider.services.submittions', prop.service.uuid)"
            class="
              inline-flex
              items-center
              px-3
              py-2
              text-sm
              font-medium
              text-center text-white
              bg-blue-700
              rounded-full
              hover:bg-blue-800
              focus:ring-4 focus:outline-none focus:ring-blue-300
              dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800
            "
          >
            Submitted Reports
            <span
              class="
                inline-flex
                justify-center
                items-center
                ml-2
                w-4
                h-4
                text-xs
                font-semibold
                text-blue-800
                bg-blue-200
                rounded-full
              "
            >
              {{ prop.service.approved_submittions_count }}
            </span>
          </Link>
        </template>
      </ProductsGrid>
    </div>
  </AuthenticatedLayout>
</template>
