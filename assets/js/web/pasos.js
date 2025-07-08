  document.addEventListener('DOMContentLoaded', () => {
        const stepsData = [{
                id: 1,
                title: "Solicitud del Proyecto",
                icon: "📝",
                description: "El estudiante inicia el proceso describiendo su proyecto y adjuntando los archivos necesarios.",
                student_actions: [
                    "Se registra e inicia sesión.",
                    "Llena un formulario detallado.",
                    "Adjunta documentos (rúbricas, guías)."
                ],
                expert_actions: [
                    "Recibe una notificación de nueva solicitud en su panel."
                ]
            },
            {
                id: 2,
                title: "Cotización del Experto",
                icon: "🧑‍🏫",
                description: "Un experto en la materia analiza la solicitud y envía una cotización con el costo y tiempo de entrega.",
                student_actions: [
                    "Espera la propuesta del experto."
                ],
                expert_actions: [
                    "Analiza los requerimientos.",
                    "Define costo y tiempo de entrega.",
                    "Envía la cotización al estudiante."
                ]
            },
            {
                id: 3,
                title: "Aprobación y Chat",
                icon: "💬",
                description: "El estudiante revisa y aprueba la cotización. Al confirmar, se abre un chat directo con el experto.",
                student_actions: [
                    "Revisa la cotización.",
                    "Acepta la propuesta para iniciar.",
                    "Obtiene acceso al chat en vivo."
                ],
                expert_actions: [
                    "Recibe la confirmación.",
                    "Comienza a trabajar en el proyecto.",
                    "Se comunica vía chat para resolver dudas."
                ]
            },
            {
                id: 4,
                title: "Colaboración y Avances",
                icon: "🔄",
                description: "El experto comparte avances del trabajo a través del chat, con marca de agua y sin opción de descarga.",
                student_actions: [
                    "Revisa los avances en la plataforma.",
                    "Proporciona retroalimentación."
                ],
                expert_actions: [
                    "Sube archivos de avance.",
                    "Asegura que los documentos tengan marca de agua.",
                    "Ajusta el trabajo según la retroalimentación."
                ]
            },
            {
                id: 5,
                title: "Pago y Entrega Final",
                icon: "🏆",
                description: "El proceso de pago se divide en dos partes para garantizar la satisfacción y seguridad de ambos.",
                student_actions: [
                    "Realiza un primer pago del 50%.",
                    "Revisa el trabajo final (con marca de agua).",
                    "Liquida el 50% restante.",
                    "Descarga el archivo final sin restricciones."
                ],
                expert_actions: [
                    "Marca el trabajo como finalizado.",
                    "Sube el documento final (protegido).",
                    "Recibe la notificación de pago completo."
                ]
            }
        ];

        const stepsContainer = document.getElementById('steps-container');
        const detailsContainer = document.getElementById('details-container');
        let paymentChart = null;

        stepsData.forEach(step => {
            const stepEl = document.createElement('div');
            stepEl.className = 'step-card bg-white p-6 rounded-lg shadow-md cursor-pointer';
            stepEl.dataset.id = step.id;
            stepEl.innerHTML = `
                    <div class="text-4xl mb-3">${step.icon}</div>
                    <h4 class="font-bold text-lg text-gray-800">${step.title}</h4>
                `;
            stepsContainer.appendChild(stepEl);
        });

        stepsContainer.addEventListener('click', (e) => {
            const card = e.target.closest('.step-card');
            if (!card) return;

            const stepId = card.dataset.id;
            const stepData = stepsData.find(s => s.id == stepId);

            document.querySelectorAll('.step-card').forEach(c => c.classList.remove('active'));
            card.classList.add('active');

            displayDetails(stepData);
        });

        function displayDetails(step) {
            let detailsHTML = `
                    <div class="bg-white rounded-lg shadow-xl p-8 content-visible">
                        <h3 class="text-2xl font-bold text-center mb-2 text-blue-600">${step.title}</h3>
                        <p class="text-center text-gray-600 mb-8 max-w-2xl mx-auto">${step.description}</p>
                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
                                <h5 class="font-bold text-lg mb-4 text-blue-800 flex items-center"><span class="text-2xl mr-3">🎓</span>Acciones del Estudiante</h5>
                                <ul class="list-disc list-inside space-y-2 text-gray-700">
                                    ${step.student_actions.map(action => `<li>${action}</li>`).join('')}
                                </ul>
                            </div>
                            <div class="bg-green-50 p-6 rounded-lg border border-green-200">
                                <h5 class="font-bold text-lg mb-4 text-green-800 flex items-center"><span class="text-2xl mr-3">🧑‍🏫</span>Acciones del Experto</h5>
                                <ul class="list-disc list-inside space-y-2 text-gray-700">
                                    ${step.expert_actions.map(action => `<li>${action}</li>`).join('')}
                                </ul>
                            </div>
                        </div>
                        ${step.id === 5 ? `
                        <div class="mt-8 pt-8 border-t">
                            <h4 class="text-xl font-bold text-center text-gray-800 mb-4">Visualización del Pago</h4>
                            <div class="chart-container">
                                <canvas id="paymentChart"></canvas>
                            </div>
                        </div>` : ''}
                    </div>
                `;
            detailsContainer.innerHTML = detailsHTML;

            if (step.id === 5) {
                renderPaymentChart();
            }
        }

        function renderPaymentChart() {
            const ctx = document.getElementById('paymentChart');
            if (!ctx) return;

            if (paymentChart) {
                paymentChart.destroy();
            }

            paymentChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Pago Inicial (50%)', 'Pago Final (50%)'],
                    datasets: [{
                        label: 'Estado del Pago',
                        data: [50, 50],
                        backgroundColor: [
                            'rgba(59, 130, 246, 0.7)', // blue-500
                            'rgba(16, 185, 129, 0.7)' // green-500
                        ],
                        borderColor: [
                            'rgba(59, 130, 246, 1)',
                            'rgba(16, 185, 129, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.parsed + '%';
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        }

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        /*Para que no generar error cuando no haya ninguna card creada*/
        const firstStepCard = document.querySelector('.step-card');
        if (firstStepCard) firstStepCard.click();
    });