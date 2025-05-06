<template>
  <Head title="Eventos" />
  <div>
    <Navbar />
    <h1>Mis Eventos</h1>
    <div class="flex items-center mb-4">
      <h1>
        <Link :href="route('events.create')">Crear</Link>
      </h1>
      <div class="search-container">
        <input 
          type="text" 
          v-model="search" 
          placeholder="Buscar por nombre o categoría..." 
          class="px-4 py-2 border rounded-lg shadow-sm"
        />
      </div>
    </div>
    <table>
      <tr>
        <th>Nombre:</th>
        <th>Fecha:</th>
        <th>Categoria:</th>
        <th>Imagen:</th>
        <th>Acciones:</th>
      </tr>
      <tr v-for="event in filteredEvents" :key="event.id">
        <td>
          <a :href="route('events.show', event.id)">{{ event.name }}</a>
        </td>
        <td>
          {{ event.date }}
        </td>
        <td>
          {{ event.category.name }}
        </td>
        <td>
          <img class="w-20" :src="`/storage/${event.image}`" :alt="event.name">
        </td>
        <td>
          <div class="text-black">
            <Link :href="route('events.show', event.id)">Ver </Link>
            <Link :href="route('events.edit', event.id)">Editar </Link>
            <button @click="deleteEvent(event.id)">Eliminar </button>
          </div>
        </td>
      </tr>
    </table>
    <div v-if="filteredEvents.length === 0" class="mt-4 text-center text-gray-500">
      No se encontraron resultados para "{{ search }}"
    </div>
  </div>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, defineProps, computed } from 'vue';
import Navbar from '@/Components/Navbar.vue';
import axios from 'axios';

const search = ref('')

const props = defineProps({
  events: Array,
});

const events = ref(props.events);

function deleteEvent(id) {
  router.delete(route('events.destroy', id), {
    preserveScroll: true,
    onSuccess: () => {
      events.value = events.value.filter(event => event.id !== id);
    }
  });
}

const filteredEvents = computed(() =>
  props.events.filter(event =>
    event.name.toLowerCase().includes(search.value.toLowerCase()) ||
    (event.category && event.category.name &&
      event.category.name.toLowerCase().includes(search.value.toLowerCase()))
  )
);

// function deleteEvent(id) {
//   axios.post(`/events/${id}`, {
//     _method: 'DELETE'
//   }).then(() => {
//     events.value = events.value.filter(event => event.id !== id);
//   });
// }

</script>

<style scoped></style>
