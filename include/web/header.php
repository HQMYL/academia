<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo "<!-- HEADER CARGADO: Título = " . ($title ?? 'NO DEFINIDO') . " -->"; ?>
    <title><?= isset($title) ? $title : 'AcademiaLink - Flujo del Proyecto' ?></title>
    <!--TailwindCSS-->
    <script src="https://cdn.tailwindcss.com" defer></script>
    <!--Para estadísticas-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
    <!-- CSS PARA TODO EL PROYECTO -->
    <link href="<?= BASE_URL ?>assets/css/root.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>assets/css/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>assets/css/icheck-bootstrap.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>assets/css/adminlte.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/web/style.css">

    <!-- Chosen Palette: Scholarly Calm -->
    <!-- Application Structure Plan: Se ha diseñado una estructura de "viaje del usuario" lineal y por pasos. El usuario puede hacer clic en cada etapa del proceso (desde la solicitud hasta la entrega) para ver una descripción detallada de las acciones requeridas tanto por el estudiante como por el experto. Esta estructura es la más intuitiva para explicar un flujo de trabajo, ya que desglosa un proceso complejo en partes manejables y secuenciales, evitando la sobrecarga de información y guiando al usuario de forma natural. -->
    <!-- Visualization & Content Choices: El flujo principal se visualiza como una línea de tiempo interactiva hecha con HTML/CSS, que es ideal para procesos secuenciales. Al hacer clic, se revela una sección de dos columnas para diferenciar claramente las acciones del estudiante (🎓) y del experto (🧑‍🏫), mejorando la claridad. El proceso de pago se representa con un gráfico de dona de Chart.js, una forma visualmente efectiva de mostrar el progreso del pago en dos partes (50/50), lo cual es más impactante y fácil de entender que el texto solo. -->
    <!-- CONFIRMATION: NO SVG graphics used. NO Mermaid JS used. -->

</head>

<body class="antialiased">