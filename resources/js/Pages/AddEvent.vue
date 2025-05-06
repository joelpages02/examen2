<template>
  <div class="max-w-md mx-auto mt-10">
    <Navbar />
    <h1 class="text-2xl font-bold mb-4">Añadir Evento</h1>
    <form @submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
          Nombre del Evento
        </label>
        <input type="text" id="name" v-model="form.name"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          required />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
          Fecha del Evento
        </label>
        <input type="date" id="date" v-model="form.date"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          required />
      </div>
      <label for="category">
        Categoria
      </label>
      <select id="category" v-model="form.category_id" required>
        <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
      </select>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
          Imagen del Evento
        </label>
        <input type="file" id="image" @input="handleImageChange" class="w-full border p-2 rounded" accept="image/*, audio/*" />
        <div class="p-2 text-left">
          <img v-if="previewImage" class="w-20" :src="previewImage" :alt="form.name">
          
          <audio v-if="previewAudio" class="w-full mt-2" controls>
            <source :src="previewAudio" />
            Tu navegador no soporta el elemento de audio.
          </audio>
        </div>
      </div>
      <div class="flex items-center justify-between">
        <button type="submit"
          class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
          Añadir Evento
        </button>
      </div>
    </form>
  </div>
</template>

<script setup>
import Navbar from '@/Components/Navbar.vue';
import { useForm } from '@inertiajs/vue3';
import { defineProps, ref } from 'vue';

const props = defineProps({
  categories: Array,
})

const previewImage = ref(null);
const previewAudio = ref(null);

const categories = props.categories || [];

const form = useForm({
  name: '',
  date: '',
  category_id: '',
  image: null,
});

const handleImageChange = (event) => {
  const file = event.target.files[0];
  form.image = file;

  if (file) {
    const type = file.type;

    if (type.startsWith('image/')) {
      previewImage.value = URL.createObjectURL(file);
      previewAudio.value = null;
    }
    // Si es audio
    else if (type.startsWith('audio/')) {
      previewAudio.value = URL.createObjectURL(file);
      previewImage.value = null;
    }
  }
  };

function submit() {
  form.post(route('events.store'), {
    forceFormData: true
  });
}

</script>

<style scoped>
/* Estilos opcionales para tu vista */
</style>
