<?php /*
require_once 'autoload.php';
require_once "models/Obras.php";
require "vendor/autoload.php";
use Spipu\Html2Pdf\Html2Pdf;

    $content = ob_get_clean();
    $html2pdf = new Html2pdf();

    $modeloObras = new Obras();

    $obras = $modeloObras->mostrarObras();

    $indiceHTML = '
    <h1>Índex</h1>
    <ul>';
    foreach ($obras as $index => $obra) {
        $indiceHTML .= '<li><a href="#obra' . $index . '">' . htmlspecialchars($obra['titulo']) . '</a></li>';
    }
    $indiceHTML .= '</ul>';

    $html2pdf->writeHTML($indiceHTML);

    foreach ($obras as $index => $obra){
        ob_start();

        $html = '
        <page backtop="10mm" backbottom="10mm">
        <div id="obra'.$index.'">
        <h2>'.$obra['titulo'].'</h2>
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
                <div class="section-title">Ubicació</div>
                <div class="data-container">
                    <div class="data-row">
                        <span class="label">Ubicació:</span>
                        <span class="value">'.$obra['descripcion_ubicacion'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Data inici ubicació:</span>
                        <span class="value">'.$obra['fecha_inicio_ubicacion'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Data fi ubicació:</span>
                        <span class="value">'.$obra['fecha_fin_ubicacion'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Comentari ubicació:</span>
                        <span class="value">'.$obra['comentario_ubicacion'].'</span>
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
                <div class="section-title">Dates i llocs</div>
                <div class="data-container">
                    <div class="data-row">
                        <span class="label">Any inicial:</span>
                        <span class="value">'.$obra['anyo_inicial'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Any final:</span>
                        <span class="value">'.$obra['anyo_final'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Datació:</span>
                        <span class="value">'.$obra['datacion'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Lloc d\'execució:</span>
                        <span class="value">'.$obra['lugar_ejecucion'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Lloc de procedència:</span>
                        <span class="value">'.$obra['lugar_procedencia'].'</span>
                    </div>
                </div>
            </div>
        
            <div class="section">
                <div class="section-title">Baixa</div>
                <div class="data-container">
                    <div class="data-row">
                        <span class="label">Baixa:</span>
                        <span class="value">'.$obra['baja'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Causa baixa:</span>
                        <span class="value">'.$obra['causa_baja'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Data baixa:</span>
                        <span class="value">'.$obra['fecha_baja'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Persona autoritzada:</span>
                        <span class="value">'.$obra['usuario'].'</span>
                    </div>
                </div>
            </div>
        
            <div class="section">
                <div class="section-title">Identificació i Valoració</div>
                <div class="data-container">
                    <div class="data-row">
                        <span class="label">Nº Tiratge:</span>
                        <span class="value">'.$obra['numero_tiraje'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Altres números d\'identificació:</span>
                        <span class="value">'.$obra['otros_numeros_identificacion'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Valoració econòmica (€):</span>
                        <span class="value">'.$obra['valoracion_economica'].'</span>
                    </div>
                </div>
            </div>
        
            <div class="section">
                <div class="section-title">Exposició i Restauració</div>
                <div class="data-container">
                    <div class="data-row">
                        <span class="label">Exposició:</span>
                        <span class="value">'.($obra['texto_exposicion'] ?? "Indefinida").'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Data inici expo.:</span>
                        <span class="value">'.($obra['fecha_inicio_exposicion'] ?? "Indefinida").'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Data fi expo.:</span>
                        <span class="value">'.($obra['fecha_fin_exposicion'] ?? "Indefinida").'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Codi restauració:</span>
                        <span class="value">'.$obra['id_restauracion'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Data inici restauració:</span>
                        <span class="value">'.$obra['fecha_inicio_restauracion'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Data fi restauració:</span>
                        <span class="value">'.$obra['fecha_fin_restauracion'].'</span>
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
        </div>
        </div>
        </page>';
        
        

        $html2pdf->writeHTML($html);
        ob_end_clean();
        
    }
    $html2pdf->output('ficha.pdf');

   */
