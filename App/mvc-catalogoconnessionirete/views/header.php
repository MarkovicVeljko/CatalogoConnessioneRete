<!doctype html>
<html>
<head>
    <title>CatalogoConnessioniRete</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery.js"></script>
</head>
<body>

<?php Session::init(); ?>

<div class="jumbotron text-center">
    <h1>Catalogo Connessioni Rete</h1>
</div>

<div class="container">
    <?php if(Session::get('loggedIn') == true):?>
        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo URL . Session::get('role'); ?>">Home</a>
            </div>
            <div class="container-fluid">
                <?php require 'views/' . Session::get('role') . '/navbar.php'; ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo URL; ?>handler/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
            </div>
        </nav>
    <?php endif ?>