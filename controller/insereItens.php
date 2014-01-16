<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
include_once '../persistence/daos/entidades/itensBE.php';
include_once '../persistence/daos/entidades/itens_powerBE.php';
include_once '../persistence/daos/itensDAO.php';
include_once '../persistence/daos/itens_powerDAO.php';

$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
$valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_NUMBER_FLOAT);
$imagem = filter_input(INPUT_POST, 'imagem');
$poder = filter_input(INPUT_POST, 'poder');

if (empty(trim($descricao))) {
    $message = "O campo descrição é obrigatório!";
    $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("$message" => "a"));
    header("Location: " . filter_input(INPUT_SERVER, 'HTTP_REFERER'));
    return;
}

if (empty(trim($valor))) {
    $message = "O campo valor é obrigatório!";
    $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("$message" => "a"));
    header("Location: " . filter_input(INPUT_SERVER, 'HTTP_REFERER'));
    return;
}

if (empty(trim($poder)) || $poder == 0) {
    $message = "O campo poder é obrigatório!";
    $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("$message" => "a"));
    header("Location: " . filter_input(INPUT_SERVER, 'HTTP_REFERER'));
    return;
}

$itemNovo = new itensBE();
$itemNovo->setDescricao($descricao);
$itemNovo->setValor($nome);

if ($_FILES["iconeItem"]["error"] != UPLOAD_ERR_NO_FILE) {
    if ($_FILES["iconeItem"]["size"] > 5000000) {
        $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("Arquivo do icone não pode exceder 5MB.<br>" => "a"));
        header("Location: " . filter_input(INPUT_SERVER, 'HTTP_REFERER'));
        return;
    }

    $iconeFilename = $_FILES['iconeItem']['name'];
    $imageDir = "../resources/images/adm/item";
    $path_file_foto = "$imageDir/$iconeFilename";
    if (!file_exists($path_file_foto)) {
        if (!file_exists($imageDir)) {
            mkdir($imageDir);
        }
        move_uploaded_file($_FILES["iconeItem"]["tmp_name"], $path_file_foto);
    }

    if ($_FILES["iconeItem"]["error"] != UPLOAD_ERR_OK) {
        $errorCode = $_FILES["iconeItem"]["error"];
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
    $iconeFilename = "noImageAvaliable.png";
    $imageDir = "../resources/images/adm/item";
    $path_file_foto = "$imageDir/$iconeFilename";
    if (!file_exists($path_file_foto)) {
        if (!file_exists($imageDir)) {
            mkdir($imageDir);
        }
        copy("../resources/images/$iconeFilename", $path_file_foto);
    }
}
$itemNovo->setPath_image_item($path_file_foto);
$itensDAO = new itensDAO();

try {
    $novoIdItem = $itensDAO->incluir($itemNovo);
} catch (PDOException $e) {
    $message = $e->getMessage();
    $_SESSION["mensagens"] = array_merge($_SESSION["mensagens"], array("$message" => "e"));
    header("Location: " . filter_input(INPUT_SERVER, 'HTTP_REFERER'));
    return;
}

$itensPowerDAO = new itens_powerDAO();
$itemPower = new itens_powerBE();
$itemPower->setId_itens($novoIdItem);
$itemPower->setId_power($poder);
$itemPower->incluir($itemPower);

header("Location: " . filter_input(INPUT_SERVER, 'HTTP_REFERER'));
?>
