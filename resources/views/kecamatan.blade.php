@extends('layout')

@section('title', 'Kecamatan')

@section('content')
    @if (count($Wilayah) != 0)
        <div class="mt-1 mb-2">
            <a href="/kabkota/{{ $Wilayah[0]->k1 }}.{{ $Wilayah[0]->k2 }}" class="text-red-700"> ↑
                {{ $Wilayah[0]->kabkota }}</a>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            @foreach ($Wilayah as $data)
                @if ($data['deskel'] == '')
                    @continue
                @endif
                <div class="d-flex align-items-center mt-4 mb-1">
                    <h3 class="link-wilayah" style="margin: 0;">{{ $data['kode'] }} - {{ $data['deskel'] }}</h3>
                    <button type="button" data-bs-target="{{ '#editMultiple' . str_replace('.', '_', $data->kode) }}"
                        data-bs-toggle="modal" class="btn btn-success btn-sm ms-3 text-white">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <div class="modal fade" id="{{ 'editMultiple' . str_replace('.', '_', $data->kode) }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="/editmultiple" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit {{ $data['deskel'] }}</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="tingkatan_wilayah" value="Desa/Kelurahan">
                                        <input type="hidden" name="wilayah" value="{{ $data->kode }}">
                                        <div class="form-group mb-3">
                                            <label>Nama Wilayah</label>
                                            <input type="text" class="form-control" id="nama_wilayah" name="nama_wilayah"
                                                value="{{ $data['deskel'] }}" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label>Kode Wilayah</label>
                                            @php
                                                $kodePotongan = explode('.', $data->kode);
                                            @endphp
                                            <input type="number" class="form-control" id="kode_wilayah" name="kode_wilayah"
                                                value="{{ $kodePotongan[3] }}" required>
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
            @endforeach
        </div>
    </div>
@endsection
