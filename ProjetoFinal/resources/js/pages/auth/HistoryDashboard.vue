<script lang="ts">

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
                    <span class="text-xs text-gray-400">Reveja os seus resultados</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="/dashboard" class="bg-blue-500 p-2 px-6 rounded-xl text-sm font-bold text-white hover:bg-blue-600 transition shadow-md">
                    <i class="fa-solid fa-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-md p-20">
            <div class="flex flex-col items-center justify-center py-25 border-4 border-dashed border-blue-200 rounded-2xl bg-blue-50">
                <div class="p-8 rounded-full bg-white shadow-md mb-4">
                    <i class="fa-solid fa-trophy text-blue-400 text-6xl" ></i>
                </div>
                <p class="font-semibold text-blue-600 mb-1 text-3xl">Anda não realizou nenhum quiz</p>
                <p class="text-gray-400 text-s">Comece agora e acompanhe o seu progresse!</p>
            </div>
        </div>
    </section>
</template>

<style scoped>

</style>
