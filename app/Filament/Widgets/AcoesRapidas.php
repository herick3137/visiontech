<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class AcoesRapidas extends Widget
{
    protected static string $view = 'filament.widgets.acoes-rapidas';

    // Esta linha garante que o widget ocupe 100% da largura horizontal do Dashboard
    protected int | string | array $columnSpan = 'full';
}