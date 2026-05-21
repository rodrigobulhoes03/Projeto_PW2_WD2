<script setup lang="ts">
import { ref, onMounted } from 'vue'

const token = ref('')

const questionTitle = ref('')
const categoryName = ref('')
const answerOptions = ref(['', '', '', ''])
const correctIndex = ref<number | null>(null)
const errorMessage = ref('')

const totalQuestions = ref(0)
const totalCategories = ref(0)
const categoryList = ref<{ id: number; name: string }[]>([])

const fetchQuestions = async () => {
    const response = await fetch('/api/questions', {
        headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${token.value}`
        }
    })
    const data = await response.json()
    totalQuestions.value = data.length
}

const fetchCategories = async () => {
    const response = await fetch('/api/categories', {
        headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${token.value}`
        }
    })
    const data = await response.json()
    totalCategories.value = data.length
    categoryList.value = data
}

onMounted(async () => {
    token.value = localStorage.getItem('token') ?? ''

    try {
        await fetchQuestions()
        await fetchCategories()
    } catch (error: any) {
        errorMessage.value = 'Erro ao carregar os dados.'
    }
})

const submitQuestion = async () => {
    if (!questionTitle.value.trim()) {
        errorMessage.value = 'Por favor preenche a pergunta.'
        return
    }

    if (!categoryName.value.trim()) {
        errorMessage.value = 'Por favor preenche a categoria.'
        return
    }

    if (correctIndex.value === null) {
        errorMessage.value = 'Por favor seleciona a resposta correta.'
        return
    }

    errorMessage.value = ''

    let categoryId: number

    try {
        const existingCategory = categoryList.value.find(
            categor => categor.name.toLowerCase() === categoryName.value.toLowerCase()
        )

        if (existingCategory) {
            categoryId = existingCategory.id
        } else {
            const categoryResponse = await fetch('/api/categories', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token.value}`
                },
                body: JSON.stringify({ name: categoryName.value })
            })
            const newCategory = await categoryResponse.json()
            categoryList.value.push(newCategory)
            totalCategories.value++
            categoryId = newCategory.id
        }
    } catch (error: any) {
        errorMessage.value = 'Erro ao criar a categoria.'
        return
    }

    try {
        const options = answerOptions.value.map((text, index) => ({
            text,
            is_correct: index === correctIndex.value,
        }))

        const response = await fetch('/api/questions', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token.value}`
            },
            body: JSON.stringify({
                body:        questionTitle.value,
                category_id: categoryId,
                options,
            })
        })

        const data = await response.json()

        if (!response.ok) {
            errorMessage.value = data.message || 'Erro ao criar a pergunta.'
            return
        }

        totalQuestions.value++
        questionTitle.value = ''
        categoryName.value  = ''
        answerOptions.value = ['', '', '', '']
        correctIndex.value  = null

    } catch (error: any) {
        errorMessage.value = 'Erro ao criar a pergunta.'
    }
}

