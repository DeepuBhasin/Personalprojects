<?php 

class Model_brands extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/*get the active brands information*/
	public function getActiveBrands()
	{
		$sql = "SELECT * FROM brands WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the brand data */
	public function getBrandData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM brands WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM brands";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('brands', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('brands', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('brands');
			return ($delete == true) ? true : false;
		}
	}
	public function getSingleBrandData($id=null)
	{
		$singleBrandIdData=$this->db->query('SELECT * FROM brands where id='.$id)->row();
		
		$brandDataDetail=$this->db->query('SELECT * FROM branddata where brand_id='.$id.' ORDER BY created_dt DESC')->result();
		return array('singleBrandIdData'=>$singleBrandIdData,'brandDataDetail'=>$brandDataDetail);
	}
	public function makeAction()
	{
		$brand_id=trim($this->input->post('brand_id'));
		$amount=trim($this->input->post('amount'));
		$username=trim($this->input->post('username'));
		$action=trim($this->input->post('variable'));

		$balance=(float) $this->db->query('SELECT balance FROM brands WHERE id='.$brand_id)->row()->balance;

		if($action=='receive')
		{
			$balance=$balance+$amount;
			$insetData=array(
				'brand_id'=>$brand_id,
				'created_dt'=>date('Y-m-d h:i:s'),
				'receive'=>$amount,
				'balance'=>$balance,
				'username'=>$username
				);
		}
		elseif ($action=='weighed')
		{
			if($balance>0)
			{
				$balance=$balance-$amount;

				$insetData=array(
				'brand_id'=>$brand_id,
				'created_dt'=>date('Y-m-d h:i:s'),
				'weighed'=>$amount,
				'balance'=>$balance,
				'username'=>$username
				);
			}
			else
			{
				$this->session->set_flashdata('errors', 'Cannot Performed Action');
				redirect('brands/', 'refresh');
			}	
		}

		
			$check1=$this->db->insert('branddata',$insetData);
			$check2=$this->db->where(['id'=>$brand_id])->update('brands',['balance'=>$balance]);

			if($check1 && $check2)
			{
				$this->session->set_flashdata('success', 'Action Performed Successfuly');
        		redirect('brands/', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('brands/', 'refresh');
			}	

	}
}