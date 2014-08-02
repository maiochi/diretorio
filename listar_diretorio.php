<?php
//echo '<pre>'.print_r($_SERVER,true).'</pre>';
require_once('./diretorio/class_diretorio.php');
$oDiretorio = new Diretorio(__DIR__);
//echo getcwd();
//var_dump( $oDiretorio->getListagem());
//echo $oDiretorio->getDiretorio();
$aListagem = $oDiretorio->getListagem();

/*foreach($oDiretorio->getListagem() as $sTipo => $aLista) {
    echo '<h1>'.strtoupper($sTipo).'</h2><br>';
    foreach($aLista as $sNome) {
        echo '<a href="'.$oDiretorio->getCaminhoCompletoArquivo($sNome).'">'.$sNome.'</a><br>';
    }
}*/
?>
<html>
    <head>
        <style>
            #container {
               /* border: 1px solid red;*/
            }

            #pastas {
                float: left;
            }

            #arquivos {
                float: right;
            }

            .listagem {
                width: 49%;
                border: 1px solid black;
                padding: 5px;
                height: 95%;
                overflow: auto;
            }
        </style>
    </head>
    <body>
        <div id="container">
            <div id="pastas" class="listagem">
                <h1>Pastas</h1>
                <?php
                foreach($aListagem['diretorios'] as $sNome) {
                    echo '<a href="'.$oDiretorio->getCaminhoCompletoArquivo($sNome).'">'.$sNome.'</a><br>';
                }
                ?>
            </div>
            <div id="arquivos" class="listagem">
                <h1>Arquivos</h1>
                <?php
                foreach($aListagem['arquivos'] as $sNome) {
                    echo '<a href="'.$oDiretorio->getCaminhoCompletoArquivo($sNome).'">'.$sNome.'</a><br>';
                }
                ?>
            </div>
        </div>
    </body>
</html>