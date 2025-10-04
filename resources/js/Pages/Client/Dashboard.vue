<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { usePrefixPath } from '@/composables/usePrefixedRoute'

const page = usePage()
const user = page.props.auth?.user
const { path } = usePrefixPath()
</script>

<template>
  <Head title="Dashboard - Cliente" />
  <AuthenticatedLayout>
    <template #header>
      <div class="p-6">
        <h1 class="text-2xl font-semibold">Dashboard (Cliente)</h1>
        <p class="mt-2 text-gray-600">Bem-vindo, {{ user?.name }}</p>
      </div>
    </template>

    <div class="mx-auto max-w-7xl p-6">
      <div class="grid gap-6 sm:grid-cols-2">
        <div class="rounded-xl border bg-white p-4 shadow-sm">
          <h2 class="mb-2 text-lg font-semibold">Próximo agendamento</h2>
          <p class="text-gray-500">Nenhum agendamento (stub).</p>
          <div class="mt-4 flex gap-3">
            <a :href="path('agendar')" class="rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-500">
              Agendar agora
            </a>
            <a :href="path('planos')" class="rounded-md bg-gray-100 px-4 py-2 text-gray-800 hover:bg-gray-200">
              Ver planos
            </a>
          </div>
        </div>

        <div class="rounded-xl border bg-white p-4 shadow-sm">
          <h2 class="mb-2 text-lg font-semibold">Histórico</h2>
          <p class="text-gray-500">Em breve…</p>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
