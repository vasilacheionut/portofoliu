<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    proiecte: Array,
});

// variabilă reactivă care ne spune dacă suntem în mod Editare sau Adăugare
const esteEditare = ref(false);
const idProiectEditat = ref(null);

const form = useForm({
    titlu: "",
    descriere: "",
    tehnologiiString: "",
    imagine: "",
    link_github: "",
});

// Pornește modul de editare și încarcă datele în formular corect
const incarcaPentruEditare = (proiect) => {
    esteEditare.value = true;
    idProiectEditat.value = proiect.id;

    form.titlu = proiect.titlu;
    form.descriere = proiect.descriere;
    form.tehnologiiString = proiect.tehnologii.join(", ");
    form.imagine = proiect.imagine || "";
    form.link_github = proiect.link_github || "";

    // Salt lin (scroll) în susul paginii la formular
    window.scrollTo({ top: 0, behavior: "smooth" });
};

// Resetează complet formularul la starea inițială (Adăugare)
const anuleazaEditare = () => {
    esteEditare.value = false;
    idProiectEditat.value = null;
    form.reset();
};

// Executat salvarea sau actualizarea în funcție de starea curentă
const trimiteFormular = () => {
    const taguriArray = form.tehnologiiString
        .split(",")
        .map((tech) => tech.trim())
        .filter((tech) => tech !== "");

    if (esteEditare.value) {
        form.transform((data) => ({
            ...data,
            tehnologii: taguriArray,
        })).put(`/proiecte/${idProiectEditat.value}`, {
            onSuccess: () => {
                anuleazaEditare();
            },
        });
    } else {
        form.transform((data) => ({
            ...data,
            tehnologii: taguriArray,
        })).post("/proiecte", {
            onSuccess: () => form.reset(),
        });
    }
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
                        {{
                            esteEditare
                                ? `Editează Proiectul: ${form.titlu}`
                                : "Adaugă un Proiect Nou"
                        }}
                    </h3>

                    <form
                        @submit.prevent="trimiteFormular"
                        class="grid grid-cols-1 gap-4 md:grid-cols-2"
                    >
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                                >Titlu Proiect</label
                            >
                            <input
                                v-model="form.titlu"
                                type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm focus:border-blue-500"
                            />
                            <span
                                v-if="form.errors.titlu"
                                class="text-xs text-red-500 mt-1 block"
                                >{{ form.errors.titlu }}</span
                            >
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                                >Tehnologii (separate prin virgulă)</label
                            >
                            <input
                                v-model="form.tehnologiiString"
                                type="text"
                                placeholder="Laravel, Vue, Tailwind"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm focus:border-blue-500"
                            />
                            <span
                                v-if="form.errors.tehnologii"
                                class="text-xs text-red-500 mt-1 block"
                                >{{ form.errors.tehnologii }}</span
                            >
                        </div>

                        <div class="md:col-span-2">
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                                >Descriere</label
                            >
                            <textarea
                                v-model="form.descriere"
                                rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm focus:border-blue-500"
                            ></textarea>
                            <span
                                v-if="form.errors.descriere"
                                class="text-xs text-red-500 mt-1 block"
                                >{{ form.errors.descriere }}</span
                            >
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                                >Link URL Imagine</label
                            >
                            <input
                                v-model="form.imagine"
                                type="text"
                                placeholder="https://..."
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm focus:border-blue-500"
                            />
                            <span
                                v-if="form.errors.imagine"
                                class="text-xs text-red-500 mt-1 block"
                                >{{ form.errors.imagine }}</span
                            >
                        </div>

                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                                >Link GitHub</label
                            >
                            <input
                                v-model="form.link_github"
                                type="text"
                                placeholder="https://..."
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 shadow-sm focus:border-blue-500"
                            />
                            <span
                                v-if="form.errors.link_github"
                                class="text-xs text-red-500 mt-1 block"
                                >{{ form.errors.link_github }}</span
                            >
                        </div>

                        <div class="md:col-span-2 flex justify-end gap-3">
                            <button
                                v-if="esteEditare"
                                @click="anuleazaEditare"
                                type="button"
                                class="px-5 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-md transition shadow-sm"
                            >
                                Anulează
                            </button>

                            <button
                                type="submit"
                                :disabled="form.processing"
                                :class="
                                    esteEditare
                                        ? 'bg-amber-600 hover:bg-amber-700'
                                        : 'bg-green-600 hover:bg-green-700'
                                "
                                class="px-5 py-2 text-sm font-medium text-white rounded-md transition disabled:opacity-50 shadow-sm"
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
                        <div class="absolute top-3 right-3 flex gap-2 z-10">
                            <button
                                @click="incarcaPentruEditare(proiect)"
                                class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full shadow-md transition"
                                title="Editează Proiect"
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
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                    />
                                </svg>
                            </button>

                            <button
                                @click="
                                    stergeProiect(proiect.id, proiect.titlu)
                                "
                                class="bg-red-600 hover:bg-red-700 text-white p-2 rounded-full shadow-md transition"
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
                        </div>

                        <img
                            v-if="proiect.imagine"
                            :src="proiect.imagine"
                            :alt="proiect.titlu"
                            class="h-48 w-full block object-cover"
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
