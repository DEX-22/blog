<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import moment from 'moment';


defineProps({
    posts: {
        type: Array,
        required: true
    }
})


</script>

<template>

    <Head title="Inicio" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Inicio
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class=" overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 p-4">
                    <div v-for="post in posts"
                        class="my-2 p-6 border border-neutral-500 text-gray-900 dark:text-gray-100 flex flex-wrap gap-2 rounded-xl">

                        <h3 class="mb-1">
                            {{ post.title }}
                        </h3>
                        <div>
                            <p v-html="post.content"></p>
                        </div>
                        <div class="flex justify-end p-2 w-full gap-2"> 
                            
                                <small>{{ post.creator.name }}</small>
                                <vue-feather :type="post.visibility_icon" class="w-4 h-4" />
                                <small>{{ moment(post.created_at).format("d/MM/Y hh:mm A") }}</small>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
