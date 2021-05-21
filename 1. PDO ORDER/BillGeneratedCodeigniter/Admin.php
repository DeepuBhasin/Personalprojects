<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','html','form'));
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Admin_model');
         
    // if(empty($this->session->userdata('did'))) {
             
    //         redirect('Adminlogin');
    //     $this->session->unset_userdata('did_subadmin');

    // }
    
    // else{
        
    //     $this->session->userdata('did_subadmin');
    // }
        
        
        
    }
 
    function dashboard()
    {
       // $data['rigCount']  = $this->Admin_model->get_count('rig', array('status!=' => '2'));
        $data['UserCount'] = $this->Admin_model->get_count('users', array('status!='=>'2','active_status'=>'1'));
        $data['SubadminCount'] = $this->Admin_model->get_count('users', array('status!='=>'2','active_status'=>'2'));
		
        $this->load->view("admin/header");
        $this->load->view("admin/topBar");
        $this->load->view("admin/sideBar");
        $this->load->view("admin/dashboard", $data);
        $this->load->view("admin/footer");
    }


    

    

	function rig()
    {
        $data['Rig'] = $this->Admin_model->get_where_order('users',array('status!='=>'2','active_status'=>'2'),'id','DESC');
        
        $this->load->view("admin/header");
        $this->load->view("admin/topBar");
        $this->load->view("admin/sideBar");
        $this->load->view("admin/rig", $data);
        $this->load->view("admin/footer");
        $this->load->view("admin/common_footer");
    }

    function addsubadmin()
    {
        $name       = $this->input->post('name');
        $email      = $this->input->post('email');
        $number     = $this->input->post('number');
		$images     = $this->input->post('images');
        $district   = $this->input->post('district');
        $address    = $this->input->post('address'); 
        $pin        =$this->input->post('pincode');
        

        $Count = $this->Admin_model->get_count('users', array('phone' => $number,'status !='=>'2'));
        if(empty($Count))
        {

            //$uni_ids  =;
            $RigData = [
                'name'        => $name,
                'email'       => $email,
                'Address'     => $address,
                'phone'       =>$number,
                'district'    =>$district,
                'images'     => $images, 
                'pincode'    =>$pin,
                'status'     => '1', 
                'active_status'=>'2',
                'created_at' => date('Y-m-d H:i:s') 
            ];
			  
            if ($this->Admin_model->insert('users', $RigData))
            {
                $data['status']  = "1";
                $data['message'] = "Added Successfully";
            }
            else
            {
                $data['status']  = "0";
                $data['message'] = "Something went wrong";
            }
        }
        else
        {
            $data['status'] = "2";
            $data['message'] = "phone number already exists";
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function viewsubadmin()
    {
        $data['details'] = $this->Admin_model->get_where_row('users',array('id'=>$this->input->post('id')));
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function editSubAdmin()
    {
        $id         = $this->input->post('id');
        $name       = $this->input->post('name');
        $email      =$this->input->post('email');
        $number     = $this->input->post('number');
        $images     = $this->input->post('images');
        $district   = $this->input->post('district');
        $address    = $this->input->post('address'); 
        $pin        =$this->input->post('pincode');
    
        $RigData = [
                'name'        => $name,
                'email'       => $email,
                'Address'     => $address,
                'phone'       =>$number,
                'district'    =>$district,
                'images'     => $images, 
                'pincode'    =>$pin,
                'status'     => '1',
                'active_status'=>'2', 
                'updated_at' => date('Y-m-d H:i:s') 
        ];
    
        if($this->Admin_model->update('users',$RigData,array('id'=> $id)))
        {
            $data['status'] = "1";
            $data['message'] = " Updated Successfully";
        }
        else
        {
            $data['status'] = "0";
            $data['message'] = "Something went wrong";
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }

    function rigStatus()
    {
        $id=$this->input->post('id');
        $status=$this->input->post('status');

        $data=array(
            'status'=>$status
        );

        $where = array('id'=> $id);

        if($this->Admin_model->update('users',$data,$where))
        {
            $data['status']="1";
            $data['message']=($status==1) ? "Activated Successfully" : "Deactivated Successfully";
        }
        else
        {
            $data['status']="0";
            $data['message']="Something went wrong";
        }

        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    function user()
    {
       $data['wellUser'] = $this->Admin_model->get_where_order('users',array('status!='=>'2','active_status'=>'1'),'id','DESC');
       
        
        $this->load->view("admin/header");
        $this->load->view("admin/topBar");
        $this->load->view("admin/sideBar");
        $this->load->view("admin/well", $data);
        $this->load->view("admin/footer");
        $this->load->view("admin/common_footer");
    }

    function adduser()
    {
       $name       = $this->input->post('name');
        $email      = $this->input->post('email');
        $number     = $this->input->post('number');
        $images     = $this->input->post('images');
        $district   = $this->input->post('district');
        $address    = $this->input->post('address'); 
        $pin    = $this->input->post('pincode'); 

        $Count = $this->Admin_model->get_count('users', array('email' => $email,'status!='=>'2'));
        
            if(empty($Count)){

                
                    $userData = [
                       'name'        => $name,
                        'email'       => $email,
                        'Address'     => $address,
                        'phone'       =>$number,
                        'district'    =>$district,
                        'images'     => $images,
                        'pincode'    =>$pin,
                        'status'     => '1', 
                        'active_status'=>'1',
                        'created_at' => date('Y-m-d H:i:s') 
                    ];
        			  
                    if ($this->Admin_model->insert('users', $userData))
                    {
                        $data['status']  = "1";
                        $data['message'] = "Added Successfully";
                    }
                    else
                    {
                        $data['status']  = "0";
                        $data['message'] = "Something went wrong";
                    }
                }
        
        
        else
        {
            $data['status'] = "3";
            $data['message'] = "Email id already exists";
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function viewWell()
    {
        $data['details'] = $this->Admin_model->get_where_row('users',array('id'=>$this->input->post('id')));
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function editWell()
    {
        $id         = $this->input->post('id');
        $name       = $this->input->post('name');
        $email      =$this->input->post('email');
        $number     = $this->input->post('number');
        $images     = $this->input->post('images');
        $district   = $this->input->post('district');
        $address    = $this->input->post('address'); 
        $pin        =$this->input->post('pincode');
        // $user_id    =$this->input->post('ranid');
    
        $UserData = [
                'name'        => $name,
                'email'       => $email,
                'Address'     => $address,
                'phone'       =>$number,
                'district'    =>$district,
                'images'     => $images, 
                'user_id'   =>substr($district,0,4).rand(1000,10000),
                'pincode'   =>$pin,
                'status'     => '1', 
                'active_status'=>'1',
                'update_at' => date('Y-m-d H:i:s') 
        ];
    
        if($this->Admin_model->update('users',$UserData,array('id'=> $id)))
        {
            $data['status'] = "1";
            $data['message'] = " Updated Successfully";
        }
        else
        {
            $data['status'] = "0";
            $data['message'] = "Something went wrong";
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }

    function wellUserStatus()
    {
        $id=$this->input->post('id');
        $status=$this->input->post('status');
        
        $detail=$this->Admin_model->get_where_row('users',array('id'=>$id));
        $pin_district=$detail->district;
        
        $pin=$this->Admin_model->get_where('users',array('active_status'=>'2','status'=>'1','district'=>$pin_district,'id!='=>$id));
        
        if(empty($pin)){

        $data=array(
            'active_status'=>$status
        );

        $where = array('id'=> $id);

        if($this->Admin_model->update('users',$data,$where))
        {
            $data['status']="1";
            $data['message']=($status==1) ? "subadmin activate Successfully" : "users activate Successfully";
        }
        else
        {
            $data['status']="0";
            $data['message']="Something went wrong";
        }
        }
        else{
            
            $data['status']="2";
            $data['message']="alreay this district subadmin added";
        }

        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }



    function deleteUserStatus()
    {
        $id=$this->input->post('id');
        $status=$this->input->post('status');

        $data=array(
            'status'=>$status
        );

        $where = array('id'=> $id);

        if($this->Admin_model->update('users',$data,$where))
        {
            $data['status']="1";
            $data['message']=($status==1) ? "Activated Successfully" : "Deactivated Successfully";
        }
        else
        {
            $data['status']="0";
            $data['message']="Something went wrong";
        }

        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }
    
    //=======================paid user=====================================================//

    function paid_user(){
   
    // $data['user_paid'] = $this->db->select('*') ->where('MONTH(create_at)', date('m'))->get(" paid_user")->result();
        $data['paid_user']=$this->Admin_model->get_where('paid_user',array());

        $this->load->view("admin/header");
        $this->load->view("admin/topBar");
        $this->load->view("admin/sideBar");
        $this->load->view("admin/paiduser", $data);
        $this->load->view("admin/footer");
        $this->load->view("admin/common_footer");
    }
    
    function add_paid()
   {
   
      $user_id=$this->input->post('user_id');
      $amount=$this->input->post('amount');

      $paidData=[
      
      'user_id'=>$user_id,
      'amount'=>$amount,
      'status'=>'1',
      'date'=> date('Y-m-d'),
      'time'=>date("h:i:sa"),
       ];

       if($this->Admin_model->insert('paid_user',$paidData)){

            $data['status']  = "1";
            $data['message'] = "Added Successfully";
        }
        else
        {
            $data['status']  = "0";
            $data['message'] = "Something went wrong";
        }
        
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;


   }

    function changePassword()
    {
        $this->load->view("admin/header");
        $this->load->view("admin/topBar");
        $this->load->view("admin/sideBar");
        $this->load->view("admin/changePassword");
        $this->load->view("admin/footer");
        $this->load->view("admin/common_footer");
    }
    
    function changePasswordConfirm()
    {
        $admin_id      = $this->session->userdata('did');
        $old_password  = $this->input->post('old_password');
        $new_password  = $this->input->post('new_password');
        $old_password  = md5($old_password);
            
        $Checkdetails = $this->Admin_model->get_where_row('admin',array('id' => $admin_id,'password' => $old_password));
        
        if(empty($Checkdetails))
        {
            $data['status']  = "0";
            $data['message'] = "Old Password is incorrect";
        }
        else
        {
            $new_password   = md5($new_password);
            $iData      = array('password' => $new_password);
            
            if($this->Admin_model->update('admin',$iData,array('id'=> $admin_id)))
            {
              $data['status']  = "1";
              $data['message'] = "Password Changed Successfully";
            }
            else
            {
              $data['status']  = "0";
              $data['message'] = "Something went wrong";
            }
        }
        
        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }

    function settings()
    {
        $data['details'] = $this->Admin_model->get_where_row('settings',array('id'=>'1'));
        
        $this->load->view("admin/header", $data);
        $this->load->view("admin/topBar");
        $this->load->view("admin/sideBar");
        $this->load->view("admin/settings");
        $this->load->view("admin/footer");
        $this->load->view("admin/common_footer");
    }

    function SettingsSave()
    {
        $contact_address  = $this->input->post('contact_address');
        $contact_no       = $this->input->post('contact_no');
        $contact_email    = $this->input->post('contact_email');
        $support_email    = $this->input->post('support_email');

        $iData=[

            'contact_address' => $contact_address,
            'contact_no'      => $contact_no,
            'contact_email'   => $contact_email,
            'support_email'   => $support_email,
        ];

        if($this->Admin_model->update('settings',$iData,array('id'=> '1')))
        {
            $data['status'] = "1";
            $data['message'] = "Settings Update Successfully";
        }
        else
        {
            $data['status'] = "0";
            $data['message'] = "Something went wrong";
        }
        header('Content-type:application/json');
        print json_encode($data);
        exit;       
    }

    function privacyPolicy()
    {
        $data['details'] = $this->Admin_model->get_where_row('settings',array('id'=>'1'));
        
        $this->load->view("admin/header", $data);
        $this->load->view("admin/topBar");
        $this->load->view("admin/sideBar");
        $this->load->view("admin/privacyPolicy");
        $this->load->view("admin/footer");
        $this->load->view("admin/common_footer");
    }

    function PrivacyPolicySave()
    {
        $privacy   = $this->input->post('privacy');
        
        $iData = array('privacy' => $privacy);
        
        if($this->Admin_model->update('settings',$iData,array('id'=> '1')))
        {
            $data['status']  = "1";
            $data['message'] = "Privacy Policy Update Successfully";
        }
        else
        {
            $data['status']  = "0";
            $data['message'] = "Something went wrong";
        }
        
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }

    function termsAndCondition()
    {
        $data['details'] = $this->Admin_model->get_where_row('settings',array('id'=>'1'));
        
        $this->load->view("admin/header", $data);
        $this->load->view("admin/topBar");
        $this->load->view("admin/sideBar");
        $this->load->view("admin/termsAndCondition");
        $this->load->view("admin/footer");
        $this->load->view("admin/common_footer");
    }

    function TermsAndConditionSave()
    {
        $terms   = $this->input->post('terms');
        
        $iData = array('terms' => $terms);
        
        if($this->Admin_model->update('settings',$iData,array('id'=> '1')))
        {
            $data['status']  = "1";
            $data['message'] = "Terms & Condition Update Successfully";
        }
        else
        {
            $data['status']  = "0";
            $data['message'] = "Something went wrong";
        }
        
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }

    function aboutus()
    {
        $data['details'] = $this->Admin_model->get_where_row('settings',array('id'=>'1'));
        
        $this->load->view("admin/header", $data);
        $this->load->view("admin/topBar");
        $this->load->view("admin/sideBar");
        $this->load->view("admin/aboutus");
        $this->load->view("admin/footer");
        $this->load->view("admin/common_footer");
    }

    function aboutusSave()
    {
        $aboutus   = $this->input->post('aboutus');
        
        $iData = array('aboutus' => $aboutus);
        
        if($this->Admin_model->update('settings',$iData,array('id'=> '1')))
        {
            $data['status']  = "1";
            $data['message'] = "About Us Update Successfully";
        }
        else
        {
            $data['status']  = "0";
            $data['message'] = "Something went wrong";
        }
        
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }

    function logout()
    {
        $this->session->unset_userdata('did');
        redirect('adminlogin');
    }

    function profile()
    {
        $admin_id = $this->session->userdata('did');
        $data['details'] = $this->Admin_model->get_where_row('admin',array('id'=>$admin_id));
        
        $this->load->view("admin/header");
        $this->load->view("admin/topBar");
        $this->load->view("admin/sideBar");
        $this->load->view("admin/profile", $data);
        $this->load->view("admin/footer");
        $this->load->view("admin/common_footer");
    }

    function adminProfile()
    {
        $admin_id = $this->session->userdata('did');
        $name     = $this->input->post('name');
        $email    = $this->input->post('email');
        $mobile   = $this->input->post('mobile');
        $address  = $this->input->post('address');

        $iData=[

            'name'    => $name,
            'email'   => $email,
            'mobile'  => $mobile,
            'address' => $address,
        ];

        $details = $this->Admin_model->get_where_row('admin',array('id'=> $admin_id));

        if($this->Admin_model->update('admin',$iData,array('id'=> $admin_id)))
        {
            $data['status'] = "1";
            $data['message'] = "Profile Updated Successfully";

            $sess_data = array( 
                'demail'     => $details->email, 
                'dname'      => $details->name, 
                'dmobile'    => $details->mobile,
                'daddress'   => $details->address,
                'dimage'     => $details->image ? 'admin/'.$details->image : 'admin/admin.png',
                'did'        => $details->id
            );              

            $this->session->set_userdata($sess_data);
        }
        else
        {
            $data['status'] = "0";
            $data['message'] = "Something went wrong";
        }
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }

   //===================message====================================//
    function notification(){

        $data['detail']=$this->Admin_model->get_where_order('notification',array('status!='=>'2'),'id','DESC');
        $this->load->view("admin/header");
        $this->load->view("admin/topBar");
        $this->load->view("admin/sideBar");
        $this->load->view('admin/notification',$data);
        $this->load->view("admin/footer");
    }

    function addmsg()
    {
      
        $msg= $this->input->post('msg'); 
        $title=$this->input->post('title');
        

        

                
                    $userData = [
                        'msg'=>$msg,
                        'title'=>$title,
                        'status'     => '1', 
                        'create_at' => date('d-m-Y') 
                    ];
                      
                    if ($this->Admin_model->insert('notification', $userData))
                    {
                        $data['status']  = "1";
                        $data['message'] = "Added Successfully";
                    }
                    else
                    {
                        $data['status']  = "0";
                        $data['message'] = "Something went wrong";
                    }
                
        
        
        
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function viewmsg()
    {
        $data['details'] = $this->Admin_model->get_where_row('notification',array('id'=>$this->input->post('id')));
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }
    
    function editmsg()
    {
        $id         = $this->input->post('id');
        $name       = $this->input->post('msg');
        $title       =$this->input->post('title');
        
    
        $UserData = [
                'msg'        => $name,
                'title'      =>$title,
                'status'     => '1', 
                'update_at' => date('Y-m-d H:i:s') 
        ];
    
        if($this->Admin_model->update('notification',$UserData,array('id'=> $id)))
        {
            $data['status'] = "1";
            $data['message'] = " Updated Successfully";
        }
        else
        {
            $data['status'] = "0";
            $data['message'] = "Something went wrong";
        }
    
        header('Content-type:application/json');
        print json_encode($data);
        exit;
    }

    function msgUserStatus()
    {
        $id=$this->input->post('id');
        $status=$this->input->post('status');

        $data=array(
            'status'=>$status
        );

        $where = array('id'=> $id);

        if($this->Admin_model->update('notification',$data,$where))
        {
            $data['status']="1";
            $data['message']=($status==1) ? "Activated Successfully" : "Deactivated Successfully";
        }
        else
        {
            $data['status']="0";
            $data['message']="Something went wrong";
        }

        header( 'Content-type:application/json');
        print json_encode( $data);
        exit;
    }


    function unpaid_users()
    {

        $data['unpaid']=$this->Admin_model->get_where('users',array('paid_status'=>'0','status'=>'1'));

        $this->load->view("admin/header");
        $this->load->view("admin/topBar");
        $this->load->view("admin/sideBar");
        $this->load->view("admin/unpaid_user",$data);
        $this->load->view("admin/footer");
        $this->load->view("admin/common_footer");

   }
    
    function subadmin_message(){
        
        $data['message']=$this->Admin_model->get_where('subadmin_message',array());
        $this->load->view("admin/header");
        $this->load->view("admin/topBar");
        $this->load->view("admin/sideBar");
        $this->load->view("admin/subadmin_message",$data);
        $this->load->view("admin/footer");
        $this->load->view("admin/common_footer");
        
        
    }
    
    
   function download_districtwise(){
    
         $query=array();


         if(!empty($this->input->get("district")))
         {

            $query['district']=$this->input->get("district");

         }
        

       $data['student_data'] =$this->Admin_model->get_where('users',$query);
        $this->load->view("admin/header");
        $this->load->view("admin/topBar");
        $this->load->view("admin/sideBar");
        $this->load->view('admin/csv',$data);
        $this->load->view("admin/footer");
        $this->load->view("admin/common_footer");
          
      

    }

   function export()
 {
//   $file_name = 'student_details_on_'.date('Ymd').'.csv'; 
//      header("Content-Description: File Transfer"); 
//      header("Content-Disposition: attachment; filename=$file_name"); 
//      header("Content-Type: application/csv;");
   
//      // get data 
//      $student_data = $this->Admin_model->get_where('users',array());

//      // file creation 
//      $file = fopen('php://output', 'w');
 
//      $header = array("Student Name","Student Phone"); 
//      fputcsv($file, $header);
//      foreach ($student_data as $key => $value)
//      { 
//       fputcsv($file, $value); 
//      }
//      fclose($file); 
//      exit; 
//  }


            header('Content-Type: text/csv; charset=utf-8');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header("Content-Disposition: attachment; filename=backup" . date('y-m-d') . ".csv");
            header('Last-Modified: ' . date('D M j G:i:s T Y'));
            $outss = fopen("php://output", "w");
            
            $query=array();


         if(!empty($this->input->get("district")))
         {
             
           $this->db->where('district', $this->input->get("district"));

         }
         
         
            
            
            $this->db->order_by('ID', 'DESC');
            
            $query = $this->db->get('users');
            foreach ($query->result_array() as $rows) {
                fputcsv($outss, $rows);
            }
            fclose($outss);
            return;
    
    
}
}
?>
