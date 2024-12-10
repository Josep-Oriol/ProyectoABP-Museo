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
    
        .data-container {
            display: block;
            margin-bottom: 15px;
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
    
        .readonly-value {
            background-color: #F4F4F4;
            color: #666666;
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
    
        .text-area {
            min-height: 60px;
        }
    </style>
    
    <div class="container">
        <div class="section">
            <div class="section-title">Dades Principals</div>
            <div class="image-container">
                <img src="'.$obra['fotografia'].'" class="image" alt="fotografia obra">
            </div>
            <div class="data-container">
                <div class="data-row">
                    <span class="label">Títol:</span>
                    <span class="value">'.$obra['titulo'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Autor:</span>
                    <span class="value">'.$obra['autor'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Data:</span>
                    <span class="value">'.$obra['anyo_final'].'</span>
                </div>
            </div>
        </div>
    
        <div class="section">
            <div class="section-title">Dades Generals</div>
            <div class="data-container">
                <div class="data-row">
                    <span class="label">Nº de registre:</span>
                    <span class="value readonly-value">'.$obra['numero_registro'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Data de registre:</span>
                    <span class="value">'.$obra['fecha_registro'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Nom del Museu:</span>
                    <span class="value">'.$obra['nombre_museo'].'</span>
                </div>
            </div>
        </div>
    
        <div class="section">
            <div class="section-title">Clasificació i Dimensions</div>
            <div class="data-container">
                <div class="data-row">
                    <span class="label">Classificació genèrica:</span>
                    <span class="value">'.$obra['clasificacion_generica'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Nom de l\'objecte:</span>
                    <span class="value">'.$obra['nombre_objeto'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Col·lecció de procedència:</span>
                    <span class="value">'.$obra['coleccion_procedencia'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Mides màxima alçada (cm):</span>
                    <span class="value">'.$obra['maxima_altura_cm'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Mides màxima amplada (cm):</span>
                    <span class="value">'.$obra['maxima_anchura_cm'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Mides màxima profunditat (cm):</span>
                    <span class="value">'.$obra['maxima_profundidad_cm'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Material:</span>
                    <span class="value">'.$obra['material'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Tècnica:</span>
                    <span class="value">'.$obra['tecnica'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Estat de conservació:</span>
                    <span class="value">'.$obra['estado_conservacion'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Nombre d\'exemplars:</span>
                    <span class="value">'.$obra['numero_ejemplares'].'</span>
                </div>
            </div>
        </div>
    
        
    
        <div class="section">
            <div class="section-title">Ingrés</div>
            <div class="data-container">
                <div class="data-row">
                    <span class="label">Forma d\'ingrés:</span>
                    <span class="value">'.$obra['forma_ingreso'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Data d\'ingrés:</span>
                    <span class="value">'.$obra['fecha_ingreso'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Font d\'ingrés:</span>
                    <span class="value">'.$obra['fuente_ingreso'].'</span>
                </div>
            </div>
        </div>
    
        <div class="section">
            <div class="section-title">Informació Adicional</div>
            <div class="data-container">
                <div class="data-row">
                    <span class="label">Descripció:</span>
                    <span class="value text-area">'.$obra['descripcion_obra'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Bibliografia:</span>
                    <span class="value text-area">'.$obra['bibliografia'].'</span>
                </div>
                <div class="data-row">
                    <span class="label">Història de l\'objecte:</span>
                    <span class="value text-area">'.$obra['historia_objeto'].'</span>
                </div>
            </div>
        </div>
    </div>';
    
    $contenidoHTML = ob_get_contents();

    $html2pdf->writeHTML($html);
    ob_end_clean();

    $html2pdf->output('ficha.pdf');
?>

