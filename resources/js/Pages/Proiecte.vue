<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    proiecte: Array,
});

// Inițializăm formularul Inertia cu câmpurile goale
const form = useForm({
    titlu: "",
    descriere: "",
    tehnologiiString: "", // Îl folosim pentru a scrie tehnologiile cu virgulă (ex: Laravel, Vue)
    imagine: "",
    link_github: "",
});

// Trimitem formularul către Laravel
const adaugaProiect = () => {
    // Transformăm șirul de text cu virgule într-un array curat de JavaScript
    const taguriArray = form.tehnologiiString
        .split(",")
        .map((tech) => tech.trim())
        .filter((tech) => tech !== "");

    form.transform((data) => ({
        ...data,
        tehnologii: taguriArray, // Trimitem array-ul final în loc de string
    })).post("/proiecte", {
        onSuccess: () => form.reset(), // Resetează formularul dacă salvarea a reușit
    });
};

const stergeProiect = (id, titlu) => {
    if (confirm(`Ești sigur că vrei să ștergi proiectul "${titlu}"?`)) {
        router.delete(`/proiecte/${id}`);
    }
};
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
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-8">
                <div
                    class="p-6 bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 border border-gray-100 dark:border-gray-700"
                >
                    <h3
                        class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4"
                    >
                        Adaugă un Proiect Nou
                    </h3>

                    <form
                        @submit.prevent="adaugaProiect"
                        class="grid grid-cols-1 gap-4 md:grid-cols-2"
                    >
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-300"
                                >Titlu Proiect</label
                            >
                            <input
                                v-model="form.titlu"
                                type="text"
                                required
                                class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            />
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-300"
                                >Tehnologii (separate prin virgulă)</label
                            >
                            <input
                                v-model="form.tehnologiiString"
                                type="text"
                                required
                                placeholder="Laravel, Vue, Tailwind"
                                class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            />
                        </div>

                        <div class="md:col-span-2">
                            <label
                                class="block text-sm font-medium text-gray-300"
                                >Descriere</label
                            >
                            <textarea
                                v-model="form.descriere"
                                required
                                rows="3"
                                class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            ></textarea>
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-300"
                                >Link URL Imagine</label
                            >
                            <input
                                v-model="form.imagine"
                                type="url"
                                placeholder="https://images.unsplash.com/..."
                                class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            />
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-300"
                                >Link GitHub</label
                            >
                            <input
                                v-model="form.link_github"
                                type="url"
                                placeholder="https://github.com/..."
                                class="mt-1 block w-full rounded-md border-gray-700 bg-gray-900 text-gray-100 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            />
                        </div>

                        <div class="md:col-span-2 flex justify-end">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="px-5 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-md transition disabled:opacity-50 shadow-sm"
                            >
                                {{
                                    form.processing
                                        ? "Se salvează..."
                                        : "Salvează Proiectul"
                                }}
                            </button>
                        </div>
                    </form>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div
                        v-for="proiect in proiecte"
                        :key="proiect.id"
                        class="flex flex-col relative overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 border border-gray-100 dark:border-gray-700"
                    >
                        <button
                            @click="stergeProiect(proiect.id, proiect.titlu)"
                            class="absolute top-3 right-3 bg-red-600 hover:bg-red-700 text-white p-2 rounded-full shadow-md transition z-10"
                            title="Șterge Proiect"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-16v1a3 3 0 003 3h10M4 7h16"
                                />
                            </svg>
                        </button>

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
                                    v-if="proiect.link_github"
                                    :href="proiect.link_github"
                                    target="_blank"
                                    class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md transition shadow-sm"
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
