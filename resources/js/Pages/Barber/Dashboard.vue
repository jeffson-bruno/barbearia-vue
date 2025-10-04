<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, usePage, onMounted, ref } from '@inertiajs/vue3'
import { usePrefixPath } from '@/composables/usePrefixedRoute'

const page = usePage()
const user = page.props.auth?.user
const { path } = usePrefixPath()

const loading = ref(false)
const todayAppointments = ref([])

onMounted(async () => {
  // Opcional: chamada de teste à API (stub retorna [])
  try {
    loading.value = true
    const res = await fetch('/api/appointments', { credentials: 'include' })
    const data = await res.json().catch(() => ({}))
    todayAppointments.value = data?.appointments ?? []
  } catch (e) {
    console.error(e)
  } finally {
    loading.value = false
  }
})
</script>

<template>
  <Head title="Dashboard - Barbeiro" />
  <AuthenticatedLayout>
    <template #header>
      <div class="p-6">
        <h1 class="text-2xl font-semibold">Dashboard (Barbeiro)</h1>
        <p class="mt-2 text-gray-600">Olá, {{ user?.name }}</p>
      </div>
    </template>

    <div class="mx-auto max-w-7xl p-6">
      <div class="grid gap-6 sm:grid-cols-2">
        <div class="rounded-xl border bg-white p-4 shadow-sm">
          <h2 class="mb-2 text-lg font-semibold">Minha agenda de hoje</h2>
          <p v-if="loading" class="text-gray-500">Carregando…</p>
          <p v-else-if="!todayAppointments.length" class="text-gray-500">
            Sem horários para hoje (stub).
          </p>
          <ul v-else class="space-y-2">
            <li v-for="(a, i) in todayAppointments" :key="i" class="rounded border p-2">
              {{ a.time }} — {{ a.customer_name }} ({{ a.service_name }})
            </li>
          </ul>
          <div class="mt-4">
            <a :href="path('agenda')" class="text-indigo-600 hover:underline">Ver agenda completa</a>
          </div>
        </div>

        <div class="rounded-xl border bg-white p-4 shadow-sm">
          <h2 class="mb-2 text-lg font-semibold">Fila</h2>
          <p class="text-gray-500">Em breve…</p>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
