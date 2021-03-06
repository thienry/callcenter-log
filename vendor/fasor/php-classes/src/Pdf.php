<?php

namespace Fasor;

use \mpdf\Mpdf;

class Pdf extends Mpdf {
  // Atributos da classe  
  private $pdo  = null;
  private $pdf  = null;
  private $css  = null;
  private $titulo = null;

  /*  
  * Construtor da classe  
  * @param $css  - Arquivo CSS  
  * @param $titulo - Título do relatório   
  */
  public function __construct($css, $titulo) {
    $this->pdo  = Conexao::getInstance();
    $this->titulo = $titulo;
    $this->setarCSS($css);
  }

  /*  
  * Método para setar o conteúdo do arquivo CSS para o atributo css  
  * @param $file - Caminho para arquivo CSS  
  */
  public function setarCSS($file) {
    if (file_exists($file)) :
      $this->css = file_get_contents($file);
    else :
      echo 'Arquivo inexistente!';
    endif;
  }

  /*  
  * Método para montar o Cabeçalho do relatório em PDF  
  */
  protected function getHeader() {
    $data = date('j/m/Y');
    $retorno = "<table class=\"tbl_header\" width=\"1000\">  
               <tr>  
                 <td align=\"left\">Biblioteca mPDF</td>  
                 <td align=\"right\">Gerado em: $data</td>  
               </tr>  
             </table>";
    return $retorno;
  }

  /*  
  * Método para montar o Rodapé do relatório em PDF  
  */
  protected function getFooter() {
    $retorno = "<table class=\"tbl_footer\" width=\"1000\">  
               <tr>  
                 <td align=\"left\"><a href=''>devwilliam.blogspot.com</a></td>  
                 <td align=\"right\">Página: {PAGENO}</td>  
               </tr>  
             </table>";
    return $retorno;
  }

  /*   
  * Método para construir a tabela em HTML com todos os dados  
  * Esse método também gera o conteúdo para o arquivo PDF  
  */
  private function getTabela() {
    $color  = false;
    $retorno = "";

    $retorno .= "<h2 style=\"text-align:center\">{$this->titulo}</h2>";
    $retorno .= "<table style='font-family: 'Trebuchet MS', Arial, Helvetica, sans-serif; border-collapse: collapse; width: 100%;'>  
           <tr class='header'>  
             <th style='border: 1px solid #ddd; padding: 8px; padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #4CAF50; color: white;'>Marcação</th> 

             <th style='border: 1px solid #ddd; padding: 8px;  padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #4CAF50; color: white;'>Nome Paciente</th>  
             
             <th style='border: 1px solid #ddd; padding: 8px;  padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #4CAF50; color: white;'>Tipo</th>  
             
             <th style='border: 1px solid #ddd; padding: 8px;  padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #4CAF50; color: white;'>Médico</th>  
             
             <th style='border: 1px solid #ddd; padding: 8px;  padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #4CAF50; color: white;'>Data</th>  
             
             <th style='border: 1px solid #ddd; padding: 8px;  padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #4CAF50; color: white;'>Telefone</th>  
             
             <th style='border: 1px solid #ddd; padding: 8px;  padding-top: 12px; padding-bottom: 12px; text-align: left; background-color: #4CAF50; color: white;'>Status</th>  
           </tr>";

    $sql = "SELECT * FROM TAB_CLIENTE";
    foreach ($this->pdo->query($sql) as $reg) :
      $retorno .= ($color) ? "<tr>" : "<tr class=\"zebra\">";
      $retorno .= "<td class='destaque'>{$reg['nome']}</td>";
      $retorno .= "<td>{$reg['fone']}</td>";
      $retorno .= "<td>{$reg['idade']}</td>";
      $retorno .= "<td>{$reg['profissao']}</td>";
      $retorno .= "<td>{$reg['email']}</td>";
      $retorno .= "<td>{$reg['endereco']}</td>";
      $retorno .= "<td>{$reg['cidade']}</td>";
      $retorno .= "<td>{$reg['uf']}</td>";
      $retorno .= "<tr>";
      $color = !$color;
    endforeach;

    $retorno .= "</table>";
    return $retorno;
  }

/*
  '<style>


#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
*/
  
  /*   


  * Método para construir o arquivo PDF  
  */
  public function BuildPDF() {
    $this->pdf = new mPDF(["utf-8", "A4-L"]);
    $this->pdf->WriteHTML($this->css, 1);
    $this->pdf->SetHTMLHeader($this->getHeader());
    $this->pdf->SetHTMLFooter($this->getFooter());
    $this->pdf->WriteHTML($this->getTabela());
  }

  /*   
  * Método para exibir o arquivo PDF  
  * @param $name - Nome do arquivo se necessário grava-lo  
  */
  public function Exibir($name = null) {
    $this->pdf->Output($name, 'I');
  }
}
