<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

  public function __construct() {

    parent::__construct();
    $this->load->helper(array('form','url','html'));
    $this->load->library(array('session', 'form_validation'));
    $this->load->database();
        $this->load->model('Admin_model');  
        
        
     if(empty($this->session->userdata('d_id'))) {
         redirect('userlogin');
     }
  }
  
  function index(){
        
        $this->load->view('users/profile');
       
        
    }

    






    function userprofile(){

       $this->load->view('users/header');
        $this->load->view('users/ff');
        $this->load->view('users/footer');
    }
    
    
    function online_payment(){

        $this->load->view('users/online_payment');
    }
   

function tbl_orders() {

 
   
       $user_id=$this->session->userdata('d_id');
       
       $month=date('m');
       
       $detail=$this->Admin_model->get_where_row('paid_user',array('month'=>$month,'user_id'=>$user_id));
       
       
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
       
        $amount = $this->input->post('amount');

        include 'src/instamojo.php';

$api = new Instamojo\Instamojo('a1c852b01933982188f662749e1df3e2', '770a2be0c1e13ea4c10b5196333d9dcf', 'https://www.instamojo.com/api/1.1/');

       if(empty($detail)){
        try {
            $response = $api->paymentRequestCreate(array(
                "purpose" =>"buy product",
                "amount" => $amount,
                "send_email" => true,
                "email" => $email,
                "send_sms" => true,
                "phone" => $phone,
                "buyer_name" => $name,
                "allow_repeated_payments" => false,
                "redirect_url" => "http://tvomk.com/tvomk/user/scesss?amount=".$amount,
                "webhook" => "http://iappnilgiris.in/demo/juteemporium1/front_end/webhook.php"
                ));

   
            // print_r($response);
            $pay_ulr = $response['longurl'];
            header("Location: $pay_ulr");
            // exit();
        }
        catch (Exception $e) {
            print('Error: ' . $e->getMessage());
        }
       }
       
       else{
           
        //   echo "not failed";
        
        echo '<script language="javascript" type="text/javascript"> 
                alert("you are already paid this month");
                window.location = "http://tvomk.com/tvomk/user/online_payment";
        </script>';
           
       }

       

      

        
    }

    public function scesss()
    {

		$user_id=$this->session->userdata('d_id');
       
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
       
        $amount = $this->input->get('amount');

	 include 'src/instamojo.php';  //Download from website

	 if(!empty($_GET['payment_status']) && $_GET['payment_status']=='Credit')
	   {

	        $payment_request_id = $_GET['payment_request_id'];
	        $payment_id = $_GET['payment_id'];
	        $payment_status = $_GET['payment_status'];
			$Instamojo = new Instamojo\Instamojo('a1c852b01933982188f662749e1df3e2', '770a2be0c1e13ea4c10b5196333d9dcf', 'https://www.instamojo.com/api/1.1/');
			$payment_response = $Instamojo->paymentRequestPaymentStatus($payment_request_id, $payment_id);

	     	if(isset($payment_response['payment']['status']) && $payment_response['payment']['status'] == 'Credit') 
	     	{

			// Old Code
			     // $data=[

			     //   'user_id'=>$user_id,
			     //   'status'=>'1',
			     //   'amount'=>$amount,
			     //   'paid_date'=>date("Y-M-d"),
			     //   'month'=>date("m"),
			     //   'time'=>date("h:i:sa"),

			     // ];
	     	// End of old Code


	     // code by henrry for insertion of Payment Gateway data

	     	// this is the complete response from the sms gateway
	     	$paymentArray = $payment_response['payment'];	
	     	$data=[
		     	'user_id'=>$user_id,
		     	'amount'=>$payment_response['amount'],
		     	'month'=>date("m"),
		     	'status'=>1,
		     	'paid_date'=>date("Y-M-d"),
		     	'time'=>date("h:i:sa"),
		     	'marchent_id'=>$paymentArray['payment_id'],
		     	'phone'=>$paymentArray['buyer_phone'],
		     	'email'=>$paymentArray['buyer_email'],
		     	'buyer_name'=>$paymentArray['buyer_name'],
		     	'purpose'=>$payment_response['purpose'],
		     	'modified_at'=>$payment_response['modified_at'],
		     	'send_sms'=>$payment_response['send_sms'],
		     	'send_email'=>$payment_response['send_email'],
		     	'sms_status'=>$payment_response['sms_status'],
		     	'email_status'=>$payment_response['email_status'],
		     	'created_at'=>$payment_response['created_at'],
		     	'expires_at'=>$payment_response['expires_at'],
                'currency'=>$paymentArray['buyer_ecurrencymail'],
                'quantity'=>$paymentArray['quantity'],
                'total_payment'=>$paymentArray['amount']
		     	];


                 //http://chat-api.phphive.info/login/gui token will generate from this website.

                $chatApiToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2MjM1NjE2NTAsInVzZXIiOiI5MTk1OTcwODE3ODkifQ.3YosWmlCkP0EYG4wbHMy1BU5z7Rb2PW59U-iOyOE1hE";
 
                $number = $paymentArray['buyer_phone']; // buyer number
                $number = str_replace("+","",$number);
                
                $message = nl2br("TVOMK Payment Date: ".date("Y-M-d") ."\n 
                Get your bill on this URL : ".base_url('bill/complete_bill/').$paymentArray['payment_id']);
                $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'http://chat-api.phphive.info/message/send/text',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS =>json_encode(array("jid"=> $number."@s.whatsapp.net", "message" => $message)),
                  CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '.$chatApiToken,
                    'Content-Type: application/json'
                  ),
                ));
                 
                $response = curl_exec($curl);
                curl_close($curl);
                $response = json_decode($response,true);

                $data_whats_app = [
                    'error_status'=>$response['error'],
                    'messageID'=>$response['response']['messageID'],
                    'message'=>$response['response']['message'],
                    'user_id'=>$user_id,
                    'created_dt'=>date("Y-m-d h:i:s")
                ];

                $insert_at=$this->Admin_model->insert('whats_mesage_status',$data_whats_app);

		//end of the by henrry for insertion of Payment Gateway data

		

				$insert_at=$this->Admin_model->insert('paid_user',$data);
			    $update_at=['paid_status'=>'1'];
			    $where=['id'=>$user_id];
				$update=$this->Admin_model->update('users',$update_at,$where);

				$this->session->set_flashdata('message','Payment Done Successful');
				$this->session->set_flashdata('color','success');
			}
	      else
	      {

	      	$this->session->set_flashdata('message','Payment faild');
			$this->session->set_flashdata('color','danger');
	      }


	    }else{
	    	$this->session->set_flashdata('message','Acess Denied');
			$this->session->set_flashdata('color','danger');
	    }
	    return redirect('user/index');


	}
    function profile(){

        $this->load->view('users/profile');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    function updateusers(){

        $id=$this->input->post('id');
        $name=$this->input->post('name');
        $email=$this->input->post('email');
        $phone=$this->input->post('phone');
        $district=$this->input->post('district');
        $pin=$this->input->post('pin');
        $img=$this->input->post('profile');

        $data=[

                'name'        => $name,
                'email'       => $email,
                'phone'       =>$phone,
                'district'    =>$district,
                'images'     => $img, 
                'pincode'    => $pin,
                'status'     => '1', 
                'created_at' => date('Y-m-d H:i:s') 
        
        ];
        $where=array('id'=>$id);

        $update=$this->Admin_model->update('users',$data,$where);

        if(!empty($update)){

               echo '<script language="javascript" type="text/javascript"> ';
    echo 'alert("message successfully Inserted")';//msg
    echo '</script>';
    redirect('User');
            }
            else
            {
                echo '<script language="javascript">';
                echo 'alert("something went wrong")';
                echo '</script>';
            }

            // header('Content-type:application/json');
            // print json_encode($data);
            // exit;
 
    }

    function logout()
    {
        $this->session->unset_userdata('d_id');
        redirect('userlogin');
    }

    function editprofile(){

        $data['detail_edit']=$this->Admin_model->get_where('postal_pincode',array());

        $this->load->view('users/editprofile',$data);
    }

    function notification(){

        $data['detail']=$this->Admin_model->get_where('notification',array());

        $this->load->view('users/notification',$data);
    }

    function notification_save(){
    
    $user_id=$this->session->userdata('d_id');
    $details=$this->Admin_model->get_where('notification',array());

    foreach($details as $key=>$value){
       
       $msg=$value->id;

    


    $data=[
        'user_id'=>$user_id,
        'noti_id'=>$msg,
       
    ];

    $insert=$this->Admin_model->insert('final_notification',$data);
     }

    }

    public function pdf($id=null)
    {
        $data['users_detail']=$this->Admin_model->get_where_row('users',array('id'=>$id));
        $mpdf = new \Mpdf\Mpdf();
        $html = $this->load->view('users/idcard',$data,true);
        $mpdf->WriteHTML($html);
        $mpdf->Output("Your id Card.pdf","D");
    }
    
    
    public function payment_history(){
        
    $user_id=$this->session->userdata('d_id');
    $data['userspaid']=$this->Admin_model->get_where('paid_user',array('user_id'=>$user_id));
     $this->load->view('users/payment_history',$data);
        
    }


    
}


    
    
