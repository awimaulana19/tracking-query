<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Wilayah</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }

        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            background: #fff;
            padding: 20px 25px;
            border-radius: 3px;
            min-width: 1000px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            padding-bottom: 15px;
            background: #435d7d;
            color: #fff;
            padding: 16px 30px;
            min-width: 100%;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }

        .table-title .btn-group {
            float: right;
        }

        .table-title .btn {
            color: #fff;
            float: right;
            font-size: 13px;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }

        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }

        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }

        table.table tr th:first-child {
            width: 60px;
        }

        table.table tr th:last-child {
            width: 100px;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
            margin: 0 5px;
        }

        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
            outline: none !important;
        }

        table.table td a:hover {
            color: #2196F3;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #F44336;
        }

        table.table td i {
            font-size: 19px;
        }

        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }

        .pagination {
            float: right;
            margin: 0 0 5px;
        }

        .pagination li a {
            border: none;
            font-size: 13px;
            min-width: 30px;
            min-height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 2px !important;
            text-align: center;
            padding: 0 6px;
        }

        .pagination li a:hover {
            color: #666;
        }

        .pagination li.active a,
        .pagination li.active a.page-link {
            background: #03A9F4;
        }

        .pagination li.active a:hover {
            background: #0397d6;
        }

        .pagination li.disabled i {
            color: #ccc;
        }

        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }

        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }

        /* Modal styles */
        .modal .modal-dialog {
            max-width: 400px;
        }

        .modal .modal-header,
        .modal .modal-body,
        .modal .modal-footer {
            padding: 20px 30px;
        }

        .modal .modal-content {
            border-radius: 3px;
            font-size: 14px;
        }

        .modal .modal-footer {
            background: #ecf0f1;
            border-radius: 0 0 3px 3px;
        }

        .modal .modal-title {
            display: inline-block;
        }

        .modal .form-control {
            border-radius: 2px;
            box-shadow: none;
            border-color: #dddddd;
        }

        .modal textarea.form-control {
            resize: vertical;
        }

        .modal .btn {
            border-radius: 2px;
            min-width: 100px;
        }

        .modal form label {
            font-weight: normal;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-4">
                            <h2>Data <b>Wilayah</b></h2>
                        </div>
                        <div class="col-sm-8">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
                                    class="material-icons">&#xE147;</i> <span>Tambah Wilayah</span></a>
                            <a href="/logout" class="btn btn-danger"><span>Logout</span></a>
                            <a href="/sesibaru" class="btn btn-primary"><span>Download SQL Dan Buka Sesi Baru</span></a>
                            <a href="/" class="btn btn-info"><span>Multiple
                                    Edit</span></a>
                            {{-- <a href="#editSelect" class="btn btn-info" data-toggle="modal"><span>Select Edit</span></a> --}}
                        </div>
                    </div>
                </div>
                @if (session('error'))
                    <p class="alert alert-danger">{{ session('error') }}</p>
                @endif
                <div class="d-flex mb-3 mt-3">
                    <input type="text" id="search" placeholder="Search All"
                        style="border: black solid 1px; padding:7px;">
                </div>
                <table class="table table-striped table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>K1</th>
                            <th>K2</th>
                            <th>K3</th>
                            <th>K4</th>
                            <th>Provinsi</th>
                            <th>Kab/Kota</th>
                            <th>Kecamatan</th>
                            <th>Desa/Kelurahan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Wilayah as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->k1 }}</td>
                                <td>{{ $item->k2 }}</td>
                                <td>{{ $item->k3 }}</td>
                                <td>{{ $item->k4 }}</td>
                                <td>{{ $item->provinsi }}</td>
                                <td>{{ $item->kabkota }}</td>
                                <td>{{ $item->kecamatan }}</td>
                                <td>{{ $item->deskel }}</td>
                                <td>
                                    <a href="{{ '#editData' . str_replace('.', '_', $item->kode) }}" class="edit"
                                        data-toggle="modal"><i class="material-icons" data-toggle="tooltip"
                                            title="Edit">&#xE254;</i></a>
                                    <a href="{{ '#hapusData' . str_replace('.', '_', $item->kode) }}" class="delete"
                                        data-toggle="modal"><i class="material-icons" data-toggle="tooltip"
                                            title="Delete">&#xE872;</i></a>
                                </td>
                            </tr>
                            <div id="{{ 'editData' . str_replace('.', '_', $item->kode) }}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ '/edit/' . $item->kode }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Data</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>K1</label>
                                                    <input type="number" class="form-control" id="k1Edit"
                                                        name="k1" value="{{ $item->k1 }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>K2</label>
                                                    <input type="number" class="form-control" id="k2Edit"
                                                        name="k2" value="{{ $item->k2 }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>K3</label>
                                                    <input type="number" class="form-control" id="k3Edit"
                                                        name="k3" value="{{ $item->k3 }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>K4</label>
                                                    <input type="number" class="form-control" id="k4Edit"
                                                        name="k4" value="{{ $item->k4 }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Provinsi</label>
                                                    <input type="text" class="form-control" id="provinsiEdit"
                                                        name="provinsi" value="{{ $item->provinsi }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Kab/Kota</label>
                                                    <input type="text" class="form-control" id="kabkotaEdit"
                                                        name="kabkota" value="{{ $item->kabkota }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Kecamatan</label>
                                                    <input type="text" class="form-control" id="kecamatanEdit"
                                                        name="kecamatan" value="{{ $item->kecamatan }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Desa/Kelurahan</label>
                                                    <input type="text" class="form-control" id="deskelEdit"
                                                        name="deskel" value="{{ $item->deskel }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="button" class="btn btn-default" data-dismiss="modal"
                                                    value="Cancel">
                                                <input type="submit" class="btn btn-outline-info" value="Edit">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="{{ 'hapusData' . str_replace('.', '_', $item->kode) }}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form>
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Data</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah anda yakin ingin menghapus data ini?</p>
                                                <p class="text-warning"><small>Data tidak bisa dipulihkan
                                                        kembali.</small></p>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="button" class="btn btn-default" data-dismiss="modal"
                                                    value="Cancel">
                                                <a href="{{ '/hapus/' . $item->kode }}"
                                                    class="btn btn-danger">Hapus</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if ($Wilayah->hasPages())
            <div class="mb-3" style="background: white; padding: 20px;">
                {{ $Wilayah->links() }}
            </div>
        @endif
    </div>
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/tambah" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Wilayah</h4>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>K1</label>
                            <input type="number" class="form-control" id="k1" name="k1" required
                                onkeyup="toggleK2()">
                        </div>
                        <div class="form-group" id="k2Div" style="display: none;">
                            <label>K2</label>
                            <input type="number" class="form-control" id="k2" name="k2"
                                onkeyup="toggleK3()">
                        </div>
                        <div class="form-group" id="k3Div" style="display: none;">
                            <label>K3</label>
                            <input type="number" class="form-control" id="k3" name="k3"
                                onkeyup="toggleK4()">
                        </div>
                        <div class="form-group" id="k4Div" style="display: none;">
                            <label>K4</label>
                            <input type="number" class="form-control" id="k4" name="k4"
                                onkeyup="toggleDesaKelurahan()">
                        </div>
                        <div class="form-group" id="provinsiDiv" style="display: none;">
                            <label>Provinsi</label>
                            <input type="text" class="form-control" id="provinsi" name="provinsi">
                        </div>
                        <div class="form-group" id="kabkotaDiv" style="display: none;">
                            <label>Kab/Kota</label>
                            <input type="text" class="form-control" id="kabkota" name="kabkota">
                        </div>
                        <div class="form-group" id="kecamatanDiv" style="display: none;">
                            <label>Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan">
                        </div>
                        <div class="form-group" id="deskelDiv" style="display: none;">
                            <label>Desa/Kelurahan</label>
                            <input type="text" class="form-control" id="deskel" name="deskel">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-outline-success" value="Tambah">
                    </div>
                </form>

                <script>
                    function toggleK2() {
                        var k1Input = document.getElementById("k1");
                        var k2Div = document.getElementById("k2Div");
                        var provinsiDiv = document.getElementById("provinsiDiv");
                        var provinsi = document.getElementById("provinsi");

                        if (k1Input.value !== "") {
                            k2Div.style.display = "block";
                            provinsiDiv.style.display = "block";
                            provinsi.required = true;
                        } else {
                            k2Div.style.display = "none";
                            provinsiDiv.style.display = "none";
                            provinsi.required = false;
                        }
                    }

                    function toggleK3() {
                        var k2Input = document.getElementById("k2");
                        var k3Div = document.getElementById("k3Div");
                        var kabkotaDiv = document.getElementById("kabkotaDiv");
                        var kabkota = document.getElementById("kabkota");

                        if (k2Input.value !== "") {
                            k3Div.style.display = "block";
                            kabkotaDiv.style.display = "block";
                            kabkota.required = true;
                        } else {
                            k3Div.style.display = "none";
                            kabkotaDiv.style.display = "none";
                            kabkota.required = false;
                        }
                    }

                    function toggleK4() {
                        var k3Input = document.getElementById("k3");
                        var k4Div = document.getElementById("k4Div");
                        var kecamatanDiv = document.getElementById("kecamatanDiv");
                        var kecamatan = document.getElementById("kecamatan");

                        if (k3Input.value !== "") {
                            k4Div.style.display = "block";
                            kecamatanDiv.style.display = "block";
                            kecamatan.required = true;
                        } else {
                            k4Div.style.display = "none";
                            kecamatanDiv.style.display = "none";
                            kecamatan.required = false;
                        }
                    }

                    function toggleDesaKelurahan() {
                        var k4Input = document.getElementById("k4");
                        var deskelDiv = document.getElementById("deskelDiv");
                        var deskel = document.getElementById("deskel");

                        if (k4Input.value !== "") {
                            deskelDiv.style.display = "block";
                            deskel.required = true;
                        } else {
                            deskelDiv.style.display = "none";
                            deskel.required = false;
                        }
                    }
                </script>


            </div>
        </div>
    </div>
    {{-- <div id="editMultiple" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/editmultiple" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Multiple Wilayah</h4>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tingkatan Wilayah</label>
                            <select class="form-control" name="tingkatan_wilayah" id="tingkatan_wilayah">
                                <option selected>Pilih Tingkatan Wilayah</option>
                                <option value="Provinsi">Provinsi</option>
                                <option value="Kab/Kota">Kab/Kota</option>
                                <option value="Kecamatan">Kecamatan</option>
                                <option value="Desa/Kelurahan">Desa/Kelurahan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Wilayah</label>
                            <select class="form-control" name="wilayah" id="wilayah">
                                <option selected>Pilih Wilayah</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Wilayah</label>
                            <input type="text" value="" class="form-control" id="nama_wilayah"
                                name="nama_wilayah" required>
                        </div>
                        <div class="form-group">
                            <label>Kode Wilayah</label>
                            <input type="number" value="" class="form-control" id="kode_wilayah" name="kode_wilayah"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Edit">
                    </div>
                </form>

                <script>
                    document.getElementById("tingkatan_wilayah").addEventListener("change", function() {
                        var tingkatanWilayah = this.value;
                        var wilayahSelect = document.getElementById("wilayah");

                        wilayahSelect.innerHTML = '<option value="" selected>Pilih Wilayah</option>';

                        if (tingkatanWilayah === "Provinsi") {
                            @foreach ($Wilayah as $item)
                                if ("{{ $item->k1 }}" !== "00" && !wilayahSelect.querySelector(
                                        'option[value="{{ $item->k1 }}"]')) {
                                    wilayahSelect.innerHTML +=
                                        '<option value="{{ $item->k1 }}">{{ $item->provinsi }}</option>';
                                }
                            @endforeach
                        } else if (tingkatanWilayah === "Kab/Kota") {
                            @foreach ($Wilayah as $item)
                                if ("{{ $item->k2 }}" !== "00" && !wilayahSelect.querySelector(
                                        'option[value="{{ $item->k1 }}.{{ $item->k2 }}"]')) {
                                    wilayahSelect.innerHTML +=
                                        '<option value="{{ $item->k1 }}.{{ $item->k2 }}">{{ $item->kabkota }}</option>';
                                }
                            @endforeach
                        } else if (tingkatanWilayah === "Kecamatan") {
                            @foreach ($Wilayah as $item)
                                if ("{{ $item->k3 }}" !== "00" && !wilayahSelect.querySelector(
                                        'option[value="{{ $item->k1 }}.{{ $item->k2 }}.{{ $item->k3 }}"]')) {
                                    wilayahSelect.innerHTML +=
                                        '<option value="{{ $item->k1 }}.{{ $item->k2 }}.{{ $item->k3 }}">{{ $item->kecamatan }}</option>';
                                }
                            @endforeach
                        } else if (tingkatanWilayah === "Desa/Kelurahan") {
                            @foreach ($Wilayah as $item)
                                if ("{{ $item->k4 }}" !== "0000" && !wilayahSelect.querySelector(
                                        'option[value="{{ $item->k1 }}.{{ $item->k2 }}.{{ $item->k3 }}.{{ $item->k4 }}"]'
                                    )) {
                                    wilayahSelect.innerHTML +=
                                        '<option value="{{ $item->k1 }}.{{ $item->k2 }}.{{ $item->k3 }}.{{ $item->k4 }}">{{ $item->deskel }}</option>';
                                }
                            @endforeach
                        }
                    });

                    document.getElementById("wilayah").addEventListener("change", function() {
                        var selectedOption = this.options[this.selectedIndex];
                        var tingkatanWilayah = document.getElementById("tingkatan_wilayah");
                        var selected = tingkatanWilayah.options[tingkatanWilayah.selectedIndex];
                        var namaWilayahInput = document.getElementById("nama_wilayah");
                        var kodeWilayahInput = document.getElementById("kode_wilayah");

                        if (selectedOption.value !== "") {
                            namaWilayahInput.value = selectedOption.textContent;
                            if (selected.value == "Provinsi") {           
                                var values = selectedOption.value.split(".");                     
                                kodeWilayahInput.value = values[0];
                            }
                            else if (selected.value == "Kab/Kota") {           
                                var values = selectedOption.value.split(".");                     
                                kodeWilayahInput.value = values[1];
                            }
                            else if (selected.value == "Kecamatan") {           
                                var values = selectedOption.value.split(".");                     
                                kodeWilayahInput.value = values[2];
                            }
                            else if (selected.value == "Desa/Kelurahan") {           
                                var values = selectedOption.value.split(".");                     
                                kodeWilayahInput.value = values[3];
                            }
                        } else {
                            namaWilayahInput.value = "";
                        }
                    });
                </script>
            </div>
        </div>
    </div>
    <div id="editSelect" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/editselect" method="POST" id="form_edit_select">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Select</h4>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tingkatan Wilayah</label>
                            <select class="form-control" name="tingkatan_wilayah" id="tingkatan_wilayah_select">
                                <option selected>Pilih Tingkatan Wilayah</option>
                                <option value="Provinsi">Provinsi</option>
                                <option value="Kab/Kota">Kab/Kota</option>
                                <option value="Kecamatan">Kecamatan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Wilayah</label>
                            <select class="form-control" name="wilayah" id="wilayah_select">
                                <option selected>Pilih Wilayah</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Wilayah</label>
                            <ul class="list-unstyled mb-0" id="checkboxWilayah">
                            </ul>
                        </div>
                        <input type="hidden" value="" name="hasil_checkbox">
                        <div class="form-group">
                            <label>Nama Wilayah Baru</label>
                            <input type="text" value="" class="form-control" id="nama_wilayah_baru"
                                name="nama_wilayah" required>
                        </div>
                        <div class="form-group">
                            <label>Kode Wilayah</label>
                            <input type="number" class="form-control" id="kode_wilayah_baru" name="kode_wilayah"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Edit">
                    </div>
                </form>

                <script>
                    document.getElementById("tingkatan_wilayah_select").addEventListener("change", function() {
                        var tingkatanWilayah = this.value;
                        var wilayahSelect = document.getElementById("wilayah_select");
                        var namaWilayahInput = document.getElementById("nama_wilayah");

                        wilayahSelect.innerHTML = '<option value="" selected>Pilih Wilayah</option>';

                        if (tingkatanWilayah === "Provinsi") {
                            @foreach ($Wilayah as $item)
                                if ("{{ $item->k1 }}" !== "00" && !wilayahSelect.querySelector(
                                        'option[value="{{ $item->k1 }}"]')) {
                                    wilayahSelect.innerHTML +=
                                        '<option value="{{ $item->k1 }}">{{ $item->provinsi }}</option>';
                                }
                            @endforeach
                        } else if (tingkatanWilayah === "Kab/Kota") {
                            @foreach ($Wilayah as $item)
                                if ("{{ $item->k2 }}" !== "00" && !wilayahSelect.querySelector(
                                        'option[value="{{ $item->k1 }}.{{ $item->k2 }}"]')) {
                                    wilayahSelect.innerHTML +=
                                        '<option value="{{ $item->k1 }}.{{ $item->k2 }}">{{ $item->kabkota }}</option>';
                                }
                            @endforeach
                        } else if (tingkatanWilayah === "Kecamatan") {
                            @foreach ($Wilayah as $item)
                                if ("{{ $item->k3 }}" !== "00" && !wilayahSelect.querySelector(
                                        'option[value="{{ $item->k1 }}.{{ $item->k2 }}.{{ $item->k3 }}"]')) {
                                    wilayahSelect.innerHTML +=
                                        '<option value="{{ $item->k1 }}.{{ $item->k2 }}.{{ $item->k3 }}">{{ $item->kecamatan }}</option>';
                                }
                            @endforeach
                        }
                    });

                    document.getElementById("wilayah_select").addEventListener("change", function() {
                        var selectedOption = this.options[this.selectedIndex];
                        var namaWilayahInput = document.getElementById("nama_wilayah_baru");
                        var tingkatanWilayah = document.getElementById("tingkatan_wilayah_select");
                        var selected = tingkatanWilayah.options[tingkatanWilayah.selectedIndex];
                        var kodeWilayahInput = document.getElementById("kode_wilayah_baru");

                        if (selectedOption.value !== "") {
                            namaWilayahInput.value = selectedOption.textContent;
                            if (selected.value == "Provinsi") {           
                                var values = selectedOption.value.split(".");                     
                                kodeWilayahInput.value = values[0];
                            }
                            else if (selected.value == "Kab/Kota") {           
                                var values = selectedOption.value.split(".");                     
                                kodeWilayahInput.value = values[1];
                            }
                            else if (selected.value == "Kecamatan") {           
                                var values = selectedOption.value.split(".");                     
                                kodeWilayahInput.value = values[2];
                            }
                        } else {
                            namaWilayahInput.value = "";
                        }
                    });

                    document.getElementById("wilayah_select").addEventListener("change", function() {
                        var tingkatanWilayah = this.value;
                        var wilayahSelect = document.getElementById("checkboxWilayah");

                        wilayahSelect.innerHTML = '';

                        @foreach ($Wilayah as $item)
                            if (tingkatanWilayah === "{{ $item->k1 }}") {
                                if ("{{ $item->k2 }}" !== "00" && !wilayahSelect.querySelector(
                                        'li[id="{{ $item->k1 }}.{{ $item->k2 }}"]')) {
                                    wilayahSelect.innerHTML +=
                                        '<li class="d-inline-block" style="margin-right: 10px" id="{{ $item->k1 }}.{{ $item->k2 }}">' +
                                        '<div class="form-check">' +
                                        '<div class="checkbox">' +
                                        '<input type="checkbox" name="checkbox_wilayah" value="{{ $item->k1 }}.{{ $item->k2 }}" id="checkbox{{ $item->kode }}" class="form-check-input">' +
                                        '<label for="checkbox{{ $item->kode }}">{{ $item->kabkota }}</label>' +
                                        '</div>' +
                                        '</div>' +
                                        '</li>';
                                }
                            } else if (tingkatanWilayah === "{{ $item->k1 }}.{{ $item->k2 }}") {
                                if ("{{ $item->k3 }}" !== "00" && !wilayahSelect.querySelector(
                                        'li[id="{{ $item->k1 }}.{{ $item->k2 }}.{{ $item->k3 }}"]')) {
                                    wilayahSelect.innerHTML +=
                                        '<li class="d-inline-block" style="margin-right: 10px" id="{{ $item->k1 }}.{{ $item->k2 }}.{{ $item->k3 }}">' +
                                        '<div class="form-check">' +
                                        '<div class="checkbox">' +
                                        '<input type="checkbox" name="checkbox_wilayah" value="{{ $item->k1 }}.{{ $item->k2 }}.{{ $item->k3 }}" id="checkbox{{ $item->kode }}" class="form-check-input">' +
                                        '<label for="checkbox{{ $item->kode }}">{{ $item->kecamatan }}</label>' +
                                        '</div>' +
                                        '</div>' +
                                        '</li>';
                                }
                            } else if (tingkatanWilayah === "{{ $item->k1 }}.{{ $item->k2 }}.{{ $item->k3 }}") {
                                if ("{{ $item->k4 }}" !== "0000" && !wilayahSelect.querySelector(
                                        'li[id="{{ $item->k1 }}.{{ $item->k2 }}.{{ $item->k3 }}.{{ $item->k4 }}"]'
                                    )) {
                                    wilayahSelect.innerHTML +=
                                        '<li class="d-inline-block" style="margin-right: 10px" id="{{ $item->k1 }}.{{ $item->k2 }}.{{ $item->k3 }}.{{ $item->k4 }}">' +
                                        '<div class="form-check">' +
                                        '<div class="checkbox">' +
                                        '<input type="checkbox" name="checkbox_wilayah" value="{{ $item->k1 }}.{{ $item->k2 }}.{{ $item->k3 }}.{{ $item->k4 }}" id="checkbox{{ $item->kode }}" class="form-check-input">' +
                                        '<label for="checkbox{{ $item->kode }}">{{ $item->deskel }}</label>' +
                                        '</div>' +
                                        '</div>' +
                                        '</li>';
                                }
                            }
                        @endforeach
                    });

                    document.getElementById("form_edit_select").addEventListener('submit', function(event) {
                        event.preventDefault();

                        const selectedCheckboxes = Array.from(document.querySelectorAll(
                                'input[name="checkbox_wilayah"]:checked'))
                            .map(checkbox => checkbox.value);

                        document.querySelector('input[name="hasil_checkbox"]').value = selectedCheckboxes.join(',');

                        this.submit();
                    });
                </script>
            </div>
        </div>
    </div> --}}


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function(event) {
                if (event.key === 'Enter') {
                    var searchValue = $(this).val();
                    var searchURL = "/wilayah/" + searchValue;
                    window.location.href = searchURL;
                }
            });
        });
    </script>
</body>

</html>
