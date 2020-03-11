<?php

if ( ! function_exists('getallcategorys'))
{
	function getallcategorys($array)
	{
		$ci = get_instance();
		$ci->load->model('model_category');
		$allcategory= array();	
    	$results = $ci->model_category->getcategorys(0);
		if ($results) {  
			foreach($results as $val){
				$subresults = $ci->model_category->getcategorys($val->id);
				$subcategory= array();	 
				if ($subresults) { 
					foreach($subresults as $val1){

						$subresults1 = $ci->model_category->getcategorys($val1->id);
						$subcategory1= array();	 
						if ($subresults1) { 
							foreach($subresults1 as $val2){
								$subcategory1[] = array(
									'id' => $val2->id,
									'name' => $val2->name,
									'footerservices' => $val2->footerservices,
									'shortdescription' => $val2->shortdescription,
									'image' => $val2->image,
									'homeicon' => $val2->homeicon,
									'homehead' => $val2->homehead,
									'homecontent' => $val2->homecontent,
									'href' => base_url().$val2->linkname
								);
							}
						}
												
						
						$subcategory[] = array(
											
							'id' => $val1->id,
							'name' => $val1->name,
							'footerservices' => $val1->footerservices,
							'shortdescription' => $val1->shortdescription,	
							'image' => $val1->image,
							'homeicon' => $val1->homeicon,
							'homehead' => $val1->homehead,
							'homecontent' => $val1->homecontent,				
							'child' => $subcategory1,
							'href' => base_url().$val1->linkname
						);
					}
				}
				$allcategory[] = array(
					'id' => $val->id,
					'name' => $val->name,
					'footerservices' => $val->footerservices,
					'shortdescription' => $val->shortdescription,	
					'image' => $val->image,	
					'homeicon' => $val->homeicon,
					'homehead' => $val->homehead,
					'homecontent' => $val->homecontent,	
					'child' => $subcategory,
					'href' => base_url().$val->linkname
				);
			}
		}

		return $allcategory;
	}
}


if ( ! function_exists('getblog'))
{
	function getblog($array)
	{
		$ci = get_instance();
		$ci->load->model('model_blog');
		$allcategory= array();	
    	$results = $ci->model_blog->getcategorys(0);
		if ($results) {  
			foreach($results as $val){
				$subresults = $ci->model_blog->getcategorys($val->id);				
				$allcategory[] = array(
					'id' => $val->id,
					'name' => $val->name,
					'shortdescription' => $val->shortdescription,	
					'image' => $val->image,						
					'href' => base_url().$val->linkname
				);
			}
		}

		return $allcategory;
	}
}







if ( ! function_exists('getpages'))
{
	function getpages($array)
	{
		$ci = get_instance();
		$ci->load->model('model_category');
		$allcategory= array();	
    	$results = $ci->model_category->getpages(0);
		if ($results) {  
			foreach($results as $val){
				$subresults = $ci->model_category->getpages($val->id);
				$subcategory= array();	 
				if ($subresults) { 
					foreach($subresults as $val1){

						$subresults1 = $ci->model_category->getpages($val1->id);
						$subcategory1= array();	 
						if ($subresults1) { 
							foreach($subresults1 as $val2){
								$subcategory1[] = array(
									'id' => $val2->id,
									'name' => $val2->name,
									'home' => $val->home,
									'href' => base_url().$val2->linkname
								);
							}
						}
						$subcategory[] = array(
							'id' => $val1->id,
							'name' => $val1->name,							
							'home' => $val->home,
							'child' => $subcategory1,
							'href' => base_url().$val1->linkname
						);
					}
				}
				$allcategory[] = array(
					'id' => $val->id,
					'name' => $val->name,
					'home' => $val->home,
					'child' => $subcategory,
					'href' => base_url().$val->linkname
				);
			}
		}

		return $allcategory;
	}
}




