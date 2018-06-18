<?php

class Paginator{
	var $items_per_page;
	var $items_total;
	var $current_page;
	var $num_pages;
	var $mid_range;
	var $low;
	var $high;
	var $limit;
	var $return;
	var $default_ipp = 10;
	public $custom_ipp;
	var $querystring;

	function Paginator()
	{
		
		$this->current_page = 1;
		$this->mid_range = 7;
		//$this->items_per_page = (!empty($_GET['ipp'])) ? $_GET['ipp']:$this->default_ipp;
		$this->items_per_page = ($this->custom_ipp <> '') ? $this->custom_ipp : $this->default_ipp;
		//$this->items_per_page = $this->default_ipp;
		
	}

	function paginate()
	{
		$this->items_per_page = ($this->custom_ipp <> '') ? $this->custom_ipp : $this->default_ipp;
		//echo $this->items_per_page; exit;
		
		/*if($_GET['ipp'] == 'All') {
			$this->num_pages = ceil($this->items_total/$this->default_ipp);
			$this->items_per_page = $this->default_ipp;
		} else {*/
			if(!is_numeric($this->items_per_page) OR $this->items_per_page <= 0) $this->items_per_page = $this->default_ipp;
			$this->num_pages = ceil($this->items_total/$this->items_per_page);
		//}
		$this->current_page = (int) @$_GET['page']; // must be numeric > 0
		if($this->current_page < 1 Or !is_numeric($this->current_page)) $this->current_page = 1;
		if($this->current_page > $this->num_pages) $this->current_page = $this->num_pages;
		$prev_page = $this->current_page-1;
		$next_page = $this->current_page+1;

        $tab_hash   = "";
        $tab_ignore = array("cmt_sec","cty_sec");
        $tab_paging = false;
        
        $link_attr  = "href";
        
        
		if($_GET)
		{
			$args = explode("&",$_SERVER['QUERY_STRING']); //displayArray($args); echobr(RDR_REF_PATH); 
			foreach($args as $arg)
			{
				$keyval = explode("=",$arg);
				if($keyval[0] != "page" and $keyval[0] != "ipp" and (!in_array($keyval[0], $tab_ignore)) ) { $this->querystring .= "&" . $arg; }
                
                //if($keyval[0] === "cmt_sec") { $tab_hash = "#" . $keyval[1]; }
                if( in_array($keyval[0], $tab_ignore) ) { $tab_hash = "#" . $keyval[1]; $tab_paging = true; }
			}
		}

		if($_POST)
		{
			foreach($_POST as $key=>$val)
			{
				if($key != "page" And $key != "ipp") $this->querystring .= "&$key=$val";
			}
		}
        
        //if($tab_paging === true) { $link_attr  = "data-href"; }
        
        
        $this->querystring .= $tab_hash;
		
		// &ipp=$this->items_per_page$this->querystring // @original &ipp
		if($this->num_pages > 10)
		{
			$this->return = ($this->current_page != 1 And $this->items_total >= 10) ? "<a class=\"paginate\" href=\"".RDR_REF_PATH."?page=$prev_page$this->querystring\">&laquo; Prev</a> ":"<span class=\"inactive\" href=\"#\">&laquo; Prev</span> ";

			$this->start_range = $this->current_page - floor($this->mid_range/2);
			$this->end_range = $this->current_page + floor($this->mid_range/2);

			if($this->start_range <= 0)
			{
				$this->end_range += abs($this->start_range)+1;
				$this->start_range = 1;
			}
			if($this->end_range > $this->num_pages)
			{
				$this->start_range -= $this->end_range-$this->num_pages;
				$this->end_range = $this->num_pages;
			}
			$this->range = range($this->start_range,$this->end_range);

			for($i=1;$i<=$this->num_pages;$i++)
			{
				if($this->range[0] > 2 And $i == $this->range[0]) $this->return .= " ... ";
				// loop through all pages. if first, last, or in range, display
				if($i==1 Or $i==$this->num_pages Or in_array($i,$this->range))
				{
					$this->return .= ($i == $this->current_page And @$_GET['page'] != 'All') ? "<a title=\"Go to page $i of $this->num_pages\" class=\"current\" href=\"#\">$i</a> ":"<a class=\"paginate\" title=\"Go to page $i of $this->num_pages\" ".$link_attr."=\"".RDR_REF_PATH."?page=$i$this->querystring\">$i</a> ";	//&ipp=$this->items_per_page
				}
				if($this->range[$this->mid_range-1] < $this->num_pages-1 And $i == $this->range[$this->mid_range-1]) $this->return .= " ... ";
			}
			$this->return .= (($this->current_page != $this->num_pages And $this->items_total >= 10) And (@$_GET['page'] != 'All')) ? "<a class=\"paginate\" href=\"".RDR_REF_PATH."?page=$next_page$this->querystring\">Next &raquo;</a>\n":"<span class=\"inactive\" href=\"#\">Next &raquo;</span>\n";	//&ipp=$this->items_per_page
			
		}
		else
		{
            /* PAGE NUMBERING */
			for($i=1;$i<=$this->num_pages;$i++)
			{
				$this->return .= ($i == $this->current_page) ? "<a class=\"current\" href=\"#\">$i</a> ":"<a class=\"paginate\" ".$link_attr."=\"".RDR_REF_PATH."?page=$i$this->querystring\">$i</a> "; 	//&ipp=$this->items_per_page
			}
		}
		if($this->current_page < 1 Or !is_numeric($this->current_page)) 
		{
			$this->low = 0;
		} else
		{
			$this->low = ($this->current_page-1) * $this->items_per_page;
		}
		$this->high = (@$_GET['ipp'] == 'All') ? $this->items_total:($this->current_page * $this->items_per_page)-1;
		$this->limit = (@$_GET['ipp'] == 'All') ? "":" LIMIT $this->low,$this->items_per_page";
	}

	function display_items_per_page()
	{
		$items = '';
		$ipp_array = array(10,25,50,100,200); //'All'
		foreach($ipp_array as $ipp_opt)	$items .= ($ipp_opt == $this->items_per_page) ? "<option selected value=\"$ipp_opt\">$ipp_opt</option>\n":"<option value=\"$ipp_opt\">$ipp_opt</option>\n";
		return "<span class=\"paginate\">Items per page:</span><select class=\"paginate\" onchange=\"window.location='".RDR_REF_PATH."?page=1&ipp='+this[this.selectedIndex].value+'$this->querystring';return false\">$items</select>\n";
	}

	function display_jump_menu()
	{
		$option = "";
		for($i=1;$i<=$this->num_pages;$i++)
		{
			$option .= ($i==$this->current_page) ? "<option value=\"$i\" selected>$i</option>\n":"<option value=\"$i\">$i</option>\n";
		}
		return "<span class=\"paginate\">Page:</span><select class=\"paginate\" onchange=\"window.location='".RDR_REF_PATH."?page='+this[this.selectedIndex].value+'$this->querystring';return false\">$option</select>\n";
	}

	function display_pages()
	{
		return $this->return;
	}
}