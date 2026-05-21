<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'

const token = ref('')

const userName = ref('')
const categoryList = ref<{ id: number; name: string }[]>([])
const completedQuizzes = ref(0)
const errorMessage = ref('')

const fetchCategories = async () => {
    const response = await fetch('/api/categories', {
        headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${token.value}`
        }
    })
    const data = await response.json()
    categoryList.value = data
}

const fetchCompletedQuizzes = async () => {
    const response = await fetch('/api/quizzes/history', {
        headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${token.value}`
        }
    })
    const data = await response.json()
    completedQuizzes.value = data.length
}

onMounted(async () => {
    token.value    = localStorage.getItem('token') ?? ''
    userName.value = localStorage.getItem('user_name') ?? ''

    try {
        await fetchCategories()
        await fetchCompletedQuizzes()
    } catch (error: any) {
        errorMessage.value = 'Erro ao carregar os dados.'
    }
})

const startQuiz = async (categoryId: number) => {
    errorMessage.value = ''

    try {
        const response = await fetch('/api/quizzes/start', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token.value}`
            },
            body: JSON.stringify({ category_id: categoryId })
        })

        const data = await response.json()

        if (!response.ok) {
            errorMessage.value = data.message || 'Erro ao iniciar o quiz.'
            return
        }

        localStorage.setItem('quiz_id', data.quiz.id)
        localStorage.setItem('quiz_questions', JSON.stringify(data.questions))

        router.visit('/quiz')

    } catch (error: any) {
        errorMessage.value = 'Erro ao iniciar o quiz.'
    }
}

const logout = async () => {
    try {
        await fetch('/api/logout', {
            method: 'POST',
            headers: { 'Authorization': `Bearer ${token.value}` }
        })
        localStorage.removeItem('token')
        localStorage.removeItem('user_name')
        window.location.href = '/'
    } catch (error: any) {
        errorMessage.value = 'Erro ao fazer logout.'
    }
}
</script>

<template>
    <section class="relative min-h-screen p-10  bg-blue-100">

        <div class="bg-white p-5 rounded-2xl shadow-md flex justify-between items-center mb-10">
            <div class="flex items-center gap-3">
                <div class="p-3 rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 shadow-lg">
                    <img src="quiz.png" alt="logo" class="w-6 h-6 invert">
                </div>
                <div class="flex flex-col">
                    <span class="font-bold text-blue-600 text-xl">QuizHub</span>
                    <span class="text-xs text-gray-400">Painel do Jogador</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="/history" class="border border-blue-200 p-2 px-4 rounded-xl text-sm text-blue-600 hover:bg-blue-50 transition flex items-center gap-2">
                    <i class="fa-solid fa-clock-rotate-left"></i> Histórico
                </a>
                <div class="flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-200 text-sm font-bold text-gray-500">
                    <i class="fa-solid fa-circle-user text-lg text-grey-400"></i> {{ userName }}
                </div>
                <a @click.prevent="logout" href="#" class="bg-red-500 p-2 px-6 rounded-xl text-sm font-bold text-white hover:bg-red-600 transition shadow-md">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Sair
                </a>
            </div>
        </div>

        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-blue-600 mb-3">Bem-vindo de volta!</h1>
            <p class="text-blue-400 text-lg">Escolhe uma categoria e testa os teus conhecimentos</p>
        </div>

        <div class="flex gap-6 mb-10">
            <div class="flex-1 bg-white p-6 rounded-2xl shadow-md flex items-center gap-5 border border-blue-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-200">
                <div class="p-4 rounded-2xl bg-gradient-to-br from-blue-400 to-blue-600 shadow-md">
                    <i class="fa-solid fa-trophy text-white text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-400 text-sm mb-1">Quizzes Completados</p>
                    <p class="text-4xl font-bold text-blue-600">{{ completedQuizzes }}</p>
                </div>
            </div>
            <div class="flex-1 bg-white p-6 rounded-2xl shadow-md flex items-center gap-5 border border-blue-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-200">
                <div class="p-4 rounded-2xl bg-gradient-to-br from-blue-400 to-blue-600 shadow-md">
                    <i class="fa-solid fa-book-open text-white text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-400 text-sm mb-1">Categorias Disponíveis</p>
                    <p class="text-4xl font-bold text-blue-600">{{ categoryList.length }}</p>
                </div>
            </div>
            <div class="flex-1 bg-white p-6 rounded-2xl shadow-md flex items-center gap-5 border border-blue-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-200">
                <div class="p-4 rounded-2xl bg-gradient-to-br from-blue-400 to-blue-600 shadow-md">
                    <i class="fa-solid fa-bullseye text-white text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-400 text-sm mb-1">Perguntas por Quiz</p>
                    <p class="text-4xl font-bold text-blue-600">8</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-8">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-3 rounded-xl bg-blue-100">
                    <i class="fa-solid fa-layer-group text-blue-600"></i>
                </div>
                <h2 class="text-2xl font-bold text-blue-600">Escolha uma Categoria</h2>
            </div>

            <p v-if="errorMessage" class="text-red-500 text-sm mb-4">{{ errorMessage }}</p>

            <div v-if="categoryList.length === 0" class="flex flex-col items-center justify-center py-16 border-2 border-dashed border-blue-200 rounded-2xl bg-blue-50">
                <div class="p-6 rounded-full bg-white shadow-md mb-4">
                    <i class="fa-solid fa-book-open text-blue-400 text-4xl"></i>
                </div>
                <p class="font-semibold text-blue-600 mb-1">Nenhuma categoria disponível</p>
                <p class="text-gray-400 text-sm">O administrador ainda não criou categorias</p>
            </div>


            <div v-else class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <button
                    v-for="category in categoryList"
                    :key="category.id"
                    @click="startQuiz(category.id)"
                    class="bg-blue-50 border border-blue-200 p-6 rounded-2xl text-left hover:bg-blue-100 hover:border-blue-400 hover:-translate-y-1 transition-all duration-200 group"
                >
                    <div class="p-3 rounded-xl bg-blue-100 group-hover:bg-blue-200 w-fit mb-3 transition">
                        <i class="fa-solid fa-layer-group text-blue-600"></i>
                    </div>
                    <p class="font-bold text-blue-700">{{ category.name }}</p>
                    <p class="text-xs text-gray-400 mt-1">8 perguntas</p>
                </button>
            </div>
        </div>

    </section>
</template>

<style scoped>

</style>
