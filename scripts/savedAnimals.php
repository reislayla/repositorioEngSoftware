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
        $sql = "SELECT id, name, local, photo_url, created_at, age, description FROM animals WHERE local='" . $local . "'";
    } else {
        $sql = "SELECT id, name, local, photo_url, created_at, age, description FROM animals";
    }
  
    $result = $conn->query($sql);
    $animals = [];
  
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $animals[] = $row;
        }
    } else {
        echo "0 results";
    }


    $a1 = "SELECT id, photo_url, name, local, description FROM animals WHERE id = '2'";
    $animal1 = $conn->query($a1);
    $aanimal1 = [];
    if ($animal1->num_rows > 0) {
        // output data of each row
        while($row1 = $animal1->fetch_assoc()) {
            $aanimal1 = $row1;
        }
    } else {
        echo "0 results";
    }


    $a2 = "SELECT id, photo_url, name, local, description FROM animals WHERE id = '3'";
    $animal2 = $conn->query($a2);
    $aanimal2 = [];
    if ($animal2->num_rows > 0) {
        // output data of each row
        while($row2 = $animal2->fetch_assoc()) {
            $aanimal2 = $row2;
        }
    } else {
        echo "0 results";
    }
    

    $a3 = "SELECT id, photo_url, name, local, description FROM animals WHERE id = '6'";
    $animal3 = $conn->query($a3);
    $aanimal3 = [];
    if ($animal3->num_rows > 0) {
        // output data of each row
        while($row3 = $animal3->fetch_assoc()) {
            $aanimal3 = $row3;
        }
    } else {
        echo "0 results";
    }
?>

<!-- MENU-->
<div id="home">
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
                   <a class="nav-link" href="index.php#como"> Como adotar? </a>
               </li>
                <li class ="nav-item">
                   <a class="nav-link" href="index.php#pesquisa"> Pesquisar por Localidade </a>
               </li>
                <li class ="nav-item">
                   <a class="nav-link" href="#contactos"> Contactos </a>
               </li>
            </ul>
        </div>
    </nav>
</div>
<!-- FIM Menu-->

<!-- A minha Conta -->
<div class="form-popup form-container" id="myForm">
    <h2>A Minha Conta</h2>

    <p><b>Bem vindo</b></p>

    <a href="savedAnimals.php" style="color:black;">Animais Guardados</a>
    <br>
    <a href="formulario.php" style="color:black;">Formulário Pedido de Adoção</a>
    <p> <a href="index.php" style="color:grey;"> Terminar sessão </a> </p>
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

<!-- Animais Seguidos -->
<div id="saved">
<div class="card text-center">
        <strong style="text-align: left; font-size: 50px; padding-left: 2%;"> Bem vindo </strong>
        <!-- Botao retroceder e mostrar todos os animais-->
        <a href="indexAfterLogin.php" id="Voltar_Pagina_Inicial_Saved"> <button style="color:cadetblue;" class="btn btn-outline-dark" name="search" type="submit"> Voltar para a página inicial </button> </a>
    <div class="card-header"> Animais Guardados  </div>
    <div class="card-body">
        
        <div class="card-deck">
        <div class="card">
        <a href="details.php?id=2" > <img src="<?php echo $aanimal1['photo_url'] ?>" class="card-img-top"></a>
            <div class="card-body">
            <h5 class="card-title"> <?php echo $aanimal1['name'] ?> </h5>
            <p class="card-text"> <?php echo $aanimal1['description'] ?> </p>
            </div>
            <div class="card-footer">
            <small class="text-muted"> Adicionado a 02.12.2019 </small>
            </div>
        </div>
        <div class="card">
            <a href="details.php?id=3" > <img src="<?php echo $aanimal2['photo_url'] ?>" class="card-img-top"></a>
            <div class="card-body">
            <h5 class="card-title"> <?php echo $aanimal2['name'] ?> </h5>
            <p class="card-text"> <?php echo $aanimal2['description'] ?> </p>
            </div>
            <div class="card-footer">
            <small class="text-muted">  Adicionado a 27.12.2019 </small>
            </div>
        </div>
        <div class="card">
            <a href="details.php?id=6" > <img src="<?php echo $aanimal3['photo_url'] ?>" class="card-img-top"></a>
            <div class="card-body"> 
            <h5 class="card-title"> <?php echo $aanimal3['name'] ?> </h5>
            <p class="card-text"> <?php echo $aanimal3['description'] ?> </p>
            </div>
            <div class="card-footer">
            <small class="text-muted"> Adicionado a 31.12.2019 </small>
            </div>
        </div>
        </div>

    </div>
    </div>
</div>


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

</body>
</html>