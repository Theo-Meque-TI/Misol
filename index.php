
<?php
session_start();


require 'logica-autenticacao.php';

if (!isset($_SESSION["idUsuario"])) {
    $_SESSION["idUsuario"] = null;
}

if (isset($_POST['busca']) && !empty($_POST['busca'])) {
    // Busca foi feita, exiba apenas o cabeçalho e os resultados da busca
    include 'cabecalho.php';
    // Código para exibir os resultados da busca

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Resultado da Busca</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<section class="blogs" id="blogs">
    <section class="section-pesquisa">
    <div class="div-pesquisa">
            <?php if ($resultadosEncontrados): ?>
                <h1 class="h1-pesquisa">Resultados para &nbsp <h1 class="h1-pesquisa2">" <?= $buscaOriginal ?> "</h1></h1>
            <?php else: ?>
                <h1 class="h1-pesquisa">Nenhum resultado encontrado para &nbsp <h1 class="h1-pesquisa2">" <?= $buscaOriginal ?> "</h1></h1>
            <?php endif; ?>
        </div>
    </section>
    
    <section class="section-box">
    <div class="box-container">
                
        <?php
        
    while ($row = $stmt->fetch()) {

    // Obtém o id da propriedade a ser alterada
    $id_propri = $row['id_propri'];

    // Faz o SELECT das imagens associadas à propriedade
    $sql_img = "SELECT imagem1, imagem2, imagem3 FROM imgPropriedade WHERE id_propri = ?";
    $stmt_img = $conn->prepare($sql_img);
    $stmt_img->execute([$id_propri]);

    // Fetch as associative array
    $rowImgs = $stmt_img->fetch(PDO::FETCH_ASSOC);

    // Verifica se os campos contêm recursos (streams) e converte-os para string
    $imagem1_data = !empty($rowImgs['imagem1']) ? stream_get_contents($rowImgs['imagem1']) : null;

    // Converte as imagens para base64 ou exibe imagem padrão se não existir
    $imagem1 = $imagem1_data ? 'data:image/jpeg;base64,' . base64_encode($imagem1_data) : 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';

    ?>
    
    <a class="box" target="_blank" href="tela_propriedade.php?id_propri=<?php echo $row['id_propri']; ?>">
        <div class="image">
            <img src="<?= $imagem1 ?>" alt="">
        </div>
        <div class="content">
            <h1 class="title"><?= $row['titulo']; ?></h1>
            <i class='fas fa-pencil-ruler' style='font-size:17px; color: #7f8c8d;'></i>
            <span class="s-med"><?= $row['tamanho']; ?> m²</span>
            <br>
            <span id="i-estado" class="fas fa-map" style='font-size:17px; color: #7f8c8d; margin-right: 1rem;'></span>
            <span><?= $row['cidade']; ?>/<?= $row['estado']; ?></span>
            <br>
        </div>
    </a>
    <?php
}
        ?>
    </div>
    </section>
</section>
</body>
</html>

<?php
    // Adicionando mais código de busca, se necessário
    //$ordem = $_POST['ordem'];
} else {
    // Busca não foi feita, exiba o conteúdo normal da página
    include 'cabecalho.php';
    if(isAdmin() or isEmpresa()){

        $sql = "SELECT id_propri, titulo, tamanho, tipo_solo, estado, cidade, coordenadas, id 
            FROM propriedade ";
    $stmt = $conn->query($sql);
        ?>
         <body>
         

<section class="blogs" id="blogs">
<section class="section-todos">
    <div class="div-todos">
           
                <h1 class="h1-todos">Todas as Propriedades</h1>
            
        </div>
    </section>
    
    <section class="section-box">
    <div class="box-container">
                
        <?php
        
    while ($row = $stmt->fetch()) {

    // Obtém o id da propriedade a ser alterada
    $id_propri = $row['id_propri'];

    // Faz o SELECT das imagens associadas à propriedade
    $sql_img = "SELECT imagem1, imagem2, imagem3 FROM imgPropriedade WHERE id_propri = ?";
    $stmt_img = $conn->prepare($sql_img);
    $stmt_img->execute([$id_propri]);

    // Fetch as associative array
    $rowImgs = $stmt_img->fetch(PDO::FETCH_ASSOC);

    // Verifica se os campos contêm recursos (streams) e converte-os para string
    $imagem1_data = !empty($rowImgs['imagem1']) ? stream_get_contents($rowImgs['imagem1']) : null;

    // Converte as imagens para base64 ou exibe imagem padrão se não existir
    $imagem1 = $imagem1_data ? 'data:image/jpeg;base64,' . base64_encode($imagem1_data) : 'https://static.vecteezy.com/system/resources/previews/004/141/669/non_2x/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';

    ?>
    
    <a class="box" target="_blank" href="tela_propriedade.php?id_propri=<?php echo $row['id_propri']; ?>">
        <div class="image">
            <img src="<?= $imagem1 ?>" alt="">
        </div>
        <div class="content">
            <h1 class="title"><?= $row['titulo']; ?></h1>
            <i class='fas fa-pencil-ruler' style='font-size:17px; color: #7f8c8d;'></i>
            <span class="s-med"><?= $row['tamanho']; ?> m²</span>
            <br>
            <span id="i-estado" class="fas fa-map" style='font-size:17px; color: #7f8c8d; margin-right: 1rem;'></span>
            <span><?= $row['cidade']; ?>/<?= $row['estado']; ?></span>
            <br>
    </div>
    </a>
    <?php
}
        ?>
    </div>
    </section>
</section>
</body>

        <?php
        }else{
?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Misol</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<style>
    
.home{
    min-height: 100vh;
    display: flex;
    align-items: center;
    background: url(../misol/images/back.jpg) no-repeat;

    background-size: cover;
    background-position: center;
    
}


.home .content{
    max-width: 60rem;
}

.home .content h3{
    font-size: 6rem;
    text-transform: uppercase;
    color:#fff;
}

.home .content p{
    font-size: 2rem;
    font-weight: lighter;
    line-height: 1.8;
    padding:1rem 0;
    color:#eee;
}
</style>
<body>



      

<!-- header section ends -->

<!-- home section starts  -->

<section class="home" id="home">

    <div class="content">
        <h3>energia solar ao seu alcance</h3>
        <p>Conheça o potencial da energia solar para seu negócio.</p>
        <a href="../misol/#about1" class="btn">Quêm Somos?</a>
    </div>

</section>

<!-- home section ends -->

<!-- about section starts  -->

<section class="about1" id="about1">


    <h1 class="heading"> <span>Sobre</span> Nós </h1>

    <div class="row">

        <div class="image">
            <img src="images/sobre.jpg" alt="">
        </div>

        <div class="content">
            <h3>Quêm Somos?</h3>
            <p>Somos uma equipe dedicada a conectar proprietários de imóveis com empresas que buscam espaços para instalar painéis solares.</p>
            <p>Nossa missão é facilitar o arrendamento de propriedades por meio de uma plataforma intuitiva, na qual proprietários podem cadastrar seus espaços e empresas podem encontrar locais ideais para expandir seus projetos de energia renovável.</p>
            

        </div>

    </div>

</section>

<section class="about2" id="about2">

    <h1 class="heading"> <span>Empresas</span></h1>

    <div class="row">

      

        <div class="content">
            <h3>Deseja encontrar propriedades para arrendar?</h3>
            <p>Encontre os melhores espaços para a instalação de painéis solares e expanda seus projetos de energia renovável.</p>
            <p>Cadastre sua empresa e tenha acesso a uma rede de propriedades disponíveis para arrendamento.</p>
           
            <?php
            if(!isEmpresa() && !isAdmin()){
             ?>
    <a href="form_cadastrar_empresa.php" class="btn">Começar como empresa</a>
<?php
}else{
    
?>
  

<?php
}
?>
           
        </div>

        <div class="image">
            <img src="images/sobre2.jpg" alt="">
        </div>

    </div>

</section>

<section class="about3" id="about3">

    <h1 class="heading"> <span>PROPRIETÁRIO</span> </h1>

    <div class="row">

        <div class="image">
            <img src="images/sobre3.jpg" alt="">
        </div>

        <div class="content">
            <h3>Querendo arrendar sua propriedade?</h3>
            <p>Anuncie sua propriedade para empresas de energia solar e garanta uma renda extra.</p>
            <p>Ofereça seu espaço para a instalação de painéis solares e ajude a expandir o uso de energias limpas e renováveis.</p>
           
           <?php
            if(!isProprietario() && !isAdmin()){
             ?>
              <a href="form_cadastrar_proprietario.php" class="btn">Começar como proprietário</a>
    
<?php
}else{
    redireciona();
?>


<?php
}
?>
        </div>

    </div>

</section>

<section class="about4" id="about4">
<section class="contact" id="contact">

    <h1 class="heading"> <span>FALE</span>  CONOSCO</h1>

    <div class="row">

        

    <form action="https://api.staticforms.xyz/submit" method="POST" id="formulario">
            
            <div class="inputBox">
                <span class="fas fa-user"></span>
                <input type="text" name="nome" placeholder="Nome" id="nome" required>
            </div>
            <div class="inputBox">
                <span class="fas fa-envelope"></span>
                <input type="email" name="email" placeholder="Email" id="email" required>
            </div>
            

            <div class="inputBox">
                <textarea class="area-text" name="message" id="mensagem" required>

                </textarea>
            </div>
            <input type="submit" value="Enviar" class="btn" id="enviar">

            <input type="hidden" name="accessKey" value="130f5b21-4c57-404f-a107-e1ffc42ee4f6">
            <input type="hidden" name="redirectTo" value="http://localhost/misol/obrigado.php">
        </form>

    </div>

</section>
</section>




<!-- contact section ends -->



<!-- blogs section ends -->

<!-- footer section starts  -->

<section class="footer">
<!--
    <div class="share">
        <a href="#" class="fab fa-facebook-f"></a>
        <a href="#" class="fab fa-twitter"></a>
        <a href="#" class="fab fa-instagram"></a>
        <a href="#" class="fab fa-linkedin"></a>
        <a href="#" class="fab fa-pinterest"></a>
    </div>
    -->
    <div class="links">
        <a href="#home">Inicio</a>
        <a href="#about1">Sobre</a>
        <a href="#about2">Empresas</a>
        <a href="#about3">Proprietários</a>
        <a href="#about4">Contato</a>
        <!--
        <a href="#blogs">blogs</a>
    -->
    </div>

    <div class="credit">Criado por: <span> Leonardo Miranda e Théo Vicenzo</span></div>

</section>

<!-- footer section ends -->


<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>

<?php
}

if (isset($_SESSION["restrito"]) && $_SESSION["restrito"]) {
?>
    <div class="alert alert-danger" role="alert" id="er">
        <h4>Faça login para acessa-la</h4>
    </div>
<?php
    unset($_SESSION["restrito"]);
}

?>


<?php
        }
    
            ?>
