

<?php
function autenticado()
{
    if (isset($_SESSION["email"]) && $_SESSION["tipoUser"] == "proprietario") {
        return true;
    } else {
        return false;
    }
}
function isAdmin()
{
    if (isset($_SESSION["tipoUser"]) && $_SESSION["tipoUser"] == "admin" ) {
        return true;
    } else {
        return false;
    }
}

function isEmpresa()
{
    if (isset($_SESSION["tipoUser"]) && $_SESSION["tipoUser"] == "empresa" ) {
        return true;
    } else {
        return false;
    }
}

function isProprietario()
{
    if (isset($_SESSION["tipoUser"]) && $_SESSION["tipoUser"] == "proprietario" ) {
        return true;
    } else {
        return false;
    }
}

function tipoUsuario()
{
    return $_SESSION["tipoUser"];
}

//Proprietário/////////////////////

function id_usuario()
{
    return $_SESSION["idUsuario"];
}

function nome()
{
    return $_SESSION["nome"];
}

function telefone()
{
    return $_SESSION["telefone"];
}

function cpf()
{
    return $_SESSION["cpf"];
}

function email()
{
    return $_SESSION["email"];
}

function senha()
{
    return $_SESSION["senha"];
}

function imagem()
{
    return $_SESSION["imagem"];
}


///////////////////////////////////

//Empresa/////////////////////

function id_emp()
{
    return $_SESSION["id_emp"];
}

function nome_emp()
{
    return $_SESSION["nome_emp"];
}

function telefone_emp()
{
    return $_SESSION["telefone_emp"];
}

function cnpj()
{
    return $_SESSION["cnpj"];
}

function email_emp()
{
    return $_SESSION["email_emp"];
}

function senha_emp()
{
    return $_SESSION["senha_emp"];
}

function imagem_emp()
{
    return $_SESSION["imagem_emp"];
}

///////////////////////////////////


function redireciona($pagina = null) {
    if (empty($pagina)) {
        $pagina = "index.php";
    }
    header("Location: " . $pagina);
}