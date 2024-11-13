<?php
session_start();
require 'logica-autenticacao.php';
if (isAdmin()) {
    redireciona();
    die();
  }elseif(isProprietario()){
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

.img-erro{
    width: 3.5rem;
    height: 3.5rem;
   margin: 0.5rem;
}


#link-v{
    text-decoration: none;
    color: black;
    cursor: pointer;
    margin-left: 0;

text-decoration: none;
color: white;

}

.div-sucesso{
    background-color: #edffe6;
    border-radius: 0.6vw;
    color: black;
    display: flex;
    flex-direction: column;
    text-align: center;
    align-items: center;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    margin-top: 2vw;
    width: 100%;    
}

.div-sucesso a{
    
    color: #f8b80b;
}

.div-erro{
    background-color: #ff9292;
    border-radius: 0.6vw;
    color: black;
    display: flex;
    flex-direction: column;
    text-align: center;
    align-items: center;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    margin-top: 2vw;
    width: 100%;
}

.div-erro p{
    color: #970000;
}


























    </style>
<body>
    <div class="container">
        
        <div class="content first-content">
            
            <div class="first-column">
            <div id="in-div">

</div>
                <h2 class="title title-primary"><i id="link-v" class='far fa-arrow-alt-circle-left' style='font: size 28px;px;' onclick="window.location.href='index.php'"></i>Cadastrar Perfil</h2>
               
                <p class="description description-primary"> </p>

                <!-- COLOCAR UM IF NESSE VOLTAR(DEPENDE DO TIPO DE USUÁRIO) -->
                <p class="description description-primary">já é cadastrado?</p>
                <a href="form_login_proprietario.php"><button class="btn btn-primary">Entrar</button></a>
                
            </div>    
            
                
 <div class="divao">              
                    
        <div class="div-sec">                 
        <h2 class="title title-second">Criar Conta</h2>
      

</form>
        <form id="form-dados" action="inserir_proprietario.php" method="POST" class="form"  onsubmit="return validarFormulario()">

       



<label class="label-input" for="">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" required autofocus>
                    </label>

                    <label class="label-input" for="">
                    <i class="fa fa-phone" style="color: #7f8c8d; margin: 0.3vw;"></i>
                    <input type="text" id="telefone" name="telefone" placeholder="Telefone" required autofocus>
                    </label>

                    <label class="label-input" for="">
                    <i class='fas fa-id-card' style="color: #7f8c8d; margin: 0.3vw;"></i>
                    <input type="text" id="cpf" name="cpf" placeholder="CPF" required autofocus>
                    </label>
                    
                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="email" id="email" name="email" placeholder="Email" required autofocus>
                    </label>
                    
                    <label class="label-input" for="">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password"id="senha" name="senha" placeholder="Senha" required autofocus>
                    </label>

                    <label class="label-input" for="">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password" id="confirma" placeholder="Confirmar Senha" required autofocus>
                    </label>
                    
                    
                    <button ID="btn-enviar" class="btn btn-second" type="submit">Cadastrar</button>        
                </form>
           <?php   
            
if (isset($_SESSION["result"])) {

if ($_SESSION["result"]) {
// SE DEU CERTO, SE PO RESULT FOR TRUE
?>
<div class="div-sucesso">
<h3>Cadastro  concluído</h3>
<a href="form_login_proprietario.php">Acessar Conta</a>
</div>

<?php
}else{
$erro = $_SESSION["erro"];
unset($_SESSION["erro"]);
?>
<div class="div-erro">
<h3>Falha ao autenticar</h3>

<p><?php echo $erro; ?></p>
</div>
<?php
}
unset($_SESSION["result"]);
}
?>
         </div>
        
        
    </div>



    <script src="js-login/app.js"></script>


<script>
    // Função para verificar se há campos vazios
