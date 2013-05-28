<?php
  include('php-barcode.php');
  require('fpdf.php');
  
  // -------------------------------------------------- //
  //                      USEFUL
  // -------------------------------------------------- //
  
  class eFPDF extends FPDF{
    function TextWithRotation($x, $y, $txt, $txt_angle, $font_angle=0)
    {
        $font_angle+=90+$txt_angle;
        $txt_angle*=M_PI/180;
        $font_angle*=M_PI/180;
    
        $txt_dx=cos($txt_angle);
        $txt_dy=sin($txt_angle);
        $font_dx=cos($font_angle);
        $font_dy=sin($font_angle);
    
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',$txt_dx,$txt_dy,$font_dx,$font_dy,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
        if ($this->ColorFlag)
            $s='q '.$this->TextColor.' '.$s.' Q';
        $this->_out($s);
    }
  }

  // -------------------------------------------------- //
  //                  PROPERTIES
  // -------------------------------------------------- //
  
  $fontSize = 10;
  $marge    = -6;   // between barcode and hri in pixel
  $x        = 50;  // barcode center
  $y        = 15;  // barcode center
  $height   = 10;   // barcode height in 1D ; module size in 2D
  $width    = 0.340;    // barcode height in 1D ; not use in 2D
  $angle    = 0;   // rotation in degrees
  $code     = $_POST['code'];
  $type     = 'ean13';
  $black    = '000000'; // color in hexa
  //$desc     = $_POST['desc'];
  //$id      = $_POST['cod_inv'];
  //$unid     = $_POST['cant'];
  
  // -------------------------------------------------- //
  //            ALLOCATE FPDF RESSOURCE
  // -------------------------------------------------- //
    
//$pdf = new eFPDF('P', 'pt');
  $pdf = new eFPDF('P','mm',array(101.60,40));
  $pdf->AddPage();

  // -------------------------------------------------- //
  //                      Rectangulo
  // -------------------------------------------------- //

  $pdf->Rect(2, 2, 97, 35, 'D');

  // -------------------------------------------------- //
  //                      BARCODE
  // -------------------------------------------------- //
  
  $data = Barcode::fpdf($pdf, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);
  
  // -------------------------------------------------- //
  //                      HRI
  // -------------------------------------------------- //
  
  $pdf->SetFont('Arial','B',$fontSize);
  $pdf->SetTextColor(0, 0, 0);
  $len = $pdf->GetStringWidth($data['hri']);
  Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
  $pdf->TextWithRotation($x + $xt, $y + $yt, $data['hri'], $angle);

// Nombre de la empresa  
  $pdf->SetFont('Arial','B',14);
  $pdf->Cell(0,-5,'SUMECA','','','L');

// Fecha
  $pdf->SetFont('Arial','',9);
  $pdf->Cell(0,-5,date('d/m/Y'),'','','R');

// Descripción del producto
  $pdf->SetFont('Arial','',9);
  $pdf->Text(12,28,'PILA ALKAL AAA DURACEL BLISTER 2PILAS','','','L');

// Codigo del producto
  $pdf->SetFont('Arial','',9);
  $pdf->Text(12,32,'08-28-97');

// Unidad/Cantidad
  $pdf->SetFont('Arial','',8);
  $pdf->Text(40,32,'UNIDAD');
  $pdf->Text(80,32,'1');

  $pdf->Output();
?>
