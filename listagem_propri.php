<?php
session_start();
require 'logica-autenticacao.php';
if (!isAdmin()) {
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
.table tr:nth-child(odd) {
    background-color: #f9f9f9;
}

.table tr:nth-child(even) {
    background-color: #ebebeb;
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
.excluir-btn {
  background-color: #FF0000; /* Cor vermelho */
  border: none;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
  border-radius: 5px;
}

.excluir-btn:hover {
  background-color: #CC0000; /* Cor vermelho escuro para o efeito de hover */
}

.excluir-btn i {
  color: #FFFFFF; /* Cor branca para a lixeira */
}
.link-icon{
    text-decoration: none;
}
</style>
<body>

<div class="table-container" id="div-h1">     
    <div id="in-div">
        <i id="link-v" class='far fa-arrow-alt-circle-left' style='font-size:28px;' onclick="window.location.href='listagem.php'"></i>
    </div>
    <h1 class="ti-h1">Listagem de Propriedades</h1>
</div>

<div class="div-t">
    <div class="container">
        <div class="content">
            <div class="table-container-2">
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Ações</th>
                        </tr>   
                    </thead>
                    <tbody>

                    <?php
                    // Conexão com o banco de dados
                    require 'conexao.php';

                    // Verifica se o ID do proprietário foi passado na URL
                    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                        $idProprietario = $_GET['id'];

                        // Consulta SQL para listar propriedades do proprietário específico
                        $sql = "SELECT id_propri, titulo FROM propriedade WHERE id = ? ORDER BY id_propri";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([$idProprietario]);

                        // Itera sobre os resultados e exibe as propriedades na tabela
                        while ($row = $stmt->fetch()) {
                    ?>
                            <tr>
                                <td id="td-id"><?= htmlspecialchars($row["id_propri"]) ?></td>
                                <td id="id-nome"><?= htmlspecialchars($row["titulo"]) ?></td>
                                <td>
                                    <!-- Link para editar a propriedade -->
                                    <a class="link-icon" href="form_alterar_propriedade.php?id_propri=<?= htmlspecialchars($row['id_propri']) ?>">
                                        <div class="large material-icons" style="font-size: 2rem; color: #a37906;">create</div>
                                    </a>

                                    <!-- Link para excluir a propriedade, com confirmação -->
                                    <a class="link-icon" href="excluir_propriedade.php?id_propri=<?= htmlspecialchars($row['id_propri']) ?>&id=<?= htmlspecialchars($idProprietario) ?>" 
   onclick="return confirm('Tem certeza que deseja excluir?')">
    <div class="large material-icons" style="font-size: 2rem; color: red;">delete</div>
</a>


                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='3'>ID de proprietário inválido ou não fornecido.</td></tr>";
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>

</html>