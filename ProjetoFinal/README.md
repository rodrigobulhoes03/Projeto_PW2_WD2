# Projeto_PW2_WD2

x User — já existe no Laravel por defeito (utilizador comum + administrador)
Question — a pergunta em si (body, categoria getcorretQuestion())
Option — as opções de resposta de cada pergunta (e qual é a correta)
Quiz — representa uma tentativa de quiz feita por um utilizador (categoria escolhida, quando foi feito)
QuizAnswer — as respostas dadas pelo utilizador em cada quiz (para mostrar certas/erradas no histórico)

# Models
php artisan make:model Question
x php artisan make:model Question 
php artisan make:model Quiz
php artisan make:model QuizAnswer

# Controllers dentro da pasta API
php artisan make:controller API/AuthController
php artisan make:controller API/QuestionController
php artisan make:controller API/QuizController
x php artisan make:controller API/UserController

# Resources
x php artisan make:resource UserResource
php artisan make:resource QuestionResource
php artisan make:resource CategoryResource
php artisan make:resource QuizResource
php artisan make:resource QuizAnswerResource
