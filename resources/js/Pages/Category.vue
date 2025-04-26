<template>
  <Head title="Categorias" />
  <div>
    <Navbar />
    <h1>Mis Categorias</h1>
    <h1>
      <Link :href="route('categories.create')">Crear </Link>
    </h1>
    <table>
      <tr>
        <th>Nombre:</th>
        <th>Acciones:</th>
      </tr>
      <tr v-for="category in categories" :key="category.id">
        <td>
          <a :href="route('categories.show', category.id)">{{ category.name }}</a>
        </td>
        <td>
          <div class="text-black">
            <Link :href="route('categories.show', category.id)">Ver </Link>
            <Link :href="route('categories.edit', category.id)">Editar </Link>
            <button @click="deleteEvent(category.id)">Eliminar </button>
          </div>
        </td>
      </tr>
    </table>
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
