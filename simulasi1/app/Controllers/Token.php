<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Usersmodel;
use App\Models\Soalmodel;
use App\Models\Tokenmodel;
use TCPDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Token extends BaseController
{
    protected $usermodel;
    protected $soalmodel;
    protected $tokenmodel;
    public function __construct()
	{
		$this->session = \Config\Services::session();
        $this->usermodel = new Usersmodel();
        $this->soalmodel = new Soalmodel();
        $this->tokenmodel = new Tokenmodel();
	}


    public function checktoken()
    {
        if ($this->session->get("user_nm") == "") {
			return redirect('/');
		} else {
           
            $token = $this->request->getPost('token');
            $materi_id = $this->request->getPost('materi_id');
            $check = $this->tokenmodel->checktoken($token,$materi_id)->getResult();
            if (count($check)>0) {
                $ret = "sukses";
            } else {
                $ret = "gagal";
            }
            echo json_encode($ret);
        }
        
    }
}
