<?php
ob_start();
session_start();
require 'logica-autenticacao.php';
if (!isProprietario()) {
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
    .table th, .table tr {
        height: 100px;
   }
#td-nome{
  
}
   
    .table th {
       
        color: black;
    }

    .table td img {
        width: 130px;
        height: 90px;
        border-radius: 0.3vw;
        
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
.link-icon{
    text-decoration: none;
}
#td-id{
    font-weight: bold !important;
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
$usuario_admin = isAdmin(); // Supondo que o campo 'is_admin' indica se o usuário é administrador (1 = admin, 0 = não-admin)

// Obtém o ID do usuário da URL
$id_usuario_url = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

// Verifica se o ID está vazio
if (empty($id_usuario_url)) {
    header("Location: listagem_minhas_propriedades.php?id=$usuario_id");
    exit;
}

// Se o usuário não for administrador, verifica se ele está tentando acessar suas próprias propriedades
if (!$usuario_admin) {
    // Verifica se o ID do usuário na URL corresponde ao ID do usuário logado
    if ($id_usuario_url != $usuario_id) {
        // Se o ID da URL não corresponder ao ID do usuário logado, redireciona para a página inicial
        header("Location: listagem_minhas_propriedades.php?id=$usuario_id");
        exit;
    }
}

// Faz o SELECT das propriedades associadas ao usuário (seja admin ou não)
$sql = "SELECT p.id_propri, p.titulo, i.imagem1, i.imagem2, i.imagem3 FROM propriedade p INNER JOIN imgPropriedade i ON p.id_propri = i.id_propri WHERE p.id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$id_usuario_url]);
$propriedades = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Exibe a lista de propriedades
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Propriedades</title>
</head>
<body>

<div class="table-container" id="div-h1">     
    <div id="in-div">
        <i id="link-v" class='far fa-arrow-alt-circle-left' style='font-size:28px;' onclick="window.location.href='listagem.php'"></i>
    </div>
    <h1 class="ti-h1">Minhas Propriedades</h1>
</div>

<div class="div-t">
    <div class="container">
        <div class="content">
            <div class="table-container-2">
                
                <table class="table">
                    <thead>
                        <tr>
                            
                            <th>Foto Principal</th>
                            <th>Título</th>
                            <th>Ações</th>
                        </tr>   
                    </thead>
                    <tbody>

                    <?php foreach ($propriedades as $propriedade): ?>
                        <?php
                        // Verifica se os campos contêm recursos (streams) e converte-os para string
                        $imagem1_data = !empty($propriedade['imagem1']) ? stream_get_contents($propriedade['imagem1']) : null;

                        // Converte as imagens para base64 ou exibe imagem padrão se não existir
                        $imagem1 = $imagem1_data ? 'data:image/jpeg;base64,' . base64_encode($imagem1_data) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8lRbS7eKYzDq-Ftxc1p8G_TTw2unWBMEYUw&s';
                        ?>
                        <tr>
                            
                            <td><img src="<?= $imagem1 ?>"></td>
                            <td id="id-nome"><?= htmlspecialchars($propriedade["titulo"]) ?></td>
                            <td>
                                <!-- Link para editar a propriedade -->
                                <a class="link-icon" href="form_alterar_propriedade.php?id_propri=<?= htmlspecialchars($propriedade['id_propri']) ?>&id=<?= htmlspecialchars($id_usuario_url) ?>">
                                    <div class="large material-icons" style=" font-size: 2rem; color: #a37906;">create</div>
                                </a>

                                <!-- Link para excluir a propriedade, com confirmação -->
                                <a class="link-icon" href="excluir_propriedade.php?id_propri=<?= htmlspecialchars($propriedade['id_propri']) ?>&id=<?= htmlspecialchars($id_usuario_url) ?>" 
                                   onclick="return confirm('Tem certeza que deseja excluir?')">
                                   <div class="large material-icons" style="font-size: 2rem; color: red;">delete</div>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>

</html>
<?php
ob_end_flush();  // Envia a saída armazenada no buffer
?>