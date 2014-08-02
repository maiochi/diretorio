<?php
/**
 * Classe para listagem de diret�rios e arquivos
 * @author Diego Maiochi <diego@maiochi.eti.br>
 * @since 29/07/2014
 */
class Diretorio {

    private $xDiretorio;

    public function __construct($xDiretorio = false) {
        if ($xDiretorio) {
            $this->setDiretorio($xDiretorio);
        } /*else {
//            $this->setDiretorio($this->getDiretorioPadrao());
//        }*/
    }

    public function getDiretorioServidor() {
        return $_SERVER['HTTP_REFERER'];
    }

    public function setDiretorio($diretorio) {
        $this->xDiretorio = $diretorio;
    }

    public function getDiretorio() {
        if (!isset($this->xDiretorio)) {
            throw new Exception("N�o foi setado nenhum diret�rio para a listagem", 1);
        }
        return $this->xDiretorio;
    }

    /**
     * Percorre o diret�rio informado e criar um array com a listagem de arquivos e diret�rios
     * @return array
     */
    private function buscaDiretorio() {
        $xDiretorio = dir($this->getDiretorio());
        $aDados     = array();

        while (false !== ($sNome = $xDiretorio->read())) {
            if (!in_array($sNome, $this->getExcluiDaListagem())) {
                if (is_dir($this->getDiretorio().'/'.$sNome)) {
                    $aDados['diretorios'][] = $sNome;
                } else if (is_file($this->getDiretorio().'/'.$sNome)) {
                    $aDados['arquivos'][] = $sNome;
                } else {
                    $aDados['indefinidos'][] = $sNome;
                }
            }
        }
        return $aDados;
    }

    /**
     * Retorna array com a listagem
     * @return mixed
     */
    public function getListagem() {
        $aLista = $this->buscaDiretorio();
        if (count($aLista) > 0) {
            return $aLista;
        }
        return 'Nenhum arquivo encontrado';
    }

    /**
     * Define os arquivos e diretorios que n�o ser�o listados
     * @return array
     */
    private function getExcluiDaListagem() {
        return array('..','.');
    }

    /**
     * Monta o caminho completo do arquivos com base do diret�rio setado na classe
     * @param string $sNomeArquivos
     * @return string
     * @todo tratar pra acessar via servidor e n�o como arquivo
     */
    public function getCaminhoCompletoArquivo($sNomeArquivos) {
        return $this->getDiretorioServidor().'/'.$sNomeArquivos;
    }
}
