<?php
    require "vendor/autoload.php";
    use Spipu\Html2Pdf\Html2Pdf;
    ob_start();
    
    $content = ob_get_clean();
    $html2pdf = new Html2pdf();

    $html = '
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333333;
            line-height: 1.4;
        }
    
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
    
        .section {
            margin-bottom: 20px;
            padding: 15px;
            border-left: 5px solid #333333;
            background-color: #F4F4F4;
            border-radius: 5px;
        }
    
        .section-title {
            font-size: 1.2em;
            font-weight: bold;
            color: #333333;
            margin-top: 0;
            margin-bottom: 15px;
        }
    
        .image-container {
            width: 100%;
            margin: 20px 0;
            text-align: center;
        }
    
        .image {
            max-width: 50%;
            margin: 0 auto;
        }
    
        .data-row {
            margin: 10px 0;
            page-break-inside: avoid;
        }
    
        .label {
            font-weight: bold;
            color: #333333;
            margin-bottom: 5px;
            display: block;
        }
    
        .value {
            padding: 8px;
            border: 1px solid #BFBFBF;
            border-radius: 4px;
            min-height: 20px;
            display: block;
        }
    </style>
    
    <div class="container">
        <div class="section">
            <div class="section-title">Dades Principals</div>
            <div class="image-container">
                <img src="'.$datos['foto_usuario'].'" class="image" alt="fotografia usuario">
            </div>
            <div class="data-container">
                <div class="data-row">
                    <span class="label">Usuari:</span>
                    <span class="value">'.$datos['usuario'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Nom:</span>
                    <span class="value">'.$datos['nombre'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Cognoms:</span>
                    <span class="value">'.$datos['apellidos'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Correu electrònic:</span>
                    <span class="value">'.$datos['correo_electronico'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Telèfon:</span>
                    <span class="value">'.$datos['telefono'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Rol:</span>
                    <span class="value">'.$datos['rol'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Estat:</span>
                    <span class="value">'.$datos['estado'].'</span>
                </div>
            </div>
        </div>
    </div>';
    
    $contenidoHTML = ob_get_contents();

    $html2pdf->writeHTML($html);
    ob_end_clean();

    $html2pdf->output('fitxa_usuari.pdf');
?>