<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,Link } from '@inertiajs/vue3';
import moment from 'moment';
defineProps({
    posts: {
        type: Array,
        required: true
    }
})


</script>

<template>

    <Head title="Mis Posts" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Mis Posts
            </h2>

            <SecondaryButton>
                <Link 
                    :href="route('post.create')"
                    >
                    
                    <!-- class="text-white bg-green-600 px-4 py-2 rounded-xl" -->
                    Nuevo Post
                </Link>

            </SecondaryButton>

            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div v-if="!posts.length"class=" overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 p-4">
                <span class="my-2 p-6 text-gray-900 dark:text-gray-100 flex flex-wrap gap-2 rounded-xl">
                    
                    No se encontraron posts

                </span>
                </div>
                <div v-else class=" overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 p-4">
                    <div v-for="post in posts"
                        class="my-2 p-6 bg-neutral-500 text-gray-900 dark:text-gray-100 flex flex-wrap gap-2 rounded-xl">

                        <h3 class="mb-1 w-full">
                            {{ post.title }}
                        </h3>
                        <div>
                            <p v-html="post.content"></p>
                        </div>
                        <div class="text-end p-2 w-full">
                            <span class="block">
                                <h5>{{ post.creator.name }} <vue-feather :type="post.visibility_icon" /> </h5>
                                <h6>{{ moment(post.created_at).format("d MM YYYY") }}</h6>
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
