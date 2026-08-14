<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Componente;
use App\Models\Movimentacao;
use App\Models\Sonda;
use Illuminate\Support\Facades\Auth;

class ScanQrCode extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-qr-code';
    protected static ?string $navigationLabel = 'Ler QR Code';
    protected static ?string $navigationGroup = 'OPERACIONAL';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.pages.scan-qr-code';

    public $numero_serie = '';
    public $destino = 'Estoque';
    public $ultimoEquipamentoMovido = null;
    public $mensagemErro = '';

    public function processarLeitura(?string $codigoLido = null): void
    {
        $codigo = $codigoLido ?? $this->numero_serie;

        if (empty($codigo)) {
            $this->mensagemErro = "Por favor, informe ou escaneie o número de série.";
            $this->ultimoEquipamentoMovido = null;
            return;
        }

        $this->numero_serie = trim($codigo);

        $componente = Componente::where('numero_serie', $this->numero_serie)->first();

        if (!$componente) {
            $this->mensagemErro = "Componente com N/S '{$this->numero_serie}' não foi encontrado!";
            $this->ultimoEquipamentoMovido = null;
            return;
        }

        if (strtolower($componente->localizacao_atual) === strtolower($this->destino)) {
            $this->mensagemErro = "O componente '{$componente->nome}' já está localizado em '{$this->destino}'!";
            $this->ultimoEquipamentoMovido = null;
            $this->numero_serie = '';
            return;
        }

        $origem = $componente->localizacao_atual;
        $status = 'estoque';
        $sonda_id = null;

        if (str_contains(strtolower($this->destino), 'sonda')) {
            $status = 'operacao';
            $sonda = Sonda::where('nome', 'LIKE', "%{$this->destino}%")->first();
            $sonda_id = $sonda?->id;
        } elseif (in_array(strtolower($this->destino), ['oficina', 'manutenção', 'manutencao'])) {
            $status = 'manutencao';
        }

        $componente->update([
            'localizacao_atual' => $this->destino,
            'status' => $status,
            'sonda_id' => $sonda_id,
        ]);

        Movimentacao::create([
            'componente_id' => $componente->id,
            'origem' => $origem,
            'destino' => $this->destino,
            'usuario_id' => Auth::id(),
            'usuario' => Auth::user()?->name ?? 'Mecânico',
            'data_hora' => now(),
        ]);

        // Guarda os detalhes do equipamento recém-movido
        $this->ultimoEquipamentoMovido = [
            'nome' => $componente->nome,
            'numero_serie' => $componente->numero_serie,
            'origem' => $origem,
            'destino' => $this->destino,
        ];

        $this->mensagemErro = '';
        $this->numero_serie = '';
    }

    public function limparMensagens(): void
    {
        $this->ultimoEquipamentoMovido = null;
        $this->mensagemErro = '';
    }
}