if ( ! function_exists('getselectcountry'))
{
	function getselectcountry($array)
	{
		$ci = get_instance();
		$ci->load->model('model_category');
		$allcategory= array();	
    	$results = $ci->model_category->getselectcountry(0);
		if ($results) {  
			foreach($results as $val){
				$allcategory[] = array(
					'id' => $val->id,
					'countryhead' => $val->countryhead,
					'bannerhead' => $val->bannerhead,
					'countryyes' => $val->countryyes,
					'flagiocn' => $val->flagiocn,
					'countryyes' => $val->countryyes,					
					'href' => base_url().$val->linkname
				);
			}
		}

		return $allcategory;
	}
}






if ( ! function_exists('getfoooterservices'))
{
	function getfoooterservices($array)
	{
		$ci = get_instance();
		$ci->load->model('model_category');
		$allcategory= array();	
    	$results = $ci->model_category->getselectcountry(0);
		if ($results) {  
			foreach($results as $val){
				$allcategory[] = array(
					'id' => $val->id,
					'name' => $val->name,
					'footerservices' => $val->footerservices,		
								
					'href' => base_url().$val->linkname
				);
			}
		}

		return $allcategory;
	}
}




if ( ! function_exists('webdata'))
{
	function webdata()
	{
		$ci = get_instance();
		$ci->load->model('model_setting');
		$webdata = $ci->model_setting->getwebsiteinfo();
		return $webdata;
	}
}




if ( ! function_exists('questionlangauge'))
{
	function questionlangauge($language)
	{
		$hindiselect="";
		$englishselect="";
		if($language=='hindi'){
			$hindiselect="selected";
		}
		else{
			$englishselect="selected";			
		}
		$data="<option value='hindi'".$hindiselect.">Hindi</option>";
		$data.="<option value='english'".$englishselect.">English</option>";

		return $data;
	}
}



if ( ! function_exists('adminmenu'))
{
	function adminmenu()
	{
		$ci = get_instance();
		$ci->load->model('model_setting');
		$user_id=$ci->session->userdata('logged_in')['id'];
		$results = $ci->model_setting->getadminmenu($user_id);
		$data="";
		if($results){
			foreach($results as $result){
				$data.='<li><a href="'.base_url(adminpath.'/'.$result->linkname).'"><i class="fa fa-edit"></i> '.$result->name.' </a> </li>';
			}
		}
		return $data;
	}
}


if ( ! function_exists('allmenu'))
{
	function allmenu()
	{
		$ci = get_instance();
		$ci->load->model('model_setting');
		$results = $ci->model_setting->getallmenu();
		$data="";
		if($results){
			foreach($results as $result){
				$data.='<li><a href="'.base_url(adminpath.'/'.$result->linkname).'"><i class="fa fa-edit"></i> '.$result->name.' </a> </li>';
			}
		}
		return $data;
	}
}



if ( ! function_exists('usertype'))
{
	function usertype($id)
	{
		$ci = get_instance();
		$ci->load->model('model_setting');
		$results = $ci->model_setting->getusertype();
		$data="";
		if($results){
			foreach($results as $result){
				if($id==$result->id){
					$data.='<option value="'.$result->id.'" selected>'.$result->name.' </option>';
				}
				else{
					$data.='<option value="'.$result->id.'">'.$result->name.' </option>';
				}
			}
		}
		return $data;
	}
}




if ( ! function_exists('testtype'))
{
	function testtype($name) {
		$CI = get_instance();
		$data="";
		if($name=='paid'){
			$data.="<option value='paid' selected> Paid </option>";
			$data.="<option value='free'> Free </option>";
		}
		else{
			$data.="<option value='paid'> Paid </option>";
			$data.="<option value='free' selected> Free </option>";
		}
		return $data;

	}
}





