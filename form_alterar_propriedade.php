<?php
ob_start();
session_start();
require 'logica-autenticacao.php';
require 'cabecalho.php';

if (!isProprietario() && !isAdmin()) {
  redireciona();
  die();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <title>Misol</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet" />
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

       
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
    <link href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.css" rel="stylesheet">


        <script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.2/mapbox-gl-geocoder.min.js"></script>

    </head>
    <style>
  #picture__input {
  display: none;
}

.picture {
  width: 350px;
  aspect-ratio: 16/9;
  background: #ddd;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #aaa;
  border-radius: 0.6vw;
  cursor: pointer;
  font-family: sans-serif;
  transition: color 300ms ease-in-out, background 300ms ease-in-out;
  outline: none;
  overflow: hidden;
 
  
}

.picture:hover {
  color: #777;
  background: #ccc;
}

.picture:active {
  border-color: turquoise;
  color: turquoise;
  background: #eee;
}

.picture:focus {
  color: #777;
  background: #ccc;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.picture__img {
  max-width: 100%;
}
@import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap');
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    font-family: 'Open Sans', sans-serif;
    background-color: black;
}

i{
  margin-left: 6px;
  margin-right: 6px;
}

#i-estado{
  margin-left: 7px;
  margin-right: 4px;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-position: center;
   
}
.div-img-2{
   margin-left: 1rem;
   margin-right: 1rem;
   
}
.div-img{
  background-color: #b4b4b4;
  display: flex;
  justify-content: center;
  border-radius: 2vw;
  width: 300px;
  height: 200px;
}

.div-img-2 {
    width: 300px;
    height: 200px;
  background-color: #b4b4b4;
  display: flex;
  justify-content: center;
  border-radius: 2vw;
}

.div-img-3 {
    width: 300px;
    height: 200px;
  background-color: #b4b4b4;
  display: flex;
  justify-content: center;
  border-radius: 2vw;
}

.div-org{
    display: flex;
    justify-content: center;
    display: flex;
  align-items: center;
  height: 400px;
}
.upload-btn{
  width: 30%;
  height: 3vw;
  background-color: #f8b80b;
  border: none;
  border-radius: 0.5vw;
  
}
.content {
    background-color: #fff;
   
    width: 100%;
    height: 100%;
    justify-content: space-between;
    align-items: center;
    position: relative;
}

.content::before {
    content: "";
    position: absolute;
    background-color: #000000;
    width: 20%;
    height: 100rem;
    align-items: center;
    left: 0;
    display: flex;
}

/* Estilo para a div que vai conter a imagem e o input */
.container-caixa {
      position: relative;
      width: 100%;
      height: 100%;
      
    }

    /* Estilo para a imagem */
    #imagem {

      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 0.6vw;
     
    }
    #imagem-2 {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 0.6vw;
}

#imagem-3 {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 0.6vw;
}
    /* Estilo para o input tipo file */
    #imageFile{

      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      cursor: pointer;

    }
    #imageFile-2 {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
  cursor: pointer;
}

#imageFile-3 {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
  cursor: pointer;
}
    /* Estilo para o texto que aparece sobre a imagem */
    .input-label, .input-label-2,  .input-label-3 {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 15px;
      color: white;
      background-color: rgba(0, 0, 0, 0.5); /* Fundo semi-transparente */
      padding: 10px 20px;
      border-radius: 10px;
      pointer-events: none; /* Para garantir que o clique seja detectado pelo input */
      width: 200px;
      text-align: center;
    }
   
    #input-coordenadas, #input-estado, #input-cidade{
border-bottom: none;
background-color: #d8d8d8;
font-size: 15px;

    }
    #excluir-imagem-1,  #excluir-imagem-2, #excluir-imagem-3 {  
        position: absolute;
        background-color: #ff4343;
        font-size: 15px;
        border-radius: 5px;
        height: 40px;
        width: 100px;
        border: none;
        color: white;
        font-family: sans-serif;
        cursor: pointer;
        text-align: center;
        margin-top: 0.5rem;

    }


