<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/soft_skill.php");
	include("$currDir/soft_skill_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('soft_skill');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "soft-skill";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`soft_skill`.`id`" => "id",
		"`soft_skill`.`website_name`" => "website_name",
		"`soft_skill`.`tagline`" => "tagline",
		"`soft_skill`.`icon`" => "icon",
		"`soft_skill`.`keywords`" => "keywords",
		"`soft_skill`.`short_description`" => "short_description",
		"`soft_skill`.`detailed_description`" => "detailed_description",
		"`soft_skill`.`bannertext1`" => "bannertext1",
		"`soft_skill`.`bannertext2`" => "bannertext2",
		"`soft_skill`.`bannertext3`" => "bannertext3",
		"`soft_skill`.`bannertext4`" => "bannertext4",
		"`soft_skill`.`address`" => "address",
		"`soft_skill`.`email`" => "email",
		"`soft_skill`.`phone`" => "phone",
		"`soft_skill`.`googlemap`" => "googlemap"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`soft_skill`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => 8,
		9 => 9,
		10 => 10,
		11 => 11,
		12 => 12,
		13 => 13,
		14 => 14,
		15 => 15
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`soft_skill`.`id`" => "id",
		"`soft_skill`.`website_name`" => "website_name",
		"`soft_skill`.`tagline`" => "tagline",
		"`soft_skill`.`icon`" => "icon",
		"`soft_skill`.`keywords`" => "keywords",
		"`soft_skill`.`short_description`" => "short_description",
		"`soft_skill`.`detailed_description`" => "detailed_description",
		"`soft_skill`.`bannertext1`" => "bannertext1",
		"`soft_skill`.`bannertext2`" => "bannertext2",
		"`soft_skill`.`bannertext3`" => "bannertext3",
		"`soft_skill`.`bannertext4`" => "bannertext4",
		"`soft_skill`.`address`" => "address",
		"`soft_skill`.`email`" => "email",
		"`soft_skill`.`phone`" => "phone",
		"`soft_skill`.`googlemap`" => "googlemap"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`soft_skill`.`id`" => "ID",
		"`soft_skill`.`website_name`" => "Website Name",
		"`soft_skill`.`tagline`" => "Tagline",
		"`soft_skill`.`keywords`" => "Keywords",
		"`soft_skill`.`short_description`" => "Short description",
		"`soft_skill`.`detailed_description`" => "Detailed description",
		"`soft_skill`.`bannertext1`" => "Bannertext1",
		"`soft_skill`.`bannertext2`" => "Bannertext2",
		"`soft_skill`.`bannertext3`" => "Bannertext3",
		"`soft_skill`.`bannertext4`" => "Bannertext4",
		"`soft_skill`.`address`" => "Address",
		"`soft_skill`.`email`" => "Email",
		"`soft_skill`.`phone`" => "Phone",
		"`soft_skill`.`googlemap`" => "Googlemap"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`soft_skill`.`id`" => "id",
		"`soft_skill`.`website_name`" => "website_name",
		"`soft_skill`.`tagline`" => "tagline",
		"`soft_skill`.`keywords`" => "keywords",
		"`soft_skill`.`short_description`" => "short_description",
		"`soft_skill`.`detailed_description`" => "detailed_description",
		"`soft_skill`.`bannertext1`" => "bannertext1",
		"`soft_skill`.`bannertext2`" => "bannertext2",
		"`soft_skill`.`bannertext3`" => "bannertext3",
		"`soft_skill`.`bannertext4`" => "bannertext4",
		"`soft_skill`.`address`" => "address",
		"`soft_skill`.`email`" => "email",
		"`soft_skill`.`phone`" => "phone",
		"`soft_skill`.`googlemap`" => "googlemap"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array();

	$x->QueryFrom = "`soft_skill` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = false;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 0;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "soft_skill_view.php";
	$x->RedirectAfterInsert = "soft_skill_view.php?SelectedID=#ID#";
	$x->TableTitle = "Website Details";
	$x->TableIcon = "resources/table_icons/drugs_com.png";
	$x->PrimaryKey = "`soft_skill`.`id`";

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Website Name", "Tagline", "Icon", "Keywords", "Short description", "Detailed description", "Bannertext1", "Bannertext2", "Bannertext3", "Bannertext4", "Address", "Email", "Phone", "Googlemap");
	$x->ColFieldName = array('website_name', 'tagline', 'icon', 'keywords', 'short_description', 'detailed_description', 'bannertext1', 'bannertext2', 'bannertext3', 'bannertext4', 'address', 'email', 'phone', 'googlemap');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15);

	// template paths below are based on the app main directory
	$x->Template = 'templates/soft_skill_templateTV.html';
	$x->SelectedTemplate = 'templates/soft_skill_templateTVS.html';
	$x->TemplateDV = 'templates/soft_skill_templateDV.html';
	$x->TemplateDVP = 'templates/soft_skill_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->ShowRecordSlots = 0;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `soft_skill`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='soft_skill' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `soft_skill`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='soft_skill' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`soft_skill`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: soft_skill_init
	$render=TRUE;
	if(function_exists('soft_skill_init')){
		$args=array();
		$render=soft_skill_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: soft_skill_header
	$headerCode='';
	if(function_exists('soft_skill_header')){
		$args=array();
		$headerCode=soft_skill_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: soft_skill_footer
	$footerCode='';
	if(function_exists('soft_skill_footer')){
		$args=array();
		$footerCode=soft_skill_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>