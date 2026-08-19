<x-filament-panels::page>
    <div class="flex justify-end mb-2 print:hidden">
        <x-filament::button icon="heroicon-m-printer" onclick="window.print()" color="gray" size="sm">
            Exportar / Imprimir PDF
        </x-filament::button>
    </div>

    <style>
        .grade-4-colunas { display: grid !important; grid-template-columns: repeat(1, minmax(0, 1fr)) !important; gap: 10px !important; }
        @media (min-width: 640px) { .grade-4-colunas { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; } }
        @media (min-width: 1024px) { .grade-4-colunas { grid-template-columns: repeat(4, minmax(0, 1fr)) !important; } }

        /* MODO ESCURO FORÇADO PARA O RELATÓRIO */
        .dark .papel-relatorio { background-color: #0f172a !important; border-color: #1e293b !important; }
        .dark .papel-relatorio h1, 
        .dark .papel-relatorio h3, 
        .dark .papel-relatorio p.text-lg { color: #ffffff !important; }
        .dark .papel-relatorio p, 
        .dark .papel-relatorio span, 
        .dark .papel-relatorio div { color: #e2e8f0 !important; }
        .dark .papel-relatorio .bg-slate-50, 
        .dark .papel-relatorio [class*="bg-"] { background-color: #1e293b !important; border-color: #334155 !important; }
        .dark .papel-relatorio h2 { color: #22d3ee !important; }

        @media print {
            @page { size: A4 portrait; margin: 0.8cm; }
            body, html { background-color: #ffffff !important; }
            .fi-sidebar, .fi-topbar, .print\:hidden { display: none !important; }
            .fi-main { padding: 0 !important; margin: 0 !important; }
            .grade-4-colunas { grid-template-columns: repeat(4, minmax(0, 1fr)) !important; }
            .papel-relatorio { box-shadow: none !important; border: none !important; margin: 0 !important; padding: 0 !important; width: 100% !important; max-width: 100% !important; background-color: #ffffff !important; }
            .dark * { color: #000 !important; background-color: transparent !important; border-color: #e5e7eb !important; }
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        }
    </style>

    <div class="papel-relatorio w-full max-w-5xl mx-auto bg-white px-8 py-5 rounded-xl shadow-sm border border-slate-100">
        
        <div class="border-b-2 border-slate-200 pb-2 mb-3 flex justify-between items-end">
            <div>
                <h1 class="text-xl font-black text-slate-900 uppercase tracking-tight">Relatório Executivo</h1>
                <h2 class="text-[10px] font-bold tracking-[0.2em] mt-0.5" style="color: #0891b2;">VISIONTECH &bull; GEOSOL PBA</h2>
            </div>
            <div class="text-right">
                <p class="text-[8px] text-slate-400 font-bold uppercase tracking-widest">Documento Oficial</p>
                <p class="text-[11px] font-bold text-slate-700">{{ now()->format('d/m/Y \à\s H:i') }}</p>
            </div>
        </div>

        <div class="mb-4 text-slate-600 text-[11px] leading-tight text-justify bg-slate-50 p-2.5 rounded border-l-4 border-slate-300">
            <p>Panorama oficial consolidado referente ao inventário de ativos, fluxo logístico e quadro de pessoal operacional. Os dados refletem a situação exata no momento da emissão deste relatório.</p>
        </div>

        <h3 class="text-[10px] font-bold text-slate-800 uppercase tracking-widest border-b border-slate-100 pb-1 mb-2">1. Inventário de Componentes</h3>
        <div class="grade-4-colunas mb-4">
            <div class="p-2.5 border border-slate-100 rounded-lg bg-slate-50">
                <p class="text-[8px] font-bold text-slate-500 uppercase tracking-wider">Total Cadastrado</p>
                <p class="text-lg font-black text-slate-800 mt-0.5">{{ $totalEquipamentos }}</p>
            </div>
            <div class="p-2.5 border border-emerald-100 rounded-lg bg-emerald-50/40">
                <p class="text-[8px] font-bold text-emerald-600 uppercase tracking-wider">Equip. em Estoque</p>
                <p class="text-lg font-black text-emerald-700 mt-0.5">{{ $emEstoque }}</p>
            </div>
            <div class="p-2.5 border border-orange-100 rounded-lg bg-orange-50/40">
                <p class="text-[8px] font-bold text-orange-600 uppercase tracking-wider">Equip. em Manutenção</p>
                <p class="text-lg font-black text-orange-700 mt-0.5">{{ $emManutencao }}</p>
            </div>
            <div class="p-2.5 border border-blue-100 rounded-lg bg-blue-50/40">
                <p class="text-[8px] font-bold text-blue-600 uppercase tracking-wider">Equip. em Uso (Campo)</p>
                <p class="text-lg font-black text-blue-700 mt-0.5">{{ $emUso }}</p>
            </div>
        </div>

        <h3 class="text-[10px] font-bold text-slate-800 uppercase tracking-widest border-b border-slate-100 pb-1 mb-2">2. Operações e Fluxo Logístico</h3>
        <div class="grade-4-colunas mb-4">
            <div class="p-2.5 border border-slate-100 rounded-lg bg-slate-50">
                <p class="text-[8px] font-bold text-slate-500 uppercase tracking-wider">Total de Sondas</p>
                <p class="text-lg font-black text-slate-800 mt-0.5">{{ $totalSondas }}</p>
            </div>
            <div class="p-2.5 border border-red-100 rounded-lg bg-red-50/40">
                <p class="text-[8px] font-bold text-red-600 uppercase tracking-wider">Sondas em Manut.</p>
                <p class="text-lg font-black text-red-700 mt-0.5">{{ $sondasManutencao }}</p>
            </div>
            <div class="p-2.5 border border-slate-100 rounded-lg bg-slate-50">
                <p class="text-[8px] font-bold text-slate-500 uppercase tracking-wider">Movimentações Totais</p>
                <p class="text-lg font-black text-slate-800 mt-0.5">{{ $totalMovimentacoes }}</p>
            </div>
            <div class="p-2.5 border border-slate-100 rounded-lg bg-slate-50">
                <p class="text-[8px] font-bold text-slate-500 uppercase tracking-wider">Movimentações (30 Dias)</p>
                <p class="text-lg font-black text-slate-800 mt-0.5">{{ $movimentacoesMes }}</p>
            </div>
        </div>

        <h3 class="text-[10px] font-bold text-slate-800 uppercase tracking-widest border-b border-slate-100 pb-1 mb-2 flex justify-between items-center">
            <span>3. Quadro de Pessoal (RH)</span>
            <span class="text-[9px] font-black bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full">Total: {{ $totalFuncionarios }}</span>
        </h3>
        
        <div class="grade-4-colunas mb-4">
            @forelse($equipePorCargo as $cargo)
                <div class="p-2 border border-slate-100 rounded-lg flex justify-between items-center bg-slate-50/50">
                    <span class="text-[9px] font-bold text-slate-500 uppercase truncate pr-1">{{ $cargo->cargo ?? 'Não Definido' }}</span>
                    <span class="text-xs font-black text-slate-800">{{ $cargo->total }}</span>
                </div>
            @empty
                <div class="p-2 text-center text-[10px] text-slate-400 border border-dashed border-slate-200 rounded-lg" style="grid-column: 1 / -1;">
                    Nenhum cargo cadastrado.
                </div>
            @endforelse
        </div>

        <div class="border-t border-slate-100 mt-4 pt-2 text-center">
            <p class="text-[8px] text-slate-400 font-semibold uppercase tracking-widest">
                Sistema Visiontech &copy; {{ date('Y') }} - Impresso via Painel Administrativo
            </p>
        </div>
    </div>
</x-filament-panels::page>