if ( ! function_exists('subcategorytopmenu'))
{
	function subcategorytopmenu($pid)
	{
		$menudata="";
		$ci = get_instance();
		$ci->load->model('model_category');
		$filterdata=array(
			'filter_pid' => $pid,
		);
		$menuquery = $ci->model_category->getcategories($filterdata);
		if($menuquery){
			$menudata.=" <ul class='dropdown-menu'>";
			foreach($menuquery as $menurow){
				$menudata.="<li><a class='' href='".base_url(recursivemenu($menurow->linkname))."'> ".$menurow->name." </a>";
				$menudata.=subcategorytopmenu($menurow->id);
				$menudata.="</li>";
			}
			$menudata.="</ul>";
		}
		return $menudata;
	}
}


if ( ! function_exists('categorytopmenu'))
{
	function categorytopmenu($pid)
	{
		$menudata="";
		$ci = get_instance();
		$ci->load->model('model_category');
		$filterdata=array(
			'filter_pid' => $pid
		);
		$menuquery = $ci->model_category->getcategories($filterdata);
		if($menuquery){

			foreach($menuquery as $menurow){
				$menudata.="<li><a class='"; 
					$menudata.="productiocn' href='".base_url(recursivemenu($menurow->linkname))."'> ".$menurow->name."  </a>";

				$menudata.=subcategorytopmenu($menurow->id);
				$menudata.="</li>";
			}
		}
		return $menudata;
	}
}





if ( ! function_exists('subrecursivemenu'))

{

	function subrecursivemenu($pid)

	{

		$submenudata="";
		$CI = get_instance();
		$sql="select * from category where id='".$pid."'";
		$query = $CI->db->query($sql)->result();
		foreach($query as $result) {
			$submenudata.=subrecursivemenu($result->pid);
			$submenudata.=$result->linkname."/";
		}

		return $submenudata;

	}
}

if ( ! function_exists('recursivemenu'))

{

	function recursivemenu($linkname)

	{

		$menudata="";
		$CI = get_instance();
		$sql="select * from category where linkname='".$linkname."'";
		$query = $CI->db->query($sql)->result();
		foreach($query as $result) {
			 $menudata.=subrecursivemenu($result->pid);
			$menudata.=$result->linkname;
		}


		return $menudata;

	}
}




if ( ! function_exists('subbreadcrumbs'))

{

	function subbreadcrumbs($pid)

	{

		$submenudata=array();
		$submenudata1=array();
		$CI = get_instance();
		$sql="select * from category where id='".$pid."'";
		$query = $CI->db->query($sql)->result();
		foreach($query as $result) {
			$submenudata1=subbreadcrumbs($result->pid);
			$submenudata[] = array(
				'text' => $result->name,
				'href' =>	base_url(recursivemenu($result->linkname))
			);
		}
		$data=array_merge($submenudata1,$submenudata);
		return $data;

	}
}

if ( ! function_exists('breadcrumbs'))

{

	function breadcrumbs($linkname)

	{

		$menudata=array();
		$CI = get_instance();
		$sql="select * from category where linkname='".$linkname."'";
		$query = $CI->db->query($sql)->result();
		foreach($query as $result) {
			 $submenudata=subbreadcrumbs($result->pid);
			 $menudata[] = array(
				'text' => $result->name,
				'href' => base_url(recursivemenu($result->linkname))
			);
		}

		$data=array_merge($submenudata,$menudata);

		return $data;

	}
}

if ( ! function_exists('adminquestionrightoption')) {
	function adminquestionrightoption($questionbank_id,$answer_id) {

		$CI = get_instance();
		$condition = "questionbank_id = '".$questionbank_id."' and id='".$answer_id."'";

		$CI->db->select('*');

		$CI->db->from('answer');

		$CI->db->where($condition);

		$CI->db->limit(1);

		$query = $CI->db->get();

		if ($query->num_rows() == 1) {

		return $query->row()->orderno;

		} else {

		return 0;

		}
		
	}
}


