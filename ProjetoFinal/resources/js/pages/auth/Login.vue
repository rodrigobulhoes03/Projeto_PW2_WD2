<script setup lang="ts">
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

const email = ref('')
const password = ref('')

const login = async () => {
    const response = await fetch('/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
        body: JSON.stringify({
            email: email.value,
            password: password.value,
        })
    })

    const data = await response.json()

    if (!response.ok) return

    localStorage.setItem('token', data.token)
    localStorage.setItem('user', JSON.stringify(data.user))

    if (data.user.is_admin) {
        router.visit('/dashboardAdmin')
    } else {
        router.visit('/dashboard')
    }
}
</script>

<template>
    <div class="h-screen overflow-hidden relative bg-gray-100 flex flex-col justify-center items-center px-4">
        <div class="absolute -top-20 -left-20 w-80 h-80 bg-blue-400 opacity-30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-blue-400 opacity-30 rounded-full blur-3xl"></div>
        <section class="relative z-10 flex flex-col items-center w-full">
            <div class="flex flex-col items-center mb-12">
                <div class="bg-gradient-to-br from-blue-400 to-blue-600 shadow-lg p-3 rounded-2xl mb-4">
                    <img src="quiz.png" alt="logo" class="w-8 h-8 invert">
                </div>
                <h1 class="text-4xl font-bold text-blue-600 tracking-tight">QuizHub</h1>
            </div>
            <article class="w-full max-w-lg min-h-84 rounded overflow-hidden shadow-lg">
                <div class="flex flex-col items-center gap-4 mb-3 rounded-md">
                    <i class="fa-solid fa-circle-user text-2xl text-blue-400"></i>
                    <h2 class="text-2xl font-bold text-blue-600">Iniciar Sessão</h2>
                    <p class="text-sm text-gray-500">Bem-vindo de volta ao sistema</p>
                </div>
                <form class="flex flex-col items-center gap-4" @submit.prevent="login">
                    <div>
                        <label class="block text-sm font-medium text-blue-600 mb-1">Endereço de Email</label>
                        <input v-model="email" class="w-64 max-w-full border border-blue-400 rounded-md px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" type="email" placeholder="Email" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-blue-600 mb-1">Palavra-Passe</label>
                        <input v-model="password" class="w-64 max-w-full border border-blue-400 rounded-md px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" type="password" placeholder="••••••••" required>
                    </div>
                    <button class="bg-blue-600 hover:bg-blue-400 text-white font-medium px-8 py-2 rounded-md cursor-pointer transition-colors mb-2" type="submit">
                        Login
                    </button>
                    <p class="text-center text-sm text-gray-500 mt-2 mb-4">
                        Não tem conta?
                        <a href="/register" class="text-blue-600 font-medium hover:text-blue-400 transition-colors">Registe-se</a>
                    </p>
                </form>
            </article>
        </section>
    </div>
</template>

<style scoped>

</style>
