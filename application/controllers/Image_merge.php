<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Image_merge extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('image_lib');
	}
	public function index()
	{
		$this->overlayWatermark('D:\wamp\www\Management\upload\b.jpg');
	}
	public function upload()
	{
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '100';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		$this->load->library('upload', $config);
		$this->upload->do_upload();
		$data = $this->upload->data();
		//for text watermark
		$this->textWatermark($data['full_path']);
		//for overlay watermark
		$this->overlayWatermark($data['full_path']);
	}
	public function textWatermark($source_image)
	{
		$config['source_image'] = $source_image; //The path of the image to be watermarked
		$config['wm_text'] = 'Copyright 2019 Sapphire';
		$config['wm_type'] = 'text';
		$config['wm_font_path'] = 'C:/xampp/htdocs/watermark/system/fonts/texb.ttf';
		$config['wm_font_size'] = '16';
		$config['wm_font_color'] = 'ffffff';
		$config['wm_vrt_alignment'] = 'middle';
		$config['wm_hor_alignment'] = 'center';
		$config['wm_padding'] = '20';
		$this->image_lib->initialize($config);
		if (!$this->image_lib->watermark()) {
			echo $this->image_lib->display_errors();
		}
		echo "<img src='uploads/text.jpg' style='width:600px';/>";
	}
	public function overlayWatermark($source_image)
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = $source_image;
		//$config['new_image'] = $source_image;
		$config['wm_type'] = 'overlay';
		$config['wm_overlay_path'] = 'upload/user.png'; //the overlay image
		$config['wm_opacity'] = 50;
		$config['wm_hor_offset'] = 100;
		$config['wm_vrt_offset'] = 100;
		$config['wm_hor_alignment'] = 'right';
		$config['wm_vrt_alignment'] = 'top';
		$this->image_lib->initialize($config);
		if (!$this->image_lib->watermark()) {
			echo $this->image_lib->display_errors();
		}
		//echo "<img src='uploads/banner2.jpg' style='width:600px';/>";
	}
}