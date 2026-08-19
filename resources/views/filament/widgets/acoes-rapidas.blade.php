<x-filament-widgets::widget>
    <x-filament::section compact>
        <h2 class="text-xs font-bold text-gray-900 dark:text-white mb-3 uppercase tracking-wider">Ações rápidas</h2>

        <!-- Grid Responsivo: 1 coluna no celular, 2 em tablets, 4 no PC -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            
            <!-- Botão 1 -->
            <a href="/admin/scan-qr-code" class="p-3 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-teal-500 transition flex items-center gap-3 shadow-sm hover:shadow">
                <div class="p-2 bg-teal-100 text-teal-700 dark:bg-teal-900/50 dark:text-teal-400 rounded-lg shrink-0">
                    <x-heroicon-o-qr-code class="w-5 h-5" />
                </div>
                <div class="min-w-0">
                    <h3 class="font-bold text-sm leading-tight text-gray-900 dark:text-white truncate">Ler QR Code</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">Escanear componente</p>
                </div>
            </a>

            <!-- Botão 2 -->
            <a href="/admin/componentes/create" class="p-3 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-teal-500 transition flex items-center gap-3 shadow-sm hover:shadow">
                <div class="p-2 bg-indigo-100 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-400 rounded-lg shrink-0">
                    <x-heroicon-o-cube class="w-5 h-5" />
                </div>
                <div class="min-w-0">
                    <h3 class="font-bold text-sm leading-tight text-gray-900 dark:text-white truncate">Novo Componente</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">Cadastrar item</p>
                </div>
            </a>

            <!-- Botão 3 -->
            <a href="/admin/sondas/create" class="p-3 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-teal-500 transition flex items-center gap-3 shadow-sm hover:shadow">
                <div class="p-2 bg-amber-100 text-amber-700 dark:bg-amber-900/50 dark:text-amber-400 rounded-lg shrink-0">
                    <x-heroicon-o-truck class="w-5 h-5" />
                </div>
                <div class="min-w-0">
                    <h3 class="font-bold text-sm leading-tight text-gray-900 dark:text-white truncate">Nova Sonda</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">Cadastrar sonda</p>
                </div>
            </a>

            <!-- Botão 4 -->
            <a href="{{ \App\Filament\Pages\Relatorios::getUrl() }}" class="p-3 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-teal-500 transition flex items-center gap-3 shadow-sm hover:shadow">
                <div class="p-2 bg-purple-100 text-purple-700 dark:bg-purple-900/50 dark:text-purple-400 rounded-lg shrink-0">
                    <x-heroicon-o-chart-bar class="w-5 h-5" />
                </div>
                <div class="min-w-0">
                    <h3 class="font-bold text-sm leading-tight text-gray-900 dark:text-white truncate">Relatórios</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">Gerar relatórios</p>
                </div>
            </a>

        </div>
    </x-filament::section>
</x-filament-widgets::widget>
