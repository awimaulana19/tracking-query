@extends('layout')

@section('title', 'Kabupaten')

@section('content')
    @php
        $kecamatanDeskel = [];
        foreach ($Wilayah as $item) {
            $kecamatanKode = $item->k1 . '.' . $item->k2 . '.' . $item->k3;
            $deskelKode = $item->k1 . '.' . $item->k2 . '.' . $item->k3 . '.' . $item->k4;

            if (!isset($kecamatanDeskel[$kecamatanKode])) {
                $kecamatanDeskel[$kecamatanKode] = [
                    'kecamatan' => $item->kecamatan,
                    'deskel' => collect(),
                ];
            }

            if ($item->deskel) {
                if (!$kecamatanDeskel[$kecamatanKode]['deskel']->contains('deskel', $item->deskel)) {
                    $kecamatanDeskel[$kecamatanKode]['deskel']->push(['deskel' => $item->deskel, 'deskelKode' => $deskelKode]);
                }
            }
        }
    @endphp

    @if (count($Wilayah) != 0)
        <div class="mt-1 mb-2">
            <a href="/provinsi/{{ $Wilayah[0]->k1 }}" class="text-red-700"> ↑ {{ $Wilayah[0]->provinsi }}</a>
        </div>
    @endif

    <div class="col-md-12">
        @foreach ($kecamatanDeskel as $kecamatanKode => $data)
            @if ($data['kecamatan'] == '')
                @continue
            @endif
            <div class="row">
                <div class="d-flex justify-content-between align-items-center mt-4 mb-1">
                    <div class="mb-1">
                        <a href="/kecamatan/{{ $kecamatanKode }}">
                            <h3 class="link-wilayah">{{ $kecamatanKode }} - Kecamatan {{ $data['kecamatan'] }}</h3>
                        </a>
                        <button type="button" data-bs-target="{{ '#editSelect' . str_replace('.', '_', $kecamatanKode) }}"
                            data-bs-toggle="modal" class="btn btn-success btn-sm mt-1">
                            Edit Select
                        </button>
                    </div>
                    <button type="button" data-bs-target="{{ '#editMultiple' . str_replace('.', '_', $kecamatanKode) }}"
                        data-bs-toggle="modal" class="btn btn-success text-white">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <div class="modal fade" id="{{ 'editMultiple' . str_replace('.', '_', $kecamatanKode) }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="/editmultiple" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit {{ $data['kecamatan'] }}</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="tingkatan_wilayah" value="Kecamatan">
                                        <input type="hidden" name="wilayah" value="{{ $kecamatanKode }}">
                                        <div class="form-group mb-3">
                                            <label>Nama Wilayah</label>
                                            <input type="text" class="form-control" id="nama_wilayah" name="nama_wilayah"
                                                value="{{ $data['kecamatan'] }}" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Kode Wilayah</label>
                                            @php
                                                $kodePotongan = explode('.', $kecamatanKode);
                                            @endphp
                                            <input type="number" class="form-control" id="kode_wilayah" name="kode_wilayah"
                                                value="{{ $kodePotongan[2] }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="button" type="button" data-bs-dismiss="modal" aria-label="Close"
                                            value="Cancel" class="btn btn-secondary">
                                        <input type="submit" class="btn btn-success text-white" value="Update">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="{{ 'editSelect' . str_replace('.', '_', $kecamatanKode) }}" class="modal fade" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="/editselect" method="POST" id="form_edit_select{{ $kecamatanKode }}">
                                @csrf
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Select</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="tingkatan_wilayah" value="Kecamatan">
                                    <input type="hidden" name="wilayah" value="{{ $kecamatanKode }}">
                                    <input type="hidden" value="" name="hasil_checkbox"
                                        id="hasil_checkbox{{ $kecamatanKode }}">
                                    <div class="form-group mb-3">
                                        <label>Nama Wilayah Baru</label>
                                        <input type="text" value="{{ $data['kecamatan'] }}" class="form-control"
                                            id="nama_wilayah_baru" name="nama_wilayah" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label>Kode Wilayah</label>
                                        @php
                                            $kodePotongan = explode('.', $kecamatanKode);
                                        @endphp
                                        <input type="number" value="{{ $kodePotongan[2] }}" class="form-control"
                                            id="kode_wilayah_baru" name="kode_wilayah" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" type="button" data-bs-dismiss="modal" aria-label="Close"
                                        value="Cancel" class="btn btn-secondary">
                                    <input type="submit" class="btn btn-success" value="Update">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @php $count = 0; @endphp
                @foreach ($data['deskel'] as $deskel)
                    <div class="col-md-4">
                        <div class="list-group">
                            <label class="list-group-item small py-1 px-2 bg-wilayah">
                                <div class="d-flex">
                                    <div>
                                        <input class="form-check-input me-1" type="checkbox"
                                            name="checkbox_wilayah{{ $kecamatanKode }}"
                                            value="{{ $deskel['deskelKode'] }}" id="checkbox{{ $kecamatanKode }}">
                                    </div>
                                    <div class="ps-1 nama-wilayah">{{ $loop->iteration }}.
                                        {{ $deskel['deskel'] }}
                                    </div>
                                    <div class="ms-auto kode-wilayah">{{ $deskel['deskelKode'] }}</div>
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
                    document.getElementById("form_edit_select{{ $kecamatanKode }}").addEventListener('submit', function(event) {
                        event.preventDefault();

                        const selectedCheckboxes = Array.from(document.querySelectorAll(
                                'input[name="checkbox_wilayah{{ $kecamatanKode }}"]:checked'))
                            .map(checkbox => checkbox.value);

                        document.querySelector('input[id="hasil_checkbox{{ $kecamatanKode }}"]').value = selectedCheckboxes
                            .join(',');

                        this.submit();
                    });
                </script>
            </div>
        @endforeach
    </div>
@endsection
