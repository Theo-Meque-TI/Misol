<?php
session_start();
require 'logica-autenticacao.php';

if (!isAdmin()) {
  redireciona();
  die();
}

require 'conexao.php';

$id = id_usuario();

$sql = "SELECT id, nome, telefone, cpf, email, senha, imagem
FROM proprietario";

$stmt = $conn->prepare($sql);
$stmt->execute();

$proprietarios = $stmt->fetchAll();

/*IMAGEM PROPRIETÁRIO */
$sqlImg = "SELECT imagem1 FROM imgProprietario WHERE id = ?";
$stmtImg = $conn->prepare($sqlImg);


/*IMAGEM PROPRIETÁRIO */

/*IMAGEM EMPRESA */
$sqlImgEmpresa = "SELECT imagem1 FROM imgEmpresa WHERE id_emp = ?";
$stmtImgEmpresa = $conn->prepare($sqlImgEmpresa);


/*IMAGEM EMPRESA */

$sql = "SELECT id_emp, nome_emp, telefone_emp, cnpj, email_emp, senha_emp, imagem_emp
FROM empresa";

$stmt = $conn->prepare($sql);
$stmt->execute();

$empresas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Misol</title>
   
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<style>
    @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap');
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: 'Open Sans', sans-serif;
        
    }
    @media (max-width: 768px) {
    .content {
        flex-direction: column;
    }
    .table-container,  .table-container2 {

        width: 100%;
    }
    .linha-vertical {
        height: 0;/*Altura da linha*/
  border-left: 2px solid white;/* Adiciona borda esquerda na div como ser fosse uma linha.*/
  

   
}
    }
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-position: center;
        
    }

    .content {
      background-color: #f9f9f9;
        width: 100%;
        height: 100%;
        justify-content: space-between;
        align-items: center;
        position: relative;
        display: flex;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        
    }

.img-icon{
    object-fit: cover;
}

    .title {
        font-size: 24px;
        font-weight: bold;
       
        color: #f8b80b;
    }

    .table-container {
        width: 100%;
        height: 100%;
        overflow-y: auto;
        display: flex;
        justify-content: left;
        padding: 20px;
        text-align: center;
        background-color: black;
    }
    .table-container-2 {
        width: 100%;
        height: 100%;
        overflow-y: auto;
        padding: 20px;
        text-align: center;
        background-color: #f9f9f9;
        
    }
    .table {
        width: 100%;
        margin-top: 1rem;
        color: white;
        
        background-color: #bebcbc38;
        color: black;
        font-family: 'Open Sans', sans-serif;
        
    }

    .table th, .table td {
       
        padding: 10px;
        text-align: center;
        
        
    }
#td-nome{
  
}
   
    .table th {
       
        color: black;
    }

    .table td img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        
    }

    .btn-editar, .btn-excluir {
        background-color: #f8b80b;
        color: #fff;
        border: none;
        padding: 5px 10px;
        font-size: 12px;
        cursor: pointer;
        border-radius: 0.5vw;
        font-family: 'Open Sans', sans-serif;
        margin: 0.3vw;
    }

    .btn-excluir {
        background-color: #ff0000;
    }
    .ti-h1{
        width: 95%;
        color: #f8b80b;
    }
    .div-h1{
        width: 100%;
        align-items: center;
        display: flex;
            }

    #div-h1{
       text-align: center;
       border-bottom: 2px solid black;
    }
  
.div-t{
    
background-color: black;
width: 100%;
height: 100%;
}
#link-v{
    text-decoration: none;
    color:white;
    cursor: pointer;
    margin-left: 0;
display: flex;
text-decoration: none;


}
.h1-volt{
    font-family: 'Open Sans', sans-serif;
    color: black;
    font-size: 20px;
    text-decoration: none;
}
#in-div{
   
}
#cart-btn{
    
    cursor: pointer;
    border-radius: 0.3vw;
  
}

#cart-btn:hover{
 
    transition: transform 0.3s;
    transform: scale(1.1);
}
.link-icon:hover{
    transition: transform 0.3s;
    transform: scale(1.1);
} 

#td-id{
    font-weight: bold !important;
}
.table tr:nth-child(odd) {
    background-color: #f9f9f9;
}

