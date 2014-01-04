<?php-
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }
    if (!isset($_SESSION["mensagens"])) {
        $_SESSION["mensagens"] = array();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <meta charset="utf-8">
        <title>Decathlon</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Jogo para a disciplina de Jogos Sociais">
        <meta name="keywords" content="decathlon, jogo social">
        <meta name="author" content="Oscar">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>


        <!-- JS -->
        <!-- HTML5 Support for IE -->
        <!--[if lt IE 9]>
          <script src="<?php echo $resourcesFolder; ?>scripts/html5shim.js"></script>
        <![endif]-->

        <!-- Stylesheets -->
        <link href="<?php echo $resourcesFolder; ?>styles/bootstrap.min.css" rel="stylesheet">

        <!-- Font awesome CSS -->
        <link href="<?php echo $resourcesFolder; ?>styles/font-awesome.min.css" rel="stylesheet">		

        <link href="<?php echo $resourcesFolder; ?>styles/style.css" rel="stylesheet">

        <!-- Favicons -->
        <link rel="shortcut icon" href="<?php echo $resourcesFolder; ?>images/decathlon.ico">

    </head>