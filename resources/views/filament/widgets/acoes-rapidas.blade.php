<x-filament-widgets::widget>
    <x-filament::section compact>
        <h2 class="text-xs font-bold text-gray-900 dark:text-white mb-2 uppercase tracking-wider">Ações rápidas</h2>

        <!-- No Celular: 1 por linha | No PC/Tablet: 4 em linha (1x4) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-2">
            
            <!-- Botão 1: Ler QR Code -->
            <a href="/admin/scan-qr-code" class="p-2 bg-gray-50 dark:bg-gray-800/60 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-teal-500 transition flex items-center gap-2">
                <div class="p-1.5 bg-teal-100 text-teal-700 dark:bg-teal-950 dark:text-teal-400 rounded shrink-0">
                    <x-heroicon-o-qr-code class="w-4 h-4" />
                </div>
                <div class="min-w-0">
                    <h3 class="font-bold text-xs leading-tight text-gray-900 dark:text-white truncate">Ler QR Code</h3>
                    <p class="text-[10px] text-gray-500 dark:text-gray-400 truncate">Escanear componente</p>
                </div>
            </a>

            <!-- Botão 2: Cadastrar Componente -->
            <a href="/admin/componentes/create" class="p-2 bg-gray-50 dark:bg-gray-800/60 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-teal-500 transition flex items-center gap-2">
                <div class="p-1.5 bg-indigo-100 text-indigo-700 dark:bg-indigo-950 dark:text-indigo-400 rounded shrink-0">
                    <x-heroicon-o-cube class="w-4 h-4" />
                </div>
                <div class="min-w-0">
                    <h3 class="font-bold text-xs leading-tight text-gray-900 dark:text-white truncate">Cadastrar Componente</h3>
                    <p class="text-[10px] text-gray-500 dark:text-gray-400 truncate">Novo componente</p>
                </div>
            </a>

            <!-- Botão 3: Cadastrar Sonda -->
            <a href="/admin/sondas/create" class="p-2 bg-gray-50 dark:bg-gray-800/60 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-teal-500 transition flex items-center gap-2">
                <div class="p-1.5 bg-amber-100 text-amber-700 dark:bg-amber-950 dark:text-amber-400 rounded shrink-0">
                    <x-heroicon-o-truck class="w-4 h-4" />
                </div>
                <div class="min-w-0">
                    <h3 class="font-bold text-xs leading-tight text-gray-900 dark:text-white truncate">Cadastrar Sonda</h3>
                    <p class="text-[10px] text-gray-500 dark:text-gray-400 truncate">Nova sonda</p>
                </div>
            </a>

            <!-- Botão 4: Relatórios -->
            <a href="{{ \App\Filament\Pages\Relatorios::getUrl() }}" class="p-2 bg-gray-50 dark:bg-gray-800/60 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-teal-500 transition flex items-center gap-2">
                <div class="p-1.5 bg-purple-100 text-purple-700 dark:bg-purple-950 dark:text-purple-400 rounded shrink-0">
                    <x-heroicon-o-chart-bar class="w-4 h-4" />
                </div>
                <div class="min-w-0">
                    <h3 class="font-bold text-xs leading-tight text-gray-900 dark:text-white truncate">Relatórios</h3>
                    <p class="text-[10px] text-gray-500 dark:text-gray-400 truncate">Gerar relatórios</p>
                </div>
            </a>

        </div>
    </x-filament::section>
</x-filament-widgets::widget>
