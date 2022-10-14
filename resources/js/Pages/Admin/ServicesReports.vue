<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import SubmittionGrid from "@/Components/SubmittionGrid.vue";
import useActions from "@/Hooks/useActions";
import ProductDetails from "@/Components/ProductDetails.vue";

defineProps({
  submittions: Object,
  service: Object,
  makeAction: {
    type: Boolean,
    default: true,
  },
});

const { processing, makeAction, currentItem, notes } = useActions(
  "analyst.submittions.action"
);
</script>

<template>
  <Head title="Products" />

  <AuthenticatedLayout>
    <template #aside>
      <ProductDetails :service="service" v-if="!currentItem" />
      <div v-if="currentItem">
        <div class="sm:col-span-6 mt-3">
          <label class="block text-sm font-bold text-gray-700">Details</label>
          <div class="mt-1">
            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
              {{ currentItem.details }}
            </dd>
          </div>
        </div>
        <div class="sm:col-span-6 mt-3">
          <label class="block text-sm font-bold text-gray-700"
            >Attachment</label
          >
          <div class="mt-1">
            <a
              type="button"
              :href="
                route('download', { zip: currentItem.attachments[0].path })
              "
              class="
                inline-flex
                items-center
                py-2
                px-4
                text-sm
                font-medium
                text-gray-900
                bg-white
                rounded
                border border-gray-200
                hover:bg-gray-100 hover:text-blue-700
                focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700
                dark:bg-gray-700
                dark:border-gray-600
                dark:text-white
                dark:hover:text-white
                dark:hover:bg-gray-600
                dark:focus:ring-blue-500
                dark:focus:text-white
              "
            >
              <svg
                aria-hidden="true"
                class="mr-2 w-4 h-4 fill-current"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z"
                  clip-rule="evenodd"
                ></path>
              </svg>
              Download
            </a>
          </div>
        </div>
      </div>
      <form v-if="currentItem && currentItem.status === 'pending'">
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
    </template>

    <div class="px-4 sm:px-6 lg:px-8">
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
          <h1 class="text-xl font-semibold text-gray-900">Submittions</h1>
          <p class="mt-2 text-sm text-gray-700">
            A list of all submittions this Service has received.
          </p>
        </div>
      </div>

      <SubmittionGrid :submittions="submittions.data">
        <template v-slot:actions="prop">
          <button
            type="button"
            @click="currentItem = prop.submit"
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
      </SubmittionGrid>
    </div>
  </AuthenticatedLayout>
</template>
