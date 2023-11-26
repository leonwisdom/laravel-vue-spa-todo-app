<script setup>
import { ref, computed, onMounted, nextTick } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextAreaInput from '@/Components/TextAreaInput.vue';
import * as dayjs from 'dayjs'
import { MenuItem } from '@headlessui/vue'
import { PencilIcon, TrashIcon, ArrowUturnDownIcon } from '@heroicons/vue/20/solid';
import Modal from '@/Components/Modal.vue';
import OptionMenu from '@/Components/OptionMenu.vue';
import Checkbox from '@/Components/Checkbox.vue';
import Flash from '@/Components/Flash.vue';

const notes = ref(usePage().props.notes);
const input = ref("");
const showArchived = ref(false);
const isOpen = ref(false)
const toggleEditNote = ref(null);
const form = useForm({
    title: '',
    body: '',
    id: '',
    type: 'store',
});
const myInput = ref(null);
const filteredNotes = computed(() => {
    return notes.value.filter((note) => {
        const matchesSearch = (
            note.title.toLowerCase().includes(input.value.toLowerCase()) ||
            note.body.toLowerCase().includes(input.value.toLowerCase())
        );

        const notArchived = !note.deleted_at;

        return matchesSearch && (showArchived.value || notArchived);
    });
});

onMounted(() => {
    nextTick(() => {
        focusInput();
    });
});

const focusInput = () => {
    myInput.value.focus();
};

const closeDeleteNoteModal = () => {
    isOpen.value = false;
    form.id = '';
    form.title = '';
    form.type = '';
}

const openDeleteModal = (index) => {
    isOpen.value = true;
    form.id = notes.value[index].id;
    form.title = notes.value[index].title;
    form.type = 'destroy';
}

const editNote = (index) => {
    toggleEditNote.value = true;
    form.title = notes.value[index].title;
    form.body = notes.value[index].body;
    form.id = notes.value[index].id;
    form.type = 'update';
};

const cancelEditNote = () => {
    form.reset();
    toggleEditNote.value = false;
};

const deleteNote = () => {
    submit();
    closeDeleteNoteModal();
};

const restoreNote = (index) => {
    form.id = notes.value[index].id;
    form.type = 'restore';
    submit();
};

const onSubmitSuccess = (form, props) => {
    form.reset();
    notes.value = [...props.notes];
    toggleEditNote.value = false;
};

const submit = () => {
    if (form.type === 'update') {
        form.patch(route('note.update', form.id), {
            onSuccess: ({ props }) => {
                onSubmitSuccess(form, props);
            }
        });
    } else if (form.type === 'destroy') {
        form.delete(route('note.destroy', form.id), {
            onSuccess: ({ props }) => {
                onSubmitSuccess(form, props);
            }
        });
    } else if (form.type === 'restore') {
        form.post(route('note.restore'), {
            onSuccess: ({ props }) => {
                onSubmitSuccess(form, props);
            }
        });
    } else {
        form.post(route('note.store'), {
            onSuccess: ({ props }) => {
                onSubmitSuccess(form, props);
            }
        });
    }
    focusInput();
};
</script>

