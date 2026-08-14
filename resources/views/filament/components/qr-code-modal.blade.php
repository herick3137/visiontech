<div class="flex flex-col items-center justify-center p-4 text-center">
    <!-- Gera o QR Code dinamicamente contendo o numero_serie -->
    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode($record->numero_serie) }}" 
         alt="QR Code" 
         class="border p-2 rounded-lg bg-white mb-3 shadow-sm">
    
    <h3 class="font-bold text-lg text-gray-900 dark:text-white">{{ $record->nome }}</h3>
    <p class="text-sm font-mono text-gray-600 dark:text-gray-400">Nº de Série: {{ $record->numero_serie }}</p>

    <button onclick="window.print()" type="button" class="mt-4 px-4 py-2 bg-teal-600 text-white font-bold rounded-lg hover:bg-teal-700 transition">
        🖨️ Imprimir Etiqueta
    </button>
</div>