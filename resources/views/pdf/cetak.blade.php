<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Prestasi Karyawan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .header {
            border: 1px solid black;
            margin-bottom: 10px;
        }

        .header table {
            width: 100%;
            border-collapse: collapse;
        }

        .header img {
            width: 150px;
        }

        .header-info {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            padding-right: 10px;
        }

        .header-info strong {
            font-size: 16px;
        }

        .main-title {
            background-color: black;
            color: white;
            text-align: center;
            padding: 8px;
            font-size: 14px;
            font-weight: bold;
            margin: 0;
            border: 1px solid black;
            border-top: none;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .content table,
        .content th,
        .content td {
            border: 1px solid black;
        }

        .content th,
        .content td {
            padding: 5px;
            text-align: left;
        }

        .content th {
            background-color: #f2f2f2;
        }

        .content .section-title {
            text-align: left;
            font-weight: bold;
        }

        .content .section-title-center {
            text-align: center;
            font-weight: bold;
            background-color: #e0e0e0;
        }

        .content .section-title-nilai {
            text-align: center;
            width: 15%;
        }

        .content .section-title-grey {
            background-color: #e0e0e0;
            text-align: center;
            font-weight: bold;
            width: 15%;
        }

        .description {
            font-size: 12.5px;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 2;
            padding-top: 2px;
            margin-top: -20px;
            margin-bottom: 10px;
        }

        .average-explanation {
            margin-left: 20px;
            font-size: 12px;
            color: #333;
        }

        .fraction {
            display: inline-block;
            text-align: center;
            vertical-align: middle;
            font-size: 0.9em;
            padding-top: 0.1px;
        }

        .fraction .numerator {
            border-bottom: 1px solid #000;
            display: block;
            padding: 0 0.2em;
            font-size: 0.9em;
        }

        .fraction .denominator {
            display: block;
            padding: 0 0.2em;
            font-size: 0.9em;
        }

        .fraction .line {
            display: block;
            height: 0;
        }

        .signature-section {
            margin-top: 0.5px;
            text-align: center;
        }

        .signature-section table {
            width: 100%;
            text-align: center;
            margin-top: 10px;
        }

        .signature-section td {
            padding-top: 80px;
            vertical-align: bottom;
        }

        .signature-section .role {
            font-size: 11px;
            text-transform: uppercase;
            padding-top: 15px;
        }

        .signature-section .name {
            font-size: 11px;
        }

        .signature-section .place {
            padding-top: 10px;
            font-style: italic;
        }

        .madiun {
            font-size: 12px;
            text-align: left;
            line-height: 0.1;
            margin: 0.1px;
            padding: 0.1;
        }
    </style>
</head>

<body>

    <div class="header">
        <table>
            <tr>
                <td style="border-right: 1px solid #000; text-align: center; vertical-align: middle;">
                    <img src="{{ public_path('images/Logo-PT-INKA.png') }}" alt="Logo">
                </td>
                <td class="header-info">
                    PT INDUSTRI KERETA API (Persero)<br>
                    Jl. Yos Sudarso No. 71 Madiun 63122<br>
                    Telp: (0351) 452271 – 452274 Fax: (0351) 452275
                </td>
            </tr>
        </table>
    </div>

    <div class="main-title">
        PENILAIAN PRESTASI KARYAWAN SEMESTER {{ $datakaryawans->semester }} TAHUN
        {{ \Carbon\Carbon::parse($datakaryawans->created_at)->format('Y') }}
    </div>

    <div class="content">
        <table>
            <tr>
                <td><strong>NAMA</strong></td>
                <td>{{ $datakaryawans->nama }}</td>
            </tr>
            <tr>
                <td><strong>NIP</strong></td>
                <td>{{ $datakaryawans->nip }}</td>
            </tr>
            <tr>
                <td><strong>GOLONGAN</strong></td>
                <td>{{ $datakaryawans->golongan }}</td>
            </tr>
            <tr>
                <td><strong>JABATAN</strong></td>
                <td>{{ $datakaryawans->jabatan }}</td>
            </tr>
            <tr>
                <td><strong>UNIT KERJA</strong></td>
                <td>{{ $datakaryawans->unit_kerja }}</td>
            </tr>
            <tr>
                <td><strong>DIVISI</strong></td>
                <td>{{ $datakaryawans->divisi }}</td>
            </tr>
        </table>
        <!-- Deskripsi -->
        <div class="description">
            <p>Berilah bobot nilai pada poin-poin di bawah ini sesuai dengan kategori nilai sebagai berikut:</p>
            <p class="description">
                Nilai (&lt; 60) = Buruk, Nilai (60 – 69) = Kurang, Nilai (70 – 79) = Cukup, Nilai (80 – 89) = Baik,
                Nilai (90 – 100) = Sangat Baik
            </p>
        </div>
        <table>
            <tr>
                <th class="section-title-center" colspan="2">UNSUR YANG DINILAI</th>
                <th class="section-title-nilai">NILAI</th>
            </tr>
            <tr>
                <td class="section-title" colspan="2">A. MANAJERIAL (Khusus Pejabat Struktural)</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2">Kemampuan Manajerial (Perencanaan, Pengorganisasian, Penggerakan, Pengendalian &
                    Pengawasan)</td>
                <td class="section-title-nilai">{{ $penilaians->nilai_managerial }}</td>
            </tr>
            <tr>
                <td class="section-title" colspan="2">B. KINERJA</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2">1. Jumlah / Beban Kerja yang diselesaikan</td>
                <td class="section-title-nilai">{{ $penilaians->nilai_kinerja_1 }}</td>
            </tr>
            <tr>
                <td colspan="2">2. Kualitas kerja yang dihasilkan</td>
                <td class="section-title-nilai">{{ $penilaians->nilai_kinerja_2 }}</td>
            </tr>
            <tr>
                <td colspan="2">3. Pemeliharaan Peralatan dan Perlengkapan</td>
                <td class="section-title-nilai">{{ $penilaians->nilai_kinerja_3 }}</td>
            </tr>
            <tr>
                <td colspan="2">4. Paham Hubungan antar pekerjaan</td>
                <td class="section-title-nilai">{{ $penilaians->nilai_kinerja_4 }}</td>
            </tr>
            <tr>
                <td class="section-title-center" colspan="2">Rata-rata Nilai Kinerja</td>
                <td class="section-title-grey">{{ $penilaians->rata_rata_kinerja }}</td>
            </tr>
            <tr>
                <td class="section-title" colspan="2">C. PERILAKU</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2">1. Tanggung Jawab & Kerjasama</td>
                <td class="section-title-nilai">{{ $penilaians->nilai_perilaku_1 }}</td>
            </tr>
            <tr>
                <td colspan="2">2. Inisiatif dan Kreatifitas</td>
                <td class="section-title-nilai">{{ $penilaians->nilai_perilaku_2 }}</td>
            </tr>
            <tr>
                <td colspan="2">3. Tata Krama dan Kejujuran</td>
                <td class="section-title-nilai">{{ $penilaians->nilai_perilaku_3 }}</td>
            </tr>
            <tr>
                <td colspan="2">4. Disiplin</td>
                <td class="section-title-nilai">{{ $penilaians->nilai_perilaku_4 }}</td>
            </tr>
            <tr>
                <td class="section-title-center" colspan="2">Rata-rata Nilai Perilaku</td>
                <td class="section-title-grey">{{ $penilaians->rata_rata_perilaku }}</td>
            </tr>
            <tr>
                <td class="section-title-center" colspan="2"><strong>RATA-RATA NILAI PRESTASI KARYAWAN</strong></td>
                <td class="section-title-grey">{{ $penilaians->rata_rata_prestasi }}</td>
            </tr>
        </table>
    </div>
    <!-- New Section for Rata-Rata Nilai Penjabaran -->
    <div class="average-explanation">
        <p>*Rata-rata Nilai Prestasi Karyawan untuk Pejabat Struktural adalah Total Nilai =
            <span class="fraction">
                <span class="numerator">A + B + C</span>
                <span class="denominator">3</span>
            </span>
        </p>
        <p>*Rata-rata Nilai Prestasi Karyawan untuk Non Pejabat Struktural adalah Total Nilai =
            <span class="fraction">
                <span class="numerator">B + C</span>
                <span class="denominator">2</span>
            </span>
        </p>
    </div>
    <div class="signature-section">
        <table>
            <div class="madiun">Madiun,</div>
            <tr>
                <td class="role">Pejabat Penilai,<br>SM {{ $datakaryawans->unit_kerja }}</td>
                <td class="role">Diketahui Oleh,<br>Karyawan Yang Dinilai</td>
                <td class="role">Disetujui Oleh,<br>GM {{ $datakaryawans->divisi }}</td>
            </tr>
            <tr>
                <td class="name">({{ $datakaryawans->pejabat_penilai }})</td>
                <td class="name">({{ $datakaryawans->nama }})</td>
                <td class="name">
                    @if (auth()->user() &&
                            in_array(auth()->user()->role, ['generalmanager', 'manager', 'seniormanager']) &&
                            $datakaryawans->status == 'approve')
                        <img src="{{ public_path('images/approved.png') }}" alt="Signature"
                            style="width: 100px; height: auto; display: block; margin: 0 auto; page-break-inside: avoid; position: absolute; bottom: 20px; right: 50px;">
                    @endif
                    ({{ $datakaryawans->General_Manager }})
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
