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
    <link rel="stylesheet" href="style.css">
</head>


<body data-spy="scroll" data-target="#navbarResponsive">

<?php
$animal_id = $_GET['id'];

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

$sql = "SELECT id, name, local, photo_url, created_at, description, breed, sexo, numId FROM animals where id=" . $animal_id;
$result = $conn->query($sql);
$animal_details = [];

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $animal_details = $row;
    }
} else {
    echo "0 results";
}
//validar login
$message="";
if(!empty($_POST)) {
    $result = mysqli_query($conn,"SELECT username, password FROM users WHERE username='" . $_POST["uname"] . "' and password = '". $_POST["psw"]."'");
    $count  = mysqli_num_rows($result);
    if($count==0) {
        header('Location: index.php?error=1');
    } else {
        header('Location: indexAfterLogin.php');
    }
}

?>

<!-- Seccao Principal -->
<div id="home">
   <!-- MENU-->
    <nav class = "navbar navbar-expand-d navbar-dark bg-dark fixed-top">
        <a class="navbar-logo" href="index.php"><img src="imagens/LOGO2.png"></a>
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
                   <a style="cursor:pointer" data-toggle="modal" data-target="#loginModal" class="nav-link"> A Minha Conta</a>
               </li>
                <li class ="nav-item">
                   <a class="nav-link" href="#contactos"> Contactos </a>
               </li>
            </ul>
        </div>
    </nav>
</div>

    <!-- Botao retroceder e mostrar todos os animais-->
    <a href="index.php#pesquisa" id="Voltar_Pagina_Inicial"> <button style="color:cadetblue;" class="btn btn-outline-dark" name="search" type="submit"> Voltar para a página inicial </button> </a>

<!-- Detalhes -->

    <div class="details">
        <div class="row">
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-text">
                        <a href="details.php?id=<?php echo $animal_details['id'] ?>" > <img src="<?php echo $animal_details['photo_url'] ?>" class="details_photo"></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-body">
                        <div class="">
                        <h1> <?php echo $animal_details['name']?> </h1>
                        <p> <?php echo $animal_details['description'] ?> </p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"> <i class="fas fa-hashtag"></i> Nº Identificação: &nbsp; <?php echo $animal_details['numId']?> </li>
                        <li class="list-group-item"> <i class="fas fa-paw"></i> Raça: &nbsp; <?php echo $animal_details['breed']?></li> 
                        <li class="list-group-item"> <i class="fas fa-venus-mars"></i> Sexo: &nbsp; <?php echo $animal_details['sexo']?> </li>
                        <li class="list-group-item"> <i class="far fa-compass"></i> Localização: &nbsp; <?php echo $animal_details['local']?></li>
                    </ul>
                    <a data-toggle="modal" data-target="#loginModal"> <button class="btn btn-outline-dark" type="submit"> Seguir </button> </a>
                    <!-- ver -->
                    <a class="btn btn-outline-info">
                        <i class="fas fa-arrow-circle-left"></i>
                    </a> 
                    <a class="btn btn-outline-info">
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
                </div>
            </div>
        </div>
    </div>
<!-- Fim Detalhes Animal -->

<!-- Login-->


