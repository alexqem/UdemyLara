<template>
    <h1 class="text-3xl mb-4">Your Listings</h1>
    <section class="mb-4">
        <RealtorFilters  :filters="filters"/>
    </section>
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box v-for="listing in listings.data" :key="listing.id" :class="{ 'border-dashed dark:border-orange-900': listing.deleted_at }">
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between"
            :class="{ 'opacity-100': listing.deleted_at }">
                <div v-if="listing.sold_at != null" 
                    class="text-xs font-bold uppercase border border-dashed p-1 border-green-300 text-green-500 dark:border-green-600 dark:text-green-600 inline-block rounded-md mb-2"
                >
                    sold
                </div>
                <div class="xl:flex items-center gap-2">
                    <Price :price="listing.price" class="text-xl font-medium" />
                    <ListingSpace :listing="listing" />
                    <ListingAdress :listing="listing" class="text-gray-500"/>
                </div>
            <section>
                <div class="flex items-center gap-1 text-gray-400 darl:text-gray-300">
                    <a class="btn-outline text-xs font-medium" 
                        :href="route('listing.show', { listing: listing.id })"
                        target="_blank"
                    >Preview</a>
                    <Link class="btn-outline text-xs font-medium" :href="route('realtor.listing.edit', { listing: listing.id })">Edit</Link>
                    <Link :href="route('realtor.listing.destroy', {listing: listing.id})"
                        v-if="!listing.deleted_at"
                        method="delete" as="button"
                        class="btn-outline text-xs font-medium">
                            Remove
                    </Link>
                    <Link
                        v-else 
                        class="btn-outline text-xs font-medium"
                        :href="route('realtor.listing.restore', { listing: listing.id })" 
                        method="put" as="button"
                    >
                        Restore
                    </Link>
                </div>
                <div class="mt-2">
                    <Link :href="route('realtor.listing.image.create',
                        { listing: listing.id })"
                        class="block w-full btn-outline text-xs font-medium text-center">
                            Images ({{ listing.images_count }})
                    </Link>
                </div>
                <div class="mt-2">
                    <Link
                        :href="route('realtor.listing.show', { listing: listing.id })"
                        class="block w-full btn-outline text-xs font-medium text-center"
                    >
                        Offers ({{ listing.offers_count }})
                    </Link>
                </div>
            </section>
            </div>
        </Box>
    </section>
    <section v-if="listings.data.length" class="w-full flex justify-center mt-4 mb-4">
        <Pagination :links="listings.links" />
    </section>
</template>

<script setup>
import {Link } from '@inertiajs/vue3'

import Box from '@/Components/Box.vue'
import Price from '@/Components/Price.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import ListingAdress from '@/Components/ListingAdress.vue'
import Pagination from '@/Components/Pagination.vue'

import RealtorFilters from '@/Pages/Realtor/Components/RealtorFilters.vue'

defineProps({
  listings: Object,
  filters: Object,
})

</script>