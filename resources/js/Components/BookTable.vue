<script setup>
const props = defineProps({
    books: {
        type: [Array, Object],
        required: true,
        default: () => [],
    },
});

const emit = defineEmits(['edit-book', 'delete-book']);
const rows = Array.isArray(props.books) ? props.books : (props.books?.data ?? []);
</script>

<template>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Judul</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Penulis</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Penerbit</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tahun</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Stok</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                <tr v-if="rows.length === 0">
                    <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-400">
                        Tidak ada data buku ditemukan.
                    </td>
                </tr>
                <tr v-for="book in rows" :key="book.id" class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-teal-700">{{ book.judul }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ book.penulis }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ book.penerbit }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ book.tahun_terbit }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded bg-[#ccfbf1] text-[#115e59]">
                            {{ book.stok }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end gap-3">
                            <button type="button" @click="emit('edit-book', book)" class="text-gray-400 hover:text-teal-600 transition-colors" aria-label="Edit buku">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>
                            <button type="button" @click="emit('delete-book', book)" class="text-gray-400 hover:text-red-600 transition-colors" aria-label="Hapus buku">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
