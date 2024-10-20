<script setup>
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import TextInput from "../Components/TextInput.vue";
import ClientLayout from '../../Shared/ClientLayout.vue';

const params = defineProps({
	type: Number,
});

defineOptions({ layout: ClientLayout });
const form = useForm({
    email: null,
    password: null,
    type: params.type
});

const regform = useForm({
    type: params.type
});
const { props } = usePage();
const submit = async () => {
    await form.post(route("login"), {
        onError: () => form.reset("password"),
        onSuccess: () => {
            const user = props.value['auth.user'];
            window.Laravel = {
                auth: {
                    user: user ? { ...user } : null
                }
            };
        }
    });
};

function getType(type) {
    return type == 0 ? "User" : "Admin";
}

function goToRegister() {
    regform.get(route('register')); 
}

</script>

<template>
    <Head title="Login" />

    <div class="relative w-full h-screen bg-cover bg-center" style="background-image: url('/storage/images/home_bg.png');">
        <div class="flex items-center justify-center w-full h-full">
            <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
                <a class="p-1 mr-2 rounded-full bg-white border-2 border-gray-500 cursor-pointer" :href="route('home')">
                    <i class="fas fa-arrow-left w-5 h-5 text-center mr-1 text-gray-500"></i>
                </a>
                <span>{{ getType(type) }} Login</span>
                <div class="mt-6 text-center">
                    <img src="/storage/images/meo_home_logo.png" alt="Additional Image" class="mx-auto w-40" />
                </div>
                <h1 class="text-xl font-semibold text-center mb-3">Login to your account</h1>
                <form @submit.prevent="submit">
                    <div class="mb-6">
                        <TextInput name="Username" v-model="form.email" :message="form.errors.email" />
                    </div>
                    <div class="mb-6">
                        <TextInput name="password" type="password" v-model="form.password" :message="form.errors.password" />
                    </div>
                    <div class="flex flex-col items-center">
                        <button class="primary-btn">Login</button>
                        <p class="text-slate-600 mt-2 text-center">
                            Need an account? <a @click="goToRegister" class="text-link cursor-pointer">Signup now</a>
                        </p>
                    </div>
                    <div class="text-center">
                        <img src="/storage/images/buildings.png" alt="Additional Image" class="mx-auto w-60" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style>
/* Optional: Custom styles for the background image */
.bg-cover {
    background-size: cover;
}
.bg-center {
    background-position: center;
}
</style>
