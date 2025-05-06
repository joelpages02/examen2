<template>
    <div class="p-4">
        <Navbar />
        <h1 class="text-2xl font-bold mb-4">Event {{ events.name }}</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <tr>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Categoria</th>
                    <th class="px-4 py-2">Image</th>
                </tr>
                <tr>
                    <td class="px-4 py-2">
                        {{ events.name }}
                    </td>
                    <td class="px-4 py-2">
                        {{ events.date }}
                    </td>
                    <td class="px-4 py-2">
                        {{ events.category.name}}
                    </td>
                    <td class="px-4 py-2">
                        <div class="flex justify-center">
                            <img v-if="events.image && events.image.includes('.png', '.jpeg', '.jpg', '.gif')" 
                                 class="w-20" 
                                 :src="`/storage/${events.image}`" 
                                 :alt="events.name">
                            <div class="audio-container" v-if="events.image && events.image.includes('.mp3')">
                                <audio class="audio-player" controls>
                                    <source :src="`/storage/${events.image}`" type="audio/mpeg" />
                                </audio>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script setup>
    import {defineProps} from 'vue';
    import Navbar from '@/Components/Navbar.vue';
    const props = defineProps({
        events: Array,
    });
    
</script>