<?php
require 'conexao.php';
$naomostrar = filter_input(INPUT_POST, "naomostrar", FILTER_SANITIZE_SPECIAL_CHARS);

if(isEmpresa() or isAdmin()){

    if (isset($_GET["ordem"]) && !empty($_GET["ordem"])) {
        $ordem = filter_input(INPUT_GET, "ordem", FILTER_SANITIZE_SPECIAL_CHARS);
    } else {
        $ordem = "titulo";
    }
    
    $resultadosEncontrados = false; // Inicializa a variável
    
    if (isset($_POST["busca"]) && !empty($_POST["busca"])) {
        $naomostrar = true;
        $busca = filter_input(INPUT_POST, "busca", FILTER_SANITIZE_SPECIAL_CHARS);
        $buscaOriginal = $busca;
        $tipo_busca = filter_input(INPUT_POST, "tipo_busca", FILTER_SANITIZE_SPECIAL_CHARS);
    
        // Defina a consulta SQL com base no tipo de busca
        if ($tipo_busca == "titulo") {
            $sql = "SELECT id_propri, titulo, tamanho, tipo_solo, estado, cidade, coordenadas, id 
                    FROM propriedade WHERE titulo ILIKE ? ORDER BY $ordem";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$busca]);
    
        } elseif ($tipo_busca == "todos") {
            $busca = '%' . $busca . '%';
            $busca = str_replace(' ', '%', $busca);
            $sql = "SELECT id_propri, titulo, tamanho, tipo_solo, estado, cidade, coordenadas, id 
                    FROM propriedade 
                    WHERE titulo ILIKE ? 
                    OR tamanho ILIKE ? 
                    OR cidade ILIKE ? 
                    OR estado ILIKE ? 
                    ORDER BY $ordem";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$busca, $busca, $busca, $busca]);
    
        } elseif ($tipo_busca == "cidade") {
            $busca = '%' . $busca . '%';
            $sql = "SELECT id_propri, titulo, tamanho, tipo_solo, estado, cidade, coordenadas, id 
                    FROM propriedade WHERE cidade ILIKE ? ORDER BY $ordem";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$busca]);
    
        } elseif ($tipo_busca == "estado") {
            $busca = '%' . $busca . '%';
            $sql = "SELECT id_propri, titulo, tamanho, tipo_solo, estado, cidade, coordenadas, id 
                    FROM propriedade WHERE estado ILIKE ? ORDER BY $ordem";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$busca]);
        }
    
        // Verifique se a consulta retornou resultados
        if (isset($stmt) && $stmt->rowCount() > 0) {
            $resultadosEncontrados = true;
        }
    } else {
        $naomostrar = true;
        $busca = null;
        $tipo_busca = null;
        $sql = "SELECT id_propri, titulo, tamanho, tipo_solo, estado, cidade, coordenadas, id 
                FROM propriedade ORDER BY $ordem";
        $stmt = $conn->query($sql);
    }
    
}else{
    $naomostrar = null;
}
?>



<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Misol</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    
<header class="header">

<a href="index.php" class="logo">
    <img src="images/logo5.jpg" alt="">
</a>

<nav class="navbar">
    <?php
if(empty($naomostrar)){
    ?>
    <a href="../misol/#home">Inicio</a>
    <a href="../misol/#about1">Sobre</a>
    <a href="../misol/#about2">Empresa</a>
    <a href="../misol/#about3">Proprietário</a>
    <a href="../misol/#about4">Contato</a>
    <?php
}else{
    ?>

    <?php
}
   
?>
    <!--<a href="../misol/#blogs">blogs</a>-->
</nav>


<div class="icons">
   
<?php
/*IMAGEM*//*IMAGEM*//*IMAGEM*//*IMAGEM*//*IMAGEM*/



