<script setup>
import { useForm } from '@inertiajs/vue3';
import { computed, watch } from 'vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    mode: {
        type: String,
        default: 'create',
    },
    book: {
        type: Object,
        default: null,
    },
});

const emit = defineEmits(['close']);

const form = useForm({
    judul: '',
    penulis: '',
    penerbit: '',
    tahun_terbit: '',
    stok: '',
});

const isEditMode = computed(() => props.mode === 'edit');
const modalTitle = computed(() => (isEditMode.value ? 'Edit Data Buku' : 'Tambah Data Buku'));
const submitLabel = computed(() => (isEditMode.value ? 'Update' : 'Simpan'));

const fillForm = () => {
    form.clearErrors();
    form.reset();

    if (props.book) {
        form.judul = props.book.judul ?? '';
        form.penulis = props.book.penulis ?? '';
        form.penerbit = props.book.penerbit ?? '';
        form.tahun_terbit = props.book.tahun_terbit ?? '';
        form.stok = props.book.stok ?? '';
        return;
    }
};

watch(
    () => [props.show, props.book],
    () => {
        if (props.show) {
            fillForm();
        } else {
            form.reset();
        }
    },
    { immediate: true }
);

const submit = () => {
    form.clearErrors();

    if (isEditMode.value && props.book?.id) {
        form.put(`/books/${props.book.id}`, {
            preserveScroll: true,
            onSuccess: () => {
                form.reset();
                emit('close');
            },
        });
        return;
    }

    form.post('/books', {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            emit('close');
        },
    });
};

const closeModal = () => {
    form.clearErrors();
    form.reset();
    emit('close');
};
</script>

<template>
    <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-500/50 backdrop-blur-sm">
        <!-- Modal Container -->
        <div class="w-full max-w-[500px] bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col">
            
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
                <h2 class="text-[1.25rem] font-semibold text-gray-900">{{ modalTitle }}</h2>
                <button type="button" @click="closeModal" class="text-gray-400 hover:text-gray-600 transition-colors" aria-label="Tutup modal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Form -->
            <form @submit.prevent="submit" class="flex flex-col">
                <!-- Body -->
                <div class="px-6 py-5 space-y-4">
                    
                    <!-- Judul Buku -->
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700">
                            Judul Buku <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            v-model="form.judul" 
                            placeholder="Masukkan judul buku"
                            class="w-full px-3.5 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-teal-700 focus:border-teal-700 outline-none transition-colors placeholder:text-gray-400"
                        >
                        <p v-if="form.errors.judul" class="mt-1.5 text-sm text-red-600">{{ form.errors.judul }}</p>
                    </div>

                    <!-- Penulis -->
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700">
                            Penulis <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            v-model="form.penulis" 
                            placeholder="Nama penulis"
                            class="w-full px-3.5 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-teal-700 focus:border-teal-700 outline-none transition-colors placeholder:text-gray-400"
                        >
                        <p v-if="form.errors.penulis" class="mt-1.5 text-sm text-red-600">{{ form.errors.penulis }}</p>
                    </div>

                    <!-- Penerbit -->
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700">
                            Penerbit
                        </label>
                        <input 
                            type="text" 
                            v-model="form.penerbit" 
                            placeholder="Nama penerbit"
                            class="w-full px-3.5 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-teal-700 focus:border-teal-700 outline-none transition-colors placeholder:text-gray-400"
                        >
                        <p v-if="form.errors.penerbit" class="mt-1.5 text-sm text-red-600">{{ form.errors.penerbit }}</p>
                    </div>

                    <!-- Row: Tahun Terbit & Stok -->
                    <div class="grid grid-cols-2 gap-4">
                        
                        <!-- Tahun Terbit (Menampilkan Error State seperti di gambar) -->
                        <div>
                            <label 
                                class="block mb-1.5 text-sm font-medium" 
                                :class="form.errors.tahun_terbit ? 'text-red-600' : 'text-gray-700'"
                            >
                                Tahun Terbit <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input 
                                    type="number" 
                                    v-model.number="form.tahun_terbit" 
                                    placeholder="2026"
                                    :class="[
                                        'w-full px-3.5 py-2 border rounded-lg outline-none transition-colors placeholder:text-gray-400',
                                        form.errors.tahun_terbit 
                                            ? 'border-red-600 bg-red-50/10 focus:border-red-600 focus:ring-1 focus:ring-red-600 pr-10' 
                                            : 'border-gray-300 focus:ring-1 focus:ring-teal-700 focus:border-teal-700'
                                    ]"
                                >
                                <!-- Ikon Error -->
                                <div v-if="form.errors.tahun_terbit" class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                            </div>
                            <p v-if="form.errors.tahun_terbit" class="mt-1.5 text-xs text-red-600 font-medium leading-relaxed">
                                {{ form.errors.tahun_terbit }}
                            </p>
                        </div>

                        <!-- Stok -->
                        <div>
                            <label class="block mb-1.5 text-sm font-medium text-gray-700">
                                Stok <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="number" 
                                v-model.number="form.stok" 
                                placeholder="0"
                                class="w-full px-3.5 py-2 border border-gray-300 rounded-lg focus:ring-1 focus:ring-teal-700 focus:border-teal-700 outline-none transition-colors placeholder:text-gray-400"
                            >
                            <p v-if="form.errors.stok" class="mt-1.5 text-sm text-red-600">{{ form.errors.stok }}</p>
                        </div>

                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-white border-t border-gray-100 flex items-center justify-end gap-3 rounded-b-2xl">
                    <button 
                        type="button" 
                        @click="closeModal"
                        class="px-5 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-colors"
                    >
                        Batal
                    </button>
                    <button 
                        type="submit" 
                        :disabled="form.processing"
                        class="inline-flex items-center px-5 py-2 text-sm font-medium text-white bg-[#0f766e] border border-transparent rounded-lg hover:bg-teal-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-700 disabled:opacity-50 transition-colors"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        {{ submitLabel }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</template>