function validarCamposVazios() {
    // Seleciona todos os inputs dentro do formulário, exceto os campos desabilitados
    var campos = document.querySelectorAll('form input:not([disabled])');
    
    // Itera sobre os campos e verifica se algum está vazio
    for (var i = 0; i < campos.length; i++) {
        if (campos[i].value.trim() === '') {
            alert('Preencha todos os campos!');
            return false;  // Impede o envio do formulário
        }
    }
    
    // Verifica se as senhas coincidem
    var senha = document.getElementById('senha_emp').value;
    var confirmaSenha = document.getElementById('confirma').value;
    if (senha !== confirmaSenha) {
        alert('As senhas não coincidem!');
        return false;  // Impede o envio do formulário
    }

    return true;  // Permite o envio do formulário se tudo estiver correto
}

// Função para validar o CNPJ e telefone
function validarFormulario() {
    var cpf = document.getElementById('cpf').value; // Obtém o valor do campo de CPF
    var telefone = document.getElementById('telefone').value;

    // Verifica se o CNPJ está preenchido corretamente
    var cpfClean = cpf.replace(/\D+/g, ''); // Remove caracteres não numéricos
    if (cpfClean.length != 11) {
        alert('O campo de CPF está incompleto.');
        return false;
    }

    // Verifica se o telefone está preenchido corretamente
    var telefoneClean = telefone.replace(/\D+/g, ''); // Remove caracteres não numéricos
    if (telefoneClean.length != 11) {
        alert('Digite todos os números do telefone.');
        return false;
    }

    return true;  // Permite o envio do formulário
}
 // Adicione o seguinte código para formatar o CPF automaticamente
document.getElementById('cpf').addEventListener('input', function() {
    var cpf = this.value;
    var cpfClean = cpf.replace(/\D+/g, ''); // remove non-digit characters
    if (cpfClean.length > 11) {
        cpfClean = cpfClean.substring(0, 11);
    }
    this.value = cpfClean.replace(/(\d{3})(\d{3})(\d{3})(\d{2})$/, '$1.$2.$3-$4'); // format CPF
});

// Adicione o seguinte código para formatar o telefone automaticamente
document.getElementById('telefone').addEventListener('input', function() {
    var telefone = this.value;
    var telefoneClean = telefone.replace(/\D+/g, ''); // remove non-digit characters
    if (telefoneClean.length > 11) {
        telefoneClean = telefoneClean.substring(0, 11);
    }
    this.value = telefoneClean.replace(/(\d{2})(\d{5})(\d{4})$/, '($1)$2-$3'); // format telefone
});

// Adicione o seguinte código para validar os campos de senha e confirmar senha
document.getElementById('senha').addEventListener('input', function() {
    var senha = this.value;
    var confirmarSenha = document.getElementById('confirma').value;
    if (senha !== confirmarSenha) {
        document.getElementById('confirma').style.border = '1px solid red';
        document.getElementById('confirma').style.boxShadow = '0 0 10px rgba(255, 0, 0, 0.5)';
    } else {
        document.getElementById('confirma').style.border = '';
        document.getElementById('confirma').style.boxShadow = '';
    }
});

document.getElementById('confirma').addEventListener('input', function() {
    var senha = document.getElementById('senha').value;
    var confirmarSenha = this.value;
    if (senha !== confirmarSenha) {
        this.style.border = '1px solid red';
        this.style.boxShadow = '0 0 10px rgba(255, 0, 0, 0.5)';
    } else {
        this.style.border = '';
        this.style.boxShadow = '';
    }
});

// Adicione o seguinte código para validar os campos de senha e confirmar senha no momento do envio do formulário
document.getElementById('form-dados').addEventListener('submit', function(event) {
    var senha = document.getElementById('senha').value;
    var confirmarSenha = document.getElementById('confirma').value;
    if (senha !== confirmarSenha) {
        alert('As senhas não conferem!');
        event.preventDefault();
    }
});
   
//IMPEDE QUE QUALQUER CAMPO SEJA ENVIADO VAZIO//
document.getElementById('form-dados').addEventListener('submit', function(event) {
    var campos = document.querySelectorAll('#form-dados input, #form-dados select, #form-dados textarea');
    var camposVazios = Array.prototype.filter.call(campos, function(campo) {
        return campo.value.trim() === '';
    });
    if (camposVazios.length > 0) {
        alert('Preencha todos os campos!');
        event.preventDefault();
    }
});

</script>
    
</body>




</html>