const logout = async () => {
    try {
        await fetch('/api/logout', {
            method: 'POST',
            headers: { 'Authorization': `Bearer ${token.value}` }
        })
        localStorage.removeItem('token')
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
                    <img src="quiz.png" alt="logotipo" class="w-6 h-6 invert">
                </div>
                <div class="flex flex-col">
                    <span class="font-bold text-blue-600 text-xl">QuizHub</span>
                    <span class="text-xs text-gray-400">Painel do Jogador</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-200 text-sm font-bold text-gray-500">
                    <i class="fa-solid fa-circle-user text-lg text-grey-400"></i> Administrador
                </div>
                <a @click.prevent="logout" href="#" class="bg-red-500 p-2 px-6 rounded-xl text-sm font-bold text-white hover:bg-red-600 transition shadow-md">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Sair
                </a>
            </div>
        </div>
        <div class="flex flex-col md:flex-row gap-10">

            <div class="w-full flex gap-10">
                <div class="flex-1 bg-white p-10 rounded-3xl shadow-lg h-175 relative">
                    <div class="flex items-center mb-6 mt-2 gap-4">
                        <label class="p-4 rounded-2xl shadow-lg w-13 bg-blue-100">
                            <i class="fa-solid fa-question text-blue-600"></i>
                        </label>
                        <p class="font-bold text-2xl text-black ">Criar Nova Pergunta</p>
                    </div>
                    <form class="flex flex-col gap-3" @submit.prevent="submitQuestion">
                        <label class="text-black">Pergunta</label>
                        <input v-model="questionTitle" class="bg-gray-50 border border-gray-300 p-3 rounded-xl outline-none" type="text">
                        <label class="text-black">Categoria</label>
                        <input v-model="categoryName" class="bg-gray-50 border border-gray-300 p-3 rounded-xl outline-none" type="text" placeholder="Ex: História, Ciências, Geografia...">
                        <label class="text-black">Opções de Resposta</label>
                        <div class="flex items-center gap-2">
                            <input type="radio" name="resposta" :value="0" v-model="correctIndex" class="w-4 h-4 accent-blue-600 cursor-pointer flex-shrink-0">
                            <input v-model="answerOptions[0]" class="bg-gray-50 border border-gray-300  p-3 rounded-xl outline-none flex-1" type="text" placeholder="Opção 1">
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="radio" name="resposta" :value="1" v-model="correctIndex" class="w-4 h-4 accent-blue-600 cursor-pointer flex-shrink-0">
                            <input v-model="answerOptions[1]" class="bg-gray-50 border border-gray-300 p-3 rounded-xl outline-none flex-1" type="text" placeholder="Opção 2">
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="radio" name="resposta" :value="2" v-model="correctIndex" class="w-4 h-4 accent-blue-600 cursor-pointer flex-shrink-0">
                            <input v-model="answerOptions[2]" class="bg-gray-50 border border-gray-300 p-3 rounded-xl outline-none flex-1" type="text" placeholder="Opção 3">
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="radio" name="resposta" :value="3" v-model="correctIndex" class="w-4 h-4 accent-blue-600 cursor-pointer flex-shrink-0">
                            <input v-model="answerOptions[3]" class="bg-gray-50 border border-gray-300 p-3 rounded-xl outline-none flex-1" type="text" placeholder="Opção 4">
                        </div>
                        <p v-if="errorMessage" class="text-red-500 text-sm">{{ errorMessage }}</p>
                        <label class="text-sm text-gray-700">Selecione a resposta correta</label>
                        <button class="bg-blue-500 p-3 px-6 rounded-xl text-sm font-bold text-white hover:bg-blue-600 transition shadow-md">
                            <i class="fa-regular fa-circle-check"></i> Criar Pergunta
                        </button>
                    </form>
                </div>
                <div class="flex-1 bg-white p-10 rounded-3xl shadow-lg h-175 relative">
                    <div class="flex items-center mb-6 mt-2 gap-4">
                        <label class="p-4 rounded-2xl shadow-lg w-13 bg-blue-100 ">
                            <i class="fa-solid fa-chart-simple text-blue-600"></i>
                        </label>
                        <p class="font-bold text-2xl text-black ">Estatísticas</p>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-1 bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-2xl text-white">
                            <p class="text-sm opacity-80">Total de Perguntas</p>
                            <p class="text-4xl font-bold mt-2">{{ totalQuestions }}</p>
                        </div>
                        <div class="flex-1 bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-2xl text-white">
                            <p class="text-sm opacity-80">Categorias</p>
                            <p class="text-4xl font-bold mt-2">{{ totalCategories }}</p>
                        </div>
                    </div>
                    <p class="text-xl font-bold mt-10">Categorias Disponíveis</p>
                    <div v-if="categoryList.length === 0" class="flex flex-col items-center justify-center py-10 mt-8 text-gray-400">
                        <i class="fa-regular fa-folder-open text-5xl mb-3"></i>
                        <p class="text-sm">Nenhuma categoria criada ainda</p>
                    </div>
                    <div v-else class="flex flex-wrap gap-2 mt-4">
                        <span v-for="categor in categoryList" :key="categor.id"
                              class="px-4 py-2 bg-blue-100 text-blue-700 rounded-xl text-sm font-semibold">
                            {{ categor.name }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

<style scoped>

</style>
