<?php // THIS IS UNEDITED PRODUCTS CONTROLLER

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Admin_Controller 
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'Products';

        $this->load->model('model_products');
      
        $this->load->helper('url');
    }

    /* 
    * It only redirects to the manage product page
    */
    public function index()
    {
        if(!in_array('viewProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->render_template('products/index', $this->data);  
    }

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
    public function fetchProductData()
    {
        $result = array('data' => array());

        $data = $this->model_products->getProductData();

        foreach ($data as $key => $value) {

           // $store_data = $this->model_stores->getStoresData($value['store_id']);
            // button
            $buttons = '';
            if(in_array('updateProduct', $this->permission)) {
                $buttons .= '<a href="'.base_url('products/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteProduct', $this->permission)) { 
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            } 

            $file_1 = ($value['extract_file'] == "") ? '' : '<a href="'.base_url($value['extract_file']).'" target = "_blank">View upload</a>';
            $file_2 = ($value['phytochemical_file'] == "") ? '' : '<a href="'.base_url($value['phytochemical_file']).'" target = "_blank">View upload</a>'; // dapata table anme
            $file_3 = ($value['antioxidant_file'] == "") ? '' : '<a href="'.base_url($value['antioxidant_file']).'" target = "_blank">View upload</a>';
            $file_4 = ($value['tlc_file'] == "") ? '' : '<a href="'.base_url($value['tlc_file']).'" target = "_blank">View upload</a>';
            $file_5 = ($value['t_flavonoid_file'] == "") ? '' : '<a href="'.base_url($value['t_flavonoid_file']).'" target = "_blank">View upload</a>';
            $file_6 = ($value['t_phenolic_content_file'] == "") ? '' : '<a href="'.base_url($value['t_phenolic_content_file']).'" target = "_blank">View upload</a>';

            $availability = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

            $extraction = ($value['extraction'] == 3) ? '<span class="label label-success">Done</span>' : (($value['extraction'] == 1) ?'<span class="label label-warning">Pending</span>' : '<span class="label label-default">N/A</span>' );
            $phytochem_analysis = ($value['phytochem_analysis'] == 3) ? '<span class="label label-success">Done</span>' : (($value['phytochem_analysis'] == 1) ?'<span class="label label-warning">Pending</span>' : '<span class="label label-default">N/A</span>' );
            $antiox_assay = ($value['antioxidant_assay'] == 3) ? '<span class="label label-success">Done</span>' : (($value['antioxidant_assay'] == 1) ?'<span class="label label-warning">Pending</span>' : '<span class="label label-default">N/A</span>' ); // dapat table name
            $tlc = ($value['tlc'] == 3) ? '<span class="label label-success">Done</span>' : (($value['tlc'] == 1) ?'<span class="label label-warning">Pending</span>' : '<span class="label label-default">N/A</span>' );
            $t_flavonoid = ($value['t_flavonoid'] == 3) ? '<span class="label label-success">Done</span>' : (($value['t_flavonoid'] == 1) ?'<span class="label label-warning">Pending</span>' : '<span class="label label-default">N/A</span>' );   
            $t_phenolic_content = ($value['t_phenolic_content'] == 3) ? '<span class="label label-success">Done</span>' : (($value['t_phenolic_content'] == 1) ?'<span class="label label-warning">Pending</span>' : '<span class="label label-default">N/A</span>' ); 

            $result['data'][$key] = array( 
               $availability,
                $extraction . "<br>" . $file_1,
                $phytochem_analysis . "<br>" . $file_2,
                $antiox_assay . "<br>" . $file_3,
                $tlc . "<br>"  . $file_4,
               $t_flavonoid . "<br>" . $file_5,
               $t_phenolic_content . "<br>" . $file_6,
                $buttons
            );
        } // /foreach

        echo json_encode($result);
    }   

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
    public function create()
    {
        if(!in_array('createProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('availability', 'Availability', 'trim');
        $this->form_validation->set_rules('extraction', 'Extraction', 'trim');
        $this->form_validation->set_rules('phytochem_analysis', 'Phytochemical Analysis', 'trim');
        $this->form_validation->set_rules('antioxidant_assay', 'Antioxidant Assay', 'trim');
        $this->form_validation->set_rules('tlc', 'Thin Layer Chromatograph', 'trim');
        $this->form_validation->set_rules('t_flavonoid', 'Total Flavoid Content', 'trim');
        $this->form_validation->set_rules('t_phenolic_content', 'Total Phenolic Content', 'trim');

        
    
        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                'availability' => $this->input->post('availability'),
                 'extraction' => $this->input->post('extraction'),
                 'phytochem_analysis' => $this->input->post('phytochem_analysis'),
                 'antioxidant_assay' => $this->input->post('antioxidant_assay'),
                 'tlc' => $this->input->post('tlc'),
                 't_flavonoid' => $this->input->post('t_flavonoid'),
                 't_phenolic_content' => $this->input->post('t_phenolic_content'),

            );

            $create = $this->model_products->create($data);
            if($create == true) {
                $this->session->set_flashdata('success', 'Successfully created');
                redirect('products/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('products/create', 'refresh');
            }
        }
        else {
            $this->render_template('products/create', $this->data);
        }   
    }

    /*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */
    public function upload_extraction(){

        $config['upload_path'] = 'assets/images/extraction_cert';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|pdf|png|doc';
        $config['max_size'] = 2000;

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('extraction_file'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['extraction_file']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }

    public function upload_phyto(){
        
        $config['upload_path'] = 'assets/images/phytochem_cert';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|pdf|png|doc';
        $config['max_size'] = 2000;

        //$this->upload->initialize($config);

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('phytochemical_file'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['phytochemical_file']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }


    public function upload_antiox(){

        $config['upload_path'] = 'assets/images/antiox_cert';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|pdf|png|doc';
        $config['max_size'] = 2000;


        //$this->upload->initialize($config);

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('antioxidant_file'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['antioxidant_file']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }

      public function upload_tlc(){

        $config['upload_path'] = 'assets/images/tlc_cert';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|pdf|png|doc';
        $config['max_size'] = 2000;


        //$this->upload->initialize($config);

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('tlc_file'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['tlc_file']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }

     public function upload_t_flavonoid(){

        $config['upload_path'] = 'assets/images/t_flavonoid_cert';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|pdf|png|doc';
        $config['max_size'] = 2000;


        //$this->upload->initialize($config);

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('t_flavonoid_file'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['t_flavonoid_file']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }

     public function upload_t_phenolic_content(){

        $config['upload_path'] = 'assets/images/t_phenolic_cert';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|pdf|png|doc';
        $config['max_size'] = 2000;


        //$this->upload->initialize($config);

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('t_phenolic_content_file'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['t_phenolic_content_file']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }

  
    

    public function update($product_id)
    {      
        if(!in_array('updateProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$product_id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('availability', 'Availability', 'trim');
        $this->form_validation->set_rules('extraction', 'Extraction', 'trim');
        $this->form_validation->set_rules('phytochem_analysis', 'Phytochemical Analysis', 'trim');
        $this->form_validation->set_rules('antioxidant_assay', 'Antioxidant Assay', 'trim');
        $this->form_validation->set_rules('tlc', 'Thin Layer Chromatograph', 'trim');
        $this->form_validation->set_rules('t_flavonoid', 'Total Flavoid Content', 'trim');
        $this->form_validation->set_rules('t_phenolic_content', 'Total Phenolic Content', 'trim');


        if ($this->form_validation->run() == TRUE) {
            // true case

            $data = array(
                'availability' => $this->input->post('availability'),
                'extraction' => $this->input->post('extraction'),
                'phytochem_analysis' => $this->input->post('phytochem_analysis'),
                'antioxidant_assay' => $this->input->post('antioxidant_assay'),
                'tlc' => $this->input->post('tlc'),
                't_flavonoid' => $this->input->post('t_flavonoid'),
                't_phenolic_content' => $this->input->post('t_phenolic_content'),

            );

            if($_FILES['extraction_file']['size'] > 0) {
                $upload_ext = $this->upload_extraction();
                $upload_ext = array('extract_file' => $upload_ext); 
                $this->model_products->update($upload_ext, $product_id);
            }


            if($_FILES['phytochemical_file']['size'] > 0) {
                $upload_phyto = $this->upload_phyto();
                $upload_phyto = array('phytochemical_file' => $upload_phyto); // dapat table anme
                $this->model_products->update($upload_phyto, $product_id);
            }

            if($_FILES['antioxidant_file']['size'] > 0) {
                $upload_antiox = $this->upload_antiox();
                $upload_antiox = array('antioxidant_file' => $upload_antiox);
                $this->model_products->update($upload_antiox, $product_id);
            }

            if($_FILES['tlc_file']['size'] > 0) {
                $upload_tlc = $this->upload_tlc();
                $upload_tlc = array('tlc_file' => $upload_tlc);
                $this->model_products->update($upload_tlc, $product_id);
            }

             if($_FILES['t_flavonoid_file']['size'] > 0) {
                $upload_t_flavonoid= $this->upload_t_flavonoid();
                $upload_t_flavonoid = array('t_flavonoid_file' => $upload_t_flavonoid);
                $this->model_products->update($upload_t_flavonoid, $product_id);
            }

            if($_FILES['t_phenolic_content_file']['size'] > 0) {
                $upload_t_phenolic_content = $this->upload_t_phenolic_content();
                $upload_t_phenolic_content = array('t_phenolic_content_file' => $upload_t_phenolic_content);
                $this->model_products->update($upload_t_phenolic_content, $product_id);
            }



            $update = $this->model_products->update($data, $product_id);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('products/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('products/update/'.$product_id, 'refresh');
            }
        }
        else {
            
            
            // false case        

            $product_data = $this->model_products->getProductData($product_id);
            $this->data['product_data'] = $product_data;
            $this->render_template('products/edit', $this->data); 
        }   
    }

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
    public function remove()
    {
        if(!in_array('deleteProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $product_id = $this->input->post('product_id');

        $response = array();
        if($product_id) {
            $delete = $this->model_products->remove($product_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
    }

}