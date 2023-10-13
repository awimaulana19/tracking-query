<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WilayahController extends Controller
{
    public function index()
    {
        $Wilayah = Wilayah::paginate(100);
        return view('index', compact('Wilayah'));
    }

    public function store(Request $request)
    {
        $Wilayah = new Wilayah();

        $Wilayah->kode = 00;
        if ($request->k1) {
            $Wilayah->k1 = $request->k1;
        }
        if ($request->k2) {
            $Wilayah->k2 = $request->k2;
        }
        if ($request->k3) {
            $Wilayah->k3 = $request->k3;
        }
        if ($request->k4) {
            $Wilayah->k4 = $request->k4;
        }
        $Wilayah->provinsi = '';
        if ($request->provinsi) {
            $Wilayah->provinsi = $request->provinsi;
        }
        $Wilayah->kabkota = '';
        if ($request->kabkota) {
            $Wilayah->kabkota = $request->kabkota;
        }
        $Wilayah->kecamatan = '';
        if ($request->kecamatan) {
            $Wilayah->kecamatan = $request->kecamatan;
        }
        $Wilayah->deskel = '';
        if ($request->deskel) {
            $Wilayah->deskel = $request->deskel;
        }

        $Wilayah->save();

        $updateKode = Wilayah::where('kode', $Wilayah->kode)->first();

        $k1 = '';

        if ($request->k1) {
            $k1 = $request->k1;
        }

        $k2 = '';

        if ($request->k2) {
            $k2 = "." . $request->k2;
        }

        $k3 = '';

        if ($request->k3) {
            $k3 = "." . $request->k3;
        }

        $k4 = '';

        if ($request->k4) {
            $k4 = "." . $request->k4;
        }

        $values1 = $k1 . $k2 . $k3 . $k4;

        $updateKode->kode = $values1;

        $updateKode->update();

        $sql = "INSERT INTO `00_`.`md_wilayah_administrasi` VALUES ('$values1', '$updateKode->k1', '$updateKode->k2', '$updateKode->k3', '$updateKode->k4', '$updateKode->provinsi', '$updateKode->kabkota', '$updateKode->kecamatan', '$updateKode->deskel', NOW(), NOW());\n";

        $sqlFilePath = public_path('sql/logfile.sql');

        file_put_contents($sqlFilePath, $sql, FILE_APPEND);

        return redirect('/');
    }

    public function update(Request $request, $kode)
    {
        $WilayahLama = Wilayah::where('kode', $kode)->first();
        $Wilayah = Wilayah::where('kode', $kode)->first();

        if ($request->k1) {
            $Wilayah->k1 = $request->k1;
        }
        if ($request->k2) {
            $Wilayah->k2 = $request->k2;
        }
        if ($request->k3) {
            $Wilayah->k3 = $request->k3;
        }
        if ($request->k4) {
            $Wilayah->k4 = $request->k4;
        }
        $Wilayah->provinsi = '';
        if ($request->provinsi) {
            $Wilayah->provinsi = $request->provinsi;
        }
        $Wilayah->kabkota = '';
        if ($request->kabkota) {
            $Wilayah->kabkota = $request->kabkota;
        }
        $Wilayah->kecamatan = '';
        if ($request->kecamatan) {
            $Wilayah->kecamatan = $request->kecamatan;
        }
        $Wilayah->deskel = '';
        if ($request->deskel) {
            $Wilayah->deskel = $request->deskel;
        }

        $Wilayah->update();

        $k1 = '';

        if ($request->k1 != '00') {
            $k1 = $Wilayah->k1;
        }

        $k2 = '';

        if ($request->k2 != '00') {
            $k2 = "." . $Wilayah->k2;
        }

        $k3 = '';

        if ($request->k3 != '00') {
            $k3 = "." . $Wilayah->k3;
        }

        $k4 = '';

        if ($request->k4 != '0000') {
            $k4 = "." . $Wilayah->k4;
        }

        $values1 = $k1 . $k2 . $k3 . $k4;

        $Wilayah->kode = $values1;

        $Wilayah->update();

        $updates = array();

        if ($values1 == $WilayahLama->kode) {
            $values1 = '';
        } else {
            $updates[] = " kode = '$values1'";
        }

        if ($Wilayah->k1 == $WilayahLama->k1) {
            $Wilayah->k1 = '';
        } else {
            $updates[] = " k1 = '$Wilayah->k1'";
        }

        if ($Wilayah->k2 == $WilayahLama->k2) {
            $Wilayah->k2 = '';
        } else {
            $updates[] = " k2 = '$Wilayah->k2'";
        }

        if ($Wilayah->k3 == $WilayahLama->k3) {
            $Wilayah->k3 = '';
        } else {
            $updates[] = " k3 = '$Wilayah->k3'";
        }

        if ($Wilayah->k4 == $WilayahLama->k4) {
            $Wilayah->k4 = '';
        } else {
            $updates[] = " k4 = '$Wilayah->k4'";
        }

        if ($Wilayah->provinsi == $WilayahLama->provinsi) {
            $Wilayah->provinsi = '';
        } else {
            $updates[] = " provinsi = '$Wilayah->provinsi'";
        }

        if ($Wilayah->kabkota == $WilayahLama->kabkota) {
            $Wilayah->kabkota = '';
        } else {
            $updates[] = " kabkota = '$Wilayah->kabkota'";
        }

        if ($Wilayah->kecamatan == $WilayahLama->kecamatan) {
            $Wilayah->kecamatan = '';
        } else {
            $updates[] = " kecamatan = '$Wilayah->kecamatan'";
        }

        if ($Wilayah->deskel == $WilayahLama->deskel) {
            $Wilayah->deskel = '';
        } else {
            $updates[] = " deskel = '$Wilayah->deskel'";
        }

        $updateString = implode(',', $updates);

        if (!empty($updateString)) {
            $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET$updateString WHERE kode = '$kode';\n";

            $sqlFilePath = public_path('sql/logfile.sql');

            file_put_contents($sqlFilePath, $sql, FILE_APPEND);
        }

        return redirect('/');
    }

    public function hapus($kode)
    {
        $Wilayah = Wilayah::where('kode', $kode)->first();

        $sql = "DELETE FROM `00_`.`md_wilayah_administrasi` WHERE kode = '$Wilayah->kode';\n";

        $sqlFilePath = public_path('sql/logfile.sql');

        file_put_contents($sqlFilePath, $sql, FILE_APPEND);

        $Wilayah->delete();

        return redirect('/');
    }

    public function sesibaru()
    {
        $i = 1;
        $backupFileName = 'sql/logfile' . $i . '.sql';
        $backupFilePath = public_path($backupFileName);

        while (file_exists($backupFilePath)) {
            $i++;
            $backupFileName = 'sql/logfile' . $i . '.sql';
            $backupFilePath = public_path($backupFileName);
        }

        $sqlFileName = 'sql/logfile.sql';
        $sqlFilePath = public_path($sqlFileName);
        rename($sqlFilePath, $backupFilePath);

        $sql = "\n";
        $sql .= "#\n";
        $sql .= "# TRACKING QUERY\n";
        $sql .= "#\n";
        $sql .= "\n";

        file_put_contents($sqlFilePath, $sql);

        return redirect('/sql/logfile' . $i . '.sql');
    }

    public function editMultiple(Request $request)
    {
        $this->validate($request, [
            'tingkatan_wilayah' => 'required',
            'wilayah' => 'required',
            'kode_wilayah' => 'required|numeric',
            'nama_wilayah' => 'required',
        ]);

        $tingkatanWilayah = $request->input('tingkatan_wilayah');
        $selectedWilayah = $request->input('wilayah');
        $kodeWilayahBaru = $request->input('kode_wilayah');
        $namaWilayah = $request->input('nama_wilayah');

        if ($tingkatanWilayah === 'Provinsi') {
            Wilayah::where('k1', $selectedWilayah)->update(['k1' => $kodeWilayahBaru, 'provinsi' => $namaWilayah]);

            $wilayah = Wilayah::where('k1', $kodeWilayahBaru)->get();

            foreach ($wilayah as $wil) {
                $kodePotongan = explode('.', $wil->kode);
                $kodePotongan[0] = $kodeWilayahBaru;
                $kodeKeseluruhanBaru = implode('.', $kodePotongan);

                $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kode = '$kodeKeseluruhanBaru', k1 = '$kodeWilayahBaru', provinsi = '$namaWilayah' WHERE kode = '$wil->kode';\n";
                $sqlFilePath = public_path('sql/logfile.sql');
                file_put_contents($sqlFilePath, $sql, FILE_APPEND);
                $wil->update(['kode' => $kodeKeseluruhanBaru]);
            }
        } elseif ($tingkatanWilayah === 'Kab/Kota') {
            $wilayah = Wilayah::get();

            foreach ($wilayah as $wil) {
                $kodePotongan = explode('.', $wil->kode);
                if (isset($kodePotongan[1])) {
                    $kodeKab = $kodePotongan[0] . '.' . $kodePotongan[1];
                    if ($kodeKab == $selectedWilayah) {
                        $wil->kabkota = $namaWilayah;
                        $wil->k2 = $kodeWilayahBaru;
                        $kodePotongan[1] = $kodeWilayahBaru;
                        $kodeKeseluruhanBaru = implode('.', $kodePotongan);

                        $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kode = '$kodeKeseluruhanBaru', k2 = '$kodeWilayahBaru', kabkota = '$namaWilayah' WHERE kode = '$wil->kode';\n";
                        $sqlFilePath = public_path('sql/logfile.sql');
                        file_put_contents($sqlFilePath, $sql, FILE_APPEND);

                        $wil->kode = $kodeKeseluruhanBaru;
                        $wil->update();
                    }
                }
            }
        } elseif ($tingkatanWilayah === 'Kecamatan') {
            $wilayah = Wilayah::get();

            foreach ($wilayah as $wil) {
                $kodePotongan = explode('.', $wil->kode);
                if (isset($kodePotongan[1]) && isset($kodePotongan[2])) {
                    $kodeKab = $kodePotongan[0] . '.' . $kodePotongan[1] . '.' . $kodePotongan[2];
                    if ($kodeKab == $selectedWilayah) {
                        $wil->kecamatan = $namaWilayah;
                        $wil->k3 = $kodeWilayahBaru;
                        $kodePotongan[2] = $kodeWilayahBaru;
                        $kodeKeseluruhanBaru = implode('.', $kodePotongan);

                        $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kode = '$kodeKeseluruhanBaru', k3 = '$kodeWilayahBaru', kecamatan = '$namaWilayah' WHERE kode = '$wil->kode';\n";
                        $sqlFilePath = public_path('sql/logfile.sql');
                        file_put_contents($sqlFilePath, $sql, FILE_APPEND);

                        $wil->kode = $kodeKeseluruhanBaru;
                        $wil->update();
                    }
                }
            }
        } elseif ($tingkatanWilayah === 'Desa/Kelurahan') {
            $wilayah = Wilayah::where('kode', $selectedWilayah)->first();

            $kodePotongan = explode('.', $wilayah->kode);
            $kodePotongan[3] = $kodeWilayahBaru;
            $kodeKeseluruhanBaru = implode('.', $kodePotongan);

            $wilayah->deskel = $namaWilayah;
            $wilayah->k4 = $kodeWilayahBaru;
            $wilayah->kode = $kodeKeseluruhanBaru;
            $wilayah->update();

            $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kode = '$kodeKeseluruhanBaru', k4 = '$kodeWilayahBaru', deskel = '$namaWilayah' WHERE kode = '$selectedWilayah';\n";
            $sqlFilePath = public_path('sql/logfile.sql');
            file_put_contents($sqlFilePath, $sql, FILE_APPEND);
        }

        return redirect('/');
    }

    public function editSelect(Request $request)
    {
        $this->validate($request, [
            'tingkatan_wilayah' => 'required',
            'wilayah' => 'required',
            'kode_wilayah' => 'required|numeric',
            'hasil_checkbox' => 'required',
            'nama_wilayah' => 'required',
        ]);

        $tingkatanWilayah = $request->input('tingkatan_wilayah');
        $selectedWilayah = $request->input('wilayah');
        $kodeWilayahBaru = $request->input('kode_wilayah');
        $checkboxWilayah = $request->input('hasil_checkbox');
        $namaWilayah = $request->input('nama_wilayah');

        if ($tingkatanWilayah === 'Provinsi') {
            $potonganCheckbox = explode(',', $checkboxWilayah);
            $wilayah = Wilayah::get();

            foreach ($wilayah as $wil) {
                $kodePotongan = explode('.', $wil->kode);
                if (isset($kodePotongan[1])) {
                    $kodeProvinsi = $kodePotongan[0];
                    $kodeKab = $kodePotongan[0] . '.' . $kodePotongan[1];
                    foreach ($potonganCheckbox as $pot) {
                        if ($kodeProvinsi == $selectedWilayah && $pot == $kodeKab) {
                            $wil->provinsi = $namaWilayah;
                            $wil->k1 = $kodeWilayahBaru;
                            $kodePotongan[0] = $kodeWilayahBaru;
                            $kodeKeseluruhanBaru = implode('.', $kodePotongan);

                            $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kode = '$kodeKeseluruhanBaru', k2 = '$kodeWilayahBaru', provinsi = '$namaWilayah' WHERE kode = '$wil->kode';\n";
                            $sqlFilePath = public_path('sql/logfile.sql');
                            file_put_contents($sqlFilePath, $sql, FILE_APPEND);

                            $wil->kode = $kodeKeseluruhanBaru;
                            $wil->update();
                        }
                    }
                }
            }
        } elseif ($tingkatanWilayah === 'Kab/Kota') {
            $potonganCheckbox = explode(',', $checkboxWilayah);
            $wilayah = Wilayah::get();

            foreach ($wilayah as $wil) {
                $kodePotongan = explode('.', $wil->kode);
                if (isset($kodePotongan[1]) && isset($kodePotongan[2])) {
                    $kodeKab = $kodePotongan[0] . '.' . $kodePotongan[1];
                    $kodeKecamatan = $kodePotongan[0] . '.' . $kodePotongan[1] . '.' . $kodePotongan[2];
                    foreach ($potonganCheckbox as $pot) {
                        if ($kodeKab == $selectedWilayah && $pot == $kodeKecamatan) {
                            $wil->kabkota = $namaWilayah;
                            $wil->k2 = $kodeWilayahBaru;
                            $kodePotongan[1] = $kodeWilayahBaru;
                            $kodeKeseluruhanBaru = implode('.', $kodePotongan);

                            $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kode = '$kodeKeseluruhanBaru', k2 = '$kodeWilayahBaru', kabkota = '$namaWilayah' WHERE kode = '$wil->kode';\n";
                            $sqlFilePath = public_path('sql/logfile.sql');
                            file_put_contents($sqlFilePath, $sql, FILE_APPEND);

                            $wil->kode = $kodeKeseluruhanBaru;
                            $wil->update();
                        }
                    }
                }
            }
        } elseif ($tingkatanWilayah === 'Kecamatan') {
            $potonganCheckbox = explode(',', $checkboxWilayah);
            $wilayah = Wilayah::get();

            foreach ($wilayah as $wil) {
                $kodePotongan = explode('.', $wil->kode);
                if (isset($kodePotongan[1]) && isset($kodePotongan[2]) && isset($kodePotongan[3])) {
                    $kodeKecamatan = $kodePotongan[0] . '.' . $kodePotongan[1] . '.' . $kodePotongan[2];
                    $kodeDesa = $kodePotongan[0] . '.' . $kodePotongan[1] . '.' . $kodePotongan[2] . '.' . $kodePotongan[3];
                    foreach ($potonganCheckbox as $pot) {
                        if ($kodeKecamatan == $selectedWilayah && $pot == $kodeDesa) {
                            $wil->kecamatan = $namaWilayah;
                            $wil->k3 = $kodeWilayahBaru;
                            $kodePotongan[2] = $kodeWilayahBaru;
                            $kodeKeseluruhanBaru = implode('.', $kodePotongan);

                            $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kode = '$kodeKeseluruhanBaru', k3 = '$kodeWilayahBaru', kecamatan = '$namaWilayah' WHERE kode = '$wil->kode';\n";
                            $sqlFilePath = public_path('sql/logfile.sql');
                            file_put_contents($sqlFilePath, $sql, FILE_APPEND);

                            $wil->kode = $kodeKeseluruhanBaru;
                            $wil->update();
                        }
                    }
                }
            }
        }

        return redirect('/');
    }
}
