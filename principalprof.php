
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
    <link rel="stylesheet" href="css/reset.css">
    <!-- Principal CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Principal CSS da Estrutura padrão -->
    <link rel="stylesheet" href="css/index.css">
    <!-- Principal CSS da Tela -->
    <link rel="stylesheet" href="css/principalProf.css">

</head>
<!-- CABEÇALHO-->
<header>
    <!-- Barra de Navegação Padrão Professor-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">
            <img src="img/lab.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Sistema de Chamada
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-grow-1" id="navbarNavDropdown">
            <ul class="navbar-nav" id="item-ul">
                <li class="nav-item">
                    <a class="nav-link" href="principalprof.php" id="item-li">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listaonline.html" id="item-li">Abrir Presença</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cadastrarturma.html" id="item-li">Criar Turma</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Relatórios
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="relatoriodisciplina.html">Relatório Disciplina</a>
                        <a class="dropdown-item" href="relatoriodetalhado.html">Relatório Detalhado</a>
                    </div>
                </li>
            </ul>

            <div id="user-controls">
                <a id="user-controls-perfil" href="perfilprof.html"><span class="text-white">Perfil</span><span></span></a>
                <button class="btn btn-outline-dark my-2 my-sm-0" type="submit" id="button-sair">Sair</button>
            </div>
        </div>
    </nav>
</header>

<!-- CORPO DA TELA-->

<body>
    <!-- conexão com o banco de dados -->


    <!-- Principal jumbotron, para a principal mensagem de marketing ou call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-6">Olá, Professor(a)!</h1>
            <p id="frase"><b>"A educação é a arma mais poderosa que você pode usar para mudar o mundo."</b></br>Nelson Mandela
            </p>
        </div>
    </div>

    <!-- Nesse parte, será listada para o professor todas as suas turmas e as principais informações sobre elas em forma de acordeão -->
    <div class="container" id='myClasses'>
        <h2>Minhas Turmas</h2>

        <div class="accordion" id="turmas-collapse">
            <div class="card">
                <div class="card-header" id="healing1"><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                        <h5 class="mb-0">Rede de Computadores</h5>
                    </button></div>
                <div class="collapse card-body buttons-disciplina" id="collapse1" aria-labelledby="healing1" data-parent="#turmas-collapse">
                    <div><b>Curso: </b>
                        <spam>Ciência da Computação</spam><br><b>Dia: </b>
                        <spam>Segunda-feira</spam><br><b>Turno: </b>
                        <spam>Noite</spam><br><b>Código da Turma: </b>
                        <spam>8237462387</spam><br><b>Observações: </b>
                        <spam>Essa turma contém alunos do 1 ao 9 periodo</spam><br>
                    </div>
                    <div class="materia-btn"><a class="btn btn-outline-dark my-2 my-sm-0 button-relatorio" href="./disciplina.html">Relatório</a><a class="btn btn-outline-dark my-2 my-sm-0 button-chamada" href="./abrirpresenca.html">Chamada</a></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="healing2"><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                        <h5 class="mb-0">Rede de Computadores</h5>
                    </button></div>
                <div class="collapse card-body buttons-disciplina" id="collapse2" aria-labelledby="healing2" data-parent="#turmas-collapse">
                    <div><b>Curso: </b>
                        <spam>Ciência da Computação</spam><br><b>Dia: </b>
                        <spam>Segunda-feira</spam><br><b>Turno: </b>
                        <spam>Noite</spam><br><b>Código da Turma: </b>
                        <spam>8237462387</spam><br><b>Observações: </b>
                        <spam>Essa turma contém alunos do 1 ao 9 periodo</spam><br>
                    </div>
                    <div class="materia-btn"><a class="btn btn-outline-dark my-2 my-sm-0 button-relatorio" href="./disciplina.html">Relatório</a><a class="btn btn-outline-dark my-2 my-sm-0 button-chamada" href="./abrirpresenca.html">Chamada</a></div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

<!--RODAPÉ DA TELA-->
<footer class="footer mt-auto py-3">
    <nav class="navbar fixed-bottom navbar-light bg-light">
        <a class="navbar-brand" id="footer-a" href="#">Desenvolvido por TechLab</a>
        <a>E-mail: Techlab@pitagorasraja.net.br</a>
    </nav>
</footer>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</html>

