<?php
include_once 'verificaSessao.php';

include_once 'usuariosBE.php';
include_once 'perfisBE.php';
include_once 'perfil_usuarioBE.php';
include_once 'usuariosDAO.php';
include_once 'perfisDAO.php';
include_once 'perfil_usuarioDAO.php';

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST, 'senha');
$senhaConfirm = filter_input(INPUT_POST, 'senhaConfirm');
$facebook = filter_input(INPUT_POST, 'facebook');

if (empty(trim($senha))) {
    $message = "O campo senha È obrigatÛrio!";
    $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("$message" => "a"));
    header("Location: " . filter_input(INPUT_SERVER, 'HTTP_REFERER'));
    return;
}

if (empty(trim($nome))) {
    $message = "O campo nome È obrigatÛrio!";
    $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("$message" => "a"));
    header("Location: " . filter_input(INPUT_SERVER, 'HTTP_REFERER'));
    return;
}

if (empty(trim($email))) {
    $message = "O campo nome È obrigatÛrio!";
    $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("$message" => "a"));
    header("Location: " . filter_input(INPUT_SERVER, 'HTTP_REFERER'));
    return;
}

if ($senha != $senhaConfirm) {
    $message = "Senhas informadas est„o diferentes!";
    $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("$message" => "a"));
    header("Location: " . filter_input(INPUT_SERVER, 'HTTP_REFERER'));
    return;
}

$usuarioNovo = new usuariosBE();
$usuarioNovo->setEmail($email);
$usuarioNovo->setNome($nome);
$usuarioNovo->setSenha($senha);
$usuarioNovo->setFacebook($facebook);

if ($_FILES["avatar"]["error"] != UPLOAD_ERR_NO_FILE) {
    if ($_FILES["avatar"]["size"] > 5000000) {
        $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("Arquivo do avatar n√£o pode exceder 5MB.<br>" => "a"));
        header("Location: " . filter_input(INPUT_SERVER, 'HTTP_REFERER'));
        return;
    }

    $iconeFilename = $_FILES['avatar']['name'];
    $imageDir = "../resources/images/$email";
    $path_file_foto = "$imageDir/$iconeFilename";
    if (!file_exists($path_file_foto)) {
        if (!file_exists($imageDir)) {
            mkdir($imageDir);
        }
        move_uploaded_file($_FILES["avatar"]["tmp_name"], $path_file_foto);
    }

    if ($_FILES["avatar"]["error"] != UPLOAD_ERR_OK) {
        $errorCode = $_FILES["avatar"]["error"];
        switch ($errorCode) {
            case UPLOAD_ERR_INI_SIZE:
                $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = "The uploaded file was only partially uploaded";
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = "No file was uploaded";
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = "Missing a temporary folder";
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = "Failed to write file to disk";
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = "File upload stopped by extension";
                break;
            default:
                $message = "Unknown upload error";
                break;
        }

        $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("Error: $message<br>" => "e"));
        header("Location: " . filter_input(INPUT_SERVER, 'HTTP_REFERER'));
        return;
    }
} else {
    $iconeFilename = "default-avatar.png";
    $imageDir = "resources/images/$email";
    $path_file_foto = "$imageDir/$iconeFilename";
    if (!file_exists($path_file_foto)) {
        if (!file_exists($imageDir)) {
            mkdir($imageDir);
        }
        copy("resources/images/$iconeFilename", $path_file_foto);
    }
}
$usuarioNovo->setPath_file_foto($path_file_foto);
$usuarioDAO = new usuariosDAO();

$usuario = new usuariosBE();
$usuario = $usuarioDAO->ObterPorEmail($email);

if ($usuario->getId_usuario() > 0) {
    $message = "J· existe usu·rio para o e-mail:$email";
    $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("$message" => "a"));
    header("Location: " . filter_input(INPUT_SERVER, 'HTTP_REFERER'));
    return;
}
try {
    $novoIdUsuario = $usuarioDAO->incluir($usuarioNovo);
} catch (PDOException $e) {
    $message = $e->getMessage();
    $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("$message" => "e"));
    header("Location: " . filter_input(INPUT_SERVER, 'HTTP_REFERER'));
    return;
}

$perfisUsuarioDAO = new perfil_usuarioDAO();
$perfilDoUsuario = new perfil_usuarioBE();
$perfilDoUsuario->setId_usuario($novoIdUsuario);
$perfilDoUsuario->setId_perfil(1);
$perfisUsuarioDAO->incluir($perfilDoUsuario);

include 'controllerAutentica.php';
?>
