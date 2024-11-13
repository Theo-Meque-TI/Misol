<?php
session_start();
require 'logica-autenticacao.php';
ob_start();


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <title>Misol</title>
    

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

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
    display: flex;
  justify-content: center;
  align-items: center; /* Alinha verticalmente o conteúdo */
  width: 150px;
  height: 150px;
  border-radius: 50%; /* Garante que a imagem tenha um formato circular */
  overflow: hidden; /* Oculta qualquer parte da imagem que sair do contorno circular */
  margin: 0 auto; /* Centraliza horizontalmente */
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
    height: 100%;
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
      width: 9rem;
      height: 9rem;
      object-fit: cover;
      border-radius: 50%;
     
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
      width: 110px;
      transform: translate(-50%, -50%);
      font-size: 10px;
      color: white;
      font-weight: bold;
      background-color: rgba(0, 0, 0, 0.5); /* Fundo semi-transparente */
      padding: 10px 20px;
      border-radius: 5px;
      pointer-events: none; /* Para garantir que o clique seja detectado pelo input */
      opacity: 90%;
    }
.title {
    font-size: 28px;
    font-weight: bold;
    
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
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
}
.btn-primary {
    background-color: black;
    border: 1px solid #fff;
    color: white;
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
    width: 100%;
    text-align: center;
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
    width: 60%;

    align-items: center;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

.divao{
 
    justify-content: center;
    align-items: center;
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
.div-sec{
    width: 100%;
    
}
.divao{
    width: 95%;
}
.input-label {
    
      font-size: 5px;
      font-weight: bold;

}
.div-img{

  width: 99%;
  
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
    height: 300px;
    width: 99%;
    border-radius: 10px;
}


element .style{
    position: relative;
}

.img-certo{
    width: 5rem;
    height: 5rem;
   
}

.img-erro{
    width: 3.5rem;
    height: 3.5rem;
   margin: 0.5rem;
}






























    </style>
<body>
    <div class="container">
        <div class="content first-content">
            <div class="first-column">
                <h2 class="title title-primary">Verificação de Cadastro</h2>
                

                
            </div>    
            
                
 <div class="divao">              
                    
        <div class="div-sec">                 

        <?php
        require 'conexao.php';

        $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
        $telefone = filter_input(INPUT_POST, "telefone", FILTER_SANITIZE_SPECIAL_CHARS);
        $cpf = filter_input(INPUT_POST, "cpf", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $senha = filter_input(INPUT_POST, "senha");
        //$senha_hash = password_hash($senha, PASSWORD_BCRYPT);
        $imagem = filter_input(INPUT_POST, "imagem", FILTER_SANITIZE_EMAIL);

        $sql = "INSERT INTO proprietario(nome, telefone, cpf, email, senha, imagem)
        VALUES (?, ?, ?, ?, crypt(?, gen_salt('bf', 8)), ?)";
        
        /*
        echo "<p>$nome</p>";
        echo "<p>$telefone</p>";
        echo "<p>$cpf</p>";
        echo "<p>$email</p>";
        echo "<p>$senha</p>";
        echo "<p>$senha_hash</p>";
        echo "<p>$imagem</p>";
        */
        

        try{

            
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$nome, $telefone, $cpf, $email, $senha, $imagem]);
          
        } catch(Exception $e) {
            $result = false;
            $error = $e->getMessage();
        }

        if ($result == true) {
            ?>
            <!-- deu certo o insert -->
            <?php
            $_SESSION['result'] = true;

            ?>
            <?php
            } else {
            ?>
            <?php
            /*não deu certo, erro */
           //Tratamento de erro
if(strpos($error, "SQLSTATE[23505]") !== false || strpos($error, "SQLSTATE[P0001]") !== false){
    $error = "O email ou o cpf já está em uso. ";
}
            $_SESSION['result'] = false;
            $_SESSION['erro'] = $error;
            ?>
            <?php
            }
            redireciona("form_cadastrar_proprietario.php");

            ob_end_flush();
             ?>

         </div>
        
        
    </div>



    <script src="js-login/app.js"></script>

    
</body>
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


</script>



<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
// Criação do mapa usando a API do Leaflet, com foco inicial no Brasil
const map = L.map('map').setView([-14.2350, -51.9253], 4); // Centralizado no Brasil com zoom adequado

// Adicionando a camada de tiles estilo satélite do Mapbox com a nova chave de acesso
L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/satellite-v9/tiles/{z}/{x}/{y}?access_token=sk.eyJ1IjoiYWlwYXBhaTEyMyIsImEiOiJjbTFoODF2czMwYzU2MmtvZzNxaDlybXpjIn0.iNdJN8pQfRNnzS5KUscpTA', {
    attribution: '&copy; <a href="https://www.mapbox.com/about/maps/">Mapbox</a> contributors',
    tileSize: 512,
    zoomOffset: -1,
    maxZoom: 18
}).addTo(map);

let marker = null; // Nenhum alfinete inicialmente

// Função para adicionar ou mover o alfinete no mapa
function addMarker(lat, lng) {
    if (marker) {
        // Se o alfinete já existir, move para a nova localização
        marker.setLatLng([lat, lng]);
    } else {
        // Se o alfinete não existir, cria um novo
        marker = L.marker([lat, lng], { draggable: true }).addTo(map);
        
        // Atualiza o mapa e as coordenadas quando o alfinete é arrastado
        marker.on('moveend', function (e) {
            const newPos = e.target.getLatLng();
            updateMap(newPos.lat, newPos.lng, false);  // Não ajusta o zoom ao mover o alfinete
        });
        
        // Exibe cidade e estado quando o mouse está sobre o alfinete
        marker.on('mouseover', function () {
            marker.openTooltip();
        });
        
        // Oculta a tooltip quando o mouse sai do alfinete
        marker.on('mouseout', function () {
            marker.closeTooltip();
        });
    }
    updateMap(lat, lng, false);  // Não ajusta o zoom ao clicar no mapa
}

// Função para atualizar a localização do alfinete e os campos de input com novas coordenadas, cidade e estado
function updateMap(lat, lng, adjustView = true) {
    if (adjustView) {
        map.setView([lat, lng]);  // Ajusta a visualização apenas se solicitado
    }
    // Atualiza o campo de coordenadas com lat e lng
    document.getElementById('coordInput').value = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;

    // Requisição para pegar a cidade e o estado via reverse geocoding
    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
        .then(response => response.json())
        .then(data => {
            if (data.address) {
                const city = data.address.city || data.address.town || data.address.village || '';
                const state = data.address.state || '';
                
                // Atualiza os inputs de cidade e estado
                document.getElementById('cityInput').value = city;
                document.getElementById('stateInput').value = state;
                
                // Adiciona a tooltip no alfinete
                marker.bindTooltip(`${city}, ${state}`).openTooltip();
            }
        });
}

// Adiciona o alfinete ao clicar em qualquer lugar do mapa
map.on('click', function (e) {
    const lat = e.latlng.lat;
    const lng = e.latlng.lng;
    addMarker(lat, lng);
});

</script>


</html>