/*IMAGEM*//*IMAGEM*//*IMAGEM*//*IMAGEM*//*IMAGEM*/

    if(isEmpresa() || isAdmin()){
        ?>
        
    <div class="fas fa-search" id="search-btn"></div>
     <?php
     }
     ?>
    <?php
    if(isProprietario()){
        ?>
    
    <a href="listagem_minhas_propriedades.php?id=<?=$_SESSION["idUsuario"]?>"><div class="far fa-folder" id="cart-folder"></div></a>
    <?php
    }
    
    

    if(isProprietario()){
    ?>
    
   <a href="form_cadastrar_propriedade.php"><div class="fas fa-plus"></div></a> 
   
   <?php
}
?>

  
  <?php
 if(isAdmin()){
    ?>
    <a href="listagem.php"><div class="fa fa-sitemap"></div></a>
<?php
}
?>
    
    
    <?php
   if (isProprietario()) {
    $id = id_usuario();
    $sqlImg = "SELECT imagem1 FROM imgProprietario WHERE id = ?";
    $stmtImg = $conn->prepare($sqlImg);
    $stmtImg->execute([$id]);
    $rowImagem = $stmtImg->fetch(PDO::FETCH_ASSOC);

    if ($rowImagem) {
        $imagemBinaria = is_resource($rowImagem["imagem1"]) ? stream_get_contents($rowImagem["imagem1"]) : $rowImagem["imagem1"];
        $imagem = 'data:image/jpeg;base64,' . base64_encode($imagemBinaria);
    } else {
        $imagem = 'https://icones.pro/wp-content/uploads/2021/02/icone-utilisateur-gris.png';
    }
?>
<?php
// Buscar dados do proprietário
$sql = "SELECT nome, telefone, cpf, email FROM proprietario WHERE id = ?";
$stmt2 = $conn->prepare($sql);
$stmt2->execute([$id]);
$rowProprietario = $stmt2->fetch();
?>
<div> <h4 style="color: white; font-size: 15px; cursor: default;text-transform: uppercase;"><?= explode(' ', $rowProprietario["nome"])[0] ?></h4></div>
<div>
    <a href="form_alterar_proprietario.php?id=<?=$_SESSION["idUsuario"]?>">
        <img class="img-user" src="<?= $imagem ?>" style="width: 50px; height: 50px; border-radius: 50%; background-color: white;"></img>
    </a>
</div>
   <a href="sair.php"><div class='fas fa-sign-out-alt' id="#"></div></a>
   
   <div class="fas fa-bars" id="menu-btn"></div>
    
    </div>
    
    <div class="fas fa-bars" id="menu-btn"></div>
        
    </div>
    <!-- Painel lateral do usuário -->
    <div id="caixa-user" class="cart-user-container">
        <div class="cart-user">
            <div class="content2">
    
                
            </div>
        </div>
    </div>
    <!-- Painel lateral do usuário -->
    <div id="caixa-user" class="cart-user-container">
        <div class="cart-user">
            <div class="content2">
    
                
            </div>
        </div>
    </div>
   <?php
}elseif(isEmpresa()){
    $id_emp = $_SESSION["idUsuario"];
    $sqlImg = "SELECT imagem1 FROM imgEmpresa WHERE id_emp = ?";
    $stmtImg = $conn->prepare($sqlImg);
    $stmtImg->execute([$id_emp]);
    $rowImagem = $stmtImg->fetch(PDO::FETCH_ASSOC);

    if ($rowImagem) {
        $imagemBinaria = is_resource($rowImagem["imagem1"]) ? stream_get_contents($rowImagem["imagem1"]) : $rowImagem["imagem1"];
        $imagem = 'data:image/jpeg;base64,' . base64_encode($imagemBinaria);
    } else {
        $imagem = 'https://png.pngtree.com/png-vector/20190926/ourmid/pngtree-building-icon-isolated-on-abstract-background-png-image_1743000.jpg';
    }
    ?>
    <?php
// Buscar dados da empresa
$sql = "SELECT nome_emp, telefone_emp, cnpj, email_emp FROM empresa WHERE id_emp = ?";
$stmt3 = $conn->prepare($sql);
$stmt3->execute([$id_emp]);
$rowEmpresa = $stmt3->fetch();
    ?>
     <div> <h4 style="color: white; font-size: 15px; cursor: default; text-transform: uppercase;"><?= explode(' ', $rowEmpresa["nome_emp"])[0] ?></h4></div>

    
<div>
    
  <a href="form_alterar_empresa.php?id_emp=<?=$_SESSION["idUsuario"]?>">
  <img src="<?= $imagem ?>" style="width: 50px; height: 50px; border-radius: 50%; background-color: #ccc;"></img>

</div>
  </a>  
  
   <a href="sair.php"><div class='fas fa-sign-out-alt' id="#"></div></a>
   
     <div style="display: none!important;" class="fas fa-bars" id="menu-btn-d"></div>
    
</div>

<div class="fas fa-bars" id="menu-btn"></div>
    
</div>
<!-- Painel lateral do usuário -->
<div id="caixa-user" class="cart-user-container">
    <div class="cart-user">
        <div class="content2">

            
        </div>
    </div>
</div>
<!-- Painel lateral do usuário -->
<div id="caixa-user" class="cart-user-container">
    <div class="cart-user">
        <div class="content2">

            
        </div>
    </div>
</div>
   <?php
}elseif(isAdmin()){
    ?>
    <div> <h4 style="color: red; font-size: 15px; cursor: default;">#<?= nome();?></h4></div>

    <div>
   
  <img src="https://t3.ftcdn.net/jpg/00/65/75/68/360_F_65756860_GUZwzOKNMUU3HldFoIA44qss7ZIrCG8I.jpg" style="width: 50px; height: 50px; border-radius: 50%; background-color: #ccc; cursor: default;"></img>
  
  </div>
<a href="sair.php"><div class='fas fa-sign-out-alt' id="#"></div></a>

<div style="display: none!important;" class="fas fa-bars" id="menu-btn-d"></div>
    
</div>

<div class="fas fa-bars" id="menu-btn"></div>
    
</div>
<!-- Painel lateral do usuário -->
<div id="caixa-user" class="cart-user-container">
    <div class="cart-user">
        <div class="content2">

            
        </div>
    </div>
</div>
<!-- Painel lateral do usuário -->
<div id="caixa-user" class="cart-user-container">
    <div class="cart-user">
        <div class="content2">

            
        </div>
    </div>
</div>
    <?php
}
?>
   <?php
