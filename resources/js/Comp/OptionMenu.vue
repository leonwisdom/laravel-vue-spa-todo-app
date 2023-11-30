
<script setup>
import {
    Menu, MenuButton, MenuItems
} from '@headlessui/vue'
import { ChevronDownIcon, EllipsisHorizontalIcon } from '@heroicons/vue/20/solid';

const props = defineProps({
    containerClass: {
        type: String,
        default: ''
    }
})
</script>

<template>
    <Menu as="div" :class="containerClass">
        <div>
            <MenuButton
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                <EllipsisHorizontalIcon />
                <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5 text-gray-200 hover:text-gray-100" aria-hidden="true" />
            </MenuButton>
        </div>

        <transition enter-active-class="transition duration-100 ease-out" enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100" leave-active-class="transition duration-75 ease-in"
            leave-from-class="transform scale-100 opacity-100" leave-to-class="transform scale-95 opacity-0">
            <MenuItems
                class="absolute z-10 right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                <div class="px-1 py-1">
                    <slot />
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>