require_once 'autoload.php';
require_once "models/Obras.php";
require "vendor/autoload.php";
use Spipu\Html2Pdf\Html2Pdf;

    $content = ob_get_clean();
    // Changed to A3 landscape format
    $html2pdf = new Html2Pdf('L', 'A3', 'es');

    $modeloObras = new Obras();
    $obras = $modeloObras->mostrarObras();

    $indiceHTML = '
    <page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm">
    <h1>Índex</h1>
    <ul>';
    foreach ($obras as $index => $obra) {
        $indiceHTML .= '<li><a href="#obra' . $index . '">' . htmlspecialchars($obra['titulo']) . '</a></li>';
    }
    $indiceHTML .= '</ul></page>';

    $html2pdf->writeHTML($indiceHTML);

    foreach ($obras as $index => $obra){
        ob_start();

        $html = '
        <page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm" format="A3" orientation="L">
        <div id="obra'.$index.'">
        <h2>'.$obra['titulo'].'</h2>
        <style>
            body {
                font-family: Arial, sans-serif;
                color: #333333;
                line-height: 1.4;
            }
        
            .container {
                width: 100%;
                margin: 0 auto;
                padding: 20px;
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
            }
        
            .section {
                flex: 1 1 calc(33% - 20px);
                margin-bottom: 20px;
                padding: 20px;
                border-left: 5px solid #333333;
                background-color: #F4F4F4;
                border-radius: 5px;
                min-width: 300px;
                font-size: 24px;
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
                padding-bottom: 20px;
            }
        
            .image {
                max-width: 70%;
                max-height: 300px;
                margin: 0 auto;
            }
        
            .text-area {
                min-height: 60px;
            }

            .main-info {
                flex: 1 1 100%;
                display: flex;
                gap: 20px;
                align-items: flex-start;
            }

            .image-section {
                flex: 0 0 40%;
            }

            .info-section {
                flex: 0 0 55%;
            }
        </style>

        <div class="container">
            <div class="main-info">
                <div class="image-section">
                    <div class="image-container">
                        <img src="'.$obra['fotografia'].'" class="image" alt="fotografia obra">
                    </div>
                </div>
                <div class="info-section">
                    <div class="section">
                        <div class="section-title">Dades Principals</div>
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
                        <span class="label">Material:</span>
                        <span class="value">'.$obra['material'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Tècnica:</span>
                        <span class="value">'.$obra['tecnica'].'</span>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="section-title">Dimensions</div>
                <div class="data-container">
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
                </div>
            </div>
        
            <div class="section">
                <div class="section-title">Ubicació</div>
                <div class="data-container">
                    <div class="data-row">
                        <span class="label">Ubicació:</span>
                        <span class="value">'.$obra['descripcion_ubicacion'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Data inici ubicació:</span>
                        <span class="value">'.$obra['fecha_inicio_ubicacion'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Data fi ubicació:</span>
                        <span class="value">'.$obra['fecha_fin_ubicacion'].'</span>
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
                <div class="section-title">Dates i llocs</div>
                <div class="data-container">
                    <div class="data-row">
                        <span class="label">Any inicial:</span>
                        <span class="value">'.$obra['anyo_inicial'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Any final:</span>
                        <span class="value">'.$obra['anyo_final'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Datació:</span>
                        <span class="value">'.$obra['datacion'].'</span>
                    </div>
                </div>
            </div>
        
            <div class="section">
                <div class="section-title">Baixa</div>
                <div class="data-container">
                    <div class="data-row">
                        <span class="label">Baixa:</span>
                        <span class="value">'.$obra['baja'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Causa baixa:</span>
                        <span class="value">'.$obra['causa_baja'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Data baixa:</span>
                        <span class="value">'.$obra['fecha_baja'].'</span>
                    </div>
                </div>
            </div>
        
            <div class="section">
                <div class="section-title">Identificació i Valoració</div>
                <div class="data-container">
                    <div class="data-row">
                        <span class="label">Nº Tiratge:</span>
                        <span class="value">'.$obra['numero_tiraje'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Altres números d\'identificació:</span>
                        <span class="value">'.$obra['otros_numeros_identificacion'].'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Valoració econòmica (€):</span>
                        <span class="value">'.$obra['valoracion_economica'].'</span>
                    </div>
                </div>
            </div>
        
            <div class="section">
                <div class="section-title">Exposició i Restauració</div>
                <div class="data-container">
                    <div class="data-row">
                        <span class="label">Exposició:</span>
                        <span class="value">'.($obra['texto_exposicion'] ?? "Indefinida").'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Data inici expo.:</span>
                        <span class="value">'.($obra['fecha_inicio_exposicion'] ?? "Indefinida").'</span>
                    </div>
                    <div class="data-row">
                        <span class="label">Data fi expo.:</span>
                        <span class="value">'.($obra['fecha_fin_exposicion'] ?? "Indefinida").'</span>
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
        </div>
        </div>
        </page>';
        
        $html2pdf->writeHTML($html);
        ob_end_clean();
        
    }
    $html2pdf->output('ficha.pdf'); 
?> 