if(isAdmin() or isEmpresa()){
?>
 <div class="fas fa-bars" id="menu-btn"></div>
    
    </div>
    
    <div class="fas fa-bars" id="menu-btn"></div>
        
    </div>
    <!-- Painel lateral do usuário -->
    <div id="caixa-user" class="cart-user-container">
        <div class="cart-user">
            <div class="content2">
    
                
            </div>
        </div>
    </div>
    <!-- Painel lateral do usuário -->
    <div id="caixa-user" class="cart-user-container">
        <div class="cart-user">
            <div class="content2">
    
                
            </div>
        </div>
    </div>


   
    
    
  

<div class="search-form">


<form role="search" method="POST" action="index.php">
    <div class="fas fa-filter" style="font-size:2rem; margin: 1rem;">
        <select style="cursor: pointer;" id="form-select" name="tipo_busca">
            <option value="todos" <?php if(($tipo_busca) == "todos") echo "selected"; ?>>Todos</option>
            <option value="titulo" <?php if($tipo_busca == "titulo") echo "selected"; ?>>Título</option>
            <option value="cidade" <?php if($tipo_busca == "cidade") echo "selected"; ?>>Cidade</option>
            <option value="estado" <?php if($tipo_busca == "estado") echo "selected"; ?>>Estado</option>
        </select>

        <input type="search" name="busca" id="search-box" placeholder="procurar propriedades">
        <button id="btn-p" type="submit">Pesquisar</button>
    </div>
</form>
</div>



</header>
<?php
}elseif(isProprietario()){
    ?>


<div class="fas fa-bars" id="menu-btn"></div>
    
    </div>
    
    <div class="fas fa-bars" id="menu-btn"></div>
        
    </div>
    <!-- Painel lateral do usuário -->
    <div id="caixa-user" class="cart-user-container">
        <div class="cart-user">
            <div class="content2">
    
                
            </div>
        </div>
    </div>
    <!-- Painel lateral do usuário -->
    <div id="caixa-user" class="cart-user-container">
        <div class="cart-user">
            <div class="content2">
    
                
            </div>
        </div>
    </div>


   
    
    
  

<div class="search-form">


<form role="search" method="POST" action="index.php">
    <div class="fas fa-filter" style="font-size:2rem; margin: 1rem;">
        <select style="cursor: pointer;" id="form-select" name="tipo_busca">
            <option value="todos" <?php if(($tipo_busca) == "todos") echo "selected"; ?>>Todos</option>
            <option value="titulo" <?php if($tipo_busca == "titulo") echo "selected"; ?>>Título</option>
            <option value="cidade" <?php if($tipo_busca == "cidade") echo "selected"; ?>>Cidade</option>
            <option value="estado" <?php if($tipo_busca == "estado") echo "selected"; ?>>Estado</option>
        </select>

        <input type="search" name="busca" id="search-box" placeholder="procurar propriedades">
        <button id="btn-p" type="submit">Pesquisar</button>
    </div>
</form>
</div>



</header>
<?php
}else{
   ?>
 <style>
    .icons{
        margin-left: 70% !important;
    }
   </style>

<div class="fas fa-bars" id="menu-btn"></div>
    
    </div>
    
    <div class="fas fa-bars" id="menu-btn"></div>
        
    </div>
    <!-- Painel lateral do usuário -->
    <div id="caixa-user" class="cart-user-container">
        <div class="cart-user">
            <div class="content2">
    
                
            </div>
        </div>
    </div>
    <!-- Painel lateral do usuário -->
    <div id="caixa-user" class="cart-user-container">
        <div class="cart-user">
            <div class="content2">
    
                
            </div>
        </div>
    </div>


   
    
    
  

<div class="search-form">


<form role="search" method="POST" action="index.php">
    <div class="fas fa-filter" style="font-size:2rem; margin: 1rem;">
        <select style="cursor: pointer;" id="form-select" name="tipo_busca">
            <option value="todos" <?php if(($tipo_busca) == "todos") echo "selected"; ?>>Todos</option>
            <option value="titulo" <?php if($tipo_busca == "titulo") echo "selected"; ?>>Título</option>
            <option value="cidade" <?php if($tipo_busca == "cidade") echo "selected"; ?>>Cidade</option>
            <option value="estado" <?php if($tipo_busca == "estado") echo "selected"; ?>>Estado</option>
        </select>

        <input type="search" name="busca" id="search-box" placeholder="procurar propriedades">
        <button id="btn-p" type="submit">Pesquisar</button>
    </div>
</form>
</div>



</header> 
<?php
}
?>
<script src="js/script.js"></script>
<script>




    // Selecione o botão de pesquisa
const btnPesquisar = document.getElementById('btn-p');

// Selecione o conteúdo da página inicial
const conteudoInicial = document.querySelector('section.home, section.about1, section.about2, section.about3, section.menu, section.products, section.review, section.contact, section.blogs, section.footer');

// Adicione um evento de clique ao botão de pesquisa
btnPesquisar.addEventListener('click', () => {
  // Oculte o conteúdo da página inicial
  conteudoInicial.style.display = 'none';
});
</script>