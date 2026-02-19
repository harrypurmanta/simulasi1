<?php

namespace App\Controllers;
use App\Models\Soalmodel;
use App\Models\Latihanmodel;


class Sikapkerja extends BaseController
{

	protected $soalmodel;
	protected $latihanmodel;
	public function __construct()
	{
		$this->session = \Config\Services::session();
        $this->session->start();
        $this->soalmodel = new Soalmodel();
        $this->latihanmodel = new Latihanmodel();
	}

    public function index()
    {
        $request = \Config\Services::request();
        $materi_id = $request->uri->getSegment(2);
        $data['group'] = $this->latihanmodel->getSKgroup()->getResult();
        return view('front/sikapkerja/sikapkerja',$data);
    }

    public function pilihansk() {
        $request = \Config\Services::request();
        $data['sk_group_id'] = $request->uri->getSegment(3);
        return view('front/sikapkerja/petunjuksoal',$data);
    }

    public function ujian() {
        $request = \Config\Services::request();
        $data['sk_group_id'] = $request->uri->getSegment(3);
        return view('front/sikapkerja/ujian',$data);
    }

	public function petunjuksoal() {
		$sk_group_id = $this->request->getPost('sk_group_id');
        $this->session->set("sk_group_id",$sk_group_id);
        $resused = $this->soalmodel->getMaxUsed($this->session->user_id)->getResult();
        if (count($resused)>0) {
            $used = $resused[0]->maxused + 1;
        } else {
            $used = 1;
        }

        $ret = "<div class='col-lg-12' style='text-align:center;min-height: 400px;color:#000000;'>
        <h1 style='margin:20px;'><b>Penjelasan</b></h1>
        <h4><b>Sebelum mengerjakan tes, bacalah petunjuk pengerjaan tes ini dengan seksama.</b></h4>
        <p style='text-align:justify;font-size:18px;margin:18px;'>Pada tes sikap kerja ini, anda akan dihadapkan pada lima deret(angka/huruf/simbol) yang di pasangkan dengan huruf A, B, C, D dan E. yang terbagi dalam 10 kolom dimana masing-masing kolom
        memiliki pola deret yang berbeda-beda. Sebagai contoh seperti terlihat pada contoh dibawah ini :</p>
        <div style='text-align:center;'>
        <table align='center' border='2' style='width:50%;'>
        <thead>
        <tr>
        <th colspan='5'>Kolom 1</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td>∑</td>
        <td>4</td>
        <td>7</td>
        <td>V</td>
        <td>X</td>
        </tr>
        <tr>
        <td style='font-weight:bold;'>A</td>
        <td style='font-weight:bold;'>B</td>
        <td style='font-weight:bold;'>C</td>
        <td style='font-weight:bold;'>D</td>
        <td style='font-weight:bold;'>E</td>
        </tr>
        </tbody>
        </table>
        </div>

        <p style='text-align:justify;font-size:18px;margin:18px;'>Pada baris bawah huruf A, B, C, D dan E adalah pilihan jawaban nya dan pada baris atas yang berisi deret (angka/huruf/simbol) adalah pasangannya sebagai berikut.</p>
        <ul style='list-style-type: none;font-size:18px;'>
        <li>Pilihan jawaban <b>A</b> dipasangkan dengan simbol <b>∑</b></li>
        <li>Pilihan jawaban <b>B</b> dipasangkan dengan angka  <b>4</b></li>
        <li>Pilihan jawaban <b>C</b> dipasangkan dengan angka  <b>7</b></li>
        <li>Pilihan jawaban <b>D</b> dipasangkan dengan huruf  <b>V</b></li>
        <li>Pilihan jawaban <b>E</b> dipasangkan dengan huruf  <b>X</b></li>
        </ul>
        
        <p style='text-align:justify;font-size:18px;margin:18px;'>Kemudian pada persoalan, anda akan diberikan 4 deret (angka/huruf/simbol). Tugas anda adalah
        menemukan simbol/huruf/angka yang hilang pada setiap soal tersebut. Kemudian pilihlah <b>satu
        jawaban</b> diantara <b></b>lima pilihan jawaban</b> yang sesuai dengan pasangan yang hilang tersebut.</p>


        <div style='text-align:center;'>
        <h4><b>Contoh :</b></h4>
        <table align='center' border='2' style='width:50%;'>
        <thead>
        <tr>
        <th colspan='5'>Kolom 1</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        <td>∑</td>
        <td>4</td>
        <td>7</td>
        <td>V</td>
        <td>X</td>
        </tr>
        <tr>
        <td style='font-weight:bold;'>A</td>
        <td style='font-weight:bold;'>B</td>
        <td style='font-weight:bold;'>C</td>
        <td style='font-weight:bold;'>D</td>
        <td style='font-weight:bold;'>E</td>
        </tr>
        </tbody>
        </table>
        </div>


        <div style='text-align:center;margin-top:20px;'>
        <table align='center' border='1' style='width:40%;'>
        <tbody>
        <tr>
        <td>4</td>
        <td>∑</td>
        <td>7</td>
        <td>V</td>
        </tr>
        </tbody>
        </table>
        </div>

        <div style='text-align:center;margin-top:20px;'>
        <table align='center' border='2' style='width:50%;'>
        <tbody>
        <tr>
        <td style='font-weight:bold;'>A</td>
        <td style='font-weight:bold;'>B</td>
        <td style='font-weight:bold;'>C</td>
        <td style='font-weight:bold;'>D</td>
        <td style='font-weight:bold;'>E</td>
        </tr>
        </tbody>
        </table>
        </div>

        <p style='text-align:justify;font-size:18px;margin:18px;'>Dari 4 deret (angka/huruf/simbol) tersebut, huruf X tidak ada pada soal tersebut. Karena huruf X
        berpasangan dengan pilihan jawaban e, maka pilihlah <b>jawaban e</b> pada pilihan jawaban yang disediakan.</p>

        <h4 style='text-align:justify;font-size:18px;margin:18px;'><b>Hal-hal yang perlu anda perhatikan dalam mengerjakan tes sikap kerja ini adalah:</b></h4>

       <div>
            <ul style='list-style-type: number;text-align:justify;font-size:18px;'>
                <li>Setiap kolom memiliki waktu pengerjaan masing-masing dan jika waktu sudah habis maka secara otomatis akan berpindah ke kolom berikutnya.</li>
                <li>Setelah anda menjawab, secara otomatis soal akan berpindah ke kolom berikutnya.</li>
                <li>Tes ini mengharapakan anda bekerja dengan cepat dan cermat.</li>
            </ul>
        </div>
        <div style='margin-top:18px;text-align:cennter;'><h2>Selamat Mengerjakan</h2></div>

        <div style='margin-top:20px;text-align:cennter;'><button style='font-size: 30px;' class='btn btn-primary' onclick='startujiansk(\"$class_soal\",1,1,$used,\"null\",\"null\")'>Mulai</button></div>
        
    </div>";
        echo json_encode($ret);

    }

