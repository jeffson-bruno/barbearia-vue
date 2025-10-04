<script setup>
import { Link } from '@inertiajs/vue3'
import { usePrefixPath } from '@/composables/usePrefixedRoute'

const { path, isActive } = usePrefixPath()
</script>

<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Topbar -->
    <nav class="border-b bg-white">
      <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3">
        <div class="flex items-center gap-6">
          <!-- Dashboard -->
          <Link :href="path('dashboard')"
                class="font-semibold text-gray-800 hover:underline"
                :class="{ 'text-indigo-600': isActive('dashboard') }">
            Dashboard
          </Link>

          <!-- Perfil (se aplicável) -->
          <Link :href="path('profile')"
                class="text-gray-600 hover:underline"
                :class="{ 'text-indigo-600': isActive('profile') }">
            Perfil
          </Link>
        </div>

        <!-- Botão Logout -->
        <Link :href="path('logout')"
              method="post"
              as="button"
              class="rounded-md bg-red-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-red-500">
          Sair
        </Link>
      </div>
    </nav>

    <!-- Slot do conteúdo -->
    <main>
      <slot />
    </main>
  </div>
</template>
