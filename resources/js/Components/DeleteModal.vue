<script setup>
import { useForm } from '@inertiajs/vue3';

// Mendefinisikan props untuk mengontrol visibilitas dan ID data yang akan dihapus
const props = defineProps({
    show: {
        type: Boolean,
        default: false
    },
    bookId: {
        type: [Number, String],
        default: null
    }
});

// Emit untuk menutup modal
const emit = defineEmits(['close']);

// Inisialisasi form Inertia (kosong, karena hanya butuh aksi delete)
const form = useForm({});

// Fungsi untuk mengeksekusi penghapusan
const deleteBook = () => {
    if (!props.bookId) return;

    form.delete(`/books/${props.bookId}`, {
        preserveScroll: true,
        onSuccess: () => {
            emit('close');
        }
    });
};
</script>

<template>
    <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/50 backdrop-blur-sm transition-opacity">
        <!-- Modal Container -->
        <div class="w-full max-w-[360px] bg-white rounded-2xl shadow-2xl p-6 flex flex-col items-center text-center">
            
            <!-- Icon -->
            <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>

            <!-- Text Content -->
            <h2 class="text-[1.15rem] font-semibold text-gray-900 mb-2">Hapus Buku?</h2>
            <p class="text-sm text-gray-600 mb-6 leading-relaxed">
                Apakah Anda yakin ingin menghapus buku ini? Data yang dihapus masih dapat direstore nanti.
            </p>

            <!-- Action Buttons -->
            <div class="flex w-full gap-3">
                <button 
                    type="button"
                    @click="emit('close')"
                    :disabled="form.processing"
                    class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-colors disabled:opacity-50"
                >
                    Batal
                </button>
                <button 
                    type="button"
                    @click="deleteBook"
                    :disabled="form.processing"
                    class="flex-1 px-4 py-2.5 text-sm font-medium text-white bg-[#b91c1c] border border-transparent rounded-lg hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-700 transition-colors disabled:opacity-50"
                >
                    Ya, Hapus
                </button>
            </div>
            
        </div>
    </div>
</template>