    public function sikapkerjaujian() {
        $request = \Config\Services::request();
        $proc = $this->request->getPost("proc");
        $soal_id = $this->request->getPost("soal_id");
        $jawaban_id = $this->request->getPost("jawaban_id");
        $group_id = $this->request->getPost("group_id");
        $no_soal = $this->request->getPost("no_soal");
        $pilihan_nm = $this->request->getPost("pilihan_nm");
        $kolom_id = $this->request->getPost("kolom_id");
        $materi = $this->request->getPost("materi");
        $sk_group_id = $this->request->getPost("sk_group_id");
        $date = date("Y-m-d H:i:s");
        if ($proc == "start") {
            $getUsed = $this->soalmodel->getResponByMateriId($this->session->user_id,$sk_group_id)->getResult();
            if (count($getUsed)>0) {
                $used = $getUsed[0]->used + 1;
                $this->session->set("used",$used);
              } else {
                $used = 1;
                $this->session->set("used",$used);
              }
        }
        
        if ($jawaban_id != "") {
            $data = [
                "jawaban_id" => $jawaban_id,
                "pilihan_nm" => $pilihan_nm,
                "soal_id" => $soal_id,
                "no_soal" => $no_soal,
                "group_id" => $group_id,
                "materi" => $materi,
                "used" => $this->session->used,
                "kolom_id" => $kolom_id,
                "created_user_id" => $this->session->user_id,
                "created_dttm" => $date,
                "session" => $this->session->session
            ];
            $respon_id = $this->soalmodel->simpanResponSK($data);
        }
        $no_soal = $no_soal + 1;
        // if ($proc == "start") {
        //     $kolom_id = $kolom_id + 1;
        // } 

        if ($proc == "persiapan") {
            echo json_encode(array("ret"=>"persiapan", "kolom"=>$kolom_id));
        } else if ($no_soal == 51 && $group_id == 4 && $kolom_id <= 10) {
            echo json_encode(array("ret"=>"persiapan", "kolom"=>$kolom_id));
        } else if ($group_id == 4 && $kolom_id == 11) {
            echo json_encode(array("ret"=>"selesai"));
        } else {
            // print_r($request->uri->getSegment(2));exit;
            $res = $this->soalmodel->getSoalSK($no_soal,4,98,$kolom_id,$sk_group_id)->getResult();
            if (count($res)>0) {
                $ret = "<div class='col-md-12'>
                    <table border='0' style='margin: 0 auto;'>
                        <tbody>
                            <tr style='font-size:75px;font-weight:bold;text-align:center;'>";
                            $getjawaban = $this->soalmodel->getjawaban($res[0]->soal_id)->getResult();
                                foreach ($getjawaban as $key) {
                                    $jawaban_nm = str_split($key->jawaban_nm,1);
                                    foreach ($jawaban_nm as $jwb_nm) {
                                        $ret .= "<td width='70'>$jwb_nm</td>";
                                    }
                                }

                        $ret .= "</tr>
                            <tr style='font-size:35px;font-weight:normal;text-align:center;'>
                                <td>A</td>
                                <td>B</td>
                                <td>C</td>
                                <td>D</td>
                                <td>E</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class='col-md-12' style='width:100%;margin-top:30px;'>
                    <label style='font-size:20px;' for='Pertanyaan'>Pertanyaan ".$no_soal."</label>
                    <div style='display:flex;'>";
                        foreach ($res as $keySoal) {
                            $soal_nm = str_split($keySoal->soal_nm,1);
                            foreach ($soal_nm as $jwb_nm) {
                                $ret .= "<div style='background-color:grey;min-width:70px;min-height:70px;font-size:65px;font-weight:bold;text-align:center;margin:10px;'>
                        ".$jwb_nm."</div>";
                            }
                        }
                        
                $ret .= "</div>
                    <div style='display:flex;'>";
                    foreach ($getjawaban as $k) {
                        $jawaban_id = $k->jawaban_id;
                        $ret .= "<button onclick='startujian(\"next\",\"A\",".$jawaban_id.",".$res[0]->soal_id.",$group_id,$no_soal,$kolom_id,$materi)' style='margin:5px;font-weight:bold;font-size: 20px;'
                        class='btn btn-block btn-outline-success'>A</button>
                    <button onclick='startujian(\"next\",\"B\",".$jawaban_id.",".$res[0]->soal_id.",$group_id,$no_soal,$kolom_id,$materi)' style='margin:5px;font-weight:bold;font-size: 20px;'
                        class='btn btn-block btn-outline-success'>B</button>
                    <button onclick='startujian(\"next\",\"C\",".$jawaban_id.",".$res[0]->soal_id.",$group_id,$no_soal,$kolom_id,$materi)' style='margin:5px;font-weight:bold;font-size: 20px;'
                        class='btn btn-block btn-outline-success'>C</button>
                    <button onclick='startujian(\"next\",\"D\",".$jawaban_id.",".$res[0]->soal_id.",$group_id,$no_soal,$kolom_id,$materi)' style='margin:5px;font-weight:bold;font-size: 20px;'
                        class='btn btn-block btn-outline-success'>D</button>
                    <button onclick='startujian(\"next\",\"E\",".$jawaban_id.",".$res[0]->soal_id.",$group_id,$no_soal,$kolom_id,$materi)' style='margin:5px;font-weight:bold;font-size: 20px;'
                        class='btn btn-block btn-outline-success'>E</button>";
                    }
                        
                $ret .= "</div>
                </div>";
                echo json_encode(array("ret"=>$ret, "kolom"=>$kolom_id,"group_id"=>$group_id,"no_soal"=>$no_soal));
            } else {
                $ret = "soal_tidak_ada";
                echo json_encode(array("ret"=>$ret));
            }
        }
    }

