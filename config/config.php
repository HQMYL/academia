<?php
// Detectar si estamos en localhost
$isLocal = $_SERVER['HTTP_HOST'] === 'localhost';

// Detectar carpeta base del proyecto automáticamente
$carpeta = trim(str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('\\', '/', realpath(__DIR__ . '/../'))), '/');

// Construir la BASE_URL
$baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/';
if (!$isLocal && $carpeta !== '') {
    $baseUrl .= $carpeta . '/';
} elseif ($isLocal) {
    $baseUrl .= $carpeta . '/'; // para localhost siempre se agrega
}

define('BASE_URL', $baseUrl);
define('ROOT_PATH', realpath(__DIR__ . '/../') . '/');
