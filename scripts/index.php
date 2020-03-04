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
        $sql = "SELECT id, name, local, photo_url, created_at, age description FROM animals WHERE local='" . $local . "'";
    } else {
        $sql = "SELECT id, name, local, photo_url, created_at, age description FROM animals";
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
                   <a class="nav-link" href="#como"> Como adotar? </a>
               </li>
                <li class ="nav-item">
                   <a class="nav-link" href="#pesquisa"> Pesquisar por Localidade </a>
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
        <a class="btn btn-outline-light botao" href="#como"> Descubra aqui </a>
    </div>
</div>
<!-- FIM Seccao Principal -->

<!-- Como adotar?-->
<div id="como" class="offset">
   <div class="col-12 narrow text-center">
        <h1> Como adotar?</h1>
        <p>Está à procura de um animal de estimação? Então, este site é o lugar certo para si. <br> São centenas de animais que esperam ansiosamente por um lar. Será você o herói de um deles? <br>Pesquise aqui e adote o cão ou o gato perfeito.</p>
        <h6 style="margin-top: 45px;"> <strong> POR QUE DEVO ADOTAR UM ANIMAL? </strong> </h6>
        <p> Tem ideia de quantos animais estão na rua? Ou então, quantos animais estão em abrigos? Pois é, são milhares. Todos esses animais têm direito a uma segunda oportunidade. <br> Muitos tiveram uma família um dia e, subitamente, foram rejeitados e excluídos… <br>É possível fazer a diferença! </p>
        <h6 style="margin-top: 45px;"> <strong>  COMO FUNCIONA O PROCESSO DE ADOÇÃO? </strong> </h6>
        <div>
            <ol style="text-align: center; list-style-position: inside;">
                <li> Registe-se no site <a style="color:dodgerblue; cursor:pointer;" data-toggle="modal" data-target="#loginModal" >aqui</a>.</li>
                <li> Escolha, de forma consciente, o animal na plataforma. </li>
                <li> Visite o abrigo. </li>
                <li> Marque aconselhamento médico veterinário para apoio na adoção. </li>
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
                                        <input type="checkbox" checked="checked" name="remember"> Ao criar uma conta concorda com os <a href="#" style="color:dodgerblue"> Termos & Privacidade</a>.
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
<!-- FIM Login -->

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