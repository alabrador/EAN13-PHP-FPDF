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
  
  $fontSize = 8;
  $marge    = -5;  // between barcode and hri in pixel
  $x        = 25;  // barcode center
  $y        = 10;  // barcode center
  $x2       = 75;
  $y2       = 10;
  $x3       = 25;
  $y3       = 35;
  $x4       = 75;
  $y4       = 35;
  $height   = 7;   // barcode height in 1D ; module size in 2D
  $width    = 0.210;    // barcode height in 1D ; not use in 2D
  $angle    = 0;   // rotation in degrees
  $code     = $_POST['code'];
  $empresa  = 'SUMECA';
  $nombre   = 'PILA ALKAL AAA DURACEL BLISTER 2PILAS';
  $cantidad = '1';
  $codigo   = '08-28-97';
  $code2    = '1000000253533';
  $code3    = '1000000253533';
  $code4    = '1000000253533';
//  $desc1    = $_POST['desc1'];
//  $desc2    = $_POST['desc2'];
//  $desc3    = $_POST['desc3'];
//  $desc4    = $_POST['desc4'];
//  $empa1    = $_POST['empa1'];
//  $empa2    = $_POST['empa2'];
//  $empa3    = $_POST['empa3'];
//  $empa4    = $_POST['empa4'];
//  $cant1
  $type     = 'ean13';
  $black    = '000000'; // color in hexa
  $web      = 'sumeca.com.ve';


  // -------------------------------------------------- //
  //            ALLOCATE FPDF RESSOURCE
  // -------------------------------------------------- //
    
  $pdf = new eFPDF('P','mm',array(101.90,65));
  $pdf->AddPage();

  // -------------------------------------------------- //
  //                      Rectangulo 1
  // -------------------------------------------------- //

  $pdf->Rect(1, 1, 50, 23, 'D');
// Nombre de la empresa  
  $pdf->SetFont('Arial','B',9);
  $pdf->Text(3,5,$empresa,'','','L');

// Fecha
  $pdf->SetFont('Arial','',7);
  $pdf->Text(30,5,date('d/m/Y'),'','','R');

// Descripción del producto
  $pdf->SetFont('Arial','',6.2);
  $pdf->Text(3,19,$nombre,'','','L');

// Unidad/Cantidad
  $pdf->SetFont('Arial','',8);
  $pdf->Text(3,22,$codigo);
  $pdf->Text(40,22,$cantidad);

//Web
  $pdf->SetFont('Arial','',7);
  $pdf->Text(18,22,$web);

  // -------------------------------------------------- //
  //                      Rectangulo 2
  // -------------------------------------------------- //

  $pdf->Rect(51, 1, 50, 23, 'D');

// Nombre de la empresa  
  $pdf->SetFont('Arial','B',9);
  $pdf->Text(53,5,$empresa,'','','L');

  $pdf->SetFont('Arial','B',8);
  $pdf->Text(65,16.5,$code2,'','','C');

// Fecha
  $pdf->SetFont('Arial','',7);
  $pdf->Text(80,5,date('d/m/Y'),'','','R');

// Descripción del producto
  $pdf->SetFont('Arial','',6.2);
  $pdf->Text(53,19,$nombre,'','','L');

// Unidad/Cantidad
  $pdf->SetFont('Arial','',8);
  $pdf->Text(53,22,$codigo);
  $pdf->Text(90,22,$cantidad);

//Web
  $pdf->SetFont('Arial','',7);
  $pdf->Text(67,22,$web);

  // -------------------------------------------------- //
  //                      Rectangulo 3
  // -------------------------------------------------- //

  $pdf->Rect(1, 25, 50, 23, 'D');

// Nombre de la empresa  
  $pdf->SetFont('Arial','B',9);
  $pdf->Text(3,30,$empresa,'','','L');

  $pdf->SetFont('Arial','B',8);
  $pdf->Text(15,41,$code3,'','','C');

// Fecha
  $pdf->SetFont('Arial','',7);
  $pdf->Text(30,30,date('d/m/Y'),'','','R');

// Descripción del producto
  $pdf->SetFont('Arial','',6.2);
  $pdf->Text(3,43,$nombre,'','','L');

// Unidad/Cantidad
  $pdf->SetFont('Arial','',8);
  $pdf->Text(3,46,$codigo);
  $pdf->Text(40,46,$cantidad);

//Web
  $pdf->SetFont('Arial','',7);
  $pdf->Text(18,46,$web);


  // -------------------------------------------------- //
  //                      Rectangulo 4
  // -------------------------------------------------- //

  $pdf->Rect(51, 25, 50, 23, 'D');

// Nombre de la empresa  
  $pdf->SetFont('Arial','B',9);
  $pdf->Text(53,30,$empresa,'','','L');

  $pdf->SetFont('Arial','B',8);
  $pdf->Text(65,41,$code4,'','','C');

// Fecha
  $pdf->SetFont('Arial','',7);
  $pdf->Text(80,30,date('d/m/Y'),'','','R');

// Descripción del producto
  $pdf->SetFont('Arial','',6.2);
  $pdf->Text(53,43,$nombre,'','','L');

// Unidad/Cantidad
  $pdf->SetFont('Arial','',8);
  $pdf->Text(53,46,$codigo);
  $pdf->Text(90,46,$cantidad);

//Web
  $pdf->SetFont('Arial','',7);
  $pdf->Text(67,46,$web);



  // -------------------------------------------------- //
  //                      BARCODE
  // -------------------------------------------------- //
  
  $data = Barcode::fpdf($pdf, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);
  $data = Barcode::fpdf($pdf, $black, $x2, $y2, $angle, $type, array('code'=>$code2), $width, $height);
  $data = Barcode::fpdf($pdf, $black, $x3, $y3, $angle, $type, array('code'=>$code3), $width, $height);
  $data = Barcode::fpdf($pdf, $black, $x4, $y4, $angle, $type, array('code'=>$code4), $width, $height);
  
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