.title {
    font-size: 28px;
    font-weight: bold;
    text-transform: capitalize;
}
.title-primary {
    color: #fff;
}
.title-second {
    color: #f8b80b;
}
.description {
    font-size: 14px;
    font-weight: 300;
    line-height: 30px;
}
.description-primary {
    color: #fff;
}
.description-second {
    color: #7f8c8d;
}
.header .navbar a{
    text-decoration: none !important;
}
.btn {
    border-radius: 15px;
    text-transform: uppercase;
    color: #fff;
    font-size: 10px;
    padding: 10px 50px;
    cursor: pointer;
    font-weight: bold;
    width: 150px;
    align-self: center;
    border: none;
    margin-top: 1rem;
}
.btn-primary {
    background-color: transparent;
    border: 1px solid #fff;
    transition: background-color .5s;
}
.btn-primary:hover {
    background-color: #fff;
    color: #f8b80b;
}
.btn-second {
    background-color: #f8b80b;
    border: 1px solid #f8b80b;
    transition: background-color .5s;
    width: 100%;
}
.btn-second:hover {
    background-color: #fff;
    border: 1px solid #f8b80b;
    color: #f8b80b;
}
.first-content {
    display: flex;
    height: 100%;
}
.first-content .second-column {
    z-index: 11;
}
.first-column {
    text-align: center;
    width: 20%;
    z-index: 10;
}
.second-column {
    width: 60%;
    display: flex;
    flex-direction: column;
    align-items: center;
    
}
.social-media {
    margin: 1rem 0;
}
.link-social-media:not(:first-child){
    margin-left: 10px;
}
.link-social-media .item-social-media {
    transition: background-color .5s;
}
.link-social-media:hover .item-social-media{
    background-color: #f8b80b;
    color: #fff;
    border-color: #f8b80b;
}
.list-social-media {
    display: flex;
    list-style-type: none;
}
.item-social-media {
    border: 1px solid #bdc3c7;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    line-height: 35px;
    text-align: center;
    color: #95a5a6;
}
.form {
    width: 100%;
}

.form-2 {
    width: 100%;
    margin-top: 20px;
    
}
.form input {
    height: 45px;
    width: 100%;
    border: none;
    background-color: #ecf0f1;
    caret-color: orange;  
    border: none;  
    font-size: 16px;

}

.form select{
    font-size: 16px;
}
.div-sec {
    display: flex;
    flex-direction: column;
    width: 90%;
justify-content: center;
    align-items: center;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}
h2{
    text-align: center;
}
h1{
    text-align: center;
    font-size: 35px;
    font-weight:  bold;

}
.divao{
 margin-top: 250px;
    justify-content: center;
    align-items: center;
    height: 100%;
    background-position: center;
    width: 80%;
    padding: 20px;
}

.form-2 input {
    height: 45px;
    width: 100%;
    border: none;
    background-color: #ecf0f1;
    caret-color: orange;  
    border: none;  

}

input:focus{
    outline: none; /* Remove o contorno padrão */
    border: none;  /* Remove a borda */
    border-bottom:#f8b80b 2px solid;
}

input:-webkit-autofill 
{    
    -webkit-box-shadow: 0 0 0px 1000px #ecf0f1 inset !important;
    -webkit-text-fill-color: #000 !important;
}
.label-input {
    background-color: #ecf0f1;
    display: flex;
    align-items: center;
    margin: 8px;
}
.icon-modify {
    color: #7f8c8d;
    padding: 0 5px;
}

/* second content*/

.second-content {
    position: absolute;
    display: flex;
}
.second-content .first-column {
    order: 2;
    z-index: -1;
}
.second-content .second-column {
    order: 1;
    z-index: -1;
}
.password {
    color: #34495e;
    font-size: 14px;
    margin: 15px 0;
    text-align: center;
}
.password::first-letter {
    text-transform: capitalize;
}

.div-img-2, .div-img-3 {
  display: block;
}

.sign-in-js .first-content .first-column {
    z-index: -1;
}

.sign-in-js .second-content .second-column {
    z-index: 11;
}
.sign-in-js .second-content .first-column {
    z-index: 13;
}

.sign-in-js .content::before {
    left: 60%;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
 
    animation: slidein 1.3s; /*MODIFIQUEI DE 3s PARA 1.3s*/

    z-index: 12;
}

.sign-up-js .content::before {
    animation: slideout 1.3s; /*MODIFIQUEI DE 3s PARA 1.3s*/

    z-index: 12;
}

.sign-up-js .second-content .first-column,
.sign-up-js .second-content .second-column {
    z-index: -1;
}

.sign-up-js .first-content .second-column {
    z-index: 11;
}

.sign-up-js .first-content .first-column {
    z-index: 13;    
}


/* DESLOCAMENTO CONTEÚDO ATRÁS DO CONTENT:BEFORE*/
.sign-in-js .first-content .second-column {

    z-index: -1;
    position: relative;
    animation: deslocamentoEsq 1.3s; /*MODIFIQUEI DE 3s PARA 1.3s*/
}

.sign-up-js .second-content .second-column {
    position: relative;
    z-index: -1;
    animation: deslocamentoDir 1.3s; /*MODIFIQUEI DE 3s PARA 1.3s*/
}

/*ANIMAÇÃOO CSS PARA O CONTEÚDO*/

@keyframes deslocamentoEsq {

    from {
        left: 0;
        opacity: 1;
        z-index: 12;
    }

    25% {
        left: -80px;
        opacity: .5;
        /* z-index: 12; NÃO HÁ NECESSIDADE */
    }

    50% {
        left: -100px;
        opacity: .2;
        /* z-index: 12; NÃO HÁ NECESSIDADE */
    }

    to {
        left: -110px;
        opacity: 0;
        z-index: -1;
    }
}


