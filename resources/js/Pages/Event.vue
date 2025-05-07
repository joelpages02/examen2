<template>
  <Head title="Eventos" />
  <div>
    <Navbar />
    <h1 class="text-2xl font-bold mb-4">Mis Eventos</h1>
    <div class="flex flex-col gap-4 mb-4">
      <Link :href="route('events.create')" class="text-black w-fit">Crear</Link>
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 md:max-w-4xl">
        <input type="text" v-model="filters.search" placeholder="Buscar..." 
          class="w-full px-4 py-2 md:px-2 md:py-1 border rounded-lg text-base md:text-md" />
        <select v-model="filters.name" class="w-full px-4 py-2 md:px-2 md:py-1 border rounded-lg text-base md:text-md">
          <option value="">Todos los nombres</option>
          <option v-for="name in uniqueNames" :key="name" :value="name">{{ name }}</option>
        </select>
        <select v-model="filters.category" class="w-full px-4 py-2 md:px-2 md:py-1 border rounded-lg text-base md:text-md">
          <option value="">Todas las categorías</option>
          <option v-for="cat in categories" :key="cat" :value="cat">{{ cat }}</option>
        </select>
        <select v-model="filters.date" class="w-full px-4 py-2 md:px-2 md:py-1 border rounded-lg text-base md:text-md">
          <option value="">Todas las fechas</option>
          <option v-for="date in dates" :key="date" :value="date">{{ date }}</option>
        </select>
      </div>
    </div>
    <div class="overflow-x-auto">
      <table class="min-w-full">
        <tr class="text-center bg-gray-200">
          <th class="px-4 py-2">Nombre:</th>
          <th class="px-4 py-2">Fecha:</th>
          <th class="px-4 py-2">Categoria:</th>
          <th class="px-4 py-2">Imagen:</th>
          <th class="px-4 py-2">Acciones:</th>
        </tr>
        <tr v-for="event in filteredEvents" :key="event.id">
          <td class="px-4 py-2 text-center">
            <a :href="route('events.show', event.id)">{{ event.name }}</a>
          </td>
          <td class="px-4 py-2 text-center">
            {{ event.date }}
          </td>
          <td class="px-4 py-2 text-center">
            {{ event.category.name }}
          </td>
          <td class="px-4 py-2 text-center">
            <div class="flex justify-center">
              <img v-if="event.image && event.image.includes('.png', '.jpeg', '.jpg', '.gif')" class="w-20"
                :src="`/storage/${event.image}`" :alt="event.name">
            </div>
            <div class="audio-container flex justify-center" v-if="event.image && event.image.includes('.mp3')">
              <audio class="audio-player" controls>
                <source :src="`/storage/${event.image}`" type="audio/mpeg" />
              </audio>
            </div>
          </td>
          <td class="px-4 py-2 text-center">
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
      No se encontraron resultados para "{{ filters.search }}"
    </div>
  </div>
</template>

<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, defineProps, computed } from 'vue';
import Navbar from '@/Components/Navbar.vue';

const props = defineProps({
  events: Array,
});

const filters = ref({
  search: '',
  category: '',
  date: '',
  name: ''
});

const categories = computed(() => [...new Set(props.events.map(e => e.category?.name).filter(Boolean))]);
const dates = computed(() => [...new Set(props.events.map(e => e.date))]);
const uniqueNames = computed(() => [...new Set(props.events.map(e => e.name))]);
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


const filteredEvents = computed(() => {
  return props.events.filter(event => {
    if (filters.value.search) {
      const searchTerm = filters.value.search.toLowerCase();
      const matchesName = event.name.toLowerCase().includes(searchTerm);
      const matchesCategory = event.category?.name?.toLowerCase().includes(searchTerm);
      const matchesDate = event.date?.toLowerCase().includes(searchTerm);
      
      if (!matchesName && !matchesCategory && !matchesDate) return false;
    }

    if (filters.value.name && event.name !== filters.value.name) return false;
    if (filters.value.category && event.category?.name !== filters.value.category) return false;
    if (filters.value.date && event.date !== filters.value.date) return false;

    return true;
  });
});
</script>

<style scoped>
select {
  min-width: 200px;
}
</style>
