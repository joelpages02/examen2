<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <nav class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <Link href="/" class="text-white font-bold text-xl">
                            Logo
                        </Link>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <Link
                                href="/events"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                            >
                                Eventos
                            </Link>
                            <Link
                                href="/categories"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                            >
                                Categorías
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menú móvil -->
        <div class="md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <Link
                    href="/events"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                >
                    Eventos
                </Link>
                <Link
                    href="/categories"
                    class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
                >
                    Categorías
                </Link>
            </div>
        </div>
    </nav>
</template> 