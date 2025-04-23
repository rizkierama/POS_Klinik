<!DOCTYPE html>
<html>
<head>
    <title>Nota Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .container {
            width: 300px;
            margin: 0 auto;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Nota Transaksi</h2>
        <p>Tanggal: {{ $transaksi->created_at->format('d-m-Y H:i:s') }}</p>
        <table>
            <thead>
                <tr>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi->details as $detail)
                    <tr>
                        <td>{{ $detail->obat->nama_obat ?? 'Obat tidak ditemukan' }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p><strong>Total: Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</strong></p>
    </div>
</body>
</html>
