<script lang="ts">
</script>

<template>
    <div class="min-h-screen overflow-hidden relative bg-gray-100 flex flex-col justify-center items-center">
        <div class="absolute -top-20 -left-20 w-80 h-80 bg-blue-400 opacity-30 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-blue-400 opacity-30 rounded-full blur-3xl"></div>
        <section class="relative z-10 flex flex-col items-center w-full">
            <div class="flex flex-col items-center mb-12">
                <div class="bg-blue-400 p-3 rounded-2xl shadow-lg mb-4">
                    <img src="quiz.png" alt="logo" class="w-8 h-8 invert">
                </div>
                <h1 class="text-4xl font-bold text-blue-600 tracking-tight">QuizHub</h1>
            </div>
            <article class="min-w-lg min-h-84 rounded overflow-hidden shadow-lg">
                <div class="flex flex-col items-center gap-4 mb-3 rounded-md">
                    <i class="fa-solid fa-circle-user text-2xl text-blue-400"></i>
                    <h2 class="text-2xl font-bold text-blue-600">Iniciar Sessão</h2>
                    <p class="text-sm text-gray-500">Bem-vindo de volta ao sistema</p>
                </div>
                <form class="flex flex-col items-center gap-4">
                    <div>
                        <label for="userEmail" class="block text-sm font-medium text-blue-600 mb-1">Endereço de Email</label>
                        <input class="w-64 border border-blue-400 rounded-md px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" type="email" placeholder="Email" required>
                    </div>
                    <div>
                        <label for="userPassword" class="block text-sm font-medium text-blue-600 mb-1">Palavra-Passe</label>
                        <input class="w-64 border border-blue-400 rounded-md px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" type="password" placeholder="••••••••" required>
                    </div>
                    <button class="bg-blue-600 hover:bg-blue-400 text-white font-medium px-8 py-2 rounded-md cursor-pointer transition-colors mb-2" type="submit">
                        Login
                    </button>
                </form>
            </article>
        </section>
    </div>
</template>

<style scoped>

</style>