if ( ! function_exists('studentattempttest')) {
	function studentattempttest($testid) {

		$CI = get_instance();
		$condition = "testpanel_id = '".$testid."' and student_id='".$CI->session->userdata('studentlogged_in')['id']."'";

		$CI->db->select('*');

		$CI->db->from('testpanelattemptbyuser');

		$CI->db->where($condition);

		$CI->db->limit(1);

		$query = $CI->db->get();

		if ($query->num_rows() == 1) {

		return $query->row();

		} else {

		return 0;

		}
		
	}
}


if ( ! function_exists('checkfreetestforstudent')) {
	function checkfreetestforstudent() {

		$CI = get_instance();
		$category_id=studentinfo('category_id');
		$condition = "category_id = '".$category_id."' and testoption='free'";

		$CI->db->select('*');

		$CI->db->from('testpanel');

		$CI->db->where($condition);

		$CI->db->limit(1);

		$query = $CI->db->get();

		if ($query->num_rows() == 1) {

		return $query->row();

		} else {

		return 0;

		}
		
	}
}


if ( ! function_exists('studentrollno')) {
	function studentrollno() {

		$CI = get_instance();
		$rollno=userinfo(1,'rollnoprefix').$CI->session->userdata('studentlogged_in')['id'];
		return $rollno;
		
	}
}
if ( ! function_exists('getchapterttlmarks')) {
	function getchapterttlmarks($testpanel_id,$chapter_id) {

		$CI = get_instance();
		$condition="";
		if(!empty($testpanel_id))
			{
				$condition .= "testpanel_id ='" . $testpanel_id . "' and chapter_id='".$chapter_id."'";
			}
		$CI->db->select('GROUP_CONCAT(question_id, "") as question_id');

		$CI->db->from('testpanel_question');

		$CI->db->where($condition);

		$query = $CI->db->get();
 
		if ($query->num_rows() == 1) {
			$row=$query->row();

			$condition1="";
			if(!empty($testpanel_id))
				{
					$condition1 .= "id IN (".$row->question_id.")";
				}
			$CI->db->select('sum(perquestionmark) as ttlmark');

			$CI->db->from('questionbank');

			$CI->db->where($condition1);

			$query1 = $CI->db->get();
	 	 
			if ($query1->num_rows() == 1) {
				$row1=$query1->row();
				return $row1->ttlmark;
			}
			else{
				return 0;
			}
		}
		
	}
}


if ( ! function_exists('getuserchapterttlmarks')) {
	function getuserchapterttlmarks($testpanel_id,$chapter_id) {

		$CI = get_instance();
		$condition="";
		if(!empty($testpanel_id))
			{
				$condition .= "testpanel_id ='" . $testpanel_id . "' and chapter_id='".$chapter_id."'";
			}
		$CI->db->select('GROUP_CONCAT(question_id, "") as question_id');

		$CI->db->from('testpanel_question');

		$CI->db->where($condition);

		$query = $CI->db->get();
 
		if ($query->num_rows() == 1) {
			$row=$query->row();

			$condition1="";
			if(!empty($testpanel_id))
				{
					$condition1 .= "testpanel_id='" . $testpanel_id . "' and student_id=13 and rightanswerbyadmin_id=rightanswerbyuser_id and question_id IN (".$row->question_id.")";
				}
			$CI->db->select('sum(perquestionmark) as ttlmark');

			$CI->db->from('testpanel_answerbyuser');

			$CI->db->where($condition1);

			$query1 = $CI->db->get();
	 	 
			if ($query1->num_rows() == 1) {
				$row1=$query1->row();
				return $row1->ttlmark;
			}
			else{
				return 0;
			}
		}
		
	}
}


