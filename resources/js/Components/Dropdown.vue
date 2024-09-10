<template>
    <div>
        <ul class="flex items-center flex-shrink-0 space-x-6">
            <!-- Dark mode toggle -->
            <li class="relative">
                <slot name="toggleDark"/>
            </li>
            <!-- Profile menu -->
            <li class="relative">
                <div @click="open = !open">
                    <slot name="trigger" />
                </div>
                <transition leave-active-class="transition duration-150 ease-in" leave-from-class="opacity-100"
                    leave-to-class="opacity-0">
                    <ul v-show="open"
                        class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md"
                        aria-label="submenu">
                        <li>
                            <slot name="content" />
                        </li>
                    </ul>
                </transition>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { onMounted, onUnmounted, ref } from 'vue'

const open = ref(false)

const closeOnEscape = (e) => {
    if (open.value && e.keyCode === 27) {
        open.value = false
    }
}

onMounted(() => document.addEventListener('keydown', closeOnEscape))
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape))
</script>
