<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Sale;
use App\Models\User;
use App\Models\Item;
use App\Models\Customer;
use App\Models\Identitas;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintController extends Controller
{
    public function printData(Request $request)
    {
        $data = $this->getFilteredData($request);
        $type = $request->get('type', 'transaction');
        $title = 'Laporan ' . $this->getTypeLabel($type);

        return view('print.simple-template', compact('data', 'type', 'title'));
    }

    public function downloadPdf(Request $request)
    {
        $data = $this->getFilteredData($request);
        $type = $request->get('type', 'transaction');
        $title = 'Laporan ' . $this->getTypeLabel($type);

        $pdf = Pdf::loadView('print.simple-template', compact('data', 'type', 'title'));

        return $pdf->download($type . '-' . date('Y-m-d') . '.pdf');
    }

    private function getFilteredData(Request $request)
    {
        $type = $request->get('type', 'transaction');
        $model = $this->getModelClass($type);
        $query = $model::query();

        // Eager loading untuk transaction
        if ($type === 'transaction') {
            $query->with('item'); // Load relasi item
        }

        // Filter tanggal
        if ($request->filled('dari_tanggal')) {
            $query->whereDate('created_at', '>=', $request->dari_tanggal);
        }
        if ($request->filled('sampai_tanggal')) {
            $query->whereDate('created_at', '<=', $request->sampai_tanggal);
        }

        // Filter ID spesifik
        if ($request->filled('ids')) {
            $ids = explode(',', $request->ids);
            $query->whereIn('id', array_filter($ids));
        }

        return $query->get();
    }

    private function getModelClass($type)
    {
        return match ($type) {
            'transaction' => Transaction::class,
            'sale' => Sale::class,
            'user' => User::class,
            'item' => Item::class,
            'customer' => Customer::class,
            'identitas' => Identitas::class,
            default => Transaction::class,
        };
    }

    private function getTypeLabel($type)
    {
        return match ($type) {
            'transaction' => 'Transaksi',
            'sale' => 'Sales',
            'user' => 'User',
            'item' => 'Item',
            'customer' => 'Customer',
            'identitas' => 'Identitas Koperasi',
            default => 'Data',
        };
    }
}