if ( ! function_exists('getuserchapternegativettlmarks')) {
	function getuserchapternegativettlmarks($testpanel_id,$chapter_id) {

		$CI = get_instance();
		$condition="";
		if(!empty($testpanel_id))
			{
				$condition .= "testpanel_id ='" . $testpanel_id . "' and chapter_id='".$chapter_id."'";
			}
		$CI->db->select('GROUP_CONCAT(question_id, "") as question_id');

		$CI->db->from('testpanel_question');

		$CI->db->where($condition);

		$query = $CI->db->get();
 
		if ($query->num_rows() == 1) {
			$row=$query->row();

			$condition1="";
			if(!empty($testpanel_id))
				{
					$condition1 .= "testpanel_id='" . $testpanel_id . "' and student_id=13 and rightanswerbyadmin_id!=rightanswerbyuser_id and negativemark > 0 and question_id IN (".$row->question_id.")";
				}
			$CI->db->select('sum(negativemark) as ttlmark');

			$CI->db->from('testpanel_answerbyuser');

			$CI->db->where($condition1);

			$query1 = $CI->db->get();
	 	 
			if ($query1->num_rows() == 1) {
				$row1=$query1->row();
				return $row1->ttlmark;
			}
			else{
				return 0;
			}
		}
		
	}
}



if ( ! function_exists('getuserchapterttltime')) {
	function getuserchapterttltime($testpanel_id,$chapter_id) {

		$CI = get_instance();
		$condition="";
		if(!empty($testpanel_id))
			{
				$condition .= "testpanel_id ='" . $testpanel_id . "' and chapter_id='".$chapter_id."'";
			}
		$CI->db->select('GROUP_CONCAT(question_id, "") as question_id');

		$CI->db->from('testpanel_question');

		$CI->db->where($condition);

		$query = $CI->db->get();
 
		if ($query->num_rows() == 1) {
			$row=$query->row();

			$condition1="";
			if(!empty($testpanel_id))
				{
					$condition1 .= "student_id='".$CI->session->userdata('studentlogged_in')['id']."' and id IN (".$row->question_id.")";
				}
			$CI->db->select('sum(timer) as ttlmark');

			$CI->db->from('testpanel_answerbyuser');

			$CI->db->where($condition1);

			$query1 = $CI->db->get();
	 	 
			if ($query1->num_rows() == 1) {
				$row1=$query1->row();
		// echo $this->db->last_query();
				return $row1->ttlmark;
			}
			else{
				return 0;
			}
		}
		
	}
}

if ( ! function_exists('gettestpanel'))

{

	function getadmintestpanel($data = array())

	{

		$menudata=array();
		$CI = get_instance();
		$condition="";
		$condition .= "pid =" . "'" . $data['filter_pid'] . "'";
		if(!empty($data['filter_user']))
			{
				$condition .= "and user_id =" . "'" . $data['filter_user'] . "'";
			}
		if(isset($data['subject_id']) && $data['subject_id']){
					$condition .= " and subject_id =" . "'" . $data['subject_id'] . "'";
		}

		if(isset($data['schoollavel_id']) && $data['schoollavel_id']){
				$condition .= " and schoollavel_id =" . "'" . $data['schoollavel_id'] . "'";
			}
		$sql="select * from testpanel where ".$condition;
		$query = $CI->db->query($sql);
		$level=0;
		$alltestpanels=array();
		if ($query->num_rows()) {
			$level++;
		$results=$query->result();
		foreach($results as $val) {
			 $fildata = array(
				'filter_pid' => $val->id,
				'filter_user' => $CI->session->userdata['logged_in']['id'],
				'subject_id' => $data['subject_id'],
				'schoollavel_id' => $data['schoollavel_id'],

			);
			 $children=getadmintestpanel($fildata);
			 $alltestpanels[] = array(
				'id' => $val->id,
				'name' => $val->name,
				'children' => $children,
				'status' => $val->status,
				'level' => $level,
				'href' => base_url().adminpath.'/testpanel/edit?id=' . $val->id
			);
		}
		}
		return $alltestpanels;

	}
}

if ( ! function_exists('getadmintestpaneloption'))

