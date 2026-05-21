<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'

const token         = ref('')
const quizId        = ref<number | null>(null)
const questions     = ref([])
const selectedAnswers = ref<Record<number, number>>({}) // { question_id: option_id }
const errorMessage  = ref('')


const answeredCount = computed(() => Object.keys(selectedAnswers.value).length)
const totalCount    = computed(() => questions.value.length)
const allAnswered   = computed(() => answeredCount.value === totalCount.value && totalCount.value > 0)

onMounted(() => {
    token.value  = localStorage.getItem('token') ?? ''
    quizId.value = Number(localStorage.getItem('quiz_id'))

    const savedQuestions = localStorage.getItem('quiz_questions')

    if (!quizId.value || !savedQuestions) {
        router.visit('/dashboard')
        return
    }

    questions.value = JSON.parse(savedQuestions)
})

const selectAnswer = (questionId: number, optionId: number) => {
    selectedAnswers.value[questionId] = optionId
}

const submitQuiz = async () => {
    if (!allAnswered.value) {
        errorMessage.value = 'Por favor responde a todas as perguntas antes de submeter.'
        return
    }

    errorMessage.value = ''

    const answers = Object.entries(selectedAnswers.value).map(([questionId, optionId]) => ({
        question_id: Number(questionId),
        option_id:   optionId,
    }))

    try {
        const response = await fetch(`/api/quizzes/${quizId.value}/submit`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token.value}`
            },
            body: JSON.stringify({ answer: answers })
        })

        const data = await response.json()

        if (!response.ok) {
            errorMessage.value = data.message || 'Erro ao submeter o quiz.'
            return
        }

        localStorage.setItem('quiz_score', data.score)
        localStorage.setItem('quiz_total', data.total)
        localStorage.removeItem('quiz_questions')

        router.visit('/dashboard')

    } catch (error: any) {
        errorMessage.value = 'Erro ao submeter o quiz.'
    }
}
</script>

<template>
    <section class="relative min-h-screen p-10 bg-blue-100">

        <div class="bg-white p-5 rounded-2xl shadow-md flex justify-between items-center mb-10">
            <div class="flex items-center gap-3">
                <div class="p-3 rounded-xl bg-gradient-to-br from-blue-400 to-blue-600 shadow-lg">
                    <img src="quiz.png" alt="logo" class="w-6 h-6 invert">
                </div>
                <div class="flex flex-col">
                    <span class="font-bold text-blue-600 text-xl">QuizHub</span>
                    <span class="text-xs text-gray-400">A responder ao quiz</span>
                </div>
            </div>
            <div class="flex items-center gap-3 text-sm text-gray-500 font-medium">
                <i class="fa-solid fa-circle-check text-blue-400"></i>
                {{ answeredCount }} / {{ totalCount }} respondidas
            </div>
        </div>


        <div class="flex flex-col gap-6">
            <div
                v-for="(question, index) in questions"
                :key="question.id"
                class="bg-white p-8 rounded-3xl shadow-md"
            >

                <div class="flex items-center gap-3 mb-6">
                    <span class="w-9 h-9 rounded-xl bg-blue-100 text-blue-600 font-bold text-sm flex items-center justify-center flex-shrink-0">
                        {{ index + 1 }}
                    </span>
                    <p class="font-semibold text-gray-800 text-lg">{{ question.body }}</p>
                </div>


                <div class="flex flex-col gap-3">
                    <button
                        v-for="option in question.options"
                        :key="option.id"
                        @click="selectAnswer(question.id, option.id)"
                        :class="[
                            'w-full text-left p-4 rounded-xl border-2 transition-all duration-150 font-medium',
                            selectedAnswers[question.id] === option.id
                                ? 'border-blue-500 bg-blue-50 text-blue-700'
                                : 'border-gray-200 bg-gray-50 text-gray-700 hover:border-blue-300 hover:bg-blue-50'
                        ]"
                    >
                        {{ option.text }}
                    </button>
                </div>
            </div>
        </div>


        <div class="mt-8 flex flex-col items-center gap-3">
            <p v-if="errorMessage" class="text-red-500 text-sm">{{ errorMessage }}</p>
            <button
                @click="submitQuiz"
                :disabled="!allAnswered"
                :class="[
                    'px-10 py-4 rounded-2xl font-bold text-white text-lg shadow-md transition-all duration-200',
                    allAnswered
                        ? 'bg-blue-500 hover:bg-blue-600 hover:-translate-y-1'
                        : 'bg-gray-300 cursor-not-allowed'
                ]"
            >
                <i class="fa-solid fa-paper-plane mr-2"></i> Submeter Quiz
            </button>
            <p v-if="!allAnswered" class="text-xs text-gray-400">
                Faltam {{ totalCount - answeredCount }} perguntas por responder
            </p>
        </div>

    </section>
</template>

<style scoped>

</style>
