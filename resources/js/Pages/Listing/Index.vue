<template>
    <Filters :filters="filters" />
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-2 md:grid-cols-3 xl:grid-cold-4">
        <Listing v-for="listing in listings.data" :key="listing.id" :listing="listing" />
    </div>
    <div v-if="listings.data.length" class="w-full flex justify-center mt-8 mb-8">
        <Pagination :links="listings.links" />
    </div>
</template>

<script setup>
import Listing from '@/Pages/Listing/Index/Components/Listing.vue'
import Pagination from '@/Components/Pagination.vue'
import Filters from '@/Pages/Listing/Index/Components/Filters.vue'

defineProps({
    listings: Object,
    filters: Object,   
})
</script>

 