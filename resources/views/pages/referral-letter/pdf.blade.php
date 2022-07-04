<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Rujukan</title>
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
        .container-inside {
            padding-right: .75rem;
			padding-left: .75rem;
			margin-right: 1cm;
			margin-left: 1cm;
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
        <div style="text-align: center; margin-bottom: 30px">
            <font size=14pt><b><u>SURAT RUJUKAN</u></b></font>
        </div>
        <table width=100% cellpadding=4px>
            <tr>
                <td width=65%></td>
                <td width=35%>Yth. {{$data->tujuan_dokter}}</td>
            </tr>
            <tr>
                <td></td>
                <td>Di</td>
            </tr>
            <tr>
                <td></td>
                <td>{{$data->tujuan_lokasi}}</td>
            </tr>
        </table>
        <div class="container-inside">
            <div style="text-indent: 50px;">
                <p>Mohon pemeriksaan dan pengobatan lebih lanjut terhadap penderita</p>
            </div>
            <table width="100%" style="border-collapse: collapse; margin-bottom:20px" cellpadding=4px>
                <tr>
                    <td width="30%">Nama</td>
                    <td width="1%">:</td>
                    <td>{{$data->pasien->user->name}}</td>
                </tr>
                <tr>
                    <td width="30%">Jenis Kelamin</td>
                    <td width="1%">:</td>
                    <td>{{$data->pasien->jenis_kelamin}}</td>
                </tr>
                <tr>
                    <td width="30%">Umur</td>
                    <td width="1%">:</td>
                    <td>{{$umur}} Tahun</td>
                </tr>
                <tr>
                    <td width="30%">No. Telepon</td>
                    <td width="1%">:</td>
                    <td>{{$data->pasien->no_hp}}</td>
                </tr>
                <tr>
                    <td width="30%">Alamat</td>
                    <td width="1%">:</td>
                    <td>{{$data->pasien->alamat}}</td>
                </tr>
            </table>

            <table width="100%" style="border-collapse: collapse" cellpadding=4px>
                <tr>
                    <td width="30%" colspan="3">Anamnese</td>
                </tr>
                <tr>
                    <td width="30%">Keluhan</td>
                    <td width="1%">:</td>
                    <td>{{$data->keluhan}}</td>
                </tr>
                <tr>
                    <td width="30%">Diagnosa sementara</td>
                    <td width="1%">:</td>
                    <td>{{$data->diagnosis_sementara}}</td>
                </tr>
            </table>

            <table width="100%" style="border-collapse: collapse; margin-bottom:10px" cellpadding=4px>
                <tr>
                    <td width="40%">Tindakan Yang telah diberikan</td>
                    <td width="1%">:</td>
                    <td>{{$data->diagnosis_sementara}}</td>
                </tr>
            </table>
            <br>
            <div style="text-indent: 50px;">
                Demikian surat rujukan ini kami kirim, kami mohon balasan atas surat rujukan ini. Atas perhatian Bapak/Ibu kami ucapkan terima kasih.
            </div>
            <br>
            <br>

            <table width=100% style="border-collapse: collapse" cellpadding=4px>
                <tr>
                    <td width=50% rowspan="3" style="vertical-align: middle">
                        @if ($data->catatan != null)
                            Catatan : <br>{{$data->catatan}}
                        @endif
                    </td>
                    <td width=50% style="text-align:center">Hormat Kami</td>
                </tr>
                <tr>
                    <td height="75px"></td>
                </tr>
                <tr>
                    <td style="text-align:center">{{$data->dokter->user->name}}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>