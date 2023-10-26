<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kode Wilayah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
            @php
                $provinsiKabupaten = [];
                foreach ($Wilayah as $item) {
                    $provinsiKode = $item->k1;
                    $kabupatenKode = $item->k1 . '.' . $item->k2;

                    if (!isset($provinsiKabupaten[$provinsiKode])) {
                        $provinsiKabupaten[$provinsiKode] = [
                            'provinsi' => $item->provinsi,
                            'kabupaten' => collect(),
                        ];
                    }

                    if ($item->kabkota) {
                        if (!$provinsiKabupaten[$provinsiKode]['kabupaten']->contains('kabkota', $item->kabkota)) {
                            $provinsiKabupaten[$provinsiKode]['kabupaten']->push(['kabkota' => $item->kabkota, 'kabupatenKode' => $kabupatenKode]);
                        }
                    }
                }
            @endphp

            <div class="row">
                <div class="col-md-12">
                    @foreach ($provinsiKabupaten as $provinsiKode => $data)
                        <div class="row">
                            <div class="d-flex justify-content-between align-items-center mt-4 mb-2">
                                <a href="/provinsi/{{ $provinsiKode }}" style="color: black; text-decoration:none;">
                                    <h3>{{ $provinsiKode }} - {{ $data['provinsi'] }}</h3>
                                </a>
                                <button type="button" data-bs-target="#editMultiple{{ $provinsiKode }}"
                                    data-bs-toggle="modal" class="btn btn-info text-white">
                                    <i class="bi bi-pencil-square"></i>
                                </button>

                                <div class="modal fade" id="editMultiple{{ $provinsiKode }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="/editmultiple" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit {{ $data['provinsi'] }}</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="tingkatan_wilayah" value="Provinsi">
                                                    <input type="hidden" name="wilayah" value="{{ $provinsiKode }}">
                                                    <div class="form-group mb-3">
                                                        <label>Nama Wilayah</label>
                                                        <input type="text" class="form-control" id="nama_wilayah"
                                                            name="nama_wilayah" value="{{ $data['provinsi'] }}"
                                                            required>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Kode Wilayah</label>
                                                        <input type="number" class="form-control" id="kode_wilayah"
                                                            name="kode_wilayah" value="{{ $provinsiKode }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="button" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close" value="Cancel" class="btn btn-secondary">
                                                    <input type="submit" class="btn btn-info text-white" value="Update">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="mb-3">
                                <button type="button" data-bs-target="#editSelect{{ $provinsiKode }}"
                                    data-bs-toggle="modal" class="btn btn-success">
                                    Edit Select
                                </button>
                            </div>

                            <div id="editSelect{{ $provinsiKode }}" class="modal fade" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="/editselect" method="POST"
                                            id="form_edit_select{{ $provinsiKode }}">
                                            @csrf
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Select</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="tingkatan_wilayah" value="Provinsi">
                                                <input type="hidden" name="wilayah" value="{{ $provinsiKode }}">
                                                <input type="hidden" value="" name="hasil_checkbox"
                                                    id="hasil_checkbox{{ $provinsiKode }}">
                                                <div class="form-group mb-3">
                                                    <label>Nama Wilayah Baru</label>
                                                    <input type="text" value="{{ $data['provinsi'] }}"
                                                        class="form-control" id="nama_wilayah_baru"
                                                        name="nama_wilayah" required>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label>Kode Wilayah</label>
                                                    <input type="number" value="{{ $provinsiKode }}"
                                                        class="form-control" id="kode_wilayah_baru"
                                                        name="kode_wilayah" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="button" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close" value="Cancel" class="btn btn-secondary">
                                                <input type="submit" class="btn btn-success" value="Update">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @php $count = 0; @endphp
                            @foreach ($data['kabupaten'] as $kabupaten)
                                <div class="col-md-4">
                                    <div class="list-group">
                                        <label class="list-group-item small py-1 px-2 bg-desa">
                                            <div class="d-flex">
                                                <div>
                                                    <input class="form-check-input me-1" type="checkbox"
                                                        name="checkbox_wilayah{{ $provinsiKode }}"
                                                        value="{{ $kabupaten['kabupatenKode'] }}"
                                                        id="checkbox{{ $provinsiKode }}">
                                                </div>
                                                <div class="ps-1">{{ $loop->iteration }}.
                                                    {{ $kabupaten['kabkota'] }}
                                                </div>
                                                <div class="ms-auto">{{ $kabupaten['kabupatenKode'] }}</div>
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

                            <script>
                                document.getElementById("form_edit_select{{ $provinsiKode }}").addEventListener('submit', function(event) {
                                    event.preventDefault();

                                    const selectedCheckboxes = Array.from(document.querySelectorAll(
                                            'input[name="checkbox_wilayah{{ $provinsiKode }}"]:checked'))
                                        .map(checkbox => checkbox.value);

                                    document.querySelector('input[id="hasil_checkbox{{ $provinsiKode }}"]').value = selectedCheckboxes
                                        .join(',');

                                    this.submit();
                                });
                            </script>
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
