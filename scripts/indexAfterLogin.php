<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Adoção Animal </title>
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body data-spy="scroll" data-target="#navbarResponsive">

<?php
//c:/xampp/htdocs/xampp/adocaoanimal
$servername = "localhost";
$username = "a034919";
$password = "1234567890";
$dbname = "grupo_a1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Pesquisar por Localidade
if(!empty($_GET['search'])) {
    $local = $_GET['search'];
    $sql = "SELECT id, name, local, photo_url, created_at, description FROM animals WHERE local='" . $local . "'";
} else {
    $sql = "SELECT id, name, local, photo_url, created_at, description FROM animals";
}

$result = $conn->query($sql);
$animals = [];

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $animals[] = $row;
        //echo "id: " . $row["user_id"]. " - Name: " . $row["username"]. " Email: " . $row["email"]. "<br>";
    }
} else {
    echo "0 results";
}
//var_dump($animals);

$conn->close();

?>

<!-- Seccao Principal -->
<div id="home">
   <!-- MENU-->
    <nav class = "navbar navbar-expand-d navbar-dark bg-dark fixed-top">
        <a class="navbar-logo" href="indexAfterLogin.php"><img src="imagens/LOGO2.png"></a>
        <a onclick="openForm()" style="position:absolute; left: 91%; top:10%; color:cadetblue; cursor:pointer;"> <i class="aa fas fa-user"></i> </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
               <li class ="nav-item active">
                   <a class="nav-link" href="index.php">Home</a>
               </li>
                <li class ="nav-item">
                   <a class="nav-link" href="#como"> Como adotar? </a>
               </li>
                <li class ="nav-item">
                   <a class="nav-link" href="#pesquisa"> Pesquisar por Localidade </a>
               </li>
                <li class ="nav-item">
                   <a class="nav-link" href="#contactos"> Contactos </a>
               </li>
            </ul>
        </div>
    </nav>

    </div>
<div id="hero-section">
    <!-- Principal -->
    <div class="Landing">
        <div class="home-wrap">
            <div class="home-inner">  
            </div>
        </div>
    </div>
    
    <div class="caption"> 
        <h1> Ajude-nos a adotar </h1>
        <h3> Como adotar ? </h3>
        <a class="btn btn-outline-light botao" href="#narrow"> Descubra aqui </a>
    </div>
</div>
<!-- FIM Seccao Principal -->

<!-- Como adotar?-->
<div id="comoA"class="offset">
   <div id="como"class="col-12 narrow text-center">
        <h1> Como adotar?</h1>
        <p>Está à procura por um amigo pet? Então, este site é o lugar certo para si. <br> São centenas de animais que esperam ansiosamente por um lar. Será você o herói de um deles? <br>Pesquise aqui e adote o cão ou o gato perfeito.</p>
        <h6> <strong> POR QUE DEVO ADOTAR UM ANIMAL? </strong> </h6>
        <p> Tem ideia de quantos animais estão na rua? Ou então, quantos animais estão em abrigos? Pois é, são milhares. Todos esses animais têm direito a uma segunda oportunidade. Muitos tiveram uma família um dia e, subitamente, foram rejeitados e excluídos… Você pode fazer a diferença! </p>
        <h6 style="margin-top: 5px;"> <strong>  COMO FUNCIONA O PROCESSO DE ADOÇÃO? </strong> </h6>
        <div>
            <ol style="text-align: center; list-style-position: inside;">
                <li> Registe-se no site. </li>
                <li> Escolha, de forma consciente, o animal na plataforma. </li>
                <li> Visita ao abrigo. </li>
                <li> Marcação de aconselhamento médico veterinário para apoio na adoção. </li>
            </ol>
        </div>
    <p> E já está... É simples! </p>
    </div>
</div>
<!-- FIM Como adotar? -->

<!-- Pesquisa por localidade-->
<div id="pesquisa" class="offset">
    <!--Jumbotron-->
    <div class="jumbotron">
        <div>
            <div class="col-12">
               <h3> Pesquisa por Localidade</h3>
               <div class ="heading-underLine">
                 <form class="form-inline" action="#pesquisa" method="GET">
                    <input value="<?php if(!empty($local)) { echo $local; }?>" class="form-control" name="search" type="text" placeholder="Pesquisa por Localidade">
                    <button class="btn btn-outline-dark" type="submit" style="margin-left: 1%; margin-top:-0.5%">Submeter</button>
                 </form>
               </div>
            </div>
            
            <div class="row text-center">
                <?php
                if (!empty($animals) ) {
                    foreach($animals as $animal) { ?>
                        <div class="col-md-3">
                            <div class="pesquisa">
                                <h3> <?php echo $animal['name'] ?> </h3>
                                <a href="details.php?id=<?php echo $animal['id'] ?>" > <img src="<?php echo $animal['photo_url'] ?>" class="pesquisa_photo"></a>
                            </div>
                        </div>
                        <?php }
               } else {
                    echo('Sem resultados.');
               } ?>
            </div>
            
            <!-- Botao retroceder e mostrar todos os animais-->
            <div style="align:left; position:absolute; left:45%; ">
                <form action="#pesquisa" name="search" method="GET">
                    <button style="color:cadetblue; font-size:25px" class="btn btn-outline-dark" name="search" type="submit"> Voltar para trás </button>
                </form>
            </div>
            
        </div>
    </div>
</div>
<!-- FIM Pesquisa por localidade -->


<!-- Contactos-->
<div id="contactos" class="offset">
    <footer>
        <div class="row justify-content-center"> 
            
            <div class="col-md-5 text-center"> 
                <img src="imagens/LOGO21.png">
                <p> Se tiver alguma dúvida ou sugestão, entre em contacto connosco para que o possamos ajudar com a maior brevidade. </p>
                <strong> Informação de Contactos: </strong>
                <p> <a href="https://wa.me/111222333" target="_blank">(+351) 111 222 333 <br> 
                <a href="mailto:email@adotame.pt?Subject=Sobre a adocao"> email@adotame.pt </a></p>
                <a href="https://www.facebook.com/" target="_blank"> <i class="fab fa-facebook-square"></i></a>
                <a href="https://twitter.com/" target="_blank"> <i class="fab fa-twitter-square"></i></a>
                <a href="https://www.instagram.com/" target="_blank"> <i class="fab fa-instagram"></i></a>
            </div>
            
            <hr class="baixo">
            2019 &copy; Adota-me
        </div>
    </footer>
</div>
<!-- FIM Contactos-->


<!-- A minha Conta -->
<div class="form-popup form-container" id="myForm">
    <h2>A Minha Conta</h2>
    <hr>
    <p><b>Bem vindo</b></p>

    <a href="savedAnimals.php" style="color:black;">Animais Guardados</a>
    <br>
    <a href="formulario.php" style="color:black;">Formulário Pedido de Adoção</a>
    <p> <a href="index.php" style="color:grey;"> Sair da sessão </a> </p>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
<!-- Fim a Minha Conta -->


<!-- Cursor volta para o Topo -->    
<button onclick="topFunction()" id="buttonTop" title="Para o topo"> Topo </button>
    <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            if (document.body.scrollTop > 40 || document.documentElement.scrollTop > 40) {
                document.getElementById("buttonTop").style.display = "block";
            } else {
                document.getElementById("buttonTop").style.display = "none";
            }
        }
        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>

</body>
</html>