@keyframes deslocamentoDir {

    from {
        left: 0;
        z-index: 12;
    }

    25% {
        left: 80px;
        /* z-index: 12;  NÃO HÁ NECESSIDADE*/
    }

    50% {
        left: 100px;
        /* z-index: 12; NÃO HÁ NECESSIDADE*/
        /* background-color: yellow;  Exemplo que dei no vídeo*/
    }

    to {
        left: 110px;
        z-index: -1;
    }
}


/*ANIMAÇÃO CSS*/

@keyframes slidein {

    from {
        left: 0;
        width: 40%;
    }

    25% {
        left: 5%;
        width: 50%;
    }

    50% {
        left: 25%;
        width: 60%;
    }

    75% {
        left: 45%;
        width: 50%;
    }

    to {
        left: 60%;
        width: 40%;
    }
}

@keyframes slideout {

    from {
        left: 60%;
        width: 40%;
    }

    25% {
        left: 45%;
        width: 50%;
    }

    50% {
        left: 25%;
        width: 60%;
    }

    75% {
        left: 5%;
        width: 50%;
    }

    to {
        left: 0;
        width: 40%;
    }
}

/*VERSÃO MOBILE*/


@media screen and (max-width: 1040px) {
    .content {
        width: 100%;
        height: 100%;
    }

    .picture{
      width: 300px;
    }
    .content::before {
        width: 100%;
        height: 18%;
        top: 0;
        border-radius: 0;
        
    }
.div-sec{
    width: 100%;
    
}
.divao{
    width: 100%;
}
.input-label,  .input-label-2,  .input-label-3 {

    width: 70px;
      font-size: 7px;
      font-weight: bold;
      opacity: 70%;

}
#excluir-imagem-1, #excluir-imagem-2, #excluir-imagem-3{
    font-size: 10px;
        border-radius: 5px;
        height: 20px;
        width: 70px;
}

    .first-content, .second-content {
        flex-direction: column;
        justify-content: space-between;
    }

    .first-column, .second-column {
        width: 100%;
        justify-content: space-between;
        height: 100%;
        margin-bottom: 10vw;
    }
    
    .sign-in-js .content::before {
        top: 60%;
        left: 0;
        border-radius: 0;

    }

    .form {
        width: 90%;
    }
 .form-2{
        width: 90%;
    }
    .div-org{
        height: 200px;
    }
    .div-img, .div-img-2, .div-img-3{
        height: 100px;
        width: 120px;
        
    }
    .h3-i{
    
    font-size: 7px;
}
    /* ANIMAÇÃO MOBILE CSS*/

    @keyframes deslocamentoEsq {

        from {
            top: 0;
            opacity: 1;
            z-index: 12;
        }
        .form-2 {
            top: 0;
            opacity: 1;
            z-index: 12;
        }
        25% {
            top: -80px;
            opacity: .5;
            /* z-index: 12; NÃO HÁ NECESSIDADE */
        }
    
        50% {
            top: -100px;
            opacity: .2;
            /* z-index: 12; NÃO HÁ NECESSIDADE */
        }
    
        to {
            top: -110px;
            opacity: 0;
            z-index: -1;
        }
    }
    
    
    @keyframes deslocamentoDir {
    
        from .form-2{
            top: 0;
            z-index: 12;
        }
    
        25% {
            top: 80px;
            /* z-index: 12;  NÃO HÁ NECESSIDADE*/
        }
    
        50% {
            top: 100px;
            /* z-index: 12; NÃO HÁ NECESSIDADE*/
            /* background-color: yellow;  Exemplo que dei no vídeo*/
        }
    
        to {
            top: 110px;
            z-index: -1;
        }
    }
    
    
    
    @keyframes slidein {
    
        from {
            top: 0;
            height: 40%;
        }
    
        25% {
            top: 5%;
            height: 50%;
        }
    
        50% {
            top: 25%;
            height: 60%;
        }
    
        75% {
            top: 45%;
            height: 50%;
        }
    
        to {
            top: 60%;
            height: 40%;
        }
    }
    
    @keyframes slideout {
    
        from {
            top: 60%;
            height: 40%;
        }
    
        25% {
            top: 45%;
            height: 50%;
        }
    
        50% {
            top: 25%;
            height: 60%;
        }
    
        75% {
            top: 5%;
            height: 50%;
        }
    
        to {
            top: 0;
            height: 40%;
        }
    }
   
}

@media screen and (max-width: 740px) {
    .form .form-2 {
        width: 50%;
    }
}

@media screen and (max-width: 425px) {
    .form .form-2{
        width: 100%;
    }
}
.t-div {
    width: 100%;
    height: 100%;
    text-align: left;
    margin-left: 2%;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
}
.div-lado-imagem{
    width: 100%;
    align-items: center;
       
    background-color: #eeeeee;
    height:300px;
    color: black;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); 
    justify-content: center;
    display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-around;
}

.div-cidade, .div-estado,.div-coordenadas{
    width: 90%;
    height: 20%;
    color: black;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); 
