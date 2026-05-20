<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";

// Prindem variabilele trimise din Laravel
defineProps({
    totalProiecte: Number,
    totalTehnologii: Number,
    mesaje: Array,
    mesajeNecitite: Number,
});

// Funcția pentru marcare ca citit
const marcheazaCitit = (id) => {
    router.patch(
        route("mesaje.citit", id),
        {},
        {
            preserveScroll: true,
        },
    );
};

// Funcția pentru ștergere mesaj
const stergeMesaj = (id) => {
    if (confirm("Sigur vrei să ștergi definitiv acest mesaj?")) {
        router.delete(route("mesaje.destroy", id), {
            preserveScroll: true,
        });
    }
};
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
                        class="p-6 bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 border border-gray-100 dark:border-gray-700 flex items-center justify-between"
                    >
                        <div>
                            <p
                                class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider"
                            >
                                Mesaje Noi
                            </p>
                            <h4
                                class="mt-2 text-3xl font-extrabold"
                                :class="
                                    mesajeNecitite > 0
                                        ? 'text-rose-600 dark:text-rose-400'
                                        : 'text-gray-400'
                                "
                            >
                                {{ mesajeNecitite }}
                            </h4>
                        </div>
                        <div
                            class="p-3 rounded-full"
                            :class="
                                mesajeNecitite > 0
                                    ? 'bg-rose-100 dark:bg-rose-900/50 text-rose-600 dark:text-rose-400'
                                    : 'bg-gray-100 dark:bg-gray-700 text-gray-400'
                            "
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
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-6"
                >
                    <h3
                        class="text-lg font-bold mb-4 text-gray-900 dark:text-white flex items-center gap-2"
                    >
                        <span>Inbox Mesaje</span>
                        <span
                            class="text-xs px-2 py-0.5 bg-gray-100 dark:bg-gray-700 rounded-full text-gray-500 dark:text-gray-400 font-normal"
                        >
                            Total: {{ mesaje.length }}
                        </span>
                    </h3>

                    <div
                        v-if="mesaje.length === 0"
                        class="text-center py-8 border border-dashed border-gray-200 dark:border-gray-700 rounded-lg"
                    >
                        <p class="text-gray-500 dark:text-gray-400 text-sm">
                            Nu ai primit niciun mesaj deocamdată.
                        </p>
                    </div>

                    <div v-else class="space-y-4">
                        <div
                            v-for="mesaj in mesaje"
                            :key="mesaj.id"
                            class="p-5 rounded-lg border transition duration-150 relative group"
                            :class="
                                !mesaj.citit
                                    ? 'border-l-4 border-l-rose-500 border-gray-200 dark:border-gray-700 bg-rose-50/5 dark:bg-rose-950/5'
                                    : 'border-gray-200 dark:border-gray-800 bg-gray-50/30 dark:bg-gray-900/10'
                            "
                        >
                            <div
                                class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-3"
                            >
                                <div>
                                    <span
                                        class="font-bold text-gray-900 dark:text-white text-base"
                                        >{{ mesaj.nume }}</span
                                    >
                                    <span
                                        class="text-xs text-gray-400 dark:text-gray-500 ml-2"
                                        >({{ mesaj.email }})</span
                                    >
                                </div>

                                <div class="flex items-center gap-3">
                                    <span
                                        class="text-xs text-gray-400 dark:text-gray-500 mr-1"
                                    >
                                        {{
                                            new Date(
                                                mesaj.created_at,
                                            ).toLocaleDateString("ro-RO", {
                                                day: "numeric",
                                                month: "short",
                                                hour: "2-digit",
                                                minute: "2-digit",
                                            })
                                        }}
                                    </span>

                                    <button
                                        v-if="!mesaj.citit"
                                        @click="marcheazaCitit(mesaj.id)"
                                        title="Marchează ca citit"
                                        class="text-xs font-semibold text-emerald-600 hover:text-emerald-700 bg-emerald-50 dark:bg-emerald-950/40 p-1.5 rounded transition"
                                    >
                                        Bifează citit
                                    </button>

                                    <button
                                        @click="stergeMesaj(mesaj.id)"
                                        title="Șterge mesajul"
                                        class="text-xs text-rose-600 hover:text-rose-700 bg-rose-50 dark:bg-rose-950/40 p-1.5 rounded transition"
                                    >
                                        Șterge
                                    </button>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <h4
                                    class="text-sm font-semibold text-gray-800 dark:text-gray-300"
                                >
                                    <span
                                        class="text-xs text-gray-400 uppercase tracking-wider font-medium mr-1"
                                        >Subiect:</span
                                    >
                                    {{ mesaj.subiect || "Fără subiect" }}
                                </h4>
                                <p
                                    class="text-sm text-gray-600 dark:text-gray-400 whitespace-pre-wrap mt-2 bg-white dark:bg-gray-900/60 p-3 rounded border border-gray-100 dark:border-gray-800/80"
                                >
                                    {{ mesaj.continut }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
