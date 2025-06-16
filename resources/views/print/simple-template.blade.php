<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
        }
    </style>
</head>

<body onload="window.print()">
    <h1>{{ $title }}</h1>

    <table>
        @if($type === 'transaction')
        <thead>
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>QTY</th>
                <th>price</th>
                <th>Amount</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->item->nama_item }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price }}</td>
                <td class="text-right">Rp {{ number_format($item->amount ?? 0, 0, ',', '.') }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
        @elseif($type === 'sale')
        <thead>
            <tr>
                <th>No</th>
                <th>Do Number</th>
                <th>Status</th>
                <th>Nama Customer</th>
                <th>Alamat</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->do_number }}</td>
                <td>{{ $item->status }}</td>
                <td>{{ $item->customer->nama_customer }}</td>
                <td>{{ $item->customer->alamat }}</td>
                <td>{{ $item->created_at }}</td>

            </tr>
            @endforeach
        </tbody>
        @elseif($type === 'item')
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Item</th>
                <th>uom</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->nama_item }}</td>
                <td>{{ $item->uom }}</td>
                <td class="text-right">Rp {{ number_format($item->harga_beli ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($item->harga_jual ?? 0, 0, ',', '.') }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
        @else
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Customer</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>No Telepon</th>
                <th>Fax</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->nama_customer }}</td>
                <td>{{ $item->alamat }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->telp }}</td>
                <td>{{ $item->fax }}</td>
                <td>{{ $item->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
        @endif
    </table>

    <div class="footer">
        <p>Total Data: {{ $data->count() }}</p>
        <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
        <p>Oleh: {{ auth()->user()->name }}</p>
    </div>
</body>

</html>