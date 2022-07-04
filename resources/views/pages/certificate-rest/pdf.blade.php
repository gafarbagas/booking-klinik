<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Keterangan Istirahat</title>
    <style>
        th, td{
			vertical-align: top
		}
		.container {
			padding-right: .75rem;
			padding-left: .75rem;
			margin-right: 1cm;
			margin-left: 1cm;
            padding-top: .75rem;
			padding-bottom: .75rem;
			margin-top: 1cm;
			margin-bottom: 1cm
		}
        @page { margin: 0px; }
        body { margin: 0px; }
    </style>
</head>
<body>
    <div class="container">
        <table style="width: 100%">
            <thead>
                <tr>
                    <td style="text-align: center;">
                        <font size=18pt><b>KLINIK SAMRATULANGI</b></font><br>
                        <font size=11pt><b>No. Ijin : 449.4/0044/B-11/10K/XII/2020</b></font><br>
                        <font size=12pt>Jl. Samratulangi No. 22 Manahan Solo</font><br>
                        <font size=12pt>Telp. 08564722653</font><br>
                    </td>
                </tr>
            </thead>
        </table>
        <hr>
        <div style="text-align: center;">
            <font size=14pt><b><u>SURAT KETERANGAN ISTIRAHAT</u></b></font>
        </div>
        <div class="container">
            <table width="100%" style="border-collapse: collapse" cellpadding=4px>
                <tr>
                    <td width="20%">Nama</td>
                    <td width="1%">:</td>
                    <td>{{$data->pasien->user->name}}</td>
                </tr>
                <tr>
                    <td width="20%">Umur</td>
                    <td width="1%">:</td>
                    <td>{{$umur}} Tahun</td>
                </tr>
                <tr>
                    <td width="20%">Jenis Kelamin</td>
                    <td width="1%">:</td>
                    <td>{{$data->pasien->jenis_kelamin}}</td>
                </tr>
                <tr>
                    <td width="20%">Alamat</td>
                    <td width="1%">:</td>
                    <td>{{$data->pasien->alamat}}</td>
                </tr>
            </table>
            <table width="100%" style="border-collapse: collapse; margin-bottom: 2rem" cellpadding=4px>
                <tr rowspan="2">
                    <td width="40%" rowspan="2">Keterangan</td>
                    <td width="5%">
                        @if ($data->keterangan == "Sedang Berobat Jalan")
                            <img src="img/checkbox.png" width="20px">
                        @else
                            <img src="img/box.png" width="20px">
                        @endif
                    </td>
                    <td>Sedang Berobat Jalan</td>
                </tr>
                <tr>
                    <td>
                        @if ($data->keterangan == "Post Tindakan")
                            <img src="img/checkbox.png" width="20px">
                        @else
                            <img src="img/box.png" width="20px">
                        @endif
                    </td>
                    <td>Post Tindakan</td>
                </tr>
            </table>

            <table width="100%" style="border-collapse: collapse; margin-bottom: 2rem" cellpadding=4px>
                <tr rowspan="2">
                    <td width="40%" rowspan="2">Karena gangguan kesehatan</td>
                    <td width="5%">
                        @if ($data->alasan == "Perlu Istirahat / Kontrol")
                            <img src="img/checkbox.png" width="20px">
                        @else
                            <img src="img/box.png" width="20px">
                        @endif
                    </td>
                    <td>Perlu Istirahat / Kontrol</td>
                </tr>
                <tr>
                    <td>
                        @if ($data->alasan == "Masih Memerlukan Istirahat")
                            <img src="img/checkbox.png" width="20px">
                        @else
                            <img src="img/box.png" width="20px">
                        @endif
                    </td>
                    <td>Masih Memerlukan Istirahat</td>
                </tr>
            </table>
            <div style="margin-bottom: 4rem">
                <p>Selama <b>{{$hari}}</b> Hari, terhitung mulai tanggal <b>{{$tanggalMulai}}</b> sampai tanggal <b>{{$tanggalSelesai}}</b></p>
            </div>

            <table width=100% cellpadding=4px>
                <tr>
                    <td width=50%></td>
                    <td width=50%>Solo, {{$tanggalSurat}} <br> Dokter yang memeriksa</td>
                </tr>
                <tr><td height="75px"></td></tr>
                <tr>
                    <td></td>
                    <td>{{$data->dokter->user->name}}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>