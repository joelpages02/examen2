<template>
    <div>
        <Navbar />
        <h1>Categoria {{ category.name }}</h1>
        <table>
            <tr>
                <th>Nombre</th>
            </tr>
            <tr>
                <td>
                    {{ category.name }}
                </td>
            </tr>
        </table>
    </div>
</template>

<script setup>
    import {defineProps} from 'vue';
    import Navbar from '@/Components/Navbar.vue';
    const props = defineProps({
        category: Array,
    });
    
</script>