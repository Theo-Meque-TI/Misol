<?php

session_start();
require 'logica-autenticacao.php';
require 'cabecalho.php';

if (!isEmpresa() && !isAdmin()) {
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

        a{
            text-decoration: none;
        }
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
    align-items: center;
    display: flex;
    justify-content: center;
    height: 100vh;
    margin: 0;
    padding: 0;
    background-color: black;

background-size: cover;
background-position: center;
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
.div-img{
  background-color: #b4b4b4;
  display: flex;
  justify-content: center;
  border-radius: 0.6vw;
  width: 99%;
  height:500px;
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

    /* Estilo para o input tipo file */
    #imageFile {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0;
      cursor: pointer;

    }

    /* Estilo para o texto que aparece sobre a imagem */
    .input-label {
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
    width: 70%;
    
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

}

.div-sec {
    display: flex;
    flex-direction: column;
    width: 100%;
    height: auto;
    justify-content: space-around;
    align-items: center;
    margin: 0 auto;
    
    padding: 20px;
    background-color: #f9f9f9;
    
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}



.divao{
 margin-top: 20rem;
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
    .ti-h2{
        font-size: 20px;    }
.div-sec{
    width: 100%;
    
}
.divao{
    width: 100%;
}
.input-label {
    
      font-size: 10px;
      font-weight: bold;

}
.div-img{

  width: 99%;
  height: 250px;
}
.w-100{
    height: 30rem !important;
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
   .h3-c{
    font-size: 10px;
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
    height: 400px;
    width: 100%;
    border-radius: 5px;
    
}


element .style{
    position: relative;
}

/*CSS WHATSAPP*/
.whats{
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 9999;
}

/*CSS WHATSAPP*/

.div-vi-1{
    width: 100%;
    height: 140px;
    align-items: center;
    margin: 0 auto;
    padding: 10px;
    background-color: #898989;
    color: white;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    
}

.div-area-img{
    text-align: center;
}


.img-area{
    width: 60px;
    height: 60px;
    
}

.img-icon{
    width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
}




.div-form-1, .div-form-2, .div-form-0,  .div-form-3{

    width: 100%;
}
.div-f-1{
    width: 33%;
    align-items: center;
    text-align: center;
    display: flex;
    justify-content: center;
    margin: 0 auto;
    padding: 10px;
    background-color: #f9f9f9;
    color: black;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    margin-top: 1rem;
  
}

.div-form-2{
    width: 50%;
    height: 140px;
    align-items: center;
    margin: 0 auto;
    padding: 10px;
    background-color: #f9f9f9;
    color: black;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    margin-top: 1rem;
    margin-left: 2vw !important;

}
.div-form-1{
    width: 100%;
    height: 140px;
    align-items: center;
    margin: 0 auto;
    padding: 10px;
    background-color: #f9f9f9;
    color: black;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    margin-top: 1rem;
}
.div-form-2{
    width: 100%;
    height: 140px;
    align-items: center;
    margin: 0 auto;
    padding: 10px;
    background-color: #f9f9f9;
    color: black;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); 
    margin-top: 1rem;
}

.div-form-0{
    margin-top: 2rem;
   
    color: #f8b80b;
    margin-top: 4rem;
}

.div-form-3{
    width: 100%;
   
   
    margin: 0 auto;
    padding: 10px;
    background-color: #f9f9f9;
    color: black;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); 
    margin-top: 1rem;
    justify-content: center;
    display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-around;
}


.div-map{
    width: 100%;
    height: 400px;
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

#vi-ti{
    border-bottom: solid black 2px;
}
#vi-ti-1{
    border-bottom: solid black 2px;
}
.div-di{
    width: 50%;
    height: 100%;
    float: right;
}


.div-lado-imagem h3{
    font-size: 1.75rem;
    margin-bottom: 0;
}

.div-inf{
    display: flex;
    height: 10vw;
    background-color: red;
}
.div-dev{
    display: flex;
   margin-bottom: 3vw;
   flex-wrap: wrap;
}
.t-div{
    width: 100%;
    height: 100%;
    text-align: left;
    margin-left:  2%;
    font-size: 1.5rem;
    
    display: flex;
 
  align-items: center;
}

