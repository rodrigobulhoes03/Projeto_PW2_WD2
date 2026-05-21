<script setup lang="ts">
import { ref, onMounted } from 'vue'

const token = ref('')
const quizHistory = ref([])
const selectedQuiz = ref(null)

const fetchHistory = async () => {
    const response = await fetch('/api/quizzes/history', {
        headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${token.value}`
        }
    })
    const data = await response.json()
    quizHistory.value = data
}

onMounted(async () => {
    token.value = localStorage.getItem('token') ?? ''
    await fetchHistory()
})

const viewQuizDetails = async (quizId: number) => {
    const response = await fetch(`/api/quizzes/${quizId}`, {
        headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${token.value}`
        }
    })
    const data = await response.json()
    selectedQuiz.value = data
}

const closeDetails = () => {
    selectedQuiz.value = null
}
</script>

<template>
    <section class="relative min-h-screen p-4 sm:p-10 bg-blue-100">

        <div class="bg-white p-4 sm:p-5 rounded-2xl shadow-md flex flex-wrap justify-between items-center gap-3 mb-6 sm:mb-10">
            <div class="flex items-center gap-3">
                <div class="p-3 rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 shadow-lg">
                    <img src="quiz.png" alt="logo" class="w-6 h-6 invert">
                </div>
                <div class="flex flex-col">
                    <span class="font-bold text-blue-600 text-xl">QuizHub</span>
                    <span class="text-xs text-gray-400">Reveja os seus resultados</span>
                </div>
            </div>
            <a href="/dashboard" class="bg-blue-500 p-2 px-6 rounded-xl text-sm font-bold text-white hover:bg-blue-600 transition shadow-md">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>

        <div v-if="quizHistory.length === 0" class="bg-white rounded-2xl shadow-md p-6 sm:p-20">
            <div class="flex flex-col items-center justify-center py-16 sm:py-25 border-4 border-dashed border-blue-200 rounded-2xl bg-blue-50">
                <div class="p-6 sm:p-8 rounded-full bg-white shadow-md mb-4">
                    <i class="fa-solid fa-trophy text-blue-400 text-5xl sm:text-6xl"></i>
                </div>
                <p class="font-semibold text-blue-600 mb-1 text-xl sm:text-3xl text-center">Ainda não realizou nenhum quiz</p>
                <p class="text-gray-400 text-sm text-center">Comece agora e acompanhe o seu progresso!</p>
            </div>
        </div>

        <div v-else class="flex flex-col gap-4">
            <div
                v-for="quiz in quizHistory"
                :key="quiz.id"
                class="bg-white p-4 sm:p-6 rounded-2xl shadow-md flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4"
            >
                <div class="flex items-center gap-4 sm:gap-5 min-w-0">
                    <div class="p-3 sm:p-4 rounded-2xl bg-blue-100 flex-shrink-0">
                        <i class="fa-solid fa-layer-group text-blue-600 text-lg sm:text-xl"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="font-bold text-gray-800 text-base sm:text-lg truncate">{{ quiz.category.name }}</p>
                        <p class="text-gray-400 text-sm mt-1">
                            <i class="fa-solid fa-calendar-days mr-1"></i>
                            {{ new Date(quiz.completed_at).toLocaleDateString('pt-PT') }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-between sm:justify-end gap-4 sm:gap-6 border-t border-gray-100 pt-3 sm:border-0 sm:pt-0">
                    <div class="text-center">
                        <p class="text-2xl sm:text-3xl font-bold text-blue-600">{{ quiz.score }}<span class="text-base sm:text-lg text-gray-400">/8</span></p>
                        <p class="text-xs text-gray-400">pontuação</p>
                    </div>

                    <button
                        @click="viewQuizDetails(quiz.id)"
                        class="bg-blue-50 border border-blue-200 px-4 sm:px-5 py-2 rounded-xl text-sm font-semibold text-blue-600 hover:bg-blue-100 transition whitespace-nowrap"
                    >
                        Ver detalhes
                    </button>
                </div>
            </div>
        </div>

        <div
            v-if="selectedQuiz"
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4 sm:p-6"
            @click.self="closeDetails"
        >
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto p-5 sm:p-8">

                <div class="flex items-start justify-between gap-4 mb-6">
                    <div class="min-w-0">
                        <p class="font-bold text-xl sm:text-2xl text-gray-800 break-words">{{ selectedQuiz.category.name }}</p>
                        <p class="text-gray-400 text-sm mt-1">
                            Pontuação: <span class="font-bold text-blue-600">{{ selectedQuiz.score }}/8</span>
                        </p>
                    </div>
                    <button @click="closeDetails" class="p-2 rounded-xl hover:bg-gray-100 transition flex-shrink-0">
                        <i class="fa-solid fa-xmark text-gray-400 text-xl"></i>
                    </button>
                </div>

                <div class="flex flex-col gap-4">
                    <div
                        v-for="(answer, index) in selectedQuiz.answer_submits"
                        :key="answer.id"
                        class="p-4 sm:p-5 rounded-2xl border-2"
                        :class="answer.option.is_correct ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50'"
                    >
                        <div class="flex items-start gap-3 mb-3">
                            <span class="w-7 h-7 rounded-lg bg-white shadow text-sm font-bold flex items-center justify-center flex-shrink-0 text-gray-600">
                                {{ index + 1 }}
                            </span>
                            <p class="font-semibold text-gray-800 text-sm sm:text-base">{{ answer.question.body }}</p>
                        </div>

                        <div class="flex items-center gap-2 ml-10">
                            <i
                                :class="answer.option.is_correct
                                    ? 'fa-solid fa-circle-check text-green-500'
                                    : 'fa-solid fa-circle-xmark text-red-500'"
                            ></i>
                            <p class="text-sm font-medium" :class="answer.option.is_correct ? 'text-green-700' : 'text-red-700'">
                                {{ answer.option.text }}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
