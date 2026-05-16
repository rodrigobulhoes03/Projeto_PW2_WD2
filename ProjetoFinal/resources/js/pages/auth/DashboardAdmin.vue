<script lang="ts">
</script>

<template>
    <section class="relative min-h-screen p-10  bg-blue-100">
        <div class="bg-white p-5 rounded-2xl shadow-md flex justify-between items-center mb-10 border border-gray-50">
            <div class="flex items-center gap-3">
                <div class="p-2 rounded-xl shadow-lg mb-4 mt-4 bg-blue-400">
                    <img src="quiz.png" alt="logo" class="w-6 h-6 invert">
                </div>
                <div class="flex flex-col">
                   <span class="font-bold text-blue-600">QuizHub</span>
                   <span class=" text-xs text-gray-400">Painel de Administração</span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-200 text-sm font-bold text-gray-500">
                    <i class="fa-solid fa-circle-user text-lg text-grey-400"></i>
                    Administrador
                </div>
                <a href="#" class="flex items-center gap-2 bg-red-500 px-4 py-2 rounded-xl text-sm font-bold text-white hover:bg-red-600 transition">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Sair
                </a>
            </div>
        </div>
        <div class="flex flex-col md:flex-row gap-10">

            <div class="w-full flex gap-10">
                <div class="flex-1 bg-white p-10 rounded-3xl shadow-lg h-160 relative">
                    <div class="flex items-center mb-6 mt-2 gap-4">
                        <button class="p-4 rounded-2xl shadow-lg w-13 bg-blue-100 hover:bg-blue-200 transition">
                            <i class="fa-solid fa-plus text-l" style="color: #2f68ad;"></i>
                        </button>
                            <p class="font-bold text-2xl text-black ">Criar Nova Pergunta</p>
                    </div>
                    <form class="flex flex-col gap-3">
                        <label class="text-black">Pergunta</label>
                        <input  class="bg-gray-50 border border-gray-300 p-3 rounded-xl outline-none" type="text">
                        <label class="text-black">Categoria</label>
                        <input class="bg-gray-50 border border-gray-300 p-3 rounded-xl outline-none" type="text" placeholder="Ex: História, Ciências, Geografia...">
                        <label class="text-black">Opções de Resposta</label>
                        <div class="flex items-center gap-2">
                            <input type="radio" name="resposta" class="w-4 h-4 accent-blue-600 cursor-pointer flex-shrink-0">
                            <input class="bg-gray-50 border border-gray-300  p-3 rounded-xl outline-none flex-1" type="text" placeholder="Opção 1">
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="radio" name="resposta" class="w-4 h-4 accent-blue-600 cursor-pointer flex-shrink-0">
                            <input class="bg-gray-50 border border-gray-300 p-3 rounded-xl outline-none flex-1" type="text" placeholder="Opção 2">
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="radio" name="resposta" class="w-4 h-4 accent-blue-600 cursor-pointer flex-shrink-0">
                            <input class="bg-gray-50 border border-gray-300 p-3 rounded-xl outline-none flex-1" type="text" placeholder="Opção 3">
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="radio" name="resposta" class="w-4 h-4 accent-blue-600 cursor-pointer flex-shrink-0">
                            <input class="bg-gray-50 border border-gray-300 p-3 rounded-xl outline-none flex-1" type="text" placeholder="Opção 4">
                        </div>
                        <label class="text-sm text-gray-700">Selecione a resposta correta usando os botões á esquerda</label>
                    </form>
                </div>
                <div class="flex-1 bg-white p-10 rounded-3xl shadow-lg h-160 relative">
                    <div class="flex items-center mb-6 mt-2 gap-4">
                        <label class="p-4 rounded-2xl shadow-lg w-13 bg-blue-100 ">
                            <i class="fa-solid fa-chart-simple" style="color:#2f68ad ;"></i>
                        </label>
                        <p class="font-bold text-2xl text-black ">Estatísticas</p>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-1 bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-2xl text-white">
                            <p class="text-sm opacity-80">Total de Perguntas</p>
                            <p class="text-4xl font-bold mt-2">0</p>
                        </div>
                        <div class="flex-1 bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-2xl text-white">
                            <p class="text-sm opacity-80">Categorias</p>
                            <p class="text-4xl font-bold mt-2">0</p>
                        </div>
                    </div>
                    <p class="text-xl font-bold mt-10">Categorias Disponíveis</p>
                    <div class="flex flex-col items-center justify-center py-10 mt-8 text-gray-400">
                        <i class="fa-regular fa-folder-open text-5xl mb-3"></i>
                        <p class="text-sm">Nenhuma categoria criada ainda</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

<style scoped>

</style>
