<?php
    session_start();
    require 'autoload/header.php';
?>

<section class="main content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-center">A vulnerabilidade: XSS</h1>
            </div>
        </div>
    </div>

    <div class="introduction-content">
        <p class="site-content-p">O Cross-Site Scripting (também conhecido como XSS), segundo a OWASP, é a 7ª vulnerabilidade que mais ocorre em aplicações web nos dias de hoje. É uma vulnerabilidade que consiste, basicamente, em ativar scripts maliciosos por meio de entradas em uma aplicação web.</p>

        <div class="container-fluid site-content-p">
            <div class="center-image">
                <img src="img/exemploXSS1.png" alt="Exemplo 1">
            </div>
        </div>

        <p class="site-content-p">No exemplo acima, quando o comentário for exibido, o browser entenderá que o seu conteúdo é um script JS, e tentará executá-lo, em vez de apenas exibir o texto digitado. Dessa maneira, quando qualquer usuário abrir a página que exibe os comentários, o script será executado, resultando em algo semelhante ao exibido abaixo.</p>

        <div class="container-fluid site-content-p">
            <div class="center-image">
                <img src="img/exemploXSS2.png" alt="Exemplo 2">
            </div>
        </div>

        <p class="site-content-p">Apesar de parecer algo simples, ainda hoje existem sites que sofrem com essa vulnerabilidade. Um exemplo recente ocorreu no site do Supremo Tribunal Federal, quando um hacker brasileiro conseguiu rodar Minecraft diretamente nos servidores do site, após mais de um ano sem que a falha fosse corrigida (a matéria completa pode ser encontrada <a href="https://www.voxel.com.br/noticias/hacker-brasileiro-roda-minecraft-direto-pagina-stf_848815.htm" target="_blank">aqui</a>). Para não sofrer esse mesmo tipo de ataque, a exibição de dados de um usuário deve ser sempre sanitizada, para que o browser entenda que o conteúdo a ser exibido é apenas um texto, e não algo a ser executado por ele. Nesse site, a proteção contra o XSS foi realizada da seguinte maneira:</p>

        <div class="container-fluid site-content-p">
            <div class="center-image">
                <img src="img/exemploXSS3.png" alt="Exemplo 3">
            </div>
        </div>

        <p>No PHP, a função <em>htmlspecialchars()</em> faz com que as tags HTML de uma string sejam tratadas como texto pelo navegador. O resultado, utilizando essa função, agora é esse: </p>

        <div class="container-fluid site-content-p">
            <div class="center-image">
                <img src="img/exemploXSS4.png" alt="Exemplo 4">
            </div>
        </div>
    </div>

    <br>
</section>

<?php require 'autoload/footer.php'; ?>