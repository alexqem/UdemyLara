<template>
    <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 w-full">
        <div class="container mx-auto ">
        <nav class="p-4 flex items-center justify-between">
            <div class="text-lg font-medium">
                <Link :href="route('listing.index')">Listings</Link>
            </div>
            <div class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center">
                <Link :href="route('listing.index')">Property Sales</Link>
            </div>
            <div class="flex space-x-4">
                <button @click="toggleTheme" class="text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" ><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8z" clip-rule="evenodd"></path></svg>
                </button>
                <div v-if="user" class="space-x-4">
                    <Link class="text-sm text-gray-500" :href="route('realtor.listing.index')">{{ user.name }}</Link>
                    <Link :href="route('realtor.listing.create')" class="btn-nav">
                        + New Listing
                    </Link>
                    <Link :href="route('logout')" method="delete" as="button">Logout</Link>
                </div>
                <div v-else class="space-x-4">
                    <Link :href="route('user-account.create')">Register</Link>
                    <Link :href="route('login')">Sign-In</Link>
                </div>
            </div>
        </nav>
        </div>
    </header>
   <main class="container mx-auto p-4 w-full">
    <div v-if="flashSuccess" class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2">
      {{ flashSuccess }}
    </div>
    <slot>Default</slot>
  </main>
</template>
<script setup>

    import {Link, usePage } from '@inertiajs/vue3'
    import {ref, onMounted } from 'vue'
    import { computed } from 'vue'

    const page = usePage()
    const flashSuccess = computed(
        () => page.props.flash.success,
    )

    const user = computed(
        () => page.props.user,
    )
    const isDark = ref(true);

    onMounted(() => {

        if (localStorage.theme === 'light') {
            isDark.value = false;
            document.documentElement.classList.remove('dark');
        }
        
    });

    function toggleTheme() {
        isDark.value = !isDark.value;

        if (isDark.value) {
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.theme = 'light'; 
        }
    }

</script>

<style scoped>
  .success {
    background-color: green;
    color: white;
  }
</style>
