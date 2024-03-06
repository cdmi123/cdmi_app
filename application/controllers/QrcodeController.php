<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class QrcodeController extends CI_Controller {

    var $branch_id = 0;

    function __construct(){
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->model('Admission_model');
        $this->branch_id = $this->session->userdata('branch_id');
    }

    public function qrcodeGenerator($id=0)
    {    
        $qrtext = $id; 
        $no = rand(100000,999999);
        
        if($this->branch_id==1){
            $branch_name="Y";
        }else if($this->branch_id==2){
            $branch_name="K";
        }else if($this->branch_id==3){
            $branch_name="U";
        }else if($this->branch_id==4){
            $branch_name="A";
        }


        $this->load->library('ciqrcode');
        
        /* Data */
        //$hex_data   = bin2hex($qrtext);

        $save_name  = $branch_name.'-'.$qrtext.'-'.$no.'.jpg';
        $save_name1  = $branch_name.'-'.$qrtext.'-'.$no;


        /* QR Code File Directory Initialize */
        $dir = 'assets/media/qrcode/';
        if (!file_exists($dir)) {
            mkdir($dir, 0775, true);
        }

            $arr = array(
                'qr_number'=>$save_name1,
            );

            $this->db->where('regno',$id);
            $this->db->update('college_admission',$arr);

        /* QR Configuration  */
        $config['cacheable']    = true;
        $config['imagedir']     = $dir;
        $config['quality']      = true;
        $config['size']         = '1024';
        $config['black']        = array(255,255,255);
        $config['white']        = array(255,255,255);
        $this->ciqrcode->initialize($config);
  
        /* QR Data  */
        $params['data']     = $save_name1;
        $params['level']    = 'H';
        $params['size']     = 12;
        $params['savename'] = FCPATH.$config['imagedir']. $save_name;
        
        $this->ciqrcode->generate($params);

        $img_path = FCPATH.$config['imagedir']. $save_name;

                ob_end_clean();
                header("Content-Type: application/image");
                header("Content-Disposition: attachment; filename=\"".basename($img_path)."\"");
                readfile($img_path);
                exit;  
    }
}