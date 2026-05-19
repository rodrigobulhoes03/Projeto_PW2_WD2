<script lang="ts">

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
                <a href="#" class="border border-blue-200 p-2 px-4 rounded-xl text-sm text-blue-600 hover:bg-blue-50 transition flex items-center gap-2">
                    <i class="fa-solid fa-clock-rotate-left"></i> Histórico
                </a>
                <div class="flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-200 text-sm font-bold text-gray-500">
                    <i class="fa-solid fa-circle-user text-lg text-grey-400"></i>
                </div>
                <a href="#" class="bg-red-500 p-2 px-6 rounded-xl text-sm font-bold text-white hover:bg-red-600 transition shadow-md">
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
                    <p class="text-4xl font-bold text-blue-600">0</p>
                </div>
            </div>
            <div class="flex-1 bg-white p-6 rounded-2xl shadow-md flex items-center gap-5 border border-blue-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-200">
                <div class="p-4 rounded-2xl bg-gradient-to-br from-blue-400 to-blue-600 shadow-md">
                    <i class="fa-solid fa-book-open text-white text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-400 text-sm mb-1">Categorias Disponíveis</p>
                    <p class="text-4xl font-bold text-blue-600">0</p>
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
            <div class="flex flex-col items-center justify-center py-16 border-2 border-dashed border-blue-200 rounded-2xl bg-blue-50">
                <div class="p-6 rounded-full bg-white shadow-md mb-4">
                    <i class="fa-solid fa-book-open text-blue-400 text-4xl"></i>
                </div>
                <p class="font-semibold text-blue-600 mb-1">Nenhuma categoria disponível</p>
                <p class="text-gray-400 text-sm">O administrador ainda não criou categorias</p>
            </div>
        </div>
    </section>

</template>

<style scoped>

</style>
