@extends('layout')

@section('title', 'Provinsi')

@section('content')
    <div class="mt-1 mb-2">
        <a href="/"> ↑ Indonesia</a>
    </div>

    <div class="col-md-12">
        @foreach ($kabupatenKecamatan as $kabupatenKode => $data)
            @if ($data['kabkota'] == '')
                @continue
            @endif
            <div class="row">
                <div class="d-flex justify-content-between align-items-center mt-4 mb-1">
                    <div class="mb-1">
                        <a href="/kabkota/{{ $kabupatenKode }}">
                            <h3 class="link-wilayah">{{ $kabupatenKode }} - {{ $data['kabkota'] }}</h3>
                        </a>
                        @auth
                            <button type="button" data-bs-target="{{ '#editSelect' . str_replace('.', '_', $kabupatenKode) }}"
                                data-bs-toggle="modal" class="btn btn-success btn-sm mt-1">
                                Edit Select
                            </button>
                        @endauth
                    </div>
                    @auth
                        <button type="button" data-bs-target="{{ '#editMultiple' . str_replace('.', '_', $kabupatenKode) }}"
                            data-bs-toggle="modal" class="btn btn-success text-white">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <div class="modal fade" id="{{ 'editMultiple' . str_replace('.', '_', $kabupatenKode) }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="/editmultiple" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit {{ $data['kabkota'] }}</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="tingkatan_wilayah" value="Kab/Kota">
                                            <input type="hidden" name="wilayah" value="{{ $kabupatenKode }}">
                                            <div class="form-group mb-3">
                                                <label>Nama Wilayah</label>
                                                <input type="text" class="form-control" id="nama_wilayah" name="nama_wilayah"
                                                    value="{{ $data['kabkota'] }}" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Kode Wilayah</label>
                                                @php
                                                    $kodePotongan = explode('.', $kabupatenKode);
                                                @endphp
                                                <input type="number" class="form-control" id="kode_wilayah" name="kode_wilayah"
                                                    value="{{ $kodePotongan[1] }}" required>
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
                    @endauth
                </div>
                @auth
                    <div id="{{ 'editSelect' . str_replace('.', '_', $kabupatenKode) }}" class="modal fade" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="/editselect" method="POST" id="form_edit_select{{ $kabupatenKode }}">
                                    @csrf
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Select</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="tingkatan_wilayah" value="Kab/Kota">
                                        <input type="hidden" name="wilayah" value="{{ $kabupatenKode }}">
                                        <input type="hidden" value="" name="hasil_checkbox"
                                            id="hasil_checkbox{{ $kabupatenKode }}">
                                        <div class="form-group mb-3">
                                            <label>Nama Wilayah Baru</label>
                                            <input type="text" value="{{ $data['kabkota'] }}" class="form-control"
                                                id="nama_wilayah_baru" name="nama_wilayah" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Kode Wilayah</label>
                                            @php
                                                $kodePotongan = explode('.', $kabupatenKode);
                                            @endphp
                                            <input type="number" value="{{ $kodePotongan[1] }}" class="form-control"
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
                @endauth
                @php $count = 0; @endphp
                @foreach ($data['kecamatan'] as $kecamatan)
                    <div class="col-md-4">
                        <div class="list-group">
                            <label class="list-group-item small py-1 px-2 bg-wilayah">
                                <div class="d-flex">
                                    <div>
                                        <input class="form-check-input me-1" type="checkbox"
                                            name="checkbox_wilayah{{ $kabupatenKode }}"
                                            value="{{ $kecamatan['kecamatanKode'] }}" id="checkbox{{ $kabupatenKode }}">
                                    </div>
                                    <div class="ps-1 nama-wilayah">{{ $loop->iteration }}.
                                        {{ $kecamatan['kecamatan'] }}
                                    </div>
                                    <div class="ms-auto kode-wilayah">{{ $kecamatan['kecamatanKode'] }}</div>
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

                @auth
                    <script>
                        document.getElementById("form_edit_select{{ $kabupatenKode }}").addEventListener('submit', function(event) {
                            event.preventDefault();

                            const selectedCheckboxes = Array.from(document.querySelectorAll(
                                    'input[name="checkbox_wilayah{{ $kabupatenKode }}"]:checked'))
                                .map(checkbox => checkbox.value);

                            document.querySelector('input[id="hasil_checkbox{{ $kabupatenKode }}"]').value = selectedCheckboxes
                                .join(',');

                            this.submit();
                        });
                    </script>
                @endauth
            </div>
        @endforeach
    </div>
@endsection
