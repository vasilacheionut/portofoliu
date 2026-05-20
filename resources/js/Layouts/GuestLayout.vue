<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center justify-center bg-gray-100 pt-6 sm:pt-0 dark:bg-gray-900 transition duration-150"
    >
        <div>
            <Link href="/">
                <ApplicationLogo
                    class="h-20 w-20 fill-current text-gray-500 dark:text-gray-400"
                />
            </Link>
        </div>

        <div
            class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg dark:bg-gray-800 border border-transparent dark:border-gray-700"
        >
            <slot />
        </div>
    </div>
</template>