{

	function getadmintestpaneloption($pid,$id,$level)

	{

		$menudata="";
		$CI = get_instance();
		$condition="";
		$condition .= "pid ='" . $pid . "'";
		$condition .= "and user_id ='" . $CI->session->userdata['logged_in']['id'] . "'";
		$sql="select * from testpanel where ".$condition;
		$query = $CI->db->query($sql);
		$alltestpanels=array();
		if ($query->num_rows()) {

			$level++;
			$results=$query->result();
			foreach($results as $val) {
				 $icon="";
				 for($i=1; $i<=$level; $i++){
				 	$icon.="->";
				 }
				 if($val->id==$id){
				 	$menudata.="<option value='".$val->id."' selected>".$icon.$val->name."</option>";
				 }
				 else{

				 	$menudata.="<option value='".$val->id."'>".$icon.$val->name."</option>";
				 }

				 $menudata.=getadmintestpaneloption($val->id,$id,$level);
			}
		}
		return $menudata;

	}
}


if ( ! function_exists('gethourlist'))

{

	function gethourlist($hour)

	{
		$menudata="";
		$CI = get_instance();
		for($i=1; $i<=24; $i++){
			if($i==$hour){
				$menudata.="<option value='".$i."' selected>".$i."</option>";
			}
			else{

				$menudata.="<option value='".$i."'>".$i."</option>";
			}
		}
		return $menudata;

	}
}

if ( ! function_exists('getminuteslist'))

{

	function getminuteslist($minutes)

	{
		$menudata="";
		$CI = get_instance();
		for($i=1; $i<=60; $i++){
			if($i==$minutes){
				$menudata.="<option value='".$i."' selected>".$i."</option>";
			}
			else{

				$menudata.="<option value='".$i."'>".$icon.$i."</option>";
			}
		}
		return $menudata;

	}
}


if ( ! function_exists('questionalreadyothertest')) {
	function questionalreadyothertest($id,$testpanelid) {

		$CI = get_instance();
		$total=0;
		$questiondata=array();
		$sql="select * from testpanel_question where question_id='".$id."' and testpanel_id != '".$testpanelid."'";
		$query = $CI->db->query($sql)->result();
		foreach($query as $result) {
			$total++;
			$info = $CI->model_testpanel->gettestpanel($result->testpanel_id);
			if($info){
				$questiondata[] = array(
					'name' => $info->name
				);
			}
		}
		$menudata = array(
			'questiondata' => $questiondata,
			'total' => $total
		);
		return $menudata;
	}
}

if ( ! function_exists('gettotalmarks')) {
	function gettotalmarks($testpanelid) {
		
		$CI = get_instance();
		$total=0;
		$questiondata=array();
		$CI->load->model('model_question');
		$sql="select * from testpanel_question where testpanel_id = '".$testpanelid."'";
		$rows = $CI->db->query($sql)->result();
		foreach($rows as $row){
    		$marksq = $CI->model_question->getquestionmark($row->question_id);
    		$total=$total+$marksq->perquestionmark;
		}
		return $total;
		
	}
}

if ( ! function_exists('testoption'))
{
	function testoption($name) {
		$CI = get_instance();
		$data="";
		if($name=='paid'){
			$data.="<option value='paid' selected> Paid </option>";
			$data.="<option value='free'> Free </option>";
		}
		else{
			$data.="<option value='paid'> Paid </option>";
			$data.="<option value='free' selected> Free </option>";
		}
		return $data;

	}
}


if ( ! function_exists('yesnooption'))
{
	function yesnooption($option) {
		$CI = get_instance();
		$data="";
		if($option){
			$data.="<option value='1' selected> Yes </option>";
			$data.="<option value='0'> No </option>";
		}
		else{
			$data.="<option value='1'> Yes </option>";
			$data.="<option value='0' selected> No </option>";
		}
		return $data;

	}
}

