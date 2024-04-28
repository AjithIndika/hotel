<?php

class Image_model extends CI_Model {
      function __construct() {
        parent::__construct();
        
    }
    
    public function image_up($image_details) {
       
                $cons['upload_path'] = './'.$image_details['path'].'/';
                $cons['allowed_types'] = 'jpg|png|jpeg';
                $cons['remove_spaces'] = true;
                $cons['overwrite'] = TRUE;
                $cons['max_size'] = '2048000';
                $cons['max_height'] = '768000';
                $cons['max_width'] = '10240000';
                $cons['file_name'] = $image_details['newimage'];

                $this->load->library('upload', $cons);
                if ($this->upload->do_upload()) {
                    $data = array('upload_data' => $this->upload->data());
                }

                $cons['image_library'] = 'gd2';
                $cons['source_image'] = './'.$image_details['path'].'/' .$image_details['newimage'];
                $cons['maintain_ratio'] = TRUE;
                $cons['overwrite'] = TRUE;
                $cons['width'] = 5000;
                $cons['height'] = 5000;

                $this->load->library('image_lib', $cons);
                $this->image_lib->resize();
        
    }
    
    
    public function image_updat_my($id,$data) {
    $this->db->where('id',$id);
    $this->db->update('mywork', $data);
        
    }
    

}
