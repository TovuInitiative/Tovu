<?php
class posts extends master
{
	var $qPost;
	var $qUser;
	var $qPass;
	var $h_tb;
	var $h_lnk;
	var $h_cnt;
	
	public $message;
	public $qLastInsert;
	public $qRowsAffected;
	var $redirect;
	
	
	function inserter_plain($qPost) {
		//$this->connect() or trigger_error('SQL', E_USER_ERROR);
		$result = $this->dbQuery($qPost);
		$this->qLastInsert = $this->insertId($result); //mysql_insert_id();
        return $this->qLastInsert;
	}
	
	function inserter_nomsg($qPost, $redirect = "index.php") {
		//$this->connect() or trigger_error('SQL', E_USER_ERROR);
		$result = $this->dbQuery($qPost);
		?> <script language="javascript"> location.href="<?php echo $redirect; ?>"; </script> <?php
	}
	
	function inserter_multi($qPost){
		//$this->connect() or trigger_error('SQL', E_USER_ERROR);
		foreach($qPost as $seq_post){
			$query = $seq_post;
			$result = $this->dbQuery($query);
		}
	}
	
	
	
		
}
	
	
?>