<template>
  <Head title="Categorias" />
  <div>
    <Navbar />
    <h1 class="text-2xl font-bold mb-4">Mis Categorias</h1>
    
    <div class="flex justify-between items-center mb-6">
      <Link :href="route('categories.create')"
            class="text-black font-bold py-2 px-4 rounded transition-colors">
        Crear Categoría
      </Link>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full bg-white shadow-md rounded">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-2 text-left">Nombre</th>
            <th class="px-4 py-2 text-left">Acciones</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-black">
          <tr v-for="category in categories" :key="category.id">
            <td class="px-4 py-3">
              <a :href="route('categories.show', category.id)" >
                {{ category.name }}
              </a>
            </td>
            <td class="px-4 py-3">
              <div class="flex gap-4">
                <Link :href="route('categories.show', category.id)"
                      class="hover:text-blue-700">
                  Ver
                </Link>
                <Link :href="route('categories.edit', category.id)"
                      class="hover:text-green-700">
                  Editar
                </Link>
                <button @click="deleteEvent(category.id)"
                        class="hover:text-red-700">
                  Eliminar
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import Navbar from '@/Components/Navbar.vue';

const props = defineProps({
  categories: Array,
});

function deleteEvent(id) {
  router.delete(route('categories.destroy', id));
}
</script>

<style scoped></style>
