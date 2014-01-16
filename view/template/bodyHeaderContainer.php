<body>
    <header>
        <div class="navi">
            <div class="container">
                <div class="navbar navbar-default bs-docs-nav" role="banner">
                    <?php foreach ($bigButtons as $nameButton => $urlButton) { ?>
                        <div class="navbar-header">
                            <a class="navbar-brand" href="<?php echo $urlButton ?>"><?php echo $nameButton ?></a>
                        </div>
                    <?php } ?>
                    <nav class="collapse navbar-collapse bs-navbar-collapse navbar-left" role="navigation">
                        <ul class="nav navbar-nav ">
                            <?php foreach ($navLinks as $nameLink => $urlLink) { ?>
                                <li>
                                    <a href="<?php echo $urlLink ?>"><?php echo $nameLink ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
                <?php if (isset($_SESSION["mensagens"]) && !empty($_SESSION["mensagens"])) { ?>
                    <div class="navbar navbar-default bs-docs-nav" role="banner">
                        <p>
                            <?php foreach ($_SESSION["mensagens"] as $mensagem => $tipo) { ?>
                                <?php if ($tipo == 'e') { ?>
                                <div class="alert alert-danger">
                                    <?php } else if ($tipo == 'a') { ?>
                                    <div class="alert alert-warning">
                                        <?php } else { ?>
                                        <div class="alert alert-success">
                                    <?php } ?>
                                        <b><?php echo $mensagem ?></b></div><br/>
                                <?php } ?>
                                </p>
                                </div>
                            <?php } 
                                $_SESSION["mensagens"] = array();
                            ?>
                            </div>
                            </div>
                            </div>
                            <div class="container">
                                <div class="row">