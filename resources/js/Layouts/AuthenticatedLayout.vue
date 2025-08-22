<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  href: String,
  active: { type: Boolean, default: false },
})

const classes = computed(() =>
  props.active
    ? 'block border-l-4 border-indigo-400 bg-indigo-50 py-2 pl-3 pr-4 text-base font-medium text-indigo-700 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition'
    : 'block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition'
)
</script>

<template>
  <Link :href="href" :class="classes"><slot /></Link>
</template>
