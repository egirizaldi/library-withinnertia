<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import BookTable from '@/Components/BookTable.vue';
import BookForm from '@/Components/BookForm.vue';
import SearchInput from '@/Components/SearchInput.vue';
import DeleteModal from '@/Components/DeleteModal.vue';
import Pagination from '@/Components/Pagination.vue';
import FlashToast from '@/Components/FlashToast.vue';

const props = defineProps({
    books: {
        type: Object,
        default: () => ({}),
    },
    search: {
        type: String,
        default: '',
    },
});

const showModal = ref(false);
const showDeleteModal = ref(false);
const selectedBook = ref(null);
const selectedBookId = ref(null);
const editMode = ref('create');

const openCreateModal = () => {
    selectedBook.value = null;
    editMode.value = 'create';
    showModal.value = true;
};

const openEditModal = (book) => {
    selectedBook.value = book;
    editMode.value = 'edit';
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    selectedBook.value = null;
    editMode.value = 'create';
};

const openDeleteModal = (book) => {
    selectedBookId.value = book.id;
    showDeleteModal.value = true;
};

const closeDeleteModal = () => {
    showDeleteModal.value = false;
    selectedBookId.value = null;
};
</script>

<template>
    <Head title="Daftar Buku" />
    <FlashToast />

    <div class="flex h-screen bg-[#f8fafc] font-sans">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#f1f5f9] border-r border-gray-200 flex flex-col justify-between">
            <div>
                <!-- Logo Area -->
                <div class="px-6 py-6 flex items-center gap-3">
                    <div class="w-8 h-8 bg-white rounded shadow flex items-center justify-center">
                        <svg class="w-5 h-5 text-teal-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <div>
                        <h1 class="font-bold text-teal-800 text-lg leading-tight">Library Admin</h1>
                        <p class="text-xs text-gray-500">Central Branch</p>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="mt-4">
                    <Link href="/books" class="flex items-center px-6 py-3 bg-gray-200 border-l-4 border-teal-700 text-teal-800 font-medium text-sm">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        Daftar Buku
                    </Link>
                    <Link href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100 hover:text-gray-900 font-medium text-sm transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Anggota
                    </Link>
                    <Link href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100 hover:text-gray-900 font-medium text-sm transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Peminjaman
                    </Link>
                    <Link href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100 hover:text-gray-900 font-medium text-sm transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        Laporan
                    </Link>
                </nav>
            </div>

            <!-- Bottom Menu -->
            <div class="mb-6">
                <Link href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100 hover:text-gray-900 font-medium text-sm transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Settings
                </Link>
                <Link href="#" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100 hover:text-gray-900 font-medium text-sm transition-colors">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </Link>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8">
                <h2 class="text-xl font-bold text-teal-700 tracking-wide">LibrarianPro</h2>

                <div class="flex items-center space-x-4">
                    <button class="text-gray-500 hover:text-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </button>
                    <button class="text-gray-500 hover:text-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </button>
                    <div class="w-8 h-8 rounded-full bg-gray-300 overflow-hidden border border-gray-200">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" alt="User Avatar" class="w-full h-full object-cover" />
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="flex-1 overflow-auto p-8">
                <!-- Page Title & Action -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Daftar Buku</h1>
                        <p v-if="books.total !== undefined" class="text-sm text-gray-500 mt-1">
                            Total {{ books.total }} buku
                        </p>
                    </div>
                    <button @click="openCreateModal" class="bg-[#115e59] hover:bg-teal-800 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center transition-colors shadow-sm">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Buku
                    </button>
                </div>

                <!-- Main Card container -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">

                    <!-- Search Bar -->
                    <SearchInput :modelValue="search" />

                    <!-- Table -->
                    <BookTable :books="books" @edit-book="openEditModal" @delete-book="openDeleteModal" />

                    <!-- Pagination -->
                    <Pagination :links="books.links ?? []" />
                </div>
            </div>
        </main>
    </div>

    <!-- Modals -->
    <BookForm :show="showModal" :mode="editMode" :book="selectedBook" @close="closeModal" />
    <DeleteModal :show="showDeleteModal" :bookId="selectedBookId" @close="closeDeleteModal" />
</template>
