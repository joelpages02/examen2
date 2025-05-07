<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted, computed, watch } from 'vue'
import Navbar from '@/Components/Navbar.vue';

const currentIndex = ref(0)
// let interval = null
const autoplayInterval = ref(null)
const isPaused = ref(false)
const search = ref('')
const tablaSeleccionada = ref('eventos')

const props = defineProps({
    events: Array,
    categories: Array,
});

// const startAutoplay = () => {
//     if (!isPaused.value) {
//         autoplayInterval.value = setInterval(() => {
//             nextImage()
//         }, 3000)
//     }
// }

// const stopAutoplay = () => {
//     if (autoplayInterval.value) {
//         clearInterval(autoplayInterval.value)
//         autoplayInterval.value = null
//     }
// }

// const toggleAutoplay = () => {
//     isPaused.value = !isPaused.value
//     if (isPaused.value) {
//         stopAutoplay()
//     } else {
//         startAutoplay()
//     }
// }

// const events = [
//   {
//     name: 'Evento 1',
//     category: { name: 'Música' },
//     image: '/images/events/evento1.jpg',
//   },
//   {
//     name: 'Evento 2',
//     category: { name: 'Arte' },
//     image: '/images/events/evento2.jpg',
//   },
//   {
//     name: 'Evento 3',
//     category: { name: 'Deporte' },
//     image: '/images/events/evento3.jpg',
//   },
// ]

// const filteredEvents = computed(() => 
//     props.events.filter(event =>
//         event.name.toLowerCase().includes(search.value.toLowerCase()) ||
//         (event.category && event.category.name && 
//          event.category.name.toLowerCase().includes(search.value.toLowerCase()))
//     )
// );

// watch(filteredEvents, () => {
//     currentIndex.value = 0;
// }, { deep: true });

const nextImage = () => {
    if (props.events && props.events.length > 0) {
        currentIndex.value = (currentIndex.value + 1) % props.events.length
    }
}

const prevImage = () => {
    if (props.events && props.events.length > 0) {
        currentIndex.value = (currentIndex.value - 1 + props.events.length) % props.events.length
    }
}

const goToImage = (index) => {
    if (props.events && props.events.length > 0) {
        currentIndex.value = index
    }
}

// onMounted(() => {
//     startAutoplay()
// })

// onUnmounted(() => {
//     stopAutoplay()
// })

const getImageUrl = (imagePath) => {
    return `/storage/${imagePath}`;
}

// function handleImageError() {
//     document.getElementById('screenshot-container')?.classList.add('!hidden');
//     document.getElementById('docs-card')?.classList.add('!row-span-1');
//     document.getElementById('docs-card-content')?.classList.add('!flex-row');
//     document.getElementById('background')?.classList.add('!hidden');
// }
</script>

<template>
    <Head title="Inicio" />
    <Navbar />

    <div class="container mx-auto px-4">
        <div class="flex gap-4 mt-4">
            <button @click="tablaSeleccionada = 'eventos'" 
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Ver Eventos
            </button>
            <button @click="tablaSeleccionada = 'categorias'" 
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Ver Categorías
            </button>
        </div>

        <div class="w-full max-w-4xl mx-auto mt-10">
            <template v-if="props.events && props.events.length > 0">
                <div class="relative overflow-hidden rounded-xl shadow-lg mb-8">
                    <img :src="getImageUrl(props.events[currentIndex].image)" 
                         :alt="props.events[currentIndex].name"
                         class="w-full h-64 object-cover transition-all duration-500" />

                    <div class="absolute bottom-0 w-full bg-black bg-opacity-75 text-white p-4">
                        <div class="text-center text-lg font-semibold">
                            {{ props.events[currentIndex].name }} - {{ props.events[currentIndex].category.name }}
                        </div>
                    </div>

                    <button @click="prevImage"
                        class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-black bg-opacity-75 text-white px-3 py-1 rounded-full hover:bg-opacity-75">
                        ‹
                    </button>

                    <button @click="nextImage"
                        class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-black bg-opacity-75 text-white px-3 py-1 rounded-full hover:bg-opacity-75">
                        ›
                    </button>

                    <div class="flex justify-center mt-4 space-x-2">
                        <span v-for="(event, index) in props.events" 
                              :key="event.id" 
                              @click="goToImage(index)"
                              class="w-3 h-3 rounded-full cursor-pointer transition-all duration-300"
                              :class="{
                                'bg-gray-900': index === currentIndex,
                                'bg-gray-400': index !== currentIndex
                              }" />
                    </div>
                </div>

                <div v-if="tablaSeleccionada === 'eventos'" class="overflow-x-auto mt-5">
                    <table class="min-w-full bg-white shadow-md rounded">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-left">Nombre</th>
                                <th class="px-4 py-2 text-left">Fecha</th>
                                <th class="px-4 py-2 text-left">Categoria</th>
                                <th class="px-4 py-2 text-left">Imagen</th>
                                <th class="px-4 py-2 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="event in props.events" :key="event.id" class="border-b">
                                <td class="px-4 py-2">
                                    <a :href="route('events.show', event.id)">{{ event.name }}</a>
                                </td>
                                <td class="px-4 py-2">{{ event.date }}</td>
                                <td class="px-4 py-2">{{ event.category.name }}</td>
                                <td class="px-4 py-2">
                                    <div class="flex justify-center">
                                        <img v-if="event.image && event.image.includes('.png', '.jpeg', '.jpg', '.gif')"
                                            class="w-20" :src="getImageUrl(event.image)" :alt="event.name">
                                        <audio v-else-if="event.image && event.image.includes('.mp3')"
                                            class="audio-player" controls>
                                            <source :src="getImageUrl(event.image)" type="audio/mpeg" />
                                        </audio>
                                    </div>
                                </td>
                                <td class="px-4 py-2">
                                    <div class="flex gap-4">
                                        <Link :href="route('events.show', event.id)">
                                            Ver
                                        </Link>
                                        <Link :href="route('events.edit', event.id)">
                                            Editar
                                        </Link>
                                        <button @click="deleteEvent(event.id)">
                                            Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div v-if="tablaSeleccionada === 'categorias'" class="overflow-x-auto mt-5">
                    <table class="min-w-full bg-white shadow-md rounded">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-left">Nombre</th>
                                <th class="px-4 py-2 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="category in props.categories" :key="category.id" class="border-b">
                                <td class="px-4 py-2">
                                    <a :href="route('categories.show', category.id)">{{ category.name }}</a>
                                </td>
                                <td class="px-4 py-2">
                                    <div class="flex gap-4">
                                        <Link :href="route('categories.show', category.id)">
                                            Ver
                                        </Link>
                                        <Link :href="route('categories.edit', category.id)">
                                            Editar
                                        </Link>
                                        <button @click="deleteEvent(category.id)">
                                            Eliminar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </template>
            <template v-else>
                <div class="text-center text-gray-600">
                    No hay eventos disponibles
                </div>
            </template>
        </div>
    </div>
</template>
