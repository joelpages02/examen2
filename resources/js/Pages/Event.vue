<template>
  <Head title="Eventos" />
  <div class="p-4">
    <Navbar />
    <h1 class="text-2xl font-bold mb-4">Mis Eventos</h1>
    <div class="flex flex-col sm:flex-row items-center gap-4 mb-4">
      <h1>
        <Link :href="route('events.create')" class="text-blue-500 hover:text-blue-700">Crear</Link>
      </h1>
      <div class="w-full sm:w-auto">
        <input type="text" v-model="search" placeholder="Buscar por nombre o categoría..."
          class="w-full px-4 py-2 border rounded-lg shadow-sm" />
      </div>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full">
        <tr>
          <th class="px-4 py-2">Nombre:</th>
          <th class="px-4 py-2">Fecha:</th>
          <th class="px-4 py-2">Categoria:</th>
          <th class="px-4 py-2">Imagen:</th>
          <th class="px-4 py-2">Acciones:</th>
        </tr>
        <tr v-for="event in filteredEvents" :key="event.id">
          <td class="px-4 py-2">
            <a :href="route('events.show', event.id)">{{ event.name }}</a>
          </td>
          <td class="px-4 py-2">
            {{ event.date }}
          </td>
          <td class="px-4 py-2">
            {{ event.category.name }}
          </td>
          <td class="px-4 py-2">
            <div class="flex justify-center">
              <img v-if="event.image && event.image.includes('.png', '.jpeg', '.jpg', '.gif')" class="w-20"
                :src="`/storage/${event.image}`" :alt="event.name">
            </div>
            <div class="audio-container" v-if="event.image && event.image.includes('.mp3')">
              <audio class="audio-player" controls>
                <source :src="`/storage/${event.image}`" type="audio/mpeg" />
              </audio>
            </div>
          </td>
          <td class="px-4 py-2">
            <div class="text-black">
              <Link :href="route('events.show', event.id)">Ver </Link>
              <Link :href="route('events.edit', event.id)">Editar </Link>
              <button @click="deleteEvent(event.id)">Eliminar </button>
            </div>
          </td>
        </tr>
      </table>
    </div>
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

// function deleteEvent(id) {
//   router.delete(route('events.destroy', id));
// }

function deleteEvent(id) {
  router.delete(route('events.destroy', id), {
    preserveScroll: true,
    onSuccess: () => {
      events.value = events.value.filter(event => event.id !== id);
    }
  });
}

// function deleteEvent(id) {
//   axios.post(`/events/${id}`, {
//     _method: 'DELETE'
//   }).then(() => {
//     events.value = events.value.filter(event => event.id !== id);
//   });
// }

const filteredEvents = computed(() =>
  props.events.filter(event =>
    event.name.toLowerCase().includes(search.value.toLowerCase()) ||
    (event.category && event.category.name &&
      event.category.name.toLowerCase().includes(search.value.toLowerCase()))
  )
);

</script>

<style scoped></style>