.div-form-ti{
    text-align: center;
    
    color: black;
    border-bottom: 2px solid #f8b80b;
    border-top: 2px solid #f8b80b;
    margin-bottom: 2rem;
}
#ti-vi{
    font-size: 2rem !important;
}
.carousel-indicators img{
            width: 70px;
            display: block;
        }
        .carousel-indicators button{
            width: max-content!important;
        }
        .carousel-indicators{
            position: unset;
        }
        .w-100{
            width: 90%;
            height: 50rem;
            object-fit: cover;
            border-radius: 10px;
        }
        .img-em{
            border-radius: 5px;
            width: 50px;
            height: 50px
                }
        .carousel-control-next-icon, .carousel-control-prev-icon{
            width: 50px;
            height: 50px;
            
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

    </style>
<body>
<?php
// Obtém o id da propriedade a ser alterada
$id_propri = filter_input(INPUT_GET, "id_propri", FILTER_SANITIZE_NUMBER_INT);

// Faz o SELECT das imagens associadas à propriedade
$sql_img = "SELECT imagem1, imagem2, imagem3 FROM imgPropriedade WHERE id_propri = ?";
$stmt_img = $conn->prepare($sql_img);
$stmt_img->execute([$id_propri]);

// Fetch as associative array
$rowImgs = $stmt_img->fetch(PDO::FETCH_ASSOC);

// Verifica se os campos contêm recursos (streams) e converte-os para string
$imagem1_data = !empty($rowImgs['imagem1']) ? stream_get_contents($rowImgs['imagem1']) : null;
$imagem2_data = !empty($rowImgs['imagem2']) ? stream_get_contents($rowImgs['imagem2']) : null;
$imagem3_data = !empty($rowImgs['imagem3']) ? stream_get_contents($rowImgs['imagem3']) : null;

// Converte as imagens para base64 ou exibe imagem padrão se não existir
$imagem1 = $imagem1_data ? 'data:image/jpeg;base64,' . base64_encode($imagem1_data) : 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';
$imagem2 = $imagem2_data ? 'data:image/jpeg;base64,' . base64_encode($imagem2_data) : 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';
$imagem3 = $imagem3_data ? 'data:image/jpeg;base64,' . base64_encode($imagem3_data) : 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';

//SELECT DADOS
$sql = "SELECT titulo, tamanho, tipo_solo, estado, cidade, coordenadas, id FROM propriedade WHERE id_propri = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id_propri]);
$rowPropriedade = $stmt->fetch();

// Buscar dados do proprietário
$sql = "SELECT nome, telefone, cpf, email FROM proprietario WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$rowPropriedade['id']]);
$rowProprietario = $stmt->fetch();

if (is_array($rowProprietario)) {
    $telefone = $rowProprietario["telefone"];
    $telefoneSemCaracteres = preg_replace('/\D/', '', $telefone);
    $nome = $rowProprietario["nome"];
    $cpf = $rowProprietario["cpf"];
    $email = $rowProprietario["email"];
} else {
    $telefone = '';
    $telefoneSemCaracteres = '';
    $nome = '';
    $cpf = '';
    $email = '';
}

// Buscar imagem do proprietário (se existir)
$sqlImg = "SELECT imagem1 FROM imgProprietario WHERE id = ?";
$stmtImg = $conn->prepare($sqlImg);
$stmtImg->execute([$rowPropriedade['id']]);
$rowImagem = $stmtImg->fetch(PDO::FETCH_ASSOC);

if (is_array($rowImagem)) {
    $imagemBinaria = is_resource($rowImagem["imagem1"]) ? stream_get_contents($rowImagem["imagem1"]) : $rowImagem["imagem1"];
    $imagem = 'data:image/jpeg;base64,' . base64_encode($imagemBinaria);
} else {
    $imagem = 'https://cdn-icons-png.flaticon.com/512/5987/5987462.png';
}

?>
                
 <div class="divao">              
                 
        <div class="div-sec"> 
                           
       
                <form action="inserir_propriedade.php" method="POST" class="form">
                <div class="div-form-ti">
            <h2 class="ti-h2"><?= $rowPropriedade["titulo"] ?></h2> 
            </div> 
                
                <div class="carousel slide" 
id="carouselDemo"
data-bs-wrap="true" 
data-bs-ride="carousel">

    <div class="carousel-inner">

        <div class="carousel-item active">
            <img src="<?= $imagem1 ?>" class="w-100">
            <div class="carousel-caption">
                
            </div>
        </div>

        <div class="carousel-item " 
        data-bs-interval="2000">
            <img src="<?= $imagem2 ?>" class="w-100">
            <div class="carousel-caption">
               
            </div>
        </div>

        <div class="carousel-item ">
            <img src="<?= $imagem3 ?>" class="w-100">
            <div class="carousel-caption">
                
            </div>
        </div>

    </div>

    <button class="carousel-control-prev" 
    type="button"
    data-bs-target="#carouselDemo" 
    data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next"
    type="button"
    data-bs-target="#carouselDemo"
    data-bs-slide="next">
    <span  class="carousel-control-next-icon"></span>
</button>

    <div class="carousel-indicators">
        <button type="button" class="active"
            data-bs-target="#carouselDemo"
            data-bs-slide-to="0">
            <img class="img-em" src="<?= $imagem1 ?>" />
        </button>

        <button type="button" 
        data-bs-target="#carouselDemo"
        data-bs-slide-to="1">
            <img class="img-em" src="<?= $imagem2 ?>" />
        </button>

        <button type="button"
        data-bs-target="#carouselDemo"
        data-bs-slide-to="2">
            <img class="img-em" src="<?= $imagem3 ?>" />
        </button>
    </div>

</div>
                 
                </form>
                
                <div class="div-form-0">
                
                    <h2 id="vi-ti-1">Proprietário:</h2>
            
<div class="div-dev">

<div class="div-f-1">

<div class="div-area-img">
<img src="<?= $imagem ?>" alt="" class="img-icon">
<br>
<h3 class="h3-c">
<?= $rowProprietario["nome"] ?>
</h3>

</div>
 </div>

<div class="div-f-1">

<div class="div-area-img">
<i class="material-icons">phone</i>
<br>
<h3 class="h3-c">
<?= $rowProprietario["telefone"] ?>
</h3>

</div>
 </div>


<div class="div-f-1">

<div class="div-area-img">
<i class="fa fa-envelope" style="font-size:24px"></i>
<br>
<h3 class="h3-c">
<?= $rowProprietario["email"] ?>
</h3>

</div>

                </div>


    </div>
                <h2 id="vi-ti">Visão Geral:</h2>  

                <div style="display: flex;">

                
<div class="div-form-1">
       
<h3>Área</h3>
<div class="div-area-img">
<img class="img-area" src="https://cdn-icons-png.flaticon.com/512/7260/7260357.png" alt=""> 
<h3>
<?= $rowPropriedade["tamanho"] ?> m²
</h3>
</div>

</div>

<div class="div-form-2">
       
<h3>Solo</h3>
<div class="div-area-img">
<img class="img-area" src="https://cdn-icons-png.flaticon.com/512/5612/5612660.png" alt=""> 
<h3>
<?= $rowPropriedade["tipo_solo"] ?>
</h3>

        </div>
          
        </div>

       
               </div>
               
               <div class="div-form-0">
               <h2>Localização:</h2>
               </div>
               
               <div class="div-form-3">
       
      
       <div id="map" class="div-map">

</div>
<div class="div-lado-imagem">
   
                                        <div class="div-coordenadas">
                                        <h3>Coordenadas:</h3>
                                            <i class="fas fa-search-location" style='font-size:17px; color: #7f8c8d;'></i>
                                            <input value="" type="text" name="coordenadas" id="input-coordenadas" required readonly>
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
       
</div>
         </div>
         
         </div>
         
        </div><!-- first content -->
        
    </div>
<a href="https://wa.me/<?=$telefoneSemCaracteres?>?text=Olá, está propriedade está disponível?" target="_blank">
    <div class="whats">
        <img src="images/whatsapp.png" widht="75px" height="75px" alt="Converse com o proprietário pelo Whatsapp">
    </div>
    </a>

    <script src="js-login/app.js"></script>

    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script>
    const inputFile = document.querySelector("#picture__input");
const pictureImage = document.querySelector(".picture__image");
const pictureImageTxt = "Adicionar imagem";
pictureImage.innerHTML = pictureImageTxt;

inputFile.addEventListener("change", function (e) {
  const inputTarget = e.target;
  const file = inputTarget.files[0];

  if (file) {
    const reader = new FileReader();

    reader.addEventListener("load", function (e) {
      const readerTarget = e.target;

      const img = document.createElement("img");
      img.src = readerTarget.result;
      img.classList.add("picture__img");

      pictureImage.innerHTML = "";
      pictureImage.appendChild(img);
    });

    reader.readAsDataURL(file);
  } else {
    pictureImage.innerHTML = pictureImageTxt;
  }
});

</script>
<script>
    // Evento para alterar a imagem quando um novo arquivo for selecionado
    document.getElementById('imageFile').addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('imagem').src = e.target.result;
        }
        reader.readAsDataURL(file);
      }
    });
  </script>
  <script>
  // Função para formatar os números com ponto a cada 3 dígitos
  function formatNumber(input) {
    // Remove qualquer caractere que não seja dígito
    let value = input.value.replace(/\D/g, '');

    // Formata o número com ponto a cada 3 dígitos
    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    // Atualiza o valor no campo de input sem o "m²"
    input.value = value;
  }
  
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



</script>



<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>

</script>


</html>