.table tr:nth-child(even) {
    background-color: #ebebeb;
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
<body>



<div class="table-container" id="div-h1">     
<div id="in-div">
<i id="link-v" class='far fa-arrow-alt-circle-left' style='font-size:28px;' onclick="window.location.href='index.php'"></i>
</div>

<h1 class="ti-h1">Listagem</h1>

</div>

<div class="div-t">

    <div class="container">

        <div class="content">
            <div class="table-container-2">
                <hr>
                <h2 class="title">Proprietários</h2>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Propriedades</th>
                            <th>Img</th>
                            <th>Nome</th>
                           
                            <th>Ações</th>
                        </tr>   
                    </thead>
                    <tbody>
                        <?php 
                        
                        foreach ($proprietarios as $row) { ?>
                            <tr>
                                <td id="td-id"><?= $row["id"] ?></td>
                                <td><a style="color: black;" href="listagem_propri.php?id=<?= $row["id"]?>"><div class='far fa-folder' id="cart-btn"></div></a></td>
                                <?php 
                                    $stmtImg->execute([$row["id"]]);
                                    $rowImagem = $stmtImg->fetch(PDO::FETCH_ASSOC);
                                    if ($rowImagem) {
                                        $imagemBinaria = is_resource($rowImagem["imagem1"]) ? stream_get_contents($rowImagem["imagem1"]) : $rowImagem["imagem1"];
                                        $imagem = 'data:image/jpeg;base64,' . base64_encode($imagemBinaria);
                                    } else {
                                        $imagem = 'https://icones.pro/wp-content/uploads/2021/02/icone-utilisateur-gris.png';
                                    }
                                ?>
                                <td><img src="<?= $imagem ?>" alt="" class="img-icon"></td>
                                <td id="id-nome"><?= $row["nome"] ?></td>
                                
                                <td>
                                    <a  href="form_alterar_proprietario.php?id=<?= $row["id"]?>"><div class="large material-icons" style="font-size: 2rem; color: #a37906;">create</div></a>
                                    <a  href="excluir_proprietario.php?id=<?= $row["id"]?>" onclick="if(!confirm('Tem certeza que deseja excluir?')) return false;"><div class="large material-icons" style="font-size: 2rem; color: red;">delete</div></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="table-container-2">
    <hr>
    <h2 class="title">Empresas</h2>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Img</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($empresas as $row) { ?>
                <tr>
                    <td id="td-id"><?= $row["id_emp"] ?></td>
                    <?php 
                        $stmtImgEmpresa->execute([$row["id_emp"]]);
                        $rowImagemEmpresa = $stmtImgEmpresa->fetch(PDO::FETCH_ASSOC);
                        if ($rowImagemEmpresa) {
                            $imagemBinariaEmpresa = is_resource($rowImagemEmpresa["imagem1"]) ? stream_get_contents($rowImagemEmpresa["imagem1"]) : $rowImagemEmpresa["imagem1"];
                            $imagemEmpresa = 'data:image/jpeg;base64,' . base64_encode($imagemBinariaEmpresa);
                        } else {
                            $imagemEmpresa = 'https://png.pngtree.com/png-vector/20190926/ourmid/pngtree-building-icon-isolated-on-abstract-background-png-image_1743000.jpg';
                        }
                    ?>
                    <td><img src="<?= $imagemEmpresa ?>" alt="" class="img-icon"></td>
                    <td maxlength="10"><?= $row["nome_emp"] ?></td>
                    <td>
                        <a  href="form_alterar_empresa.php?id_emp=<?= $row["id_emp"]?>"><div class="large material-icons" style="font-size: 2rem; color: #a37906;">create</div></a>
                        <a  href="excluir_empresa.php?id_emp=<?= $row["id_emp"]?>" onclick="if(!confirm('Tem certeza que deseja excluir?')) return false;"><div class="large material-icons" style="font-size: 2rem; color: red;">delete</div></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php
         if (isset($_SESSION["result"])) {
            $mostrarBalao = true;
            if ($_SESSION["result"]) {
              // SE DEU CERTO, SE PO RESULT FOR TRUE
              ?>
              <script>
                const balao = document.createElement('div');
                balao.classList.add('balao');
                balao.innerHTML = 'Excluído com Sucesso.';
                document.body.appendChild(balao);
                setTimeout(() => {
                  balao.remove();
                }, 3000);
              </script>
              <?php
           
            } else {
              $erro = $_SESSION["erro"];
              unset($_SESSION["erro"]);
              ?>
              <script>
                const balao = document.createElement('div');
                balao.classList.add('balao');
                balao.innerHTML = 'Erro ao excluir.';
                document.body.appendChild(balao);
                balao.style.background = '#f2dede'; /* Vermelho claro */
                balao.style.color = '#a94442'; /* Vermelho escuro */
                setTimeout(() => {
                  balao.remove();
                }, 3000);
              </script>
              <?php
            }
            unset($_SESSION["result"]);
          } else {
            $mostrarBalao = false;
          }
 if ($mostrarBalao) {
            ?>
            <script>
              //BALÃO//


// Crie um elemento div para o balão
const balao = document.createElement('div');
balao.classList.add('balao');

// Adicione o texto ao balão
balao.innerHTML = 'Propriedade Excluída';

// Adicione o balão ao corpo da página
document.body.appendChild(balao);

// Defina a posição do balão
balao.style.top = '50%';
balao.style.left = '50%';
balao.style.transform = 'translate(-50%, -50%)';

// Defina o tempo de exibição do balão
setTimeout(() => {
  balao.remove();
}, 3000);
//BALÃO//
            </script>
            <?php
          }
?>
</div>
        </div>
    </div>
</div>

</body>
</html>