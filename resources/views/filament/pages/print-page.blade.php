{{-- resources/views/filament/pages/print-page.blade.php --}}
<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Form Section --}}
        <div class="bg-white rounded-lg shadow p-6">
            <form wire:submit.prevent="printData">
                {{ $this->form }}
            </form>
        </div>

        {{-- Action Buttons --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Aksi Print</h3>
            <div class="flex gap-3">
                <x-filament::button
                    color="success"
                    icon="heroicon-o-printer"
                    wire:click="printData">
                    Print Data
                </x-filament::button>

                <x-filament::button
                    color="primary"
                    icon="heroicon-o-document-arrow-down"
                    wire:click="downloadPdf">
                    Download PDF
                </x-filament::button>


            </div>
        </div>

        {{-- Info Section --}}
        <div class="bg-blue-50 rounded-lg p-4">
            <div class="flex items-start space-x-3">
                <x-heroicon-o-information-circle class="w-5 h-5 text-blue-500 mt-0.5" />
                <div class="text-sm text-blue-700">
                    <p class="font-medium">Cara Penggunaan:</p>
                    <ul class="mt-2 list-disc list-inside space-y-1">
                        <li>Pilih jenis data yang ingin dicetak</li>
                        <li>Atur filter tanggal jika diperlukan</li>
                        <li>Pilih data spesifik atau kosongkan untuk cetak semua</li>
                        <li>Klik tombol Print atau Download PDF</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>