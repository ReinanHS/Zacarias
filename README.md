<p align="center">
<img src="https://uploaddeimagens.com.br/images/001/232/580/thumb/zacarias.png?1514637326">
</p>

# Sobre Zacarias
Zacarias é um Framework PHP utilizado para o desenvolvimento web, que utiliza a arquitetura MVC e tem como principal característica ajudar a desenvolver aplicações seguras e performáticas de forma rápida, com código limpo e simples, já que ele incentiva o uso de boas práticas de programação e utiliza o padrão PSR-2 como guia para estilo de escrita do código.

# Instalando o Zacarias-PHP

[![Como instalar vídeo aula no YouTube](http://img.youtube.com/vi/EAEWQrEF4H8&feature=youtu.be/0.jpg)](http://www.youtube.com/watch?v=EAEWQrEF4H8&feature=youtu.be)

O ZacariasPHP utiliza Composer, uma ferramenta de gerenciamento de dependências para PHP 7.0+. Primeiramente, você precisará baixar e instalar o Composer se não o fez anteriormente. Se você tem cURL instalada, é tão fácil quanto executar o seguinte:

```sh
curl -s https://getcomposer.org/installer | php
```

Ou, você pode baixar composer.phar do [Site oficial do Composer](https://getcomposer.org/download/ "Composer Download").

Para sistemas Windows, você pode baixar o [instalador aqui](https://getcomposer.org/Composer-Setup.exe). Mais instruções para o instalador Windows do Composer podem ser encontradas dentro do LEIA-ME.

Agora que você baixou e instalou o Composer, temos que instalar o git:
```sh
sudo apt-get update & sudo apt-get install git
```

Para sistemas Windows, você pode baixar o [instalador aqui](https://git-scm.com/). Mais instruções para o instalador Windows do Git podem ser encontradas dentro do LEIA-ME.

Agora que você baixou e instalou o Composer e git, você pode receber uma nova aplicação ZacariasPHP executando:

```sh
git clone https://www.github.com/ReinanHS/Zacarias.git [App Nome]
```

Assim usamos o Git para criar um novo projeto Zacarias em nosso diretório htdocs chamado “App Nome”. Espere alguns instantes até serem baixados todos os arquivos, pois o processo pode demorar dependendo da conexão. 

Uma vez que o Git terminar de baixar o esqueleto da aplicação e o núcleo da biblioteca ZacariasPHP, você deve ter uma aplicação funcional instalada via Composer. Esteja certo de manter os arquivos composer.json e composer.lock com o restante do seu código fonte.

# Instalando e atualizando as dependências via composer:

Se você quer manter atualizado com as últimas mudanças com as dependências do ZacariasPHP, você tem que executar o seguinte comando:

```sh
composer install
```

Logo depois:

```sh
composer update
```

# Requisitos
Você deve ter instalado em seu computador a versão 7.0.9 ou maior do PHP e as extensões OpenSSL PHP, PDO PHP, Mbstring PHP, Tokenizer. Também precisará ter instalado o Composer e git, um servidor como Apache/Nginx e um editor de código ou IDE de sua preferência.

# Reescrita de URL

Apesar do ZacariasPHP ser construído para trabalhar com mod_rewrite fora da caixa, e normalmente o faz, nos atentamos que alguns usuários lutam para conseguir fazer tudo funcionar bem em seus sistemas.

Aqui estão algumas coisas que você poderia tentar para conseguir tudo rodando corretamente. Primeiramente observe seu httpd.conf. (Tenha certeza que você está editando o httpd.conf do sistema ao invés de um usuário, ou site específico.)

1. Tenha certeza que a sobreescrita do .htaccess está permitida e que AllowOverride está definido para All no correto DocumentRoot. Você deve ver algo similar a:
```
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Handle Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

2. Certifique-se que o mod_rewrite está sendo carregado corretamente. Você deve ver algo como:
```
LoadModule rewrite_module libexec/apache2/mod_rewrite.so
```

Em muitos sistemas estará comentado por padrão, então você pode apenas remover os símbolos #.

Depois de fazer as mudanças, reinicie o Apache para certificar-se que as configurações estão ativas.

Verifique se os seus arquivos .htaccess estão realmente nos diretórios corretos. Alguns sistemas operacionais tratam arquivos iniciados com ‘.’ como ocultos e portanto, não os copia.

# Crie um Virtual Host usando XAMPP no Windows:

Em ambiente local, podemos utilizar esse mesmo artificio, sendo que a utilização do Virtual Host em ambiente local pode ajudar na organização. Se utilizar modo de re-escrita (rewrite), não precisa mudar o .htaccess que está local para o que está em produção.

Se trabalhar com cookies, pode separar por virtual host, sem ter conflito, etc.

Ao invés de utilizar:
```
localhost/Zacarias/public/
```
Você pode utilizar:
```
zacarias.com
```

Você pode criar qualquer nome, domínio ou subdomínio de acordo com seu gosto.

Basicamente, vamos configurar o Windows para quando acessar o domínio e apontar para nossa máquina (localhost) no Apache para uma pasta específica.

Acesse o arquivo:
```
C:\Windows\System32\drivers\etc\hosts
```
Você pode acessar com bloco de notas mesmo. Pode ser que você tenha que executar como Administrador. Para isso, vá na busca do Windows e digite: Bloco de notas.

![alt text](https://blog.mxcursos.com/wp-content/uploads/2018/01/virtual-host-bloco-de-notas-1-253x480.jpg "Bloco de notas")

Depois basta clicar com botão direito em cima do Bloco de Notas e escolher Executar como Administrador.

![alt text](https://blog.mxcursos.com/wp-content/uploads/2018/01/virtual-host-bloco-de-notas-administrador-1.jpg "Bloco de notas")

Depois basta ir em Arquivo > Abrir, ir no arquivo host (basta copiar o endereço que foi informado antes no tutorial) depois clicar em abrir.

![alt text](https://blog.mxcursos.com/wp-content/uploads/2018/01/virtual-host-bloco-de-notas-abrir-600x65.jpg "Bloco de notas")

Nesse arquivo, você encontrará o ip para sua máquina (127.0.0.1) com nome na frente “localhost”. Quando você digitar  “localhost” no seu navegador, ele está apontando para sua máquina, então o Apache (Servidor Web) vai apontar para sua pasta.

Como estamos usando o XAMPP com a premissa de estar instalado no C://, ele irá apontar para: C:\xampp\htdocs.

O seu arquivo host será como esse abaixo

![alt text](https://blog.mxcursos.com/wp-content/uploads/2018/01/virtual-host-bloco-de-notas-host-600x318.jpg "Bloco de notas")

Agora adicione o domínio que você deseja como está no localhost. No exemplo, vou criar chamado “zacarias.com”, ficando assim:
```
127.0.0.1       localhost
127.0.0.1       zacarias.com
```

Agora será necessário configurar o Apache. Também poderá ser feito com bloco de notas, ou qualquer editor de código.

```
C:\xampp\apache\conf\extra\httpd-vhosts.conf
```

Nesse arquivo serão configurados os Virtual Hosts. Ele já vem com configurações de exemplo, porém comentado.

Vamos usá-lo como base:
```
##<VirtualHost *:80>
    ##ServerAdmin webmaster@dummy-host.example.com
    ##DocumentRoot "C:/xampp/htdocs/dummy-host.example.com"
    ##ServerName dummy-host.example.com
    ##ServerAlias www.dummy-host.example.com
    ##ErrorLog "logs/dummy-host.example.com-error.log"
    ##CustomLog "logs/dummy-host.example.com-access.log" common
##</VirtualHost>
```

1. VirtualHost: Tag definindo as configurações do virtual host.
2. ServerAdmin: Endereço de contato.
3. DocumentRoot: Caminho completo até a pasta que será acessada.
4. ServerName: Nome do host que será acessado.
5. ServerAlias: Nomes alternativos para o host.
6. ErrorLog:  Nome do arquivo que o servidor registrará os erros encontrados.
7. CustomLog: Nome do arquivo para as requisições.

Iremos adicionar a nossa configuração, apontando para onde será configurado o virtual host. No nosso projeto seria:
```
<VirtualHost *:80>
    ServerAdmin webmaster@zacarias.com
    DocumentRoot "C:/xampp/htdocs/Zacarias/public"
    ServerName zacarias.com
    ErrorLog "logs/zacarias-error.log"
    CustomLog "logs/zacarias.log" common
</VirtualHost>
```

# Novas características!

  - Motor de roteamento simples e rápido.
  - Container de injeção de dependência poderosa.
  - Sistema de blade templates.

Você também pode:
  - Criar bancos de dados dinamicamente
  - Criar rotas dinamicamente

# Colaboradores
Gostaríamos de agradecer aos seguintes colaboradores por ajudar o desenvolvimento do framework Zacarias.

> Todas as inovações eficazes são surpreendentemente simples.
> Na verdade, maior elogio que uma inovação pode receber é haver quem diga: 
> Isto é óbvio! Por que não pensei nisso antes?

Ajude o projeto, faça a diferença
Lista de Colaboradores
- ReinanHS

# Licença
O framework Zacarias é um software de código aberto licenciado sob a licença MIT.
