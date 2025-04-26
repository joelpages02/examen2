<template>
    <div>
        <Navbar />
        <h1>Event {{ events.name }}</h1>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Categoria</th>
                <th>Image</th>
            </tr>
            <tr>
                <td>
                    {{ events.name }}
                </td>
                <td>
                    {{ events.date }}
                </td>
                <td>
                    {{ events.category.name}}
                </td>
                <td>
                    <img class="w-20" :src="`/storage/${events.image}`" :alt="events.name">
                </td>
            </tr>
        </table>
    </div>
</template>

<script setup>
    import {defineProps} from 'vue';
    import Navbar from '@/Components/Navbar.vue';
    const props = defineProps({
        events: Array,
    });
    
</script>