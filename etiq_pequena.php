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
  //                  PROPIEDADES
  // -------------------------------------------------- //
  
  $fontSize = 6;
  $marge    = -5;   // between barcode and hri in pixel
  $x        = 25;  // barcode center
  $y        = 9;  // barcode center
  $height   = 6;   // barcode height in 1D ; module size in 2D
  $width    = 0.230;    // barcode height in 1D ; not use in 2D
  $angle    = 0;   // rotation in degrees
  $code     = $_POST['code']; 
  $type     = 'ean13';
  $black    = '000000'; // color in hexa

  // -------------------------------------------------- //
  //                  PROPIEDADES2
  // -------------------------------------------------- //
  
  $marge2    = -5;   // between barcode and hri in pixel
  $x2        = 75;  // barcode center
  $y2        = 9;  // barcode center
  $code2     = '1000000253536';
  // -------------------------------------------------- //
  //                  PROPIEDADES3
  // -------------------------------------------------- //
  
  $marge3    = -5;   // between barcode and hri in pixel
  $x3        = 25;  // barcode center
  $y3        = 21;  // barcode center
  $code3     = '1000000253537';
  // -------------------------------------------------- //
  //                  PROPIEDADES4
  // -------------------------------------------------- //
  
  $marge4    = -5;   // between barcode and hri in pixel
  $x4        = 75;  // barcode center
  $y4        = 21;  // barcode center
  $code4     = '1000000253538';
 // -------------------------------------------------- //
  //                  PROPIEDADES5
  // -------------------------------------------------- //
  
  $marge5    = -5;   // between barcode and hri in pixel
  $x5        = 25;  // barcode center
  $y5        = 33;  // barcode center
  $code5     = '1000000253539';
  // -------------------------------------------------- //
  //                  PROPIEDADES6
  // -------------------------------------------------- //
  
  $marge6    = -5;   // between barcode and hri in pixel
  $x6        = 75;  // barcode center
  $y6        = 33;  // barcode center
  $code6     = '1000000253540';
  
  // -------------------------------------------------- //
  //                  PROPIEDADES7
  // -------------------------------------------------- //
  
  $marge7    = -5;   // between barcode and hri in pixel
  $x7        = 25;  // barcode center
  $y7        = 45;  // barcode center
  $code7     = '1000000253541';
  
  // -------------------------------------------------- //
  //                  PROPIEDADES8
  // -------------------------------------------------- //
  
  $marge8    = -5;   // between barcode and hri in pixel
  $x8        = 75;  // barcode center
  $y8        = 45;  // barcode center
  $code8     = '1000000253542';
  
  
  // -------------------------------------------------- //
  //            ALLOCATE FPDF RESSOURCE
  // -------------------------------------------------- //
    
  $pdf = new eFPDF('P','mm',array(101.60,65));
  $pdf->AddPage();

  // -------------------------------------------------- //
  //                      Rectangulo
  // -------------------------------------------------- //

  $pdf->Rect(1,4, 50, 12, 'D');      //x,y,ancho,alto
  $pdf->Rect(51, 4, 50, 12, 'D');
  $pdf->Rect(1, 16, 50, 12, 'D');
  $pdf->Rect(51, 16, 50, 12, 'D');
  $pdf->Rect(1, 28, 50, 12, 'D');
  $pdf->Rect(51, 28, 50, 12, 'D');
  $pdf->Rect(1, 40, 50, 12, 'D');
  $pdf->Rect(51, 40, 50, 12, 'D');

  
  $pdf->SetFont('Arial','B',6);
  $pdf->Text(67,14,$code2,'','','C');
  
  $pdf->SetFont('Arial','B',6);
  $pdf->Text(17,26,$code3,'','','C');
  
  $pdf->SetFont('Arial','B',6);
  $pdf->Text(67,26,$code4,'','','C');
  
  $pdf->SetFont('Arial','B',6);
  $pdf->Text(17,38,$code5,'','','C');
  
  $pdf->SetFont('Arial','B',6);
  $pdf->Text(67,38,$code6,'','','C');
  
  $pdf->SetFont('Arial','B',6);
  $pdf->Text(17,50,$code7,'','','C');
  
  $pdf->SetFont('Arial','B',6);
  $pdf->Text(67,50,$code8,'','','C');
  
  
  // -------------------------------------------------- //
  //                      BARCODE
  // -------------------------------------------------- //
  
  $data = Barcode::fpdf($pdf, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);
  $data = Barcode::fpdf($pdf, $black, $x2, $y2, $angle, $type, array('code'=>$code2), $width, $height);
  $data = Barcode::fpdf($pdf, $black, $x3, $y3, $angle, $type, array('code'=>$code3), $width, $height);
  $data = Barcode::fpdf($pdf, $black, $x4, $y4, $angle, $type, array('code'=>$code4), $width, $height);
  $data = Barcode::fpdf($pdf, $black, $x5, $y5, $angle, $type, array('code'=>$code5), $width, $height);
  $data = Barcode::fpdf($pdf, $black, $x6, $y6, $angle, $type, array('code'=>$code6), $width, $height);
  $data = Barcode::fpdf($pdf, $black, $x7, $y7, $angle, $type, array('code'=>$code7), $width, $height);
  $data = Barcode::fpdf($pdf, $black, $x8, $y8, $angle, $type, array('code'=>$code8), $width, $height);
  
  // -------------------------------------------------- //
  //                      HRI
  // -------------------------------------------------- //
  
  $pdf->SetFont('Arial','B',$fontSize);
  $pdf->SetTextColor(0, 0, 0);
  $len = $pdf->GetStringWidth($data['hri']);
  Barcode::rotate(-$len / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
  $pdf->TextWithRotation($x + $xt, $y + $yt, $data['hri'], $angle);
  
  $pdf->Output();
?>
