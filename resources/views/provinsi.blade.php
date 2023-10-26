<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kode Wilayah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <main id="content" role="main" class="my-3 my-lg-5 pb-5 pb-lg-0">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h2">Kode Wilayah<br><span class="h3 text-uppercase fw-normal">by</span><span
                        class="h3 text-capitalize fw-normal"> DIGIDES</span></h1>
                <a href="/wilayah" class="btn btn-primary">
                    Tambah Wilayah
                </a>
            </div>
            <div class="mt-1 mb-2">
                <a href="/" class="text-red-700"> ↑ Indonesia</a>
            </div>
            @php
                $kabupatenKecamatan = [];
                foreach ($Wilayah as $item) {
                    $kabupatenKode = $item->k1 . '.' . $item->k2;
                    $kecamatanKode = $item->k1 . '.' . $item->k2 . '.' . $item->k3;

                    if (!isset($kabupatenKecamatan[$kabupatenKode])) {
                        $kabupatenKecamatan[$kabupatenKode] = [
                            'kabkota' => $item->kabkota,
                            'kecamatan' => collect(),
                        ];
                    }

                    if ($item->kecamatan) {
                        if (!$kabupatenKecamatan[$kabupatenKode]['kecamatan']->contains('kecamatan', $item->kecamatan)) {
                            $kabupatenKecamatan[$kabupatenKode]['kecamatan']->push(['kecamatan' => $item->kecamatan, 'kecamatanKode' => $kecamatanKode]);
                        }
                    }
                }
            @endphp

            <div class="row">
                <div class="col-md-12">
                    @foreach ($kabupatenKecamatan as $kabupatenKode => $data)
                        @if ($loop->first)
                            @continue
                        @endif
                        <div class="row">
                            <a href="/kabkota/{{ $kabupatenKode }}" style="color: black; text-decoration:none;">
                                <h3 class="mt-4">{{ $kabupatenKode }} - {{ $data['kabkota'] }}</h3>
                            </a>
                            @php $count = 0; @endphp
                            @foreach ($data['kecamatan'] as $kecamatan)
                                <div class="col-md-4">
                                    <div class="list-group">
                                        <label class="list-group-item small py-1 px-2 bg-desa">
                                            <div class="d-flex">
                                                <div>
                                                    <input class="form-check-input me-1" type="checkbox" value="">
                                                </div>
                                                <div class="ps-1">{{ $loop->iteration }}.
                                                    {{ $kecamatan['kecamatan'] }}
                                                </div>
                                                <div class="ms-auto">{{ $kecamatan['kecamatanKode'] }}</div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                @php
                                    $count++;
                                    if ($count % 3 == 0) {
                                        echo '</div><div class="row">';
                                    }
                                @endphp
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
