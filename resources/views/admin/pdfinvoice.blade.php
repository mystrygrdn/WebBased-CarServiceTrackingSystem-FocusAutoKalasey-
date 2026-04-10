<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 12px;
    }

    .header {
        width: 100%;
        margin-bottom: 20px;
    }

    .logo-box {
        width: 80px;
        height: 80px;
        border: 2px solid #000;
        text-align: center;
        font-weight: bold;
        font-size: 18px;
        line-height: 1.2;
    }

    .logo-box span {
        font-size: 10px;
    }

    .title {
        font-size: 20px;
        font-weight: bold;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 6px;
        word-wrap: break-word;
    }

    th {
        background: #f2f2f2;
        text-align: center;
    }

    .no-border td {
        border: none;
        padding: 2px;
    }

    .right {
        text-align: right;
    }

    .center {
        text-align: center;
    }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <table class="header no-border">
        <tr>
            <td width="60%">
                <div class="title">FocusAuto Body Shop</div>
                Jl. Batu No.5 Kalasey (Depan ex Dealer Chevrolet) Manado<br>
                HP: 082347949174 (Martin)
            </td>
            <td width="25%" class="right">
                <h2>NOTA</h2>
            </td>
        </tr>
    </table>

    <hr>

    {{-- INFO --}}
    <table class="no-border">
        <tr>
            <td width="50%">
                <strong>No Invoice:</strong> {{ $invoice->nomor_invoice }}<br>
                <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($invoice->tanggal_masuk)->format('d F Y') }}<br>
                <strong>Customer:</strong> {{ $invoice->serviceTracking->customer->nama ?? '-' }}
            </td>
            <td width="50%">
                <strong>No Polisi:</strong> {{ $invoice->serviceTracking->vehicle->nomor_polisi ?? '-' }}<br>
                <strong>Merk:</strong> {{ $invoice->serviceTracking->vehicle->merek ?? '-' }}<br>
                <strong>Tipe:</strong> {{ $invoice->serviceTracking->vehicle->model ?? '-' }}
            </td>
        </tr>
    </table>

    <br>

    {{-- TABLE ITEM --}}
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="35%">Pekerjaan / Part</th>
                <th width="8%">Qty</th>
                <th width="15%">Harga</th>
                <th width="15%">Subtotal</th>
                <th width="22%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->items as $i => $item)
            <tr>
                <td class="center">{{ $i + 1 }}</td>
                <td>{{ $item->pekerjaan_part }}</td>
                <td class="center">{{ $item->qty }}</td>
                <td class="right">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td class="right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>

    {{-- TOTAL --}}
    <table class="no-border">
        <tr>
            <td width="70%"></td>
            <td width="30%">
                <table>
                    <tr>
                        <td>Subtotal</td>
                        <td class="right">Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>PPN 11%</td>
                        <td class="right">Rp {{ number_format($invoice->tax, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Grand Total</strong></td>
                        <td class="right"><strong>Rp {{ number_format($invoice->total, 0, ',', '.') }}</strong></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <br><br>

    <div class="right">
        Hormat Kami,<br><br><br>
        <strong>FocusAuto Body Shop</strong>
    </div>

</body>

</html>