<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Actions;
use App\Models\Transaction;
use App\Models\Sale;
use App\Models\User;
use App\Models\Item;
use App\Models\Customer;
use App\Models\Identitas;

class PrintPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-printer';
    protected static string $view = 'filament.pages.print-page';
    protected static ?string $navigationGroup = 'Laporan';
    protected static ?string $navigationLabel = 'Print Data';
    protected static ?string $title = 'Print Data';

    public ?string $model_type = 'transaction';
    public ?string $dari_tanggal = null;
    public ?string $sampai_tanggal = null;
    public ?array $selected_ids = [];

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Pilih Data untuk Dicetak')
                    ->schema([
                        Forms\Components\Select::make('model_type')
                            ->label('Pilih Jenis Data')
                            ->options([
                                'transaction' => 'Data Transaksi',
                                'sale' => 'Data Sales',
                                'user' => 'Data Petugas',
                                'item' => 'Data Item',
                                'customer' => 'Data Customer',
                                'identitas' => 'Data Identitas Koperasi',
                            ])
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn() => $this->selected_ids = []),

                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\DatePicker::make('dari_tanggal')
                                    ->label('Dari Tanggal'),
                                Forms\Components\DatePicker::make('sampai_tanggal')
                                    ->label('Sampai Tanggal')
                                    ->default(now()),
                            ]),

                        Forms\Components\CheckboxList::make('selected_ids')
                            ->label('Pilih Data Spesifik (Opsional)')
                            ->options(function () {
                                return $this->getModelOptions();
                            })
                            ->searchable()
                            ->bulkToggleable()
                            ->columns(2)
                            ->helperText('Kosongkan untuk mencetak semua data'),
                    ]),
            ]);
    }

    // Ubah dari getActions() ke getHeaderActions()
    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('print_data')
                ->label('Print Data')
                ->icon('heroicon-o-printer')
                ->color('success')
                ->action('printData'),

            Actions\Action::make('download_pdf')
                ->label('Download PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('primary')
                ->action('downloadPdf'),

            Actions\Action::make('preview')
                ->label('Preview')
                ->icon('heroicon-o-eye')
                ->color('gray')
                ->action('previewData'),
        ];
    }

    public function printData()
    {
        $url = route('print.data', [
            'type' => $this->model_type,
            'dari_tanggal' => $this->dari_tanggal,
            'sampai_tanggal' => $this->sampai_tanggal,
            'ids' => $this->selected_ids ? implode(',', $this->selected_ids) : null,
        ]);

        $this->js("window.open('$url', '_blank')");
    }

    public function downloadPdf()
    {
        return redirect()->route('download.pdf', [
            'type' => $this->model_type,
            'dari_tanggal' => $this->dari_tanggal,
            'sampai_tanggal' => $this->sampai_tanggal,
            'ids' => $this->selected_ids ? implode(',', $this->selected_ids) : null,
        ]);
    }

    public function previewData()
    {
        $data = $this->getFilteredData();

        $this->dispatch('notify', [
            'title' => 'Preview Data',
            'body' => "Total data yang akan dicetak: {$data->count()} {$this->model_type}",
            'type' => 'info'
        ]);
    }

    private function getModelOptions()
    {
        $model = $this->getModelClass();

        // Tambahkan eager loading untuk transaction
        $query = $model::latest()->limit(100);

        if ($this->model_type === 'transaction') {
            $query->with('item'); // Eager load relasi item
        }

        return $query->get()
            ->mapWithKeys(function ($item) {
                return [$item->id => $this->getDisplayText($item)];
            })
            ->toArray();
    }

    private function getFilteredData()
    {
        $model = $this->getModelClass();
        $query = $model::query();

        // Filter tanggal
        if ($this->dari_tanggal) {
            $query->whereDate('created_at', '>=', $this->dari_tanggal);
        }
        if ($this->sampai_tanggal) {
            $query->whereDate('created_at', '<=', $this->sampai_tanggal);
        }

        // Filter ID spesifik
        if (!empty($this->selected_ids)) {
            $query->whereIn('id', $this->selected_ids);
        }

        return $query->get();
    }

    private function getModelClass()
    {
        return match ($this->model_type) {
            'transaction' => Transaction::class,
            'sale' => Sale::class,
            'user' => User::class,
            'item' => Item::class,
            'customer' => Customer::class,
            'identitas' => Identitas::class,
            default => Transaction::class,
        };
    }

    private function getDisplayText($item)
    {
        return match ($this->model_type) {
            'transaction' => $this->getTransactionDisplay($item),
            'sale' => ($item->kode_sales ?? 'SLS-' . $item->id) . ' - ' . ($item->customer->nama_customer ?? 'Tidak ada nama'),
            'user' => $item->name . ' (' . $item->email . ')',
            'item' => ($item->kode_item ?? 'ITM-' . $item->id) . ' - ' . ($item->nama_item ?? 'Tidak ada nama'),
            'customer' => ($item->kode_customer ?? 'CUST-' . $item->id) . ' - ' . ($item->nama_customer ?? 'Tidak ada nama'),
            'identitas' => ($item->nama_identitas ?? 'Koperasi') . ' - ' . ($item->alamat ?? 'Tidak ada alamat'),
            default => 'ID: ' . $item->id,
        };
    }

    private function getTransactionDisplay($transaction)
    {
        // Perbaiki nama field dan cara akses relasi
        $kode = $transaction->kode_transaksi ?? 'TRX-' . $transaction->id;
        $itemName = $transaction->item?->nama_item ?? 'Item tidak ditemukan'; // Gunakan optional chaining
        $amount = number_format($transaction->amount ?? 0, 0, ',', '.');

        return "{$kode} - {$itemName} - Rp {$amount}";
    }
}