text-align: center;
    justify-content: center;
    display: flex;
  padding: 10px;
  align-items: center;
}
#input-coordenadas, #input-estado, #input-cidade{
border-bottom: none;
background-color: #eee;
font-size: 1.75rem;

    }
.ti-h2{
    font-size: 30px;
    font-family: Arial, Helvetica, sans-serif;
}



#select{
    height: 45px;
    width: 100%;
    border: none;
    background-color: #ecf0f1;
    caret-color: orange;  
    border: none; 
    color: #757575;
}


#select:focus{
    outline: none; /* Remove o contorno padrão */
    border: none;  /* Remove a borda */
    border-bottom:#f8b80b 2px solid;
    background-color: #ecf0f1;
}

option{
  
}

#map{
    height: 300px;
    width: 99%;
    border-radius: 10px;
}
.h3-i{
    color: yellow;
    font-size: 15px;
}

element .style{
    position: relative;
}


.ti-org{
    font-family: sans-serif;
    text-align: center;
}


/* MAPA */

/* Ajuste o seletor do mapa */
#map {
    width: 100%;
    height: 600px; /* Altura padrão */
}

.mapboxgl-canvas {
    position: absolute !important;
    width: 100% !important;
    height: 100% !important;
}
/* Posiciona a barra de pesquisa no canto superior esquerdo e aumenta sua largura */
.mapboxgl-ctrl-geocoder {
    position: relative;
    top: 10px;
    left: 10px;
    width: 400px; /* Duplicando o tamanho original */
    max-width: 100%; /* Evita que ultrapasse o limite da tela */
}
/* Estilos gerais para a barra de pesquisa */
.mapboxgl-ctrl-geocoder {
    max-width: 300px; /* Define uma largura máxima para a barra de pesquisa */
}

/* Estilos para telas menores */
@media screen and (max-width: 600px) {
    .mapboxgl-ctrl-geocoder {
        max-width: 80%; /* Reduz a largura máxima da barra em telas pequenas */
        margin: 0 auto; /* Centraliza a barra */
    }
    .mapboxgl-ctrl-top-right .mapboxgl-ctrl{
        width: 10% !important;
    }
}


/*BALÃO DE  INFORMAÇÕES NA TELA*/

.balao {
  width: 600px;
  height: 100px;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center; /* Adicione essa propriedade para centralizar verticalmente */
  position: fixed;
  top: 150px; /* Distância do topo */
  right: 20px; /* Distância da direita */
  background-color: #d4edda; /* Verde claro */
  color: #155724; /* Verde escuro */
  padding: 10px;
  border-radius: 0.5vw;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  font-size: 20px;
  font-weight: bold;
  z-index: 1000; /* Para garantir que fique acima de outros elementos */
}

/*BALÃO DE  INFORMAÇÕES NA TELA*/








    </style>
<?php
require 'conexao.php';


// Obtém o ID do usuário logado e o nível de permissão (ex: admin ou usuário comum)
$usuario_id = $_SESSION['idUsuario'];
$usuario_admin = $_SESSION['is_admin']; // Supondo que o campo 'is_admin' indica se o usuário é administrador (1 = admin, 0 = não-admin)

// Obtém o ID da propriedade e do proprietário da URL
$id_propri = filter_input(INPUT_GET, "id_propri", FILTER_SANITIZE_NUMBER_INT);
$id_proprietario = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

// Verifica se os parâmetros estão vazios
if (empty($id_propri) || empty($id_proprietario)) {
    header("Location: form_alterar_propriedade.php?id_propri=$id_propri&id=$usuario_id");
    exit;
}

// Se o usuário não for administrador, verifica se a propriedade pertence ao usuário logado
if (!isAdmin()) {
    // Faz a consulta para verificar se a propriedade pertence ao usuário logado
    $sql_verifica = "SELECT id FROM propriedade WHERE id_propri = ? AND id = ?";
    $stmt_verifica = $conn->prepare($sql_verifica);
    $stmt_verifica->execute([$id_propri, $usuario_id]);
    $propriedade_encontrada = $stmt_verifica->fetch();

    // Se a propriedade não for encontrada ou não pertencer ao usuário logado, redireciona para a página inicial
    if (!$propriedade_encontrada) {
        header("Location: index.php");
        exit;
    }
}

// Faz o SELECT dos dados da propriedade
$sql = "SELECT titulo, tamanho, tipo_solo, estado, cidade, coordenadas FROM propriedade WHERE id_propri = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id_propri]);
$rowPropriedade = $stmt->fetch();

// Verifica se a propriedade foi encontrada
if (!$rowPropriedade) {
    ?>
    <h2>Propriedade não encontrada</h2>
    <img class='img-erro' src='images/img-erro.png' alt=''>
    <p>A propriedade com ID <?= $id_propri ?> não foi encontrada.</p>
    <?php
    exit;
}

