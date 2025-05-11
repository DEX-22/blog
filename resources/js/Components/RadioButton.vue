<script setup>
import { computed } from 'vue'

const emit = defineEmits(['update:modelValue'])

const props = defineProps({
  modelValue: {
    type: [String, Number],
    required: true
  },
  value: {
    type: [String, Number],
    required: true
  },
  label: {
    type: String,
    default: ''
  },
  icon: {
    type: String, // permite pasar componentes como Heroicons
    default: null
  }
})

const isSelected = computed(() => props.modelValue === props.value)

const toggle = () => {
  emit('update:modelValue', props.value)
}
</script>

<template>
  <button
    type="button"
    @click="toggle"
    :class="[
      'px-4 py-2 rounded-full border text-sm font-medium focus:outline-none focus:ring-2 transition-all',
      isSelected
        ? 'bg-indigo-600 text-white border-indigo-600 focus:ring-indigo-300'
        : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-100 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700'
    ]"
  >

  <vue-feather v-if="icon" :type="icon" :class="class" class="w-3 h-3"  />
    {{ label }}
  </button>
</template>
