<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\Style\Paragraph;
use PhpOffice\PhpWord\Style\LineSpacing;
use PhpOffice\PhpWord\SimpleType\Jc;

// Crear una instancia de PHPWord
$phpWord = new PhpWord();

// Configurar página con márgenes más pequeños
$section = $phpWord->addSection([
    'marginLeft' => 900,
    'marginRight' => 900,
    'marginTop' => 900,
    'marginBottom' => 900,
]);

// Estilos actualizados con tamaños más pequeños
$headerStyle = ['name' => 'Arial', 'size' => 9, 'bold' => true];
$titleStyle = ['name' => 'Arial', 'size' => 10, 'bold' => true];
$normalStyle = ['name' => 'Arial', 'size' => 9];
$boldStyle = ['name' => 'Arial', 'size' => 9, 'bold' => true];
$smallStyle = ['name' => 'Arial', 'size' => 8];
$catalanStyle = ['name' => 'Arial', 'size' => 9, 'bold' => true];
$spanishStyle = ['name' => 'Arial', 'size' => 9, 'italic' => true];
$englishStyle = ['name' => 'Arial', 'size' => 9];

// Párrafos con interlineado reducido
$centerParagraph = [
    'alignment' => Jc::CENTER,
    'spacing' => 60
];
$leftParagraph = [
    'alignment' => Jc::LEFT,
    'spacing' => 60
];

// Configuración específica para checkboxes con espaciado mínimo
$checkboxParagraph = [
    'alignment' => Jc::LEFT,
    'spacing' => 40
];

// Títulos centrados
$section->addText('FORMULARI DE PRÉSTEC PER RETORNAR AL CENTRE', $titleStyle, $centerParagraph);
$section->addText('FORMULARIO DE PRÉSTAMO PARA DEVOLVER AL CENTRO', ['name' => 'Arial', 'size' => 10, 'italic' => true], $centerParagraph);
$section->addText('FORMULARY OF LOAN TO RETURN TO CENTRE', $titleStyle, $centerParagraph);

// Campos principales
$campos = [
    [
        ['Institució sol·licitant', $catalanStyle],
        [' / Institución solicitante', $spanishStyle],
        [' / Applicant Institution:', $englishStyle]
    ],
    [
        ['Responsable del préstec', $catalanStyle],
        [' / Responsable del préstamo', $spanishStyle],
        [' / Responsible of loan:', $englishStyle]
    ],
    [
        ['Càrrec', $catalanStyle],
        [' / Cargo', $spanishStyle],
        [' / Job title:', $englishStyle]
    ],
    [
        ['Exposició', $catalanStyle],
        [' / Exposición', $spanishStyle],
        [' / Exhibition:', $englishStyle]
    ]
];

foreach ($campos as $campo) {
    $textrun = $section->addTextRun($leftParagraph);
    foreach ($campo as $parte) {
        $textrun->addText($parte[0], $parte[1]);
    }
    $section->addText('_________________________________________________________________________________', $normalStyle);
}

// Lugar y fecha con espaciado reducido
$textrun = $section->addTextRun($leftParagraph);
$textrun->addText('Lloc', $catalanStyle);
$textrun->addText(' / Lugar', $spanishStyle);
$textrun->addText(' / Place:', $englishStyle);
$section->addText('____________________________________________________', $normalStyle);

$textrun = $section->addTextRun($leftParagraph);
$textrun->addText('Dates', $catalanStyle);
$textrun->addText(' / Fechas', $spanishStyle);
$textrun->addText(' / Dates:', $englishStyle);
$textrun->addText(' ___________________ - ___________________', $normalStyle);

// Información del prestador
$textrun = $section->addTextRun($leftParagraph);
$textrun->addText('Nom del prestador: ', $boldStyle);
$textrun->addText('Museu Apel·les Fenosa. Fundació Privada Apel·les Fenosa', $normalStyle);
$section->addText('Nombre del prestador / Name of lender', $smallStyle);

// Dirección y contacto con espaciado reducido
$textrun = $section->addTextRun($leftParagraph);
$textrun->addText('Adreça: ', $boldStyle);
$textrun->addText('Carrer Major, 25, 43700 El Vendrell, Tarragona', $normalStyle);
$textrun->addText('    Telèfon: ', $boldStyle);
$textrun->addText('+34 977 15 41 92', $normalStyle);
$section->addText('Dirección / Address    Teléfono / Telephone', $smallStyle);

$textrun = $section->addTextRun($leftParagraph);
$textrun->addText('Correu electrònic: ', $boldStyle);
$textrun->addText('info@museuapellesfenosa.cat', $normalStyle);
$section->addText('Correo electrónico / Electronic mail', $smallStyle);

