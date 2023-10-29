<?php

namespace App\Http\Controllers;

use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WilayahController extends Controller
{
    public function home()
    {
        $Wilayah = Wilayah::get();
        return view('home', compact('Wilayah'));
    }

    public function provinsi($k1)
    {
        $Wilayah = Wilayah::where('k1', $k1)->get();
        return view('provinsi', compact('Wilayah'));
    }

    public function kabkota($k2)
    {
        $kodePotongan = explode('.', $k2);
        $kode1 = $kodePotongan[0];
        $kode2 = $kodePotongan[1];
        $Wilayah = Wilayah::where('k1', $kode1)->where('k2', $kode2)->get();
        return view('kabupaten', compact('Wilayah'));
    }

    public function kecamatan($k3)
    {
        $kodePotongan = explode('.', $k3);
        $kode1 = $kodePotongan[0];
        $kode2 = $kodePotongan[1];
        $kode3 = $kodePotongan[2];
        $Wilayah = Wilayah::where('k1', $kode1)->where('k2', $kode2)->where('k3', $kode3)->get();
        return view('kecamatan', compact('Wilayah'));
    }

    // public function deskel($k4)
    // {
    //     $kodePotongan = explode('.', $k4);
    //     $kode1 = $kodePotongan[0];
    //     $kode2 = $kodePotongan[1];
    //     $kode3 = $kodePotongan[2];
    //     $kode4 = $kodePotongan[3];
    //     $Wilayah = Wilayah::where('k1', $kode1)->where('k2', $kode2)->where('k3', $kode3)->where('k4', $kode4)->get();
    //     return view('deskel', compact('Wilayah'));
    // }

    public function index()
    {
        $Wilayah = Wilayah::paginate(200);
        return view('index', compact('Wilayah'));
    }

    public function search($search)
    {
        $query = Wilayah::query();

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('kode', 'like', '%' . $search . '%')
                    ->orWhere('k1', 'like', '%' . $search . '%')
                    ->orWhere('k2', 'like', '%' . $search . '%')
                    ->orWhere('k3', 'like', '%' . $search . '%')
                    ->orWhere('k4', 'like', '%' . $search . '%')
                    ->orWhere('provinsi', 'like', '%' . $search . '%')
                    ->orWhere('kabkota', 'like', '%' . $search . '%')
                    ->orWhere('kecamatan', 'like', '%' . $search . '%')
                    ->orWhere('deskel', 'like', '%' . $search . '%');
            });
        }

        $Wilayah = $query->paginate(200);

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

        return redirect()->back();
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

        return redirect()->back();
    }

    public function hapus($kode)
    {
        $Wilayah = Wilayah::where('kode', $kode)->first();

        $sql = "DELETE FROM `00_`.`md_wilayah_administrasi` WHERE kode = '$Wilayah->kode';\n";

        $sqlFilePath = public_path('sql/logfile.sql');

        file_put_contents($sqlFilePath, $sql, FILE_APPEND);

        $Wilayah->delete();

        return redirect()->back();
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
            $wilayah = Wilayah::where('k1', $selectedWilayah)->get();

            $cek = Wilayah::where('k1', $selectedWilayah)->where('k1', $kodeWilayahBaru)->whereRaw("BINARY provinsi != ?", [$namaWilayah])->get();

            foreach ($wilayah as $wil) {
                if ($wil->k1 == $kodeWilayahBaru) {
                    if ($wil->provinsi != $namaWilayah) {
                        $wil->provinsi = $namaWilayah;
                        $wil->update();
                    }
                } else {
                    $kodePotongan = explode('.', $wil->kode);
                    $kodePotongan[0] = $kodeWilayahBaru;
                    $kodeKeseluruhanBaru = implode('.', $kodePotongan);
                    $wil->k1 = $kodeWilayahBaru;

                    if ($wil->provinsi == $namaWilayah) {
                        $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kode = '$kodeKeseluruhanBaru', k1 = '$kodeWilayahBaru' WHERE kode = '$wil->kode';\n";
                    } else {
                        $wil->provinsi = $namaWilayah;
                        $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kode = '$kodeKeseluruhanBaru', k1 = '$kodeWilayahBaru', provinsi = '$namaWilayah' WHERE kode = '$wil->kode';\n";
                    }

                    $sqlFilePath = public_path('sql/logfile.sql');
                    file_put_contents($sqlFilePath, $sql, FILE_APPEND);
                    $wil->kode = $kodeKeseluruhanBaru;
                    $wil->update();
                }
            }

            if (count($cek) != 0) {
                $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET provinsi = '$namaWilayah' WHERE k1 = '$selectedWilayah';\n";
                $sqlFilePath = public_path('sql/logfile.sql');
                file_put_contents($sqlFilePath, $sql, FILE_APPEND);
            }
        } elseif ($tingkatanWilayah === 'Kab/Kota') {
            $potonganWilayah = explode('.', $selectedWilayah);
            $wilayah = Wilayah::where('k1', $potonganWilayah[0])->where('k2', $potonganWilayah[1])->get();

            $cek = Wilayah::where('k1', $potonganWilayah[0])->where('k2', $potonganWilayah[1])->where('k2', $kodeWilayahBaru)->whereRaw("BINARY kabkota != ?", [$namaWilayah])->get();

            foreach ($wilayah as $item) {
                if ($item->k2 == $kodeWilayahBaru) {
                    if ($item->kabkota != $namaWilayah) {
                        $item->kabkota = $namaWilayah;
                        $item->update();
                    }
                } else {
                    $kodePotongan = explode('.', $item->kode);
                    $kodePotongan[1] = $kodeWilayahBaru;
                    $kodeKeseluruhanBaru = implode('.', $kodePotongan);
                    $item->k2 = $kodeWilayahBaru;

                    if ($item->kabkota == $namaWilayah) {
                        $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kode = '$kodeKeseluruhanBaru', k2 = '$kodeWilayahBaru' WHERE kode = '$item->kode';\n";
                    } else {
                        $item->kabkota = $namaWilayah;
                        $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kode = '$kodeKeseluruhanBaru', k2 = '$kodeWilayahBaru', kabkota = '$namaWilayah' WHERE kode = '$item->kode';\n";
                    }

                    $sqlFilePath = public_path('sql/logfile.sql');
                    file_put_contents($sqlFilePath, $sql, FILE_APPEND);
                    $item->kode = $kodeKeseluruhanBaru;
                    $item->update();
                }
            }

            if (count($cek) != 0) {
                $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kabkota = '$namaWilayah' WHERE k1 = '$potonganWilayah[0]' AND k2 = '$potonganWilayah[1]';\n";
                $sqlFilePath = public_path('sql/logfile.sql');
                file_put_contents($sqlFilePath, $sql, FILE_APPEND);
            }
        } elseif ($tingkatanWilayah === 'Kecamatan') {
            $potonganWilayah = explode('.', $selectedWilayah);
            $wilayah = Wilayah::where('k1', $potonganWilayah[0])->where('k2', $potonganWilayah[1])->where('k3', $potonganWilayah[2])->get();

            $cek = Wilayah::where('k1', $potonganWilayah[0])->where('k2', $potonganWilayah[1])->where('k3', $potonganWilayah[2])->where('k3', $kodeWilayahBaru)->whereRaw("BINARY kecamatan != ?", [$namaWilayah])->get();

            foreach ($wilayah as $item) {
                if ($item->k3 == $kodeWilayahBaru) {
                    if ($item->kecamatan != $namaWilayah) {
                        $item->kecamatan = $namaWilayah;
                        $item->update();
                    }
                } else {
                    $kodePotongan = explode('.', $item->kode);
                    $kodePotongan[2] = $kodeWilayahBaru;
                    $kodeKeseluruhanBaru = implode('.', $kodePotongan);
                    $item->k3 = $kodeWilayahBaru;

                    if ($item->kecamatan == $namaWilayah) {
                        $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kode = '$kodeKeseluruhanBaru', k3 = '$kodeWilayahBaru' WHERE kode = '$item->kode';\n";
                    } else {
                        $item->kecamatan = $namaWilayah;
                        $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kode = '$kodeKeseluruhanBaru', k3 = '$kodeWilayahBaru', kecamatan = '$namaWilayah' WHERE kode = '$item->kode';\n";
                    }

                    $sqlFilePath = public_path('sql/logfile.sql');
                    file_put_contents($sqlFilePath, $sql, FILE_APPEND);
                    $item->kode = $kodeKeseluruhanBaru;
                    $item->update();
                }
            }

            if (count($cek) != 0) {
                $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kecamatan = '$namaWilayah' WHERE k1 = '$potonganWilayah[0]' AND k2 = '$potonganWilayah[1]' AND k3 = '$potonganWilayah[2]';\n";
                $sqlFilePath = public_path('sql/logfile.sql');
                file_put_contents($sqlFilePath, $sql, FILE_APPEND);
            }
        } elseif ($tingkatanWilayah === 'Desa/Kelurahan') {
            $wilayah = Wilayah::where('kode', $selectedWilayah)->first();

            $cek = Wilayah::where('kode', $selectedWilayah)->where('k4', $kodeWilayahBaru)->whereRaw("BINARY deskel != ?", [$namaWilayah])->get();

            if ($wilayah->k4 == $kodeWilayahBaru) {
                if ($wilayah->deskel != $namaWilayah) {
                    $wilayah->deskel = $namaWilayah;
                    $wilayah->update();
                }
            } else {
                $kodePotongan = explode('.', $wilayah->kode);
                $kodePotongan[3] = $kodeWilayahBaru;
                $kodeKeseluruhanBaru = implode('.', $kodePotongan);
                $wilayah->k4 = $kodeWilayahBaru;

                if ($wilayah->deskel == $namaWilayah) {
                    $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kode = '$kodeKeseluruhanBaru', k4 = '$kodeWilayahBaru' WHERE kode = '$wilayah->kode';\n";
                } else {
                    $wilayah->deskel = $namaWilayah;
                    $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kode = '$kodeKeseluruhanBaru', k4 = '$kodeWilayahBaru', deskel = '$namaWilayah' WHERE kode = '$wilayah->kode';\n";
                }

                $sqlFilePath = public_path('sql/logfile.sql');
                file_put_contents($sqlFilePath, $sql, FILE_APPEND);
                $wilayah->kode = $kodeKeseluruhanBaru;
                $wilayah->update();
            }

            if (count($cek) != 0) {
                $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET deskel = '$namaWilayah' WHERE kode = '$selectedWilayah';\n";
                $sqlFilePath = public_path('sql/logfile.sql');
                file_put_contents($sqlFilePath, $sql, FILE_APPEND);
            }
        }

        return redirect()->back();
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
            $wilayah = Wilayah::where('k1', $selectedWilayah)->get();

            $potonganCheckbox = explode(',', $checkboxWilayah);

            foreach ($wilayah as $wil) {
                $kodePotongan = explode('.', $wil->kode);
                if (isset($kodePotongan[1])) {
                    $kodeProvinsi = $kodePotongan[0];
                    $kodeKab = $kodePotongan[0] . '.' . $kodePotongan[1];
                    foreach ($potonganCheckbox as $pot) {
                        if ($kodeProvinsi == $selectedWilayah && $pot == $kodeKab) {
                            if ($wil->k1 == $kodeWilayahBaru && $wil->provinsi == $namaWilayah) {
                                return redirect()->back();
                            }
                            if (($wil->k1 != $kodeWilayahBaru && $wil->provinsi != $namaWilayah) || ($wil->k1 == $kodeWilayahBaru && $wil->provinsi == $namaWilayah)) {
                                $wil->provinsi = $namaWilayah;
                                $wil->k1 = $kodeWilayahBaru;
                                $kodePotongan[0] = $kodeWilayahBaru;
                                $kodeKeseluruhanBaru = implode('.', $kodePotongan);

                                $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kode = '$kodeKeseluruhanBaru', k1 = '$kodeWilayahBaru', provinsi = '$namaWilayah' WHERE kode = '$wil->kode';\n";
                                $sqlFilePath = public_path('sql/logfile.sql');
                                file_put_contents($sqlFilePath, $sql, FILE_APPEND);

                                $wil->kode = $kodeKeseluruhanBaru;
                                $wil->update();
                            } else {
                                return redirect()->back()->with('error', 'Jika Kode Wilayah Di Ubah Maka Nama Wilayah Harus Di Ubah, Begitupun Sebaliknya');
                            }
                        }
                    }
                }
            }
        } elseif ($tingkatanWilayah === 'Kab/Kota') {
            $potonganWilayah = explode('.', $selectedWilayah);
            $wilayah = Wilayah::where('k1', $potonganWilayah[0])->where('k2', $potonganWilayah[1])->get();

            $potonganCheckbox = explode(',', $checkboxWilayah);

            foreach ($wilayah as $wil) {
                $kodePotongan = explode('.', $wil->kode);
                if (isset($kodePotongan[1]) && isset($kodePotongan[2])) {
                    $kodeKab = $kodePotongan[0] . '.' . $kodePotongan[1];
                    $kodeKecamatan = $kodePotongan[0] . '.' . $kodePotongan[1] . '.' . $kodePotongan[2];
                    foreach ($potonganCheckbox as $pot) {
                        if ($kodeKab == $selectedWilayah && $pot == $kodeKecamatan) {
                            if ($wil->k2 == $kodeWilayahBaru && $wil->kabkota == $namaWilayah) {
                                return redirect()->back();
                            }
                            if (($wil->k2 != $kodeWilayahBaru && $wil->kabkota != $namaWilayah) || ($wil->k2 == $kodeWilayahBaru && $wil->kabkota == $namaWilayah)) {
                                $wil->kabkota = $namaWilayah;
                                $wil->k2 = $kodeWilayahBaru;
                                $kodePotongan[1] = $kodeWilayahBaru;
                                $kodeKeseluruhanBaru = implode('.', $kodePotongan);

                                $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kode = '$kodeKeseluruhanBaru', k2 = '$kodeWilayahBaru', kabkota = '$namaWilayah' WHERE kode = '$wil->kode';\n";
                                $sqlFilePath = public_path('sql/logfile.sql');
                                file_put_contents($sqlFilePath, $sql, FILE_APPEND);

                                $wil->kode = $kodeKeseluruhanBaru;
                                $wil->update();
                            } else {
                                return redirect()->back()->with('error', 'Jika Kode Wilayah Di Ubah Maka Nama Wilayah Harus Di Ubah, Begitupun Sebaliknya');
                            }
                        }
                    }
                }
            }
        } elseif ($tingkatanWilayah === 'Kecamatan') {
            $potonganWilayah = explode('.', $selectedWilayah);
            $wilayah = Wilayah::where('k1', $potonganWilayah[0])->where('k2', $potonganWilayah[1])->where('k3', $potonganWilayah[2])->get();

            $potonganCheckbox = explode(',', $checkboxWilayah);

            foreach ($wilayah as $wil) {
                $kodePotongan = explode('.', $wil->kode);
                if (isset($kodePotongan[1]) && isset($kodePotongan[2]) && isset($kodePotongan[3])) {
                    $kodeKecamatan = $kodePotongan[0] . '.' . $kodePotongan[1] . '.' . $kodePotongan[2];
                    $kodeDesa = $kodePotongan[0] . '.' . $kodePotongan[1] . '.' . $kodePotongan[2] . '.' . $kodePotongan[3];
                    foreach ($potonganCheckbox as $pot) {
                        if ($kodeKecamatan == $selectedWilayah && $pot == $kodeDesa) {
                            if ($wil->k3 == $kodeWilayahBaru && $wil->kecamatan == $namaWilayah) {
                                return redirect()->back();
                            }
                            if (($wil->k3 != $kodeWilayahBaru && $wil->kecamatan != $namaWilayah) || ($wil->k3 == $kodeWilayahBaru && $wil->kecamatan == $namaWilayah)) {
                                $wil->kecamatan = $namaWilayah;
                                $wil->k3 = $kodeWilayahBaru;
                                $kodePotongan[2] = $kodeWilayahBaru;
                                $kodeKeseluruhanBaru = implode('.', $kodePotongan);

                                $sql = "UPDATE `00_`.`md_wilayah_administrasi` SET kode = '$kodeKeseluruhanBaru', k3 = '$kodeWilayahBaru', kecamatan = '$namaWilayah' WHERE kode = '$wil->kode';\n";
                                $sqlFilePath = public_path('sql/logfile.sql');
                                file_put_contents($sqlFilePath, $sql, FILE_APPEND);

                                $wil->kode = $kodeKeseluruhanBaru;
                                $wil->update();
                            } else {
                                return redirect()->back()->with('error', 'Jika Kode Wilayah Di Ubah Maka Nama Wilayah Harus Di Ubah, Begitupun Sebaliknya');
                            }
                        }
                    }
                }
            }
        }

        return redirect()->back();
    }
}
