<!doctype html>
<html>
<head>
    <title>CatalogoConnessioniRete</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/custom.js"></script>
</head>
<body>

<?php Session::init(); ?>

<div class="jumbotron text-center">
    <h1>Catalogo Connessioni Rete</h1>
</div>

<div class="container">
    <p class="text-right">
        <?php if(Session::get('loggedIn') == true):?>
            <a href="<?php echo URL; ?>dashboard/logout">Logout</a>
        <?php endif ?>
    </p>