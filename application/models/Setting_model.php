<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model{

	function get_all_app_setting()
    {
        $this->db->where('app_id', 1);
        return $this->db->get('application_setting')->row();
    }

    function update_application_setting()
    {
        $data = [
            'app_name' => $this->input->post('app_name'),
            'app_keywords' => $this->input->post('app_keywords'), 
            'app_meta_title' => $this->input->post('app_meta_title'), 
            'app_meta_description' => $this->input->post('app_meta_description'),
            'footer_about_us' => $this->input->post('footer_about_us'),
            'app_address' => $this->input->post('app_address'), 
            'app_mobile' => $this->input->post('app_mobile'), 
            'app_email' => $this->input->post('app_email'),
            'rozar_key_id' => $this->input->post('rozar_key_id'),
            'rozar_key_secret' => $this->input->post('rozar_key_secret'),
            'head_code' => $this->input->post('head_code'),
            'facebook' => $this->input->post('facebook'),
            'twitter' => $this->input->post('twitter'),
            'youtube' => $this->input->post('youtube'),
            'instagram' => $this->input->post('instagram'),
            'telegram' => $this->input->post('telegram'),
        ];
        if(!empty($_FILES['app_sticky_logo']['name']))
        {
            $app_sticky_logo = $this->get_all_app_setting();
            if(file_exists($app_sticky_logo->app_sticky_logo))
            {
                unlink($app_sticky_logo->app_sticky_logo);
            }
            $_FILES['file']['name'] = $_FILES['app_sticky_logo']['name'];
            $_FILES['file']['type'] = $_FILES['app_sticky_logo']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['app_sticky_logo']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['app_sticky_logo']['error'];
            $_FILES['file']['size'] = $_FILES['app_sticky_logo']['size'];

            // Set preference
            $config['upload_path'] = 'uploads/'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = '5000'; // max_size in kb
            $config['file_name'] = uniqid().$_FILES['app_sticky_logo']['name'];
            $this->upload->initialize($config);
            //Load upload library
            $this->load->library('upload',$config); 

            // File upload
            if($this->upload->do_upload('file'))
            {
                // Get data about the file
                $uploadData = $this->upload->data();
                $filename = $uploadData['file_name'];

                 if (isset($filename)) 
                {
                    $data['app_sticky_logo'] = 'uploads/' . $filename;

                }
            }
        }
        if(!empty($_FILES['app_footer_logo']['name']))
        {
            $app_footer_logo = $this->get_all_app_setting();
            if(file_exists($app_footer_logo->app_footer_logo))
            {
                unlink($app_footer_logo->app_footer_logo);
            }
            $_FILES['file']['name'] = $_FILES['app_footer_logo']['name'];
            $_FILES['file']['type'] = $_FILES['app_footer_logo']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['app_footer_logo']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['app_footer_logo']['error'];
            $_FILES['file']['size'] = $_FILES['app_footer_logo']['size'];

            // Set preference
            $config['upload_path'] = 'uploads/'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = '5000'; // max_size in kb
            $config['file_name'] = uniqid().$_FILES['app_footer_logo']['name'];
            $this->upload->initialize($config);
            //Load upload library
            $this->load->library('upload',$config); 

            // File upload
            if($this->upload->do_upload('file'))
            {
                // Get data about the file
                $uploadData = $this->upload->data();
                $filename = $uploadData['file_name'];

                 if (isset($filename)) 
                {
                    $data['app_footer_logo'] = 'uploads/' . $filename;

                }
            }
        }

        if(!empty($_FILES['fevicon']['name']))
        {
            $app_footer_logo = $this->get_all_app_setting();
            if(file_exists($app_footer_logo->fevicon))
            {
                unlink($app_footer_logo->fevicon);
            }
            $_FILES['file']['name'] = $_FILES['fevicon']['name'];
            $_FILES['file']['type'] = $_FILES['fevicon']['type'];
            $_FILES['file']['tmp_name'] = $_FILES['fevicon']['tmp_name'];
            $_FILES['file']['error'] = $_FILES['fevicon']['error'];
            $_FILES['file']['size'] = $_FILES['fevicon']['size'];

            // Set preference
            $config['upload_path'] = 'uploads/'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = '5000'; // max_size in kb
            $config['file_name'] = uniqid().$_FILES['fevicon']['name'];
            $this->upload->initialize($config);
            //Load upload library
            $this->load->library('upload',$config); 

            // File upload
            if($this->upload->do_upload('file'))
            {
                // Get data about the file
                $uploadData = $this->upload->data();
                $filename = $uploadData['file_name'];

                 if (isset($filename)) 
                {
                    $data['fevicon'] = 'uploads/' . $filename;

                }
            }
        }
        $this->db->where('app_id', 1);
        return $this->db->update('application_setting', $data);
    }

    function get_visual_setting()
    {
        $this->db->where('id', 1);
        return $this->db->get('visual_setting')->row();
    }

    function update_visual_setting()
    {
        $data = [
            'color_1'                   => $this->input->post('color_1'),
            'color_2'                    => $this->input->post('color_2'),
        ];

        $this->db->where('id', 1);
        return $this->db->update('visual_setting', $data);
    }

}
