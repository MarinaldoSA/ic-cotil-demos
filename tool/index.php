<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ferramenta de invasão - SQL Injection</title>

    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300, 400,
      700" rel="stylesheet">
  </head>
  <body>
    <header>
      <div class="center">
        <div class="logo">Ferramenta de Invasão</div>
      </div> <!-- center -->
    </header> <!-- header -->

    <section class="formulario">
      <div class="overlay"></div>
        <form action="uploads.php" method="post"
          enctype="multipart/form-data">

          <input type="file" name="fileToUpload" id="fileToUpload">

          <label for="fileToUpload">
            Escolha o seu arquivo de URLs
          </label>

          <input type="submit" value="Enviar arquivo" name="submit">

        </form>
    </section><!-- formulario -->
  </body>
</html>