// Faz o SELECT das imagens associadas à propriedade
$sql_img = "SELECT imagem1, imagem2, imagem3 FROM imgPropriedade WHERE id_propri = ?";
$stmt_img = $conn->prepare($sql_img);
$stmt_img->execute([$id_propri]);

$rowImgs = $stmt_img->fetch(PDO::FETCH_ASSOC);

// Verifica se os campos contêm recursos (streams) e converte-os para string
$imagem1_data = !empty($rowImgs['imagem1']) ? stream_get_contents($rowImgs['imagem1']) : null;
$imagem2_data = !empty($rowImgs['imagem2']) ? stream_get_contents($rowImgs['imagem2']) : null;
$imagem3_data = !empty($rowImgs['imagem3']) ? stream_get_contents($rowImgs['imagem3']) : null;

// Converte as imagens para base64 ou exibe imagem padrão se não existir
$imagem1 = $imagem1_data ? 'data:image/jpeg;base64 ,' . base64_encode($imagem1_data) : 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';
$imagem2 = $imagem2_data ? 'data:image/jpeg;base64,' . base64_encode($imagem2_data) : 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';
$imagem3 = $imagem3_data ? 'data:image/jpeg;base64,' . base64_encode($imagem3_data) : 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';

if (isset($_SESSION["result"])) {
    $mostrarBalao = true;
    if ($_SESSION["result"]) {
        $mensagemBalao = 'Propriedade Alterada com Sucesso';
        $corFundo = '#d4edda';
        $corTexto = '#155724';
    } else {
        $erro = $_SESSION["erro"];
        unset($_SESSION["erro"]);
        $mensagemBalao = 'Falha ao alterar: ' . $erro;
        $corFundo = '#f2dede';
        $corTexto = '#a94442';
    }
    unset($_SESSION["result"]);
} else {
    $mostrarBalao = false;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Propriedade</title>
</head>
<body>
    <div class="container">
        <div class="divao">
            <div class="div-sec">
                <form action="alterar_propriedade.php" method="POST" class="form" enctype="multipart/form-data">
                    <input type="hidden" name="id_propri" value="<?= $id_propri ?>">
                    <hr style="margin-bottom: 1rem;">
                    <h1>Editar Propriedade</h1>
                    <hr style="margin-bottom: 1rem;">
                    <div class="div-org">
                        <div class="div-img">
                            <div class="container-caixa">
                                <!-- Imagem 1 -->
                                <img id="imagem" src="<?= $imagem1 ?>" alt="Imagem 1">
                                <div class="input-label"><h3 class="h3-i">*Imagem Principal</h3></div>
                                <input type="file" name="imagem1" id="imageFile" accept="image/*">
                                <button type="button" id="excluir-imagem-1" style="display: none;">Excluir</button>
                            </div>
                        </div>

                        <div class="div-img-2">
                            <div class="container-caixa">
                                <!-- Imagem 2 -->
                                <img id="imagem-2" src="<?= $imagem2 ?>" alt="Imagem 2">
                                <div class="input-label-2">Alterar Imagem</div>
                                <input type="file" name="imagem2" id="imageFile-2" accept="image/*">
                                <button type="button" id="excluir-imagem-2" style="display: none;">Excluir</button>
                            </div>
                        </div>

                        <div class="div-img-3">
                            <div class="container-caixa">
                                <!-- Imagem 3 -->
                                <img id="imagem-3" src="<?= $imagem3 ?>" alt="Imagem 3">
                                <div class="input-label-3">Alterar Imagem</div>
                                <input type="file" name="imagem3" id="imageFile-3" accept="image/*">
                                <button type="button" id="excluir-imagem-3" style="display: none;">Excluir</button>
                            </div>
                        </div>
                    </div>

                    <!-- Campos de texto já preenchidos -->
                    <label class="label-input">
                    <i id="fa-1" style='font-size:17px; color: #7f8c8d;' class='fas'>&#xf303;</i>
                        <input value="<?= $rowPropriedade["titulo"] ?>" type="text" name="titulo" id=" inputTitulo" placeholder="Título" required>
                    </label>

                    <label class="label-input">
                        <i class='fas fa-pencil-ruler' style='font-size:17px; color: #7f8c8d;'></i>
                        <input value="<?= $rowPropriedade["tamanho"] ?>" type="text" name="tamanho" placeholder="Tamanho (m²)" required id="inputTamanho" oninput="formatNumber(this)">
                    </label>

                    <label class="label-input">
                        <i class="fa fa-leaf" style='font-size:17px; color: #7f8c8d;'></i>
                        <select name="tipo_solo" id="select" required>
                            <option selected><?= $rowPropriedade["tipo_solo"] ?></option>
                            <?php
                            // Definir as opções possíveis
                            $tiposSolo = ["Pedregoso", "Arenoso", "Argiloso", "Latosolo(Terra Roxa)"];

                            // Gerar opções exceto a que já está selecionada
                            foreach ($tiposSolo as $tipo) {
                                if ($tipo !== $rowPropriedade["tipo_solo"]) {
                                    echo "<option>$tipo</option>";
                                }
                            }
                            ?>
                        </select>
                    </label>

                    <div class="form-2">
                        <hr style="margin-bottom: 1rem;">
                        <h2>Mude a localização de sua propriedade</h2>
                        <hr style="margin-bottom: 1rem;">
                        <div id="map"></div>
                        <div class="div-lado-imagem">
                            <div class="div-coordenadas">
                                <h3>Coordenadas:</h3>
                                <i class="fas fa-search-location" style='font-size:17px; color: #7f8c8d;'></i>
                                <input value="<?= $rowPropriedade["coordenadas"] ?>" type="text" name="coordenadas" id="input-coordenadas" required readonly>
                            </div>
                            <div class="div-estado">
                                <h3>Estado:</h3>
                                <span id="i-estado" class="fas fa-map" style='font-size:17px; color: #7f8c8d;'></span>
                                <input value="<?= $rowPropriedade["estado"] ?>" type="text" name="estado" id="input-estado" required readonly>
                            </div>
                            <div class="div-cidade">
                                <h3>Cidade:</h3>
                                <i class='fas' style='font-size:17px; color: #7f8c8d;'>&#xf64f;</i>
                                <input value="<?= $rowPropriedade["cidade"] ?>" type="text" name="cidade" id="input-cidade" required readonly>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-second" type="submit">Salvar</button>
                </form>
            </div>
        </div>
    </div>

    <?php if ($mostrarBalao): ?>
    <script>
        const balao = document.createElement('div');
        balao.classList.add('balao');
        balao.innerHTML = '<?php echo $mensagemBalao; ?>';
        balao.style.backgroundColor = '<?php echo $corFundo; ?>';
        balao.style.color = '<?php echo $corTexto; ?>';
        document.body.appendChild(balao);
        setTimeout(() => {
            balao.remove();
        }, 3000);
    </script>
    <?php endif; ?>

    <script src="js-login/app.js"></script>
</body>




<script>


 // Evento para alterar a imagem quando um novo arquivo for selecionado
// Adiciona os eventos de clique às imagens
document.getElementById('imageFile').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagem').src = e.target.result;
            document.getElementById('excluir-imagem-1').style.display = 'block';
            // Adiciona o campo de imagem 2
            document.querySelector('.div-img-2').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
});

