@extends('layout')

@section('title', 'Home')

@section('content')
    <div class="col-md-12">
        @foreach ($provinsiKabupaten as $data)
            <div class="row">
                <div class="d-flex align-items-center mt-4 mb-1">
                    <div class="mb-1">
                        <a href="/provinsi/{{ $data['k1'] }}">
                            <h3 class="link-wilayah" style="margin: 0;">{{ $data['k1'] }} - {{ $data['provinsi'] }}</h3>
                        </a>
                    </div>
                    @auth
                        <button type="button" data-bs-target="#editMultiple{{ $data['k1'] }}" data-bs-toggle="modal"
                            class="btn btn-sm btn-success text-white ms-3">
                            <i class="bi bi-pencil-square"></i>
                        </button>

                        <div class="modal fade" id="editMultiple{{ $data['k1'] }}" tabindex="-1"
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
                                            <input type="hidden" name="wilayah" value="{{ $data['k1'] }}">
                                            <div class="form-group mb-3">
                                                <label>Nama Wilayah</label>
                                                <input type="text" class="form-control" id="nama_wilayah" name="nama_wilayah"
                                                    value="{{ $data['provinsi'] }}" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Kode Wilayah</label>
                                                <input type="number" class="form-control" id="kode_wilayah" name="kode_wilayah"
                                                    value="{{ $data['k1'] }}" required>
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
            </div>
        @endforeach
    </div>
@endsection
