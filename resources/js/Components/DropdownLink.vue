<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    href: {
        type: String,
        required: true,
    },
    as: {
        type: String,
        default: "a",
    },
});
</script>

<template>
    <component
        :is="as === 'button' ? 'button' : Link"
        :href="as !== 'button' ? href : undefined"
        :type="as === 'button' ? 'button' : undefined"
        class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-700 transition duration-150 ease-in-out"
    >
        <slot />
    </component>
</template>
