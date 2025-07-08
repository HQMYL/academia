<?php
require_once __DIR__ . '/init.php';// o ../../init.php desde una subcarpeta
require_once ROOT_PATH . 'include/web/header.php';
require_once ROOT_PATH . 'include/web/navbar.php';
?>
<main>
    <section id="inicio" class="py-20 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-4 text-gray-800">Transformamos tus Proyectos Académicos</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Conectamos estudiantes con profesores expertos para llevar sus trabajos al siguiente nivel. Nuestra plataforma guía cada paso del proceso, desde la solicitud inicial hasta la entrega final, de forma clara y segura. Explora nuestro flujo de trabajo interactivo a continuación para ver lo fácil que es.</p>
        </div>
    </section>

    <section id="proceso" class="py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12">
                <h3 class="text-3xl font-bold text-gray-800">Nuestro Proceso en 5 Pasos</h3>
                <p class="text-md text-gray-500 mt-2">Haz clic en cada paso para ver los detalles.</p>
            </div>

            <div id="steps-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 text-center">
            </div>

            <div id="details-container" class="mt-12">
            </div>
        </div>
    </section>
</main>
<?php
require_once ROOT_PATH . 'include/web/footer.php';
?>
