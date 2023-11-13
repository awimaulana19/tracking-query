@extends('layout')

@section('title', 'Kecamatan')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p>{{ count($result) }} hasil ditemukan untuk “{{ $search }}”</p>
            @foreach ($result as $data)
                <div class="d-flex align-items-center mt-4 mb-1">
                    @php
                        $wilayah = '';

                        if (strpos($data['kode'], '.') === false) {
                            $wilayah = 'Provinsi';
                        } elseif (substr_count($data['kode'], '.') == 1) {
                            $wilayah = '';
                        } elseif (substr_count($data['kode'], '.') == 2) {
                            $wilayah = 'Kecamatan';
                        } elseif (substr_count($data['kode'], '.') == 3) {
                            $wilayah = 'Desa';
                        }
                    @endphp
                    <h3 class="link-wilayah" style="margin: 0;">{{ $data['kode'] }} - {{ $wilayah }} {{ $data['nama'] }}
                    </h3>
                </div>
            @endforeach
        </div>
    </div>
@endsection
