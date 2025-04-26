<template>
    <div class="max-w-md mx-auto mt-10">
        <Navbar />
        <h1 class="text-2xl font-bold mb-4">Editar Categoria</h1>
        <form @submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Nombre de la Categoria
                </label>
                <input type="text" id="name" v-model="form.name"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
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
import { onMounted } from 'vue';

const props = defineProps({
    category: Object,
});

const form = useForm({
    name: '',
    _method: 'put',
});

onMounted(() => {
    if (props.category) {
        form.name = props.category.name;
    }
});

function submit() {
    form.post(route('categories.update', { category: props.category.id }), {
        forceFormData: true
    });
}

</script>

<style scoped>
/* Estilos opcionales para tu vista */
</style>