<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

// Îi spunem componentei Vue că va primi o listă numită "proiecte" de la Laravel
defineProps({
    proiecte: Array,
});
</script>

<template>
    <Head title="Proiectele Mele" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Proiectele Mele
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div
                        v-for="proiect in proiecte"
                        :key="proiect.id"
                        class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg dark:bg-gray-800 border border-gray-100 dark:border-gray-700"
                    >
                        <h3
                            class="text-xl font-bold text-blue-600 dark:text-blue-400 mb-2"
                        >
                            {{ proiect.titlu }}
                        </h3>

                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            {{ proiect.descriere }}
                        </p>

                        <div class="flex flex-wrap gap-2">
                            <span
                                v-for="tech in proiect.tehnologii"
                                :key="tech"
                                class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200"
                            >
                                {{ tech }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
