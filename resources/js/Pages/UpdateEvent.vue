<template>
  <div class="p-4 sm:max-w-md sm:mx-auto sm:mt-10">
    <Navbar />
    <h1 class="text-2xl font-bold mb-6">Editar Evento</h1>
    <form @submit.prevent="submit" class="bg-white shadow-md rounded px-4 sm:px-8 py-6 mb-4">
      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
          Nombre del Evento
        </label>
        <input type="text" 
               id="name" 
               v-model="form.name"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
          Fecha del Evento
        </label>
        <input type="date" 
               id="date" 
               v-model="form.date"
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
          Categoria
        </label>
        <select id="category" 
                v-model="form.category_id" 
                required
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          <option value="" disabled selected>Selecciona una categoría</option>
          <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.name }}
          </option>
        </select>
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
          Imagen del Evento
        </label>
        <div class="mb-4">
          <img v-if="event.image" 
               class="w-32 sm:w-40 object-cover rounded" 
               :src="`/storage/${event.image}`" 
               :alt="event.name">
        </div>
        <input type="file" 
               id="image" 
               @input="handleImageChange" 
               class="w-full border p-2 rounded" 
               accept="image/*,audio/*" />
        <div class="mt-4">
          <img v-if="previewImage" 
               class="w-32 sm:w-40 object-cover rounded" 
               :src="previewImage" 
               :alt="form.name">
        </div>
      </div>

      <div class="flex items-center justify-end">
        <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition-colors">
          Actualizar Evento
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import Navbar from '@/Components/Navbar.vue';
import { useForm } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const previewImage = ref(null);

const props = defineProps({
  event: Object,
  categories: Array,
});

const form = useForm({
  name: '',
  date: '',
  category_id: '',
  image: '',
  _method: 'put',
});

onMounted(() => {
  if (props.event) {
    form.name = props.event.name;
    form.date = props.event.date;
    form.category_id = props.event.category_id;
  }
});

const handleImageChange = (event) => {
  const file = event.target.files[0];
  form.image = file;

  if (file) {
    previewImage.value = URL.createObjectURL(file);
  }
};

function submit() {
  form.post(route('events.update', { event: props.event.id }), {
    forceFormData: true
  });
}
</script>

<style scoped>
/* Estilos opcionales para tu vista */
</style>