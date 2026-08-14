<x-filament-panels::page>
    <div 
        x-data="{
            html5QrCode: null,
            cameraIniciada: false,
            leituraPausada: false,
            modalAberto: false,
            erroCamera: '',

            async iniciarCamera() {
                this.erroCamera = '';
                
                if (typeof Html5Qrcode === 'undefined') {
                    setTimeout(() => this.iniciarCamera(), 300);
                    return;
                }

                try {
                    if (!this.html5QrCode) {
                        this.html5QrCode = new Html5Qrcode('reader');
                    }

                    const config = { fps: 10, qrbox: { width: 250, height: 250 } };

                    await this.html5QrCode.start(
                        { facingMode: 'environment' },
                        config,
                        (decodedText) => {
                            this.aoEscanear(decodedText);
                        }
                    );

                    this.cameraIniciada = true;
                } catch (err) {
                    console.error('Erro ao acessar a câmera:', err);
                    this.cameraIniciada = false;
                    this.erroCamera = 'Não foi possível acessar a câmera.';
                }
            },

            async aoEscanear(codigo) {
                if (this.leituraPausada) return;

                this.leituraPausada = true;
                if (this.html5QrCode) {
                    try { this.html5QrCode.pause(true); } catch(e){}
                }

                await $wire.processarLeitura(codigo);
                this.modalAberto = true;
            },

            async processarManual() {
                await $wire.processarLeitura();
                this.modalAberto = true;
            },

            proximaLeitura() {
                this.modalAberto = false;
                this.leituraPausada = false;
                $wire.limparMensagens();

                if (this.html5QrCode && this.cameraIniciada) {
                    try { this.html5QrCode.resume(); } catch(e){}
                }
            },

            async pararCamera() {
                if (this.html5QrCode && this.cameraIniciada) {
                    await this.html5QrCode.stop();
                    this.cameraIniciada = false;
                }
            }
        }"
        x-init="iniciarCamera()"
        x-on:unloaded.window="pararCamera()"
    >
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Leitor de QR Code -->
            <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow">
                <h2 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">Escanear Etiqueta do Componente</h2>
                
                <div wire:ignore id="reader" class="w-full rounded-lg overflow-hidden border border-gray-300 dark:border-gray-700 min-h-[280px] bg-gray-900 flex items-center justify-center"></div>

                <template x-if="erroCamera">
                    <div class="mt-4 p-4 bg-red-50 dark:bg-gray-900 border border-red-300 text-red-700 rounded-lg text-sm">
                        <span x-text="erroCamera"></span>
                    </div>
                </template>

                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Destino da Movimentação:</label>
                    <select wire:model.live="destino" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-lg shadow-sm">
                        <option value="Estoque">Estoque / Almoxarifado</option>
                        <option value="Oficina">Oficina (Manutenção)</option>
                        <option value="Sonda 01">Sonda 01</option>
                        <option value="Sonda 02">Sonda 02</option>
                        <option value="Sonda 03">Sonda 03</option>
                        <option value="Sonda 05">Sonda 05</option>
                    </select>
                </div>
            </div>

            
            <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow flex flex-col justify-between">
                <div>
                    <h2 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">Instruções</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        Aponte a câmera para a etiqueta do equipamento. Após a leitura, o pop-up de confirmação será exibido com os dados da movimentação.
                    </p>
                </div>

                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Entrada Manual (Nº de Série):</label>
                    <div class="flex gap-2">
                        <input type="text" wire:model="numero_serie" placeholder="Ex: BP-015" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-lg shadow-sm">
                        <button type="button" @click="processarManual()" class="px-4 py-2 bg-teal-600 text-white font-bold rounded-lg hover:bg-teal-700 transition">
                            Confirmar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        
        <div 
            x-show="modalAberto" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm"
            style="display: none;"
        >
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full p-6 text-center border border-gray-200 dark:border-gray-700">
                @if ($ultimoEquipamentoMovido)
                    
                    <div class="w-16 h-16 bg-emerald-100 dark:bg-emerald-950/60 rounded-full flex items-center justify-center mx-auto mb-4 border-2 border-emerald-500">
                        <span class="text-3xl">✅</span>
                    </div>

                    <h3 class="text-xl font-extrabold text-gray-900 dark:text-white mb-2">Equipamento Movido!</h3>
                    
                    <p class="text-gray-700 dark:text-gray-300 text-sm mb-4">
                        O item <strong class="text-gray-900 dark:text-white font-bold text-base">{{ $ultimoEquipamentoMovido['nome'] }}</strong> 
                        ({{ $ultimoEquipamentoMovido['numero_serie'] }}) foi transferido com sucesso.
                    </p>

                    <div class="p-3 bg-teal-50 dark:bg-teal-950/50 border border-teal-200 dark:border-teal-800 rounded-xl mb-6">
                        <span class="text-xs text-teal-800 dark:text-teal-300 font-bold block uppercase tracking-wider">Novo Destino</span>
                        <span class="text-xl font-black text-teal-700 dark:text-teal-400">{{ $ultimoEquipamentoMovido['destino'] }}</span>
                        <span class="text-xs text-gray-600 dark:text-gray-400 block mt-1">Origem anterior: {{ $ultimoEquipamentoMovido['origem'] }}</span>
                    </div>
                @elseif(!empty($mensagemErro))
                    
                    <div class="w-16 h-16 bg-red-100 dark:bg-red-950/60 rounded-full flex items-center justify-center mx-auto mb-4 border-2 border-red-500">
                        <span class="text-3xl">⚠️</span>
                    </div>

                    <h3 class="text-xl font-extrabold text-gray-900 dark:text-white mb-2">Atenção</h3>
                    <p class="text-red-600 dark:text-red-400 text-sm mb-6 font-semibold">
                        {{ $mensagemErro }}
                    </p>
                @endif

                
                <button 
                    type="button" 
                    @click="proximaLeitura()" 
                    class="w-full py-3.5 rounded-xl shadow-lg transition flex items-center justify-center gap-2 text-base font-bold cursor-pointer active:scale-95"
                    style="background-color: #0d9488 !important; color: #ffffff !important;"
                >
                    <span style="color: #ffffff !important; font-weight: 700;">Escanear Outro Código</span>
                </button>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js" type="text/javascript"></script>
</x-filament-panels::page>