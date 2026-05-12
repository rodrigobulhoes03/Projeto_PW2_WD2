<script>
export default {
    name: "Login"
}
</script>

<template>
    <section class="min-vh-100 d-flex flex-column justify-content-center align-items-center position-relative overflow-hidden bg-light">
        <div class="position-absolute rounded-circle blob blob-esquerda"></div>
        <div class="position-absolute rounded-circle blob blob-direita"></div>

        <div class="d-flex flex-column align-items-center mb-5">
            <div class="bg-primary p-3 rounded-4 mb-3">
                <img src="quiz.png" alt="logo" class="logo-img"/>
            </div>
            <h1 class="fw-bold text-primary">QuizHub</h1>
        </div>

        <article class="card shadow p-4 card-login">
            <div class="d-flex flex-column align-items-center gap-2 mb-3">
                <i class="fa-solid fa-circle-user fs-3 text-primary"></i>
                <h2 class="fw-bold text-primary">Iniciar Sessão</h2>
                <p class="text-muted small">Bem-vindo de volta ao sistema</p>
            </div>

            <p id="loginErro" class="invisible text-danger small text-center">Email ou palavra-passe incorretos.</p>

            <form class="d-flex flex-column gap-3">
                <div>
                    <label for="userEmail" class="form-label small fw-medium text-primary">Endereço de Email</label>
                    <input type="email" id="userEmail" class="form-control" placeholder="Email" required/>
                </div>
                <div>
                    <label for="userPassword" class="form-label small fw-medium text-primary">Palavra-Passe</label>
                    <input type="password" id="userPassword" class="form-control" placeholder="••••••••" required/>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <input type="checkbox" id="rememberMe" class="form-check-input"/>
                    <label for="rememberMe" class="form-check-label small text-muted">Lembrar de mim neste dispositivo</label>
                </div>
                <button type="submit" id="loginBtn" class="btn btn-primary w-100">Login</button>
            </form>
        </article>
    </section>
</template>

<style scoped>
:root {
    --bs-primary: #2F68AD;
    --bs-primary-rgb: 47, 104, 173;
}

.blob {
    width: 384px;
    height: 384px;
    background: #589AE5;
    opacity: 0.25;
    filter: blur(60px);
}

.blob-esquerda {
    top: 0;
    left: 0;
    transform: translate(-50%, -50%);
}

.blob-direita {
    bottom: 0;
    right: 0;
    transform: translate(50%, 50%);
}

.logo-img {
    width: 32px;
    height: 32px;
    object-fit: contain;
}

.card-login {
    min-width: 380px;
}
</style>

<style scoped>

</style>