    public function hasiltryout() {
        $request = \Config\Services::request();
        $user_id = $this->session->user_id;
        $materi_id = $request->uri->getSegment(3);
        $klm = $this->soalmodel->getKolomSoal()->getResult();
 
                $data = [
                    "kolom" => $klm
                ];
        return view('front/sikapkerja/hasiltryout',$data);
    }

    public function showresult() {
        $materi = $this->request->getPost('materi_id');
        $benar_passhand = 0;
            $salah_passhand = 0;
            $benar_kec = 0;
            $salah_kec = 0;
            $benar_keb = 0;
            $salah_keb = 0;
            $benar_sk  = 0;
            $salah_sk  = 0;
            $total_skor  = 0;
            $passhandskor = $this->soalmodel->getPasshandSkor($this->session->user_id,$this->session->session,$materi)->getResult();
            foreach ($passhandskor as $key) {
                if ($key->kunci == $key->pilihan_nm) {
                    $benar_passhand = $benar_passhand + 1;
                } else {
                    $salah_passhand = $salah_passhand + 1;
                }
            }

            $kecerdasanskor = $this->soalmodel->getKecerdasanSkor($this->session->user_id,$this->session->session,$materi)->getResult();
            foreach ($kecerdasanskor as $kec) {
                if ($kec->kunci == $kec->pilihan_nm) {
                    $benar_kec = $benar_kec + 1;
                } else {
                    $salah_kec = $salah_kec + 1;
                }
            }

            $kepskor = $this->soalmodel->getKepribadianSkor($this->session->user_id,$this->session->session,$materi)->getResult();
            foreach ($kepskor as $kep) {
                if ($kep->kunci == $kep->pilihan_nm) {
                    $benar_keb = $benar_keb + 1;
                } else {
                    $salah_keb = $salah_keb + 1;
                }
            }

            $sikapkerjaskor = $this->soalmodel->getSikapKerjaSkor($this->session->user_id,$this->session->session,$materi)->getResult();
            foreach ($sikapkerjaskor as $sk) {
                if ($sk->kunci == $sk->pilihan_nm) {
                    $benar_sk = $benar_sk + 1;
                } else {
                    $salah_sk = $salah_sk + 1;
                }
            }

            $total_skor = $benar_passhand + $benar_kec + $benar_keb + $benar_sk;
            if ($total_skor >= 61) {
                $styletotalskor = "color:green;";
                $syarat = "(Memenuhi Syarat - MS)";
            } else {
                $styletotalskor = "color:red;";
                $syarat = "(Tidak Memenuhi Syarat - TMS)";
            }
            $ret = "<div class='col-lg-12'>
                    <a href='".base_url()."/home'><button class='btn btn-primary'>Menu Utama</button></a>
                        <div style='width:100%;text-align:center;'>
                            <h1 style='margin:10px;'>SELAMAT !</h1>
                            <h1 style='margin:10px;'>SKOR ANDA</h1>
                            <h1 style='margin:10px;$styletotalskor'>$total_skor $syarat</h1>
                        </div>
                        <div>
                            <ul>
                            <li>Passhand skor <label>$benar_passhand</label></li>
                            <li>Kecerdasan skor <label>$benar_kec</label></li>
                            <li>Kepribadian skor <label>$benar_keb</label></li>
                            <li>Sikap Kerja skor <label>$benar_sk</label></li>
                            </ul>
                        </div>";
            $ret .= "</div>";
        echo json_encode($ret);
    }
    
}
