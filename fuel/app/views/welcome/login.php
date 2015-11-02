<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>AGDATA S.L.</title>
    <?php echo Asset::css('bootstrap.css'); ?>
    <?php echo Asset::css('main.css'); ?>
    <style>
    </style>
</head>
<body>
<header>
    <div class="container">
        <div id="logo"></div>
    </div>
</header>
<div class="container">
    <div class="jumbotron">
        <h1 class="login">AGDATA S.L.</h1>
        <p>Identifícate para acceder al Área de gestión.</p>
        <?php echo render('welcome/_form_login'); ?>
        <small>¿Has olvidado tu contraseña?</small>
    </div>
    <hr/>
    <footer>
        <p class="pull-right">Contenido cargado en {exec_time}s usando {mem_usage}mb de memoria.</p>
    </footer>
</div>
</body>
</html>