<template>
  <div class="max-w-md mx-auto mt-10">
    <Navbar />
    <h1 class="text-2xl font-bold mb-4">Editar Evento</h1>
    <form @submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
          Nombre del Evento
        </label>
        <input type="text" id="name" v-model="form.name"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="date">

        </label>
        <input type="date" id="date" v-model="form.date"
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
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
        <img class="w-20" :src="`/storage/${event.image}`" :alt="event.name">
        <input type="file" id="image" @input="handleImageChange" class="w-full border p-2 rounded" accept="image/*" />
        <div class="p-2 text-left">
          <img v-if="previewImage" class="w-20" :src="previewImage" :alt="form.name">
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
  console.log('form.image:', form.image);
  form.post(route('events.update', { event: props.event.id }), {
    forceFormData: true
  });
}

</script>

<style scoped>
/* Estilos opcionales para tu vista */
</style>