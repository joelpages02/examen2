<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue'
import Navbar from '@/Components/Navbar.vue';

const currentIndex = ref(0)
const autoplayInterval = ref(null)
const isPaused = ref(false)

const props = defineProps({
    events: Array,
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

const nextImage = () => {
    if (props.events.length > 0) {
        currentIndex.value = (currentIndex.value + 1) % props.events.length
    }
}

const prevImage = () => {
    if (props.events.length > 0) {
        currentIndex.value = (currentIndex.value - 1 + props.events.length) % props.events.length
    }
}

const goToImage = (index) => {
    if (props.events.length > 0) {
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
    <div v-if="props.events && props.events.length > 0" class="w-full max-w-4xl mx-auto mt-10">
        <div class="relative overflow-hidden rounded-xl shadow-lg"
             @mouseenter="stopAutoplay"
             @mouseleave="startAutoplay">
            <img
                :src="getImageUrl(props.events[currentIndex].image)"
                :alt="props.events[currentIndex].name"
                class="w-full h-64 object-cover transition-all duration-500"
            />

            <div class="absolute bottom-0 w-full bg-black bg-opacity-50 text-white p-4">
                <div class="text-center text-lg font-semibold">
                    {{ props.events[currentIndex].name }} - {{ props.events[currentIndex].category.name }}
                </div>
                <!-- <div class="flex justify-center items-center mt-2">
                    <button @click="toggleAutoplay" 
                            class="text-white text-sm px-3 py-1 rounded-full bg-gray-800 bg-opacity-50 hover:bg-opacity-75">
                        {{ isPaused ? '▶' : '⏸' }}
                    </button>
                </div> -->
            </div>

            <button @click="prevImage"
                class="absolute top-1/2 left-2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white px-3 py-1 rounded-full hover:bg-opacity-75">
                ‹
            </button>

            <button @click="nextImage"
                class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white px-3 py-1 rounded-full hover:bg-opacity-75">
                ›
            </button>
        </div>

        <div class="flex justify-center mt-4 space-x-2">
            <span
                v-for="(event, index) in props.events"
                :key="event.id"
                @click="goToImage(index)"
                class="w-3 h-3 rounded-full cursor-pointer transition-all duration-300"
                :class="{
                    'bg-gray-800': index === currentIndex,
                    'bg-gray-400': index !== currentIndex
                }"
            />
        </div>
    </div>
    <div v-else class="w-full max-w-4xl mx-auto mt-10 text-center text-gray-600">
        No hay eventos disponibles
    </div>
</template>
  
