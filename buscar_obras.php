<?php
// Conexión a la base de datos
include 'models\Database.php'; // Incluye tu archivo de conexión a la base de datos

if (isset($_POST['query'])) {
    $search = $_POST['query'];

    // Prepara una consulta para buscar obras basadas en la entrada del usuario
    $stmt = $pdo->prepare("SELECT * FROM obras WHERE Titulo LIKE :search OR Autor LIKE :search OR Numero_registro LIKE :search");
    $stmt->execute(['search' => '%' . $search . '%']);
    $obras = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($obras) {
        echo "<table>
                <tr>
                    <td>Imatge</td>
                    <td>NºRegistre</td>
                    <td>Nom</td>
                    <td>Títol</td>
                    <td>Autor</td>
                    <td>Datació</td>
                    <td>Ubicació</td>
                    <td>Acciones</td>
                </tr>";
        foreach ($obras as $obra) {
            echo "<tr>
                    <td>{$obra['Fotografia']}</td>
                    <td>{$obra['Numero_registro']}</td>
                    <td>{$obra['Nombre_del_objeto']}</td>
                    <td>{$obra['Titulo']}</td>
                    <td>{$obra['Autor']}</td>
                    <td>{$obra['Datacion']}</td>
                    <td>{$obra['Descripcion']}</td>
                    <td>";

            // Renderiza los botones según el rol del usuario
            if ($_SESSION['Rol'] == 'Administració') {
                echo "<a href='#'><img src='images/editarv2.png' alt=''></a>
                      <a href='index.php?controller=Obras&action=mostrarFicha&id={$obra['Numero_registro']}'><img src='images/fichav2.png' alt=''></a>
                      <a href='#'><img src='images/borrarv2.png' alt=''></a>";
            } else if ($_SESSION['Rol'] == 'Tècnic') {
                echo "<a href='#'><img src='images/editarv2.png' alt=''></a>
                      <a href='index.php?controller=Obras&action=mostrarFicha&id={$obra['Numero_registro']}'><img src='images/fichav2.png' alt=''></a>";
            } else if ($_SESSION['Rol'] == 'Lector') {
                echo "<a href='index.php?controller=Obras&action=mostrarFicha&id={$obra['Numero_registro']}'><img src='images/fichav2.png' alt=''></a>";
            }

            echo "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No se encontraron resultados</p>";
    }
}
?>
