<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import ProductsGrid from "@/Components/ProductsGrid.vue";
import ProductDetails from "@/Components/ProductDetails.vue";
import useActions from "@/Hooks/useActions";

defineProps({
  services: Object,
});

const { processing, makeAction, currentItem, notes } = useActions(
  "analyst.services.action"
);
</script>

<template>
  <Head title="Products" />

  <AuthenticatedLayout>
    <template v-if="!! currentItem" #aside>
      <ProductDetails :service="currentItem" />
      <form v-if="currentItem.status === 'pending'">
        <div class="sm:col-span-6 mt-3">
          <label for="notes" class="block text-sm font-medium text-gray-700"
            >Notes</label
          >
          <div class="mt-1">
            <textarea
              id="notes"
              rows="3"
              v-model="notes"
              class="
                block
                w-full
                rounded-md
                border-gray-300
                shadow-sm
                focus:border-indigo-500 focus:ring-indigo-500
                sm:text-sm
              "
            ></textarea>
          </div>
          <p class="mt-2 text-sm text-gray-500">
            required incase of rejection.
          </p>
        </div>
        <span class="isolate inline-flex rounded-md shadow-sm mt-4 w-full">
          <button
            type="button"
            :disabled="processing"
            @click="makeAction('published')"
            class="
              disabled:bg-indigo-200 disabled:cursor-not-allowed
              relative
              w-1/2
              text-center
              inline-flex
              items-center
              rounded-l-md
              border border-green-100
              bg-green-500
              px-4
              py-2
              text-sm
              font-medium
              text-white
              hover:bg-green-700
              focus:z-10
            "
          >
            Publish
            <svg
              v-if="processing"
              role="status"
              class="inline mr-3 w-5 h-5 mx-2 text-white animate-spin"
              viewBox="0 0 100 101"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                fill="#E5E7EB"
              />
              <path
                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                fill="currentColor"
              />
            </svg>
          </button>
          <button
            type="button"
            :disabled="processing"
            @click="makeAction('rejected')"
            class="
              disabled:bg-indigo-200 disabled:cursor-not-allowed
              relative
              w-1/2
              text-center
              -ml-px
              inline-flex
              items-center
              rounded-r-md
              border border-red-100
              bg-red-500
              px-4
              py-2
              text-sm
              font-medium
              text-white
              hover:bg-red-700
              focus:z-10
            "
          >
            Reject
            <svg
              v-if="processing"
              role="status"
              class="inline mr-3 w-5 h-5 mx-2 text-white animate-spin"
              viewBox="0 0 100 101"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                fill="#E5E7EB"
              />
              <path
                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                fill="currentColor"
              />
            </svg>
          </button>
        </span>
      </form>

      <Link
        v-else-if="currentItem.status === 'published'"
        :href="route('analyst.services.submittions', currentItem.uuid)"
        class="
          inline-flex
          items-center
          px-5
          py-2.5
          mt-4
          text-sm
          font-medium
          text-center text-white
          bg-blue-700
          rounded-lg
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
        {{ currentItem.approved_submittions_count }}
        </span>
      </Link>
    </template>

    <div class="px-4 sm:px-6 lg:px-8">
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
          <h1 class="text-xl font-semibold text-gray-900">Products</h1>
          <p class="mt-2 text-sm text-gray-700">
            A list of all products Service Providers have submitted.
          </p>
        </div>
      </div>

      <ProductsGrid :services="services.data">
        <template v-slot:actions="prop">
          <button
            type="button"
            @click="currentItem = prop.service"
            class="
              inline-flex
              items-center
              rounded-full
              border border-transparent
              bg-indigo-600
              px-3
              py-1.5
              text-xs
              font-medium
              text-white
              shadow-sm
              hover:bg-indigo-700
              focus:outline-none
              focus:ring-2
              focus:ring-indigo-500
              focus:ring-offset-2
            "
          >
            Show
          </button>
        </template>
      </ProductsGrid>
    </div>
  </AuthenticatedLayout>
</template>
