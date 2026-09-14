<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    links: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <div v-if="links.length > 3" class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-100 sm:px-6">
        <div class="flex-1 flex justify-end">
            <nav class="relative z-0 inline-flex items-center gap-1" aria-label="Pagination">
                <template v-for="(link, index) in links" :key="index">
                    <Link
                        v-if="link.url"
                        :href="link.url"
                        :class="[
                            'relative inline-flex items-center justify-center px-3 py-2 text-sm font-medium rounded-md transition-colors',
                            link.active
                                ? 'bg-[#115e59] text-white'
                                : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100',
                        ]"
                        v-html="link.label"
                    />
                    <span
                        v-else
                        class="relative inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-gray-300 cursor-default"
                        v-html="link.label"
                    />
                </template>
            </nav>
        </div>
    </div>
</template>
