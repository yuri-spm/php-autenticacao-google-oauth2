Autenticador Google com PHP

Um sistema simples de autenticação de usuários utilizando a API do Google (OAuth 2.0) e PHP.

Funcionalidades

• Login com a conta do Google.

• Recuperação de informações básicas do usuário (nome, e-mail e foto de perfil).

• Interface de login e página de boas-vindas.

Pré-requisitos

• PHP 8.0 ou superior

• Servidor web (Apache, Nginx, etc.)

• Conta no Google Cloud Platform para obter as credenciais da API.

Instalação

1.Clone este repositório: 

Bash


git clone https://github.com/seu-usuario/php-autenticacao-google-oauth2.git




2.Navegue até o diretório do projeto:

Bash


cd seu-repositorio




Configuração

1.Crie suas credenciais da API do Google:

•Acesse o Google Cloud Console.

•Crie um novo projeto.

•No menu de navegação, vá para "APIs e serviços" > "Credenciais".

•Clique em "Criar credenciais" e selecione "ID do cliente OAuth".

•Configure a tela de consentimento OAuth.

•Selecione "Aplicativo da Web" como o tipo de aplicativo.

•Em "URIs de redirecionamento autorizados", adicione o URL do seu arquivo callback.php. Por exemplo: http://localhost/authenticator/public/callback.php.

•Clique em "Criar". Copie o "ID do cliente" e o "Segredo do cliente".



2.
Configure as credenciais no projeto:

PHP


// Em public/index.php e public/callback.php
$clientId = "SEU_CLIENT_ID";
$clientSecret = "SEU_CLIENT_SECRET";
$redirectUri = "http://localhost/authenticator/public/callback.php";


•Abra os arquivos public/index.php e public/callback.php.

•Substitua os valores das variáveis $clientId e $clientSecret pelas suas credenciais obtidas no Google Cloud Console.

•Ajuste a variável $redirectUri para corresponder ao URL de redirecionamento que você configurou.



Uso

1.Inicie seu servidor web.

2.Acesse o projeto no seu navegador, por exemplo: http://localhost/authenticator/public/.

3.Clique no botão "Entrar com Google" e siga as instruções para autenticar com sua conta.

Estrutura do Projeto

Plain Text


/
├── auth/
│   └── GoogleAuth.php      # Classe principal para a autenticação com o Google
└── public/
    ├── index.php           # Página de login
    └── callback.php        # Página de redirecionamento após a autenticação


Licença

Este projeto está sob a licença MIT.

