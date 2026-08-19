<x-filament-widgets::widget>
    <x-filament::section compact>
        <h2 class="titulo-ar mb-2 uppercase tracking-wider">Ações rápidas</h2>

        <style>
            /* Layout (Celular 1, Tablet 2, PC 4) */
            .ar-grid { display: grid !important; grid-template-columns: repeat(1, minmax(0, 1fr)) !important; gap: 0.5rem !important; }
            @media (min-width: 640px) { .ar-grid { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; } }
            @media (min-width: 1024px) { .ar-grid { grid-template-columns: repeat(4, minmax(0, 1fr)) !important; } }

            /* Estilos - MODO CLARO (Padrão) */
            .titulo-ar { font-size: 0.75rem; font-weight: bold; color: #111827; }
            .ar-card { background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 0.5rem; display: flex; align-items: center; gap: 0.5rem; text-decoration: none; transition: all 0.2s; }
            .ar-card:hover { border-color: #14b8a6; }
            .ar-title { font-weight: bold; font-size: 0.75rem; line-height: 1.25; color: #111827; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; margin: 0; }
            .ar-desc { font-size: 10px; color: #6b7280; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; margin: 0; }
            .ar-icon { padding: 0.375rem; border-radius: 0.25rem; flex-shrink: 0; }
            
            .ico-1 { background-color: #ccfbf1; color: #0f766e; }
            .ico-2 { background-color: #e0e7ff; color: #4338ca; }
            .ico-3 { background-color: #fef3c7; color: #b45309; }
            .ico-4 { background-color: #f3e8ff; color: #7e22ce; }

            /* Estilos - MODO ESCURO (Forçado) */
            .dark .titulo-ar { color: #ffffff !important; }
            .dark .ar-card { background-color: #1e293b !important; border-color: #334155 !important; }
            .dark .ar-title { color: #ffffff !important; }
            .dark .ar-desc { color: #94a3b8 !important; }
            
            .dark .ico-1 { background-color: #042f2e !important; color: #2dd4bf !important; }
            .dark .ico-2 { background-color: #1e1b4b !important; color: #818cf8 !important; }
            .dark .ico-3 { background-color: #451a03 !important; color: #fbbf24 !important; }
            .dark .ico-4 { background-color: #3b0764 !important; color: #c084fc !important; }
        </style>

        <div class="ar-grid">
            <a href="/admin/scan-qr-code" class="ar-card">
                <div class="ar-icon ico-1"><x-heroicon-o-qr-code style="width: 1rem; height: 1rem;" /></div>
                <div style="min-width: 0;"><h3 class="ar-title">Ler QR Code</h3><p class="ar-desc">Escanear componente</p></div>
            </a>
            <a href="/admin/componentes/create" class="ar-card">
                <div class="ar-icon ico-2"><x-heroicon-o-cube style="width: 1rem; height: 1rem;" /></div>
                <div style="min-width: 0;"><h3 class="ar-title">Novo Componente</h3><p class="ar-desc">Cadastrar item</p></div>
            </a>
            <a href="/admin/sondas/create" class="ar-card">
                <div class="ar-icon ico-3"><x-heroicon-o-truck style="width: 1rem; height: 1rem;" /></div>
                <div style="min-width: 0;"><h3 class="ar-title">Nova Sonda</h3><p class="ar-desc">Cadastrar sonda</p></div>
            </a>
            <a href="{{ \App\Filament\Pages\Relatorios::getUrl() }}" class="ar-card">
                <div class="ar-icon ico-4"><x-heroicon-o-chart-bar style="width: 1rem; height: 1rem;" /></div>
                <div style="min-width: 0;"><h3 class="ar-title">Relatórios</h3><p class="ar-desc">Gerar relatórios</p></div>
            </a>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
