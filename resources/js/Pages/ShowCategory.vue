<template>
    <div>
        <Navbar />
        <h1 class="text-2xl font-bold mb-6">Categoria: {{ category.name }}</h1>
        
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Nombre</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            {{ category.name }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            <Link :href="route('categories.index')" 
                  class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition-colors">
                Volver a Categorías
            </Link>
        </div>
    </div>
</template>

<script setup>
    import { defineProps } from 'vue';
    import { Link } from '@inertiajs/vue3';
    import Navbar from '@/Components/Navbar.vue';
    
    const props = defineProps({
        category: Object,
    });
</script>