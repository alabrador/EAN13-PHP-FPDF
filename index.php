<?php session_start(); ?>
<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>HTML5 Contact Form</title>
	<meta name="description" content="">
	<meta name="author" content="">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	<link rel="stylesheet" href="css/style.css?v=2">

	<script src="js/libs/modernizr-1.7.min.js"></script>
</head>
<body>
	<div id="container">
        <div id="contact-form" class="clearfix">
            <h1>Imprimir etiquetas</h1>
            <?php
			//init variables
			$cf = array();
			$sr = false;
			
			if(isset($_SESSION['cf_returndata'])){
				$cf = $_SESSION['cf_returndata'];
			 	$sr = true;
			}
            ?>
            <ul id="errors" class="<?php echo ($sr && !$cf['form_ok']) ? 'visible' : ''; ?>">
                <li id="info">Hubo algunos problemas con el envío del formulario:</li>
                <?php 
				if(isset($cf['errors']) && count($cf['errors']) > 0) :
					foreach($cf['errors'] as $error) :
				?>
                <li><?php echo $error ?></li>
                <?php
					endforeach;
				endif;
				?>
            </ul>
            <p id="success" class="<?php echo ($sr && $cf['form_ok']) ? 'visible' : ''; ?>">Imprimiendo!</p>
            <form method="post" action="etiq_pequena.php">
                <label for="name">Codigo: <span class="required">*</span></label>
                <input type="text" id="code1" name="code" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['code'] : '' ?>" placeholder="Ingrese codigo de etiqueta" required autofocus />
         
                <label for="tipo_etiq">Tipo de Etiqueta: </label>
                <select id="tipo_etiq" name="tipo_etiq">
                    <option value="Etiqueta Estandar" <?php echo ($sr && !$cf['form_ok'] && $cf['posted_form_data']['enquiry'] == 'estandar') ? "selected='selected'" : '' ?>>Etiqueta Estandar</option>
                    <option value="Etiqueta Mediana" <?php echo ($sr && !$cf['form_ok'] && $cf['posted_form_data']['enquiry'] == 'mediana') ? "selected='selected'" : '' ?>>Etiqueta Mediana</option>
                    <option value="Etiqueta pequeña" <?php echo ($sr && !$cf['form_ok'] && $cf['posted_form_data']['enquiry'] == 'pequena') ? "selected='selected'" : '' ?>>Etiqueta Pequeña</option>
                </select>
                
                <span id="loading"></span>
                <input type="submit" value="Imprimir" id="submit-button" />
                <p id="req-field-desc"><span class="required">*</span> Indica los campos obligatorios</p>
            </form>
            <?php unset($_SESSION['cf_returndata']); ?>
        </div>
    </div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="js/libs/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
	<script src="js/plugins.js"></script>
	<script src="js/script.js"></script>
	<!--[if lt IE 7 ]>
	<script src="js/libs/dd_belatedpng.js"></script>
	<script> DD_belatedPNG.fix('img, .png_bg');</script>
	<![endif]-->
</body>
</html>