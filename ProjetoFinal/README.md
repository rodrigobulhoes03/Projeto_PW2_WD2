Projeto_PW2_WD2

x User — já existe no Laravel por defeito (utilizador comum + administrador)
x Question — a pergunta em si (body, categoria getcorretQuestion())
Option — as opções de resposta de cada pergunta (e qual é a correta)
Quiz — representa uma tentativa de quiz feita por um utilizador (categoria escolhida, quando foi feito)
SubmitAnswer — as respostas dadas pelo utilizador em cada quiz (para mostrar certas/erradas no histórico)

Models
php artisan make:model Option
x php artisan make:model Question 
php artisan make:model Quiz
php artisan make:model SubmitAnswer

Controllers dentro da pasta API

php artisan make:controller API/OptionController
php artisan make:controller API/SubmitAnswerController
php artisan make:controller API/QuestionController
x php artisan make:controller API/QuizController
x php artisan make:controller API/UserController

Resources
 php artisan make:resource OptionResource
x php artisan make:resource UserResource
x php artisan make:resource QuestionResource
php artisan make:resource QuizResource
php artisan make:resource SubmitAnswerResource