<div class="modal fade login" id="loginModal">
    <div class="modal-dialog login animated">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
        <div class="modal-body">
            <div class="box">
                    <div class="content">
                        <!-- Login -->
                    <div class="form loginBox">
                            <form class="modal-content animate" action="" method="POST">
                            <div>
                                <div class="imgcontainer">
                                    <img src="imagens/user.png" alt="Avatar" class="avatar">
                                </div>

                                <div class="containerLogin">
                                    <label for="uname"><b>Utilizador</b></label>
                                    <input type="text" placeholder="Introduza nome de Utilizador" name="uname" maxlength="20" required>

                                    <label for="psw"><b>Palavra-passe</b></label>
                                    <input type="password" placeholder="Introduza a sua palavra-passe" name="psw" required>

                                    <?php 
                                    if(!empty($_GET['error']) && $_GET['error'] == 1) { 
                                        echo '<p style="color:red"> Nome de Utilizador ou Palavra-passe errada! </p>'; 
                                        } ?>

                                    <button type="submit" name="submit" id="LoginBotao">Entrar</button>
                                    <label>
                                        <input type="checkbox" checked="checked" name="remember"> Lembrar-me
                                    </label>
                                </div>

                                <div class="containerLogin" style="background-color:#f1f1f1">
                                    <button type="button" data-dismiss="modal" class="cancelbtn">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
            </div>
            <!-- Registo -->
            <div class="box">
                <div class="content registerBox" style="display:none;">
                    <div class="form">
                        <form class="modal-content animate" action="" method="POST">
                            <div>
                            <div>
                                <div class="imgcontainer">
                                    <img src="imagens/user.png" alt="Avatar" class="avatar">
                                </div>
                                <div class="containerRegisto">
                                    <label for="pname"><b>Nome</b></label>
                                    <input type="text" placeholder="Introduza o seu nome" name="pname" maxlength="20" required>
                                    
                                    <label for="uname"><b>Apelido</b></label>
                                    <input type="text" placeholder="Introduza o seu apelido" name="uname" maxlength="20">
                                    
                                    <label for="psw"><b>Palavra-Passe</b></label>
                                    <input type="password" placeholder="Introduza uma palavra-passe" name="psw" required>

                                    <label for="psw"><b>Repetir Palavra-Passe</b></label>
                                    <input type="password" placeholder="Repita a palavra-passe" name="psw" required>

                                    <label>
                                        <input type="checkbox" checked="checked" name="remember"> Ao criar uma conta concorda com os<a href="#" style="color:dodgerblue">Terms & Privacy</a>.
                                        <button type="submit" id="LoginBotao">Registar</button>
                                    </label>
                                </div>
                            <div class="containerRegisto" style="background-color:#f1f1f1">
                                <button type="button" data-dismiss="modal" class="cancelbtn">Cancelar</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <div class="forgot login-footer">
                <span class="psw">Esqueceu a <a href="#">palavra-passe?</a></span><p></p>
                <span> Pretende
                    <a href="javascript:showRegisterForm();"> criar uma conta</a>
                ?</span>
            </div>
            <div class="forgot register-footer" style="display:none">
                    <span>Já tem conta?
                    <a href="javascript:showLoginForm();">Entre</a>.</span>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<!-- FIM Login -->


<!-- Contactos-->
    <div id="contactos" class="offset">
    <footer>
        <div class="row justify-content-center"> 
            
            <div class="col-md-5 text-center"> 
                <img src="imagens/LOGO21.png">
                <p> Se tiver alguma dúvida ou sugestão, entre em contacto connosco para que o possamos ajudar com a maior brevidade. </p>
                <strong> Informação de Contactos: </strong>
                <p> (+351) 111 222 333 <br> <a href="mailto:email@adotame.pt?Subject=Sobre a adocao"> email@adotame.pt </a></p>
                <a href="https://www.facebook.com/" target="_blank"> <i class="fab fa-facebook-square"></i></a>
                <a href="https://twitter.com/" target="_blank"> <i class="fab fa-twitter-square"></i></a>
                <a href="https://www.instagram.com/" target="_blank"> <i class="fab fa-instagram"></i></a>
            </div>
            
            <hr class="baixo">
            2019 &copy; Adota-me
        </div>
    </footer>
    </div>

<?php if(!empty($_GET['error']) && $_GET['error'] == 1) { ?>
    <script>
        $('#loginModal').modal('show');
    </script>
<?php } ?>

<script>
    //ao clicar em qq um dos menu buttons
    //vai fechar o menu do id navbarResponsive
    $('.nav-link').click( function () {
        $('#navbarResponsive').toggleClass('show hide');
    });

    //login
    function showRegisterForm(){
    $('.loginBox').fadeOut('fast',function(){
        $('.registerBox').fadeIn('fast');
        $('.login-footer').fadeOut('fast',function(){
            $('.register-footer').fadeIn('fast');
        });
    });  
    }
    function showLoginForm(){
        $('#loginModal .registerBox').fadeOut('fast',function(){
            $('.loginBox').fadeIn('fast');
            $('.register-footer').fadeOut('fast',function(){
                $('.login-footer').fadeIn('fast');    
            });
            
            $('.modal-title').html('Login with');
        });       
        $('.error').removeClass('alert alert-danger').html(''); 
    }
</script>



</body>
</html>