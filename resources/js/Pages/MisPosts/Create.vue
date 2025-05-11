@use(App\Models\Post)
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Dropdown.vue';
import RadioButton from '@/Components/RadioButton.vue'
import { Head,useForm,Link } from '@inertiajs/vue3';
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

defineProps({
    visibility: {
        type: Array,
        required: true
    },
    post:{
        type: Object,
        required: true
    }
})


const form = useForm({
    title:"",
    content: "",
    visibility: ""
})

</script>

<template>

    <Head title="Nuevo post" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Nuevo post
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class=" overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800 p-4">
                    <form @submit.prevent="form.post(route('post.store'))">
            <div>
                <InputLabel for="title" value="title" />

                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    required
                    autofocus
                    autocomplete="username"
                />

           
            </div>

            <div class="mt-4">
                <InputLabel for="visible" value="visible" />

                <div v-if="visibility" class="flex gap-2">

                    <RadioButton v-for="(item,key) in visibility"
                    v-model="form.visibility" :value="key" :label="item.label" :icon="item.icon" />

                </div>

            </div>


            <div class="mt-4">
                <InputLabel for="content" value="content" />

                <QuillEditor theme="snow" 
                    v-model:content="form.content"
                    contentType="html"
                    class="text-gray-900 dark:text-gray-100 focus:ring-indigo-500 dark:bg-gray-900 dark:text-gray-300 dark:focus:ring-indigo-600"
                ></QuillEditor>
 
            </div>
            
             <div class="mt-4 flex items-center justify-between px-4">
                <SecondaryButton>
                    <Link
                        :href="route('mis-posts')"
                        >
                        Return
                    </Link> 
                </SecondaryButton>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    >
                    Save
                </PrimaryButton>
            </div>
        </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
