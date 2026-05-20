<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

// Prindem ambele variabile trimise din Laravel
defineProps({
    totalProiecte: Number,
    totalTehnologii: Number,
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
                Panou de Control
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 border border-gray-100 dark:border-gray-700"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-bold mb-1">
                            Salut, {{ $page.props.auth.user.name }}! 👋
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Bine ai revenit la centrul de administrare al
                            portofoliului tău.
                        </p>
                    </div>
                </div>

                <div
                    class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3"
                >
                    <div
                        class="p-6 bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 border border-gray-100 dark:border-gray-700 flex items-center justify-between"
                    >
                        <div>
                            <p
                                class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"
                            >
                                Total Proiecte
                            </p>
                            <h4
                                class="mt-2 text-3xl font-extrabold text-blue-600 dark:text-blue-400"
                            >
                                {{ totalProiecte }}
                            </h4>
                        </div>
                        <div
                            class="p-3 bg-blue-100 dark:bg-blue-900/50 rounded-full text-blue-600 dark:text-blue-400"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"
                                />
                            </svg>
                        </div>
                    </div>

                    <div
                        class="p-6 bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 border border-gray-100 dark:border-gray-700 flex items-center justify-between"
                    >
                        <div>
                            <p
                                class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"
                            >
                                Tehnologii Unice
                            </p>
                            <h4
                                class="mt-2 text-3xl font-extrabold text-emerald-600 dark:text-emerald-400"
                            >
                                {{ totalTehnologii }}
                            </h4>
                        </div>
                        <div
                            class="p-3 bg-emerald-100 dark:bg-emerald-900/50 rounded-full text-emerald-600 dark:text-emerald-400"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"
                                />
                            </svg>
                        </div>
                    </div>

                    <div
                        class="p-6 bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 border border-gray-100 dark:border-gray-700 flex flex-col justify-between sm:col-span-2 lg:col-span-1"
                    >
                        <div>
                            <p
                                class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"
                            >
                                Acțiuni Rapide
                            </p>
                            <p class="mt-1 text-xs text-gray-400">
                                Gestionează modulele sau adaugă elemente noi.
                            </p>
                        </div>
                        <div class="mt-4">
                            <Link
                                href="/proiecte"
                                class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300"
                            >
                                Mergi la pagină
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 ml-1"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