document.getElementById('imageFile-2').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagem-2').src = e.target.result;
            document.getElementById('excluir-imagem-2').style.display = 'block';
            // Adiciona o campo de imagem 3
            document.querySelector('.div-img-3').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
});

document.getElementById('imageFile-3').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagem-3').src = e.target.result;
            document.getElementById('excluir-imagem-3').style.display = 'block';
        }
        reader.readAsDataURL(file);
    }
});


// Função para formatar os números com ponto a cada 3 dígitos
function formatNumber(input) {
    // Remove qualquer caractere que não seja dígito
    let value = input.value.replace(/\D/g, '');

    // Formata o número com ponto a cada 3 dígitos
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    // Atualiza o valor no campo de input sem o "m²"
    input.value = value;
}

// Verifica se as imagens estão preenchidas e mostra os botões de exclusão
if (document.getElementById('imagem').src !== 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg') {
    document.getElementById('excluir-imagem-1').style.display = 'block';
}

if (document.getElementById('imagem-2').src !== 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg') {
    document.getElementById('excluir-imagem-2').style.display = 'block';
}

if (document.getElementById('imagem-3').src !== 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg') {
    document.getElementById('excluir-imagem-3').style.display = 'block';
}

// Oculta os botões de exclusão quando as imagens forem excluídas
document.getElementById('excluir-imagem-1').addEventListener('click', function() {
    document.getElementById('imagem').src = 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';
    document.getElementById('excluir-imagem-1').style.display = 'none';
});

document.getElementById('excluir-imagem-2').addEventListener('click', function() {
    document.getElementById('imagem-2').src = 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';
    document.getElementById('excluir-imagem-2').style.display = 'none';
});

document.getElementById('excluir-imagem-3').addEventListener('click', function() {
    document.getElementById('imagem-3').src = 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';
    document.getElementById('excluir-imagem-3').style.display = 'none';
});

// Excluir a imagem da propriedade 1
document.getElementById('excluir-imagem-1').addEventListener('click', function() {
    const id_propri = <?= $id_propri ?>;
    const id_img = 1; // ID da imagem 1

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'excluir_foto_propriedade.php', true); // Crie um arquivo PHP para tratar a exclusão da imagem
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('id_propri=' + id_propri + '&id_img=' + id_img);

    // Atualizar a imagem para a imagem padrão e indicar que a imagem foi excluída
    document.getElementById('imagem').src = 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';
});

