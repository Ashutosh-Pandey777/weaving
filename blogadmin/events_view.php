<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/events.php");
	include("$currDir/events_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('events');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "events";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`events`.`id`" => "id",
		"`events`.`title`" => "title",
		"IF(    CHAR_LENGTH(`blog_categories1`.`name`), CONCAT_WS('',   `blog_categories1`.`name`), '') /* Category */" => "category",
		"`events`.`tags`" => "tags",
		"`events`.`content`" => "content",
		"`events`.`photo`" => "photo",
		"if(`events`.`date`,date_format(`events`.`date`,'%m/%d/%Y'),'')" => "date",
		"`events`.`author`" => "author",
		"`events`.`posted`" => "posted"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`events`.`id`',
		2 => 2,
		3 => '`blog_categories1`.`name`',
		4 => 4,
		5 => 5,
		6 => 6,
		7 => '`events`.`date`',
		8 => 8,
		9 => 9
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`events`.`id`" => "id",
		"`events`.`title`" => "title",
		"IF(    CHAR_LENGTH(`blog_categories1`.`name`), CONCAT_WS('',   `blog_categories1`.`name`), '') /* Category */" => "category",
		"`events`.`tags`" => "tags",
		"`events`.`content`" => "content",
		"`events`.`photo`" => "photo",
		"if(`events`.`date`,date_format(`events`.`date`,'%m/%d/%Y'),'')" => "date",
		"`events`.`author`" => "author",
		"`events`.`posted`" => "posted"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`events`.`id`" => "ID",
		"`events`.`title`" => "Title",
		"IF(    CHAR_LENGTH(`blog_categories1`.`name`), CONCAT_WS('',   `blog_categories1`.`name`), '') /* Category */" => "Category",
		"`events`.`tags`" => "Tags",
		"`events`.`content`" => "Content",
		"`events`.`date`" => "Date",
		"`events`.`author`" => "Author",
		"`events`.`posted`" => "Status"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`events`.`id`" => "id",
		"`events`.`title`" => "title",
		"IF(    CHAR_LENGTH(`blog_categories1`.`name`), CONCAT_WS('',   `blog_categories1`.`name`), '') /* Category */" => "category",
		"`events`.`tags`" => "tags",
		"`events`.`content`" => "content",
		"if(`events`.`date`,date_format(`events`.`date`,'%m/%d/%Y'),'')" => "date",
		"`events`.`author`" => "author",
		"`events`.`posted`" => "posted"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array(  'category' => 'Category');

	$x->QueryFrom = "`events` LEFT JOIN `blog_categories` as blog_categories1 ON `blog_categories1`.`id`=`events`.`category` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = true;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 1;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 1;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "events_view.php";
	$x->RedirectAfterInsert = "events_view.php?SelectedID=#ID#";
	$x->TableTitle = "events";
	$x->TableIcon = "resources/table_icons/feed.png";
	$x->PrimaryKey = "`events`.`id`";

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Title", "Category", "Tags", "Content", "Photo", "Date", "Author", "Status");
	$x->ColFieldName = array('title', 'category', 'tags', 'content', 'photo', 'date', 'author', 'posted');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8, 9);

	// template paths below are based on the app main directory
	$x->Template = 'templates/events_templateTV.html';
	$x->SelectedTemplate = 'templates/events_templateTVS.html';
	$x->TemplateDV = 'templates/events_templateDV.html';
	$x->TemplateDVP = 'templates/events_templateDVP.html';

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
		$x->QueryWhere="where `events`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='events' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `events`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='events' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`events`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: events_init
	$render=TRUE;
	if(function_exists('events_init')){
		$args=array();
		$render=events_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: events_header
	$headerCode='';
	if(function_exists('events_header')){
		$args=array();
		$headerCode=events_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: events_footer
	$footerCode='';
	if(function_exists('events_footer')){
		$args=array();
		$footerCode=events_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>