<template>
    <Head title="Notes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">To-do List</h2>
        </template>

        <Modal :show="isOpen" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    Are you sure you want to delete your to-do: {{ form.title }}?
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Notes that are deleted can be restored by clicking the restore button in the options menu.
                </p>

                <div class="mt-6 flex justify-end">
                    <SecondaryButton class="me-auto" @click="closeModal">Cancel</SecondaryButton>

                    <PrimaryButton class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        @click="deleteNote">
                        Delete Note
                    </PrimaryButton>
                </div>
            </div>
        </Modal>

        <div class="pt-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h3 class="font-medium pb-5 text-lg tracking-tight text-gray-900 leading-tight">
                    Create Your To-Do's Here
                </h3>

                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div>
                        <form class="pb-6" @submit.prevent="submit">
                            <div>
                                <InputLabel for="title" value="Title" />

                                <TextInput ref="myInput" id="title" type="text" class="mt-1 block w-full"
                                    v-model="form.title" required autofocus autocomplete="username" />

                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="body" value="Body" />

                                <TextAreaInput id="body" type="text" class="mt-1 block w-full" v-model="form.body" required
                                    autocomplete="body" />

                                <InputError class="mt-2" :message="form.errors.body" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <SecondaryButton @click="cancelEditNote" v-if="toggleEditNote" class="me-auto"
                                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Cancel
                                </SecondaryButton>
                                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing">
                                    Submit
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>

                <Flash v-if="$page.props?.flash?.message" :type="$page.props.flash.type" :message="$page.props.flash.message"></Flash>
            </div>
        </div>

        <div class="pt-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <TextInput id="searchNotes" type="text" class="my-3 block w-full" v-model="input"
                    placeholder="Search Notes..." required autofocus autocomplete="username" />

                <div class="flex items-center justify-center bg-gray-200">
                    <div class="rounded-lg p-5 bg-white w-full">
                        <div class="flex items-center space-x-2">
                            <div class="space-y-0.5 flex-1">
                                <h3
                                    class="font-medium flex items-center text-lg tracking-tight text-gray-900 leading-tight">
                                    Your Saved To-Do's <span class="ms-auto text-sm">Show archived: <Checkbox
                                            v-model:checked="showArchived"></Checkbox></span>
                                </h3>
                            </div>
                        </div>

                        <div v-if="filteredNotes.length" class="mt-5 grid gap-3.5">
                            <div v-for="(note, index) in filteredNotes" :key="note">
                                <div class="relative rounded-lg bg-gray-100">

                                    <OptionMenu container-class="m-2 absolute top-0 right-0 text-left">
                                        <div v-if="note.deleted_at" class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                            <button @click="restoreNote(index)" :class="[
                                                active ? 'bg-gray-800 dark:bg-gray-200 text-white' : 'hover:text-white text-gray-800',
                                                'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                            ]">
                                                <ArrowUturnDownIcon :active="active"
                                                    class="mr-2 h-5 w-5 text-gray-400 hover:text-white "
                                                    aria-hidden="true" />
                                                Restore
                                            </button>
                                            </MenuItem>
                                        </div>
                                        <div v-if="!note.deleted_at" class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                            <button @click="editNote(index)" :class="[
                                                active ? 'bg-gray-800 dark:bg-gray-200 text-white' : 'hover:text-white text-gray-800',
                                                'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                            ]">
                                                <PencilIcon :active="active"
                                                    class="mr-2 h-5 w-5 text-gray-400 hover:text-white "
                                                    aria-hidden="true" />
                                                Edit
                                            </button>
                                            </MenuItem>
                                        </div>
                                        <div v-if="!note.deleted_at" class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                            <button @click="openDeleteModal(index)" :class="[
                                                active ? 'bg-gray-800 dark:bg-gray-200 text-white' : 'hover:text-white text-gray-800',
                                                'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                            ]">
                                                <TrashIcon :active="active"
                                                    class="mr-2 h-5 w-5 text-gray-400 hover:text-white "
                                                    aria-hidden="true" />
                                                Delete
                                            </button>
                                            </MenuItem>
                                        </div>
                                    </OptionMenu>

                                    <div class="flex items-center space-x-4 p-3.5">
                                        <div v-if="note.deleted_at" class="flex flex-col flex-1">
                                            <h3 class="text-lg text-gray-700 font-medium">{{ note.title }} - <span
                                                    class="text-sm text-indigo-400">Archived</span></h3>
                                        </div>
                                        <div v-else>
                                            <h3 class="text-lg text-gray-800 font-medium">{{ note.title }}</h3>
                                            <div>{{ note.deleted_at }}</div>
                                            <p class="text-md text-gray-600">
                                                {{ note.body }}
                                            </p>
                                            <div class="divide-x divide-gray-200 mt-auto">
                                                <span
                                                    class="inline-block px-3 text-sm leading-none text-gray-400 font-normal first:pl-0">
                                                    Created: {{ dayjs(note.created_at).format('DD/MM/YYYY HH:mm') }}
                                                </span>
                                                <span
                                                    class="inline-block px-3 text-sm leading-none text-gray-400 font-normal first:pl-0">
                                                    Updated: {{ dayjs(note.updated_at).format('DD/MM/YYYY HH:mm') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div v-else class="py-5">
                            No results found
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