// Excluir a imagem da propriedade 2
document.getElementById('excluir-imagem-2').addEventListener('click', function() {
    const id_propri = <?= $id_propri ?>;
    const id_img = 2; // ID da imagem 2

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'excluir_foto_propriedade.php', true); // Crie um arquivo PHP para tratar a exclusão da imagem
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('id_propri=' + id_propri + '&id_img=' + id_img);

    // Atualizar a imagem para a imagem padrão e indicar que a imagem foi excluída
    document.getElementById('imagem-2').src = 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';
});

// Excluir a imagem da propriedade 3
document.getElementById('excluir-imagem-3').addEventListener('click', function() {
    const id_propri = <?= $id_propri ?>;
    const id_img = 3; // ID da imagem 3

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'excluir_foto_propriedade.php', true); // Crie um arquivo PHP para tratar a exclusão da imagem
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('id_propri=' + id_propri + '&id_img=' + id_img);

    // Atualizar a imagem para a imagem padrão e indicar que a imagem foi excluída
    document.getElementById('imagem-3').src = 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';
});
/////////////API MAPA/////////////////////////////////////////////////////////////

// Mapeamento de estados para suas siglas
const stateAbbreviations = {
    "Acre": "AC",
    "Alagoas": "AL",
    "Amapá": "AP",
    "Amazonas": "AM",
    "Bahia": "BA",
    "Ceará": "CE",
    "Distrito Federal": "DF",
    "Espírito Santo": "ES",
    "Goiás": "GO",
    "Maranhão": "MA",
    "Mato Grosso": "MT",
    "Mato Grosso do Sul": "MS",
    "Minas Gerais": "MG",
    "Pará": "PA",
    "Paraíba": "PB",
    "Paraná": "PR",
    "Pernambuco": "PE",
    "Piauí": "PI",
    "Rio de Janeiro": "RJ",
    "Rio Grande do Norte": "RN",
    "Rio Grande do Sul": "RS",
    "Rondônia": "RO",
    "Roraima": "RR",
    "Santa Catarina": "SC",
    "São Paulo": "SP",
    "Sergipe": "SE",
    "Tocantins": "TO"
};

// Chave de acesso do Mapbox
mapboxgl.accessToken = 'pk.eyJ1IjoidGhlb21lcXVlIiwiYSI6ImNtMXhyczRyMDEzOWwybHBxczcxZnB3MjQifQ.ru6Ax4iqbAetalmMNeNcuQ';

// Cria a instância do mapa com estilo satélite e etiquetas
var map = new mapboxgl.Map({
    container: 'map', // ID do elemento div para renderizar o mapa
    style: 'mapbox://styles/mapbox/satellite-streets-v12', // Estilo híbrido de satélite com etiquetas
    center: [-51.9253, -14.2350], // Coordenadas do Brasil (Longitude, Latitude)
    zoom: 4 // Nível de zoom inicial
});

// Adiciona um controle de zoom e rotação
map.addControl(new mapboxgl.NavigationControl());

// Variável para armazenar o último marcador criado
var marker;

// Pegue as coordenadas da propriedade do PHP (string "latitude, longitude")
var coordenadas = "<?= $rowPropriedade["coordenadas"] ?>";

// Verifique se as coordenadas estão presentes e no formato correto
if (coordenadas && coordenadas.includes(',')) {
    // Separe as coordenadas em latitude e longitude
    var [lat, lng] = coordenadas.split(',').map(coord => parseFloat(coord.trim()));

    // Verifique se latitude e longitude são números válidos
    if (!isNaN(lat) && !isNaN(lng)) {
        // Adiciona um marcador na posição das coordenadas recuperadas
        marker = new mapboxgl.Marker({ color: 'red' })
            .setLngLat([lng, lat]) // Posição do marcador (longitude, latitude)
            .addTo(map);

        // Atualiza o campo de coordenadas com o valor salvo
        document.getElementById('input-coordenadas').value = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;

        // Centraliza o mapa nas coordenadas com zoom
        map.flyTo({
            center: [lng, lat],
            zoom: 15 // Nível de zoom
        });

        // Chama a função de reverse geocoding para obter cidade e estado
        reverseGeocode(lng, lat);
    }
}

// Evento de clique no mapa para criar um novo marcador
map.on('click', function (e) {
    // Remove o marcador anterior (se existir)
    if (marker) {
        marker.remove();
    }

    // Adiciona um novo marcador na posição clicada
    marker = new mapboxgl.Marker({ color: 'red' })
        .setLngLat([e.lngLat.lng, e.lngLat.lat])
        .addTo(map);

    // Atualiza as coordenadas após adicionar o marcador
    document.getElementById('input-coordenadas').value = `${e.lngLat.lat.toFixed(6)}, ${e.lngLat.lng.toFixed(6)}`;

    // Chama a função de reverse geocoding para obter cidade e estado
    reverseGeocode(e.lngLat.lng, e.lngLat.lat);
});

