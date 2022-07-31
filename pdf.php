<?php
require('fpdf.php');
$db = new PDO('mysql:host=localhost;dbname=to_do_list','root','');
class myPDF extends FPDF{
    function headerTable(){
        $this->setFont('Times','B',12);
        $this->Cell(30,10,'ID',1,0,'C');
        $this->Cell(70,10,'My To Do List',1,0,'L');
        $this->Cell(60,10,'Date',1,0,'C');
        $this->Ln(10);
    }
    function viewTable($db){
        $this->SetFont('Times','',12);
        $stmt = $db->query('SELECT * FROM todo;');

        while($s = $stmt->fetch(PDO::FETCH_OBJ)){
            $this->setFont('Times','B',12);
            $this->Cell(30,10, $s-> id,1,0,'C');
            $this->Cell(70,10, $s-> title,1,0,'L');
            $this->Cell(60,10,$s-> date_time,1,0,'C');
            $this->Ln(10);
        }
        }
    }

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);

$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output();
?>