<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { usePrefixPath } from '@/composables/usePrefixedRoute'
const { path } = usePrefixPath()

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: { type: String, default: '' },
  phpVersion: { type: String, default: '' },
})

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
  <Head title="Bem-vindo" />
  <div class="flex min-h-screen items-center justify-center bg-gray-50">
    <div class="w-full max-w-xl rounded-2xl bg-white p-8 shadow">
      <h1 class="mb-6 text-2xl font-semibold">Escolha como entrar</h1>
      <div class="grid gap-3">
        <a href="/admin/login" class="rounded-lg bg-gray-900 px-4 py-3 text-center font-medium text-white hover:bg-gray-800">
          Entrar como Admin
        </a>
        <a href="/barbeiro/login" class="rounded-lg bg-emerald-600 px-4 py-3 text-center font-medium text-white hover:bg-emerald-500">
          Entrar como Barbeiro
        </a>
        <a href="/cliente/login" class="rounded-lg bg-indigo-600 px-4 py-3 text-center font-medium text-white hover:bg-indigo-500">
          Entrar como Cliente
        </a>
      </div>
    </div>
  </div>
</template>