// Evento de localização atual
locateControl.on('geolocate', function (e) {
    // Remove o marcador anterior (se existir )
    if (marker) {
        marker.remove();
    }

    // Adiciona um novo marcador na posição atual
    marker = new mapboxgl.Marker({ color: 'red' })
        .setLngLat([e.coords.longitude, e.coords.latitude])
        .addTo(map);

    // Atualiza as coordenadas após adicionar o marcador
    document.getElementById('input-coordenadas').value = `${e.coords.latitude.toFixed(6)}, ${e.coords.longitude.toFixed(6)}`;

    // Chama a função de reverse geocoding para obter cidade e estado
    reverseGeocode(e.coords.longitude, e.coords.latitude);
});

function reverseGeocode(lng, lat) {
    var url = `https://api.mapbox.com/geocoding/v5/mapbox.places/${lng},${lat}.json?access_token=pk.eyJ1IjoidGhlb21lcXVlIiwiYSI6ImNtMXhyczRyMDEzOWwybHBxczcxZnB3MjQifQ.ru6Ax4iqbAetalmMNeNcuQ&types=place,region`;

    // Faz a requisição para a API de geocodificação reversa
    fetch(url)
        .then(response => response.json())
        .then(data => {
            // Verifica se há resultados da API
            if (data && data.features && data.features.length > 0) {
                let place = data.features[0].text; // Use the first feature as the place
                let region = data.features.find(feature => feature.place_type.includes('region'));

                // Atualiza os inputs com as informações retornadas pela API
                document.getElementById('input-cidade').value = place;

                if (region) {
                    const stateName = region.text;
                    const isBrazil = Object.keys(stateAbbreviations).includes(stateName); // Verifica se o estado está no Brasil

                    // Atualiza o campo de estado
                    if (isBrazil) {
                        const stateAbbreviation = stateAbbreviations[stateName]; // Use a sigla se existir
                        document.getElementById('input-estado').value = stateAbbreviation;
                    } else {
                        // Se não for do Brasil, exibe o nome completo do estado e do país
                        const countryName = region.context.find(ctx => ctx.id.includes('country')).text; // Obtém o país
                        document.getElementById('input-estado').value = `${stateName}, ${countryName}`;
                    }
                } else {
                    document.getElementById('input-estado').value = ''; // Clear the state input if no region is found
                }
            }
        })
        .catch(error => {
            console.error('Erro ao buscar cidade e estado:', error);
        });
}
// Adiciona o controle de pesquisa (geocoder) no mapa
var geocoder = new MapboxGeocoder({
    accessToken: mapboxgl.accessToken,
    mapboxgl: mapboxgl,
    placeholder: 'Pesquise por local, cidade, bairro...', // Texto da barra de pesquisa
    marker: false, // Desativa a adição automática de um marcador após a pesquisa
    language: 'pt-BR' // Idioma dos resultados
});

// Adiciona a barra de pesquisa ao mapa
map.addControl(geocoder);

// Evento de resultado da pesquisa para centralizar e dar zoom no local encontrado
geocoder.on('result', function (e) {
    // Move o mapa para o local encontrado com um zoom mais próximo
    map.flyTo({
        center: e.result.center,
        zoom: 13 // Ajusta o zoom para mostrar o local mais de perto (valor pode ser ajustado)
    });
});


// Adiciona um evento de clique ao input de coordenadas
document.getElementById('input-coordenadas').addEventListener('click', function() {
    alert('Adcione um ponto no mapa.');
});

// Adiciona um evento de clique ao input de cidade
document.getElementById('input-cidade').addEventListener('click', function() {
    alert('Adcione um ponto no mapa.');
});

// Adiciona um evento de clique ao input de estado
document.getElementById('input-estado').addEventListener('click', function() {
    alert('Adcione um ponto no mapa.');
});
/////////////API MAPA/////////////////////////////////////////////////////////////


///////OBRIGA O USUÁRIO A INSERIR UM PONTO NO MAPA PARA ENVIAR O FORMULÁRIO/////////
///////OBRIGA O USUÁRIO A INSERIR UM PONTO NO MAPA PARA ENVIAR O FORMULÁRIO/////////
// Variável para armazenar o estado do mapa
// Adiciona um evento de envio ao formulário
document.querySelector('form').addEventListener('submit', function(e) {
    // Verifica se os campos de coordenadas, cidade e estado estão preenchidos
    if (document.getElementById('input-coordenadas').value == '' || document.getElementById('input-cidade').value == '' || document.getElementById('input-estado').value == '') {
        alert('Por favor, preencha os campos de coordenadas, cidade e estado.');
        e.preventDefault(); // Impede que o formulário seja enviado
    }
});
///////OBRIGA O USUÁRIO A INSERIR UM PONTO NO MAPA PARA ENVIAR O FORMULÁRIO/////////
///////OBRIGA O USUÁRIO A INSERIR UM PONTO NO MAPA PARA ENVIAR O FORMULÁRIO/////////
</script>

</html>
<?php
ob_end_flush();  // Envia a saída armazenada no buffer
?>












