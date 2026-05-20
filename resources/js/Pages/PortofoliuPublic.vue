<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    proiecte: Array,
    canLogin: Boolean,
});
</script>

<template>
    <Head title="Portofoliu - Vasilache Ionuț" />

    <div
        class="min-h-screen bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100 transition duration-150"
    >
        <nav
            class="bg-white shadow-sm dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700"
        >
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 justify-between items-center">
                    <div class="flex items-center gap-2">
                        <span
                            class="text-xl font-bold tracking-wider text-blue-600 dark:text-blue-400"
                            >VI</span
                        >
                        <span
                            class="text-sm font-medium text-gray-500 dark:text-gray-400"
                            >| Portofoliu Personal</span
                        >
                    </div>

                    <div>
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400"
                        >
                            Mergi la Panou Administrative
                        </Link>
                        <Link
                            v-else
                            :href="route('login')"
                            class="text-sm font-medium text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300"
                        >
                            Log In
                        </Link>
                    </div>
                </div>
            </div>
        </nav>

        <header
            class="py-16 text-center bg-white dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-800"
        >
            <div class="mx-auto max-w-3xl px-4">
                <h1
                    class="text-4xl font-extrabold text-gray-950 dark:text-white sm:text-5xl"
                >
                    Vasilache Ionuț
                </h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                    Programator Full-Stack | Aplicații Web Moderne dezvoltate cu
                    Laravel 12, Vue 3 și Tailwind CSS.
                </p>
            </div>
        </header>

        <main class="py-12">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2
                    class="text-2xl font-bold mb-8 text-gray-900 dark:text-gray-100"
                >
                    Proiecte Realizate
                </h2>

                <div
                    v-if="proiecte.length === 0"
                    class="text-center py-12 bg-white rounded-lg dark:bg-gray-800"
                >
                    <p class="text-gray-500 dark:text-gray-400">
                        Momentan nu sunt proiecte expuse. Revino curând!
                    </p>
                </div>

                <div
                    v-else
                    class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3"
                >
                    <div
                        v-for="proiect in proiecte"
                        :key="proiect.id"
                        class="flex flex-col overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 border border-gray-100 dark:border-gray-700 transform hover:scale-[1.01] transition duration-200"
                    >
                        <img
                            v-if="proiect.imagine"
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
                                    class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-4"
                                >
                                    {{ proiect.descriere }}
                                </p>
                            </div>

                            <div>
                                <div class="flex flex-wrap gap-1.5 mb-5">
                                    <span
                                        v-for="tech in proiect.tehnologii"
                                        :key="tech"
                                        class="px-2.5 py-0.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-200"
                                    >
                                        {{ tech }}
                                    </span>
                                </div>

                                <a
                                    v-if="proiect.link_github"
                                    :href="proiect.link_github"
                                    target="_blank"
                                    class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-gray-900 hover:bg-gray-800 dark:bg-blue-600 dark:hover:bg-blue-700 rounded-md transition shadow-sm"
                                >
                                    Vezi Codul pe GitHub
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
