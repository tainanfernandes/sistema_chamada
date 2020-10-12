<?php
    require_once '../controller/mysqli_connect.php';
    require_once '../controller/querys.php';


    session_start();

    if(!isset($_SESSION['user']['LOGGED'])){
      header('Location: ../login.html');
    }

    $id = $_SESSION['user']['id'];
    $nome = $_SESSION['user']['nome'];

  ?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Configuração Padrão-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Icone da Aba -->
    <link rel="icon" href="img/lab-preto.png">
    <!--Titulo da Aba-->
    <title>Sistema de Chamadas</title>

    <!-- CSS Reset-->
    <link rel="stylesheet" href="../css/reset.css" >
    <!-- Principal CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Principal CSS da Estrutura padrão -->
    <link rel="stylesheet" href="css/index.css">
    <!-- Principal CSS da Tela -->
    <link rel="stylesheet" href="css/principalaluno.css">

  </head>

  <!-- CABEÇALHO-->
  <header>
    <!-- Barra de Navegação Padrão Professor-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">
        <img src="img/lab.png" width="30" height="30" class="d-inline-block align-top" alt="">
        Sistema de Chamada
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse flex-grow-1" id="navbarNavDropdown">
        <ul class="navbar-nav" id="item-ul">
          <li class="nav-item">
            <a class="nav-link" href="principalaluno.html" id="item-li">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="minhasturmas.html" id="item-li">Minhas Turmas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="novaturma.html" id="item-li">Nova Turma</a>
          </li>
        </ul>

        <div id="user-controls"> <!--tag link para teste temporário.-->
          <button class="btn btn-outline-dark my-2 my-sm-0" type="submit" id="button-sair"><a href="../controller/logout.php">Sair</a></button>
        </div>
      </div>
    </nav>
  </header>

  <!-- CORPO DA TELA-->
  <body>
    <!-- Principal jumbotron, para a principal mensagem de marketing ou call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-6">Olá, <?php echo $nome; ?>!</h1>
        <p id="frase"><b>"Estude com a firme certeza que tudo que requer esforço e disciplina resulta em felicidade e grandes conquistas."</b></br>Desconhecido</p>
      </div>
    </div>

    <!-- Nesse parte, será listada para o Aluno todas as suas turmas e as principais informações sobre elas em forma de acordeão -->
    <div class="container">
      <h2>Minhas Turmas</h2>

      <div class="accordion" id="turmas-collapse">
                <?php
                  $consulta = query_materias_aluno($id);
                  $result = mysqli_query($mysqli, $consulta) or die (mysqli_error());
                  $row = mysqli_num_rows($result);

                    while($dado = $result->fetch_array()){ 
                    ?>

        <div class="card">
          <div class="card-header" id="headingOne">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#<?php echo str_replace(" ", "", $dado["NOMEDISCIPLINA"]); ?>" aria-expanded="true" aria-controls="collapseOne">
              <h5 class="mb-0">
              <?php echo $dado["NOMEDISCIPLINA"]; ?>
              </h5>
            </button>
          </div>
          <div id="<?php echo str_replace(" ", "", $dado["NOMEDISCIPLINA"]); ?>" class="collapse" aria-labelledby="headingOne" data-parent="#turmas-collapse">
            <div class="card-body buttons-disciplina">
              <div class="dados-turma">

                    <b>Curso: </b><?php echo $dado["NOMECURSO"]; ?></br>
                    <b>Dia: </b><?php echo $dado["DIASEMANA"]; ?></br>
                    <b>Turno: </b><?php echo $dado["TURNO"]; ?></br>
                    <b>Código Turma: </b><?php echo $dado["IDCURSO"];?> </br>
                    <b>Observações: </b><?php echo "FALTA SABER DE ONDE VEM"; ?></br>
                    <b>STATUS: </b><?php echo "FALTA SABER DE ONDE VEM"; ?></br>
              </div>
              <div class="materia-btn">
                <a class="btn btn-outline-dark my-2 my-sm-0 button-presenca" href="./marcarpresenca.html">Marcar Presença</a>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
    </div>
  </body>

  <!--RODAPÉ DA TELA-->
  <footer class="footer mt-auto py-3">
    <nav class="navbar fixed-bottom navbar-light bg-light">
      <a class="navbar-brand" id= "footer-a" href="#">Desenvolvido por TechLab</a>
      <a>E-mail: Techlab@pitagorasraja.net.br</a>
  </nav>
  </footer>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</html>
