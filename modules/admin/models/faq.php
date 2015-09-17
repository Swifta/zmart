<?php defined('SYSPATH') or die('No direct script access.');
class Faq_Model extends Model
{
	public function __construct()
	{	
		parent::__construct();
		$this->db = new Database();
		$this->session = Session::instance();	
	}
	/** ADD FAQ QUESTIONS **/

	public function add_qus($post)
	{
		$result = $this->db->insert("faq", array("question" => ucfirst($post->add_qus), "answer" => $post->answer));
		return 1;
	}
	
	/** GET FAQ COUNT **/
	
	public function get_count()
	{
		$result = $this->db->from("faq")->get();
		return count($result);
	}

	/** GET FAQ QUESTIONS **/

	public function get_questions($offset = "", $record = "")
	{
		$result = $this->db->from("faq")->orderby("faq_id","DESC")->limit($record,$offset)->get();
		return $result;
	}

	/* GET FAQ DATA  */
	
	public function get_one_record($id = "")
	{
		$get_record=$this->db->from("faq")->where(array("faq_id" => $id))->get();
		return $get_record;
	}

	/** EDIT FAQ **/

	public function faq_update($id = "", $question = "",$answer = "")
	{	
		$result=$this->db->update("faq",array("question" => $question, "answer" => $answer), array("faq_id" => $id));
		return 1;	
	}

	/** BLOCK AND UNBLOCK FAQ **/
	
	public function blockunblock_Faq($type="", $id = "")
	{	 
		$status = 0;
		if($type == 1){
			$status = 1;
		}
		$result = $this->db->update("faq", array("faq_status" => $status), array("faq_id" => $id));		
		return count($result);
	}
	
	/** DELETE FAQ **/

	public function delete_faq($id = "")
	{
		$status = $this->db->delete("faq", array("faq_id" => $id));
		return count($status);
	}
}
