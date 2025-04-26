<template>
  <Head title="Eventos" />
  <div>
    <Navbar />
    <h1>Mis Eventos</h1>
    <h1><Link :href="route('events.create')">Crear </Link></h1>
    <table>
      <tr>
        <th>Nombre:</th>
        <th>Fecha:</th>
        <th>Categoria:</th>
        <th>Imagen:</th>
        <th>Acciones:</th>
      </tr>
    <tr v-for="event in events" :key="event.id">
      <td>
        <a :href="route('events.show', event.id)">{{ event.name }}</a>
      </td>
      <td>
        {{ event.date }}
      </td>
      <td>
        {{ event.category.name}}
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
  </div>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import {ref,defineProps} from 'vue';
import Navbar from '@/Components/Navbar.vue';
import axios from 'axios';

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

// function deleteEvent(id) {
//   axios.post(`/events/${id}`, {
//     _method: 'DELETE'
//   }).then(() => {
//     events.value = events.value.filter(event => event.id !== id);
//   });
// }

</script>

<style scoped>
</style>
