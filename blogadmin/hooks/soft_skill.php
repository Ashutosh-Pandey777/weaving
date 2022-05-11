<?php
	// For help on using hooks, please refer to https://bigprof.com/appgini/help/working-with-generated-web-database-application/hooks

	function soft_skill_init(&$options, $memberInfo, &$args){

		return TRUE;
	}

	function soft_skill_header($contentType, $memberInfo, &$args){
		$header='';

		switch($contentType){
			case 'tableview':
				$header='';
				break;

			case 'detailview':
				$header='';
				break;

			case 'tableview+detailview':
				$header='';
				break;

			case 'print-tableview':
				$header='';
				break;

			case 'print-detailview':
				$header='';
				break;

			case 'filters':
				$header='';
				break;
		}

		return $header;
	}

	function soft_skill_footer($contentType, $memberInfo, &$args){
		$footer='';

		switch($contentType){
			case 'tableview':
				$footer='';
				break;

			case 'detailview':
				$footer='';
				break;

			case 'tableview+detailview':
				$footer='';
				break;

			case 'print-tableview':
				$footer='';
				break;

			case 'print-detailview':
				$footer='';
				break;

			case 'filters':
				$footer='';
				break;
		}

		return $footer;
	}

	function soft_skill_before_insert(&$data, $memberInfo, &$args){
//prevent members from inserting more than one record in table
		$memberid1=($memberInfo['username']);
		$getrecordcount=sqlValue("SELECT COUNT(*) FROM membership_userrecords WHERE tableName='soft_skill' AND memberID='$memberid1'");
		if ($getrecordcount>0) return FALSE;
		return TRUE;
	}

	function soft_skill_after_insert($data, $memberInfo, &$args){

		return TRUE;
	}

	function soft_skill_before_update(&$data, $memberInfo, &$args){

		return TRUE;
	}

	function soft_skill_after_update($data, $memberInfo, &$args){

		return TRUE;
	}

	function soft_skill_before_delete($selectedID, &$skipChecks, $memberInfo, &$args){

		return TRUE;
	}

	function soft_skill_after_delete($selectedID, $memberInfo, &$args){

	}

	function soft_skill_dv($selectedID, $memberInfo, &$html, &$args){

	}

	function soft_skill_csv($query, $memberInfo, &$args){

		return $query;
	}
	function soft_skill_batch_actions(&$args){

		return array();
	}