// Campos técnicos
$camposTecnicos = [
    [
        ['Número de registre', $catalanStyle],
        ['Número de registro', $smallStyle],
        ['Inventory number', $smallStyle]
    ],
    [
        ['Nom de l\'objecte i títol', $catalanStyle],
        ['Nombre del objeto y título', $smallStyle],
        ['Object name and title', $smallStyle]
    ],
    [
        ['Autor', $catalanStyle],
        ['Autor', $smallStyle],
        ['Author', $smallStyle]
    ],
    [
        ['Dimensions màx. (Alçada/Amplada/Fondària)', $catalanStyle],
        ['Dimensiones (Altura/Ancho/Fondo)', $smallStyle],
        ['Dimensions (Height/Width/Depth)', $smallStyle]
    ],
    [
        ['Materials:', $catalanStyle],
        ['Materials', $smallStyle],
        ['Materials', $smallStyle],
        ['    Datació:', $catalanStyle],
        ['Datación', $smallStyle],
        ['Dating', $smallStyle]
    ]
];

foreach ($camposTecnicos as $campo) {
    $textrun = $section->addTextRun($leftParagraph);
    foreach ($campo as $parte) {
        $textrun->addText($parte[0], $parte[1]);
        $textrun->addText('  ', $normalStyle);
    }
    $section->addText('_________________________________________________________________________________', $normalStyle);
}

// Segunda página
$section->addPageBreak();

// Forma de aparecer en el catálogo
$textrun = $section->addTextRun($leftParagraph);
$textrun->addText('Forma en què el prestador vol figurar en el catàleg: ', $catalanStyle);
$textrun->addText('Museu Apel·les Fenosa', $normalStyle);
$section->addText('Forma en que el prestador quiere figurar en el catálogo', $smallStyle);
$section->addText('Form in which the lender wishes to feature in the catalogue', $smallStyle);

// Permisos de fotografía con espaciado mínimo
$textrun = $section->addTextRun(['spacing' => 40]);
$textrun->addText('El prestador admet que es fotografïi per a', $catalanStyle);
$textrun->addText(' / El prestador admite que se fotografie para', $spanishStyle);
$textrun->addText(' / The lender allows be photographed for:', $englishStyle);

// Permisos con checkboxes alineados verticalmente y espaciado mínimo
$permisos = [
    ['Publicacions de l\'exposició', 200],
    ['Mitjans de comunicació', 200],
    ['Arxius', 200],
    ['Finalitats privades', 200]
];

foreach ($permisos as $permiso) {
    $textrun = $section->addTextRun($checkboxParagraph);
    $textrun->addText(str_pad($permiso[0], $permiso[1]), $normalStyle);
    $textrun->addText('☐ Sí', $normalStyle);
    $textrun->addText('     ');
    $textrun->addText('☐ No', $normalStyle);
}

// Campos adicionales con espaciado mínimo
$camposAdicionales = [
    [
        'Valoració per a l\'assegurança:',
        'Valoración para el seguro',
        'Insurance value'
    ],
    [
        'Adreça on s\'ha de recollir l\'objecte:',
        'Dirección donde debe recogerse el objeto',
        'Address from which object is to be picked up'
    ],
    [
        'Telèfon:',
        'Teléfono',
        'Telephone'
    ],
    [
        'Adreça on s\'ha de retornar l\'objecte:',
        'Dirección donde debe devolverse el objeto',
        'Address from which object is to be returned'
    ],
    [
        'Telèfon:',
        'Teléfono',
        'Telephone'
    ]
];

foreach ($camposAdicionales as $campo) {
    $textrun = $section->addTextRun(['spacing' => 40]);
    $textrun->addText($campo[0], $catalanStyle);
    $section->addText($campo[1], $smallStyle);
    $section->addText($campo[2], $smallStyle);
    $section->addText('_________________________________________________________________________________', $normalStyle);
}

// Firmas
$section->addTextBreak();
$textrun = $section->addTextRun($centerParagraph);
$textrun->addText('_____________________                    _____________________', $normalStyle);
$section->addTextBreak();

$textrun = $section->addTextRun($centerParagraph);
$textrun->addText('Data i firma del prestador del préstec', $catalanStyle);
$textrun->addText('          ');
$textrun->addText('Data i firma del prestatari del préstec', $catalanStyle);

$textrun = $section->addTextRun($centerParagraph);
$textrun->addText('Fecha y firma del prestador del préstamo', $spanishStyle);
$textrun->addText('        ');
$textrun->addText('Fecha y firma del prestatario del préstamo', $spanishStyle);

$textrun = $section->addTextRun($centerParagraph);
$textrun->addText('Date and signature of lender', $englishStyle);
$textrun->addText('                    ');
$textrun->addText('Date and signature of borrower', $englishStyle);

// Guardar y descargar
$file = 'Formulari_Prestec_Trilingue.docx';
$phpWord->save($file, 'Word2007');

header("Content-Description: File Transfer");
header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
header("Content-Disposition: attachment; filename=\"$file\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . filesize($file));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');

readfile($file);
unlink($file);
exit();