<x-filament-widgets::widget>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
        
        
        <div class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex justify-between items-center">
            <div>
                <p class="text-[11px] font-bold text-sky-600 uppercase tracking-wider">Em Operação</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white my-0.5">{{ $emOperacao }}</h3>
                <p class="text-xs text-sky-600">componentes</p>
            </div>
            <div class="p-2.5 bg-sky-50 dark:bg-sky-950/50 rounded-lg text-sky-600">
                <x-heroicon-o-truck class="w-7 h-7" />
            </div>
        </div>

        
        <div class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex justify-between items-center">
            <div>
                <p class="text-[11px] font-bold text-emerald-600 uppercase tracking-wider">Em Estoque</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white my-0.5">{{ $emEstoque }}</h3>
                <p class="text-xs text-emerald-600">componentes</p>
            </div>
            <div class="p-2.5 bg-emerald-50 dark:bg-emerald-950/50 rounded-lg text-emerald-600">
                <x-heroicon-o-home-modern class="w-7 h-7" />
            </div>
        </div>

        
        <div class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex justify-between items-center">
            <div>
                <p class="text-[11px] font-bold text-orange-600 uppercase tracking-wider">Em Manutenção</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white my-0.5">{{ $emManutencao }}</h3>
                <p class="text-xs text-orange-600">componentes</p>
            </div>
            <div class="p-2.5 bg-orange-50 dark:bg-orange-950/50 rounded-lg text-orange-600">
                <x-heroicon-o-wrench-screwdriver class="w-7 h-7" />
            </div>
        </div>

        
        <div class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm flex justify-between items-center">
            <div>
                <p class="text-[11px] font-bold text-purple-600 uppercase tracking-wider">Total de Componentes</p>
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white my-0.5">{{ $totalComponentes }}</h3>
                <p class="text-xs text-purple-600">cadastrados</p>
            </div>
            <div class="p-2.5 bg-purple-50 dark:bg-purple-950/50 rounded-lg text-purple-600">
                <x-heroicon-o-cube class="w-7 h-7" />
            </div>
        </div>

    </div>
</x-filament-widgets::widget>