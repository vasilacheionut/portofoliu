<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

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
                        class="flex flex-col overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 border border-gray-100 dark:border-gray-700"
                    >
                        <img
                            :src="proiect.imagine"
                            :alt="proiect.titlu"
                            class="h-48 w-full object-cover"
                        />

                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h3
                                    class="text-xl font-bold text-blue-600 dark:text-blue-400 mb-2"
                                >
                                    {{ proiect.titlu }}
                                </h3>

                                <p
                                    class="text-gray-600 dark:text-gray-300 mb-4"
                                >
                                    {{ proiect.descriere }}
                                </p>
                            </div>

                            <div>
                                <div class="flex flex-wrap gap-2 mb-5">
                                    <span
                                        v-for="tech in proiect.tehnologii"
                                        :key="tech"
                                        class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200"
                                    >
                                        {{ tech }}
                                    </span>
                                </div>

                                <a
                                    :href="proiect.link_github"
                                    target="_blank"
                                    class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md transition duration-150 ease-in-out shadow-sm"
                                >
                                    Vezi Codul pe GitHub
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
