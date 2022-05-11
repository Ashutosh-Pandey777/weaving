<?php

// Data functions (insert, update, delete, form) for table magazines

// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

function magazines_insert(){
	global $Translation;

	// mm: can member insert record?
	$arrPerm=getTablePermissions('magazines');
	if(!$arrPerm[1]){
		return false;
	}

	$data['title'] = makeSafe($_REQUEST['title']);
		if($data['title'] == empty_lookup_value){ $data['title'] = ''; }
	$data['category'] = makeSafe($_REQUEST['category']);
		if($data['category'] == empty_lookup_value){ $data['category'] = ''; }
	$data['tags'] = makeSafe($_REQUEST['tags']);
		if($data['tags'] == empty_lookup_value){ $data['tags'] = ''; }
	$data['content'] = makeSafe($_REQUEST['content']);
		if($data['content'] == empty_lookup_value){ $data['content'] = ''; }
	$data['date'] = parseCode('<%%creationDate%%>', true, true);
	$data['author'] = parseCode('<%%creatorUsername%%>', true);
	$data['posted'] = makeSafe($_REQUEST['posted']);
		if($data['posted'] == empty_lookup_value){ $data['posted'] = ''; }
	$data['photo'] = PrepareUploadedFile('photo', 5120000,'jpg|jpeg|gif|png', false, '');
	if($data['photo']) createThumbnail($data['photo'], getThumbnailSpecs('magazines', 'photo', 'tv'));
	if($data['photo']) createThumbnail($data['photo'], getThumbnailSpecs('magazines', 'photo', 'dv'));
	if($data['title']== ''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">" . $Translation['error:'] . " 'Title': " . $Translation['field not null'] . '<br><br>';
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	if($data['category']== ''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">" . $Translation['error:'] . " 'Category': " . $Translation['field not null'] . '<br><br>';
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	if($data['tags']== ''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">" . $Translation['error:'] . " 'Tags': " . $Translation['field not null'] . '<br><br>';
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	if($data['content']== ''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">" . $Translation['error:'] . " 'Content': " . $Translation['field not null'] . '<br><br>';
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	if($data['photo']== ''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">" . $Translation['error:'] . " 'Photo': " . $Translation['field not null'] . '<br><br>';
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	if($data['posted']== ''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">" . $Translation['error:'] . " 'Status': " . $Translation['field not null'] . '<br><br>';
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}

	/* for empty upload fields, when saving a copy of an existing record, copy the original upload field */
	if($_REQUEST['SelectedID']){
		$res = sql("select * from magazines where id='" . makeSafe($_REQUEST['SelectedID']) . "'", $eo);
		if($row = db_fetch_assoc($res)){
			if(!$data['photo']) $data['photo'] = makeSafe($row['photo']);
		}
	}

	// hook: magazines_before_insert
	if(function_exists('magazines_before_insert')){
		$args=array();
		if(!magazines_before_insert($data, getMemberInfo(), $args)){ return false; }
	}

	$o = array('silentErrors' => true);
	sql('insert into `magazines` set       `title`=' . (($data['title'] !== '' && $data['title'] !== NULL) ? "'{$data['title']}'" : 'NULL') . ', `category`=' . (($data['category'] !== '' && $data['category'] !== NULL) ? "'{$data['category']}'" : 'NULL') . ', `tags`=' . (($data['tags'] !== '' && $data['tags'] !== NULL) ? "'{$data['tags']}'" : 'NULL') . ', `content`=' . (($data['content'] !== '' && $data['content'] !== NULL) ? "'{$data['content']}'" : 'NULL') . ', ' . ($data['photo'] != '' ? "`photo`='{$data['photo']}'" : '`photo`=NULL') . ', `date`=' . "'{$data['date']}'" . ', `author`=' . "'{$data['author']}'" . ', `posted`=' . (($data['posted'] !== '' && $data['posted'] !== NULL) ? "'{$data['posted']}'" : 'NULL'), $o);
	if($o['error']!=''){
		echo $o['error'];
		echo "<a href=\"magazines_view.php?addNew_x=1\">{$Translation['< back']}</a>";
		exit;
	}

	$recID = db_insert_id(db_link());

	// hook: magazines_after_insert
	if(function_exists('magazines_after_insert')){
		$res = sql("select * from `magazines` where `id`='" . makeSafe($recID, false) . "' limit 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args=array();
		if(!magazines_after_insert($data, getMemberInfo(), $args)){ return $recID; }
	}

	// mm: save ownership data
	set_record_owner('magazines', $recID, getLoggedMemberID());

	return $recID;
}

function magazines_delete($selected_id, $AllowDeleteOfParents=false, $skipChecks=false){
	// insure referential integrity ...
	global $Translation;
	$selected_id=makeSafe($selected_id);

	// mm: can member delete record?
	$arrPerm=getTablePermissions('magazines');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='magazines' and pkValue='$selected_id'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='magazines' and pkValue='$selected_id'");
	if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
		// delete allowed, so continue ...
	}else{
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: magazines_before_delete
	if(function_exists('magazines_before_delete')){
		$args=array();
		if(!magazines_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'];
	}

	// child table: editors_choice
	$res = sql("select `id` from `magazines` where `id`='$selected_id'", $eo);
	$id = db_fetch_row($res);
	$rires = sql("select count(1) from `editors_choice` where `blog`='".addslashes($id[0])."'", $eo);
	$rirow = db_fetch_row($rires);
	if($rirow[0] && !$AllowDeleteOfParents && !$skipChecks){
		$RetMsg = $Translation["couldn't delete"];
		$RetMsg = str_replace("<RelatedRecords>", $rirow[0], $RetMsg);
		$RetMsg = str_replace("<TableName>", "editors_choice", $RetMsg);
		return $RetMsg;
	}elseif($rirow[0] && $AllowDeleteOfParents && !$skipChecks){
		$RetMsg = $Translation["confirm delete"];
		$RetMsg = str_replace("<RelatedRecords>", $rirow[0], $RetMsg);
		$RetMsg = str_replace("<TableName>", "editors_choice", $RetMsg);
		$RetMsg = str_replace("<Delete>", "<input type=\"button\" class=\"button\" value=\"".$Translation['yes']."\" onClick=\"window.location='magazines_view.php?SelectedID=".urlencode($selected_id)."&delete_x=1&confirmed=1';\">", $RetMsg);
		$RetMsg = str_replace("<Cancel>", "<input type=\"button\" class=\"button\" value=\"".$Translation['no']."\" onClick=\"window.location='magazines_view.php?SelectedID=".urlencode($selected_id)."';\">", $RetMsg);
		return $RetMsg;
	}

	sql("delete from `magazines` where `id`='$selected_id'", $eo);

	// hook: magazines_after_delete
	if(function_exists('magazines_after_delete')){
		$args=array();
		magazines_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("delete from membership_userrecords where tableName='magazines' and pkValue='$selected_id'", $eo);
}

function magazines_update($selected_id){
	global $Translation;

	// mm: can member edit record?
	$arrPerm=getTablePermissions('magazines');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='magazines' and pkValue='".makeSafe($selected_id)."'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='magazines' and pkValue='".makeSafe($selected_id)."'");
	if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){ // allow update?
		// update allowed, so continue ...
	}else{
		return false;
	}

	$data['title'] = makeSafe($_REQUEST['title']);
		if($data['title'] == empty_lookup_value){ $data['title'] = ''; }
	if($data['title']==''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Title': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	$data['category'] = makeSafe($_REQUEST['category']);
		if($data['category'] == empty_lookup_value){ $data['category'] = ''; }
	if($data['category']==''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Category': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	$data['tags'] = makeSafe($_REQUEST['tags']);
		if($data['tags'] == empty_lookup_value){ $data['tags'] = ''; }
	if($data['tags']==''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Tags': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	$data['content'] = makeSafe($_REQUEST['content']);
		if($data['content'] == empty_lookup_value){ $data['content'] = ''; }
	if($data['content']==''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Content': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	$data['photo'] = PrepareUploadedFile('photo', 5120000, 'jpg|jpeg|gif|png', false, "");
	$existing_photo = sqlValue("select `photo` from `magazines` where `id`='" . makeSafe($selected_id) . "'");
	if($data['photo'] == '' && !$existing_photo){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Photo': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	$data['date'] = parseMySQLDate('', '<%%creationDate%%>');
	$data['posted'] = makeSafe($_REQUEST['posted']);
		if($data['posted'] == empty_lookup_value){ $data['posted'] = ''; }
	if($data['posted']==''){
		echo StyleSheet() . "\n\n<div class=\"alert alert-danger\">{$Translation['error:']} 'Status': {$Translation['field not null']}<br><br>";
		echo '<a href="" onclick="history.go(-1); return false;">'.$Translation['< back'].'</a></div>';
		exit;
	}
	$data['selectedID']=makeSafe($selected_id);
		if($data['photo']) createThumbnail($data['photo'], getThumbnailSpecs('magazines', 'photo', 'tv'));
		if($data['photo']) createThumbnail($data['photo'], getThumbnailSpecs('magazines', 'photo', 'dv'));

	// hook: magazines_before_update
	if(function_exists('magazines_before_update')){
		$args=array();
		if(!magazines_before_update($data, getMemberInfo(), $args)){ return false; }
	}

	$o=array('silentErrors' => true);
	sql('update `magazines` set       `title`=' . (($data['title'] !== '' && $data['title'] !== NULL) ? "'{$data['title']}'" : 'NULL') . ', `category`=' . (($data['category'] !== '' && $data['category'] !== NULL) ? "'{$data['category']}'" : 'NULL') . ', `tags`=' . (($data['tags'] !== '' && $data['tags'] !== NULL) ? "'{$data['tags']}'" : 'NULL') . ', `content`=' . (($data['content'] !== '' && $data['content'] !== NULL) ? "'{$data['content']}'" : 'NULL') . ', ' . ($data['photo']!='' ? "`photo`='{$data['photo']}'" : '`photo`=`photo`') . ', `date`=`date`' . ', `posted`=' . (($data['posted'] !== '' && $data['posted'] !== NULL) ? "'{$data['posted']}'" : 'NULL') . " where `id`='".makeSafe($selected_id)."'", $o);
	if($o['error']!=''){
		echo $o['error'];
		echo '<a href="magazines_view.php?SelectedID='.urlencode($selected_id)."\">{$Translation['< back']}</a>";
		exit;
	}


	// hook: magazines_after_update
	if(function_exists('magazines_after_update')){
		$res = sql("SELECT * FROM `magazines` WHERE `id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = $data['id'];
		$args = array();
		if(!magazines_after_update($data, getMemberInfo(), $args)){ return; }
	}

	// mm: update ownership data
	sql("update membership_userrecords set dateUpdated='".time()."' where tableName='magazines' and pkValue='".makeSafe($selected_id)."'", $eo);

}

function magazines_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0, $TemplateDV = '', $TemplateDVP = ''){
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm=getTablePermissions('magazines');
	if(!$arrPerm[1] && $selected_id==''){ return ''; }
	$AllowInsert = ($arrPerm[1] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != ''){
		$dvprint = true;
	}

	$filterer_category = thisOr(undo_magic_quotes($_REQUEST['filterer_category']), '');

	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');
	// combobox: category
	$combo_category = new DataCombo;
	// combobox: date
	$combo_date = new DateCombo;
	$combo_date->DateFormat = "mdy";
	$combo_date->MinYear = 1900;
	$combo_date->MaxYear = 2100;
	$combo_date->DefaultDate = parseMySQLDate('<%%creationDate%%>', '<%%creationDate%%>');
	$combo_date->MonthNames = $Translation['month names'];
	$combo_date->NamePrefix = 'date';
	// combobox: posted
	$combo_posted = new Combo;
	$combo_posted->ListType = 2;
	$combo_posted->MultipleSeparator = ', ';
	$combo_posted->ListBoxHeight = 10;
	$combo_posted->RadiosPerLine = 1;
	if(is_file(dirname(__FILE__).'/hooks/magazines.posted.csv')){
		$posted_data = addslashes(implode('', @file(dirname(__FILE__).'/hooks/magazines.posted.csv')));
		$combo_posted->ListItem = explode('||', entitiesToUTF8(convertLegacyOptions($posted_data)));
		$combo_posted->ListData = $combo_posted->ListItem;
	}else{
		$combo_posted->ListItem = explode('||', entitiesToUTF8(convertLegacyOptions("draft;;publish")));
		$combo_posted->ListData = $combo_posted->ListItem;
	}
	$combo_posted->SelectName = 'posted';
	$combo_posted->AllowNull = false;

	if($selected_id){
		// mm: check member permissions
		if(!$arrPerm[2]){
			return "";
		}
		// mm: who is the owner?
		$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='magazines' and pkValue='".makeSafe($selected_id)."'");
		$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='magazines' and pkValue='".makeSafe($selected_id)."'");
		if($arrPerm[2]==1 && getLoggedMemberID()!=$ownerMemberID){
			return "";
		}
		if($arrPerm[2]==2 && getLoggedGroupID()!=$ownerGroupID){
			return "";
		}

		// can edit?
		if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){
			$AllowUpdate=1;
		}else{
			$AllowUpdate=0;
		}

		$res = sql("select * from `magazines` where `id`='".makeSafe($selected_id)."'", $eo);
		if(!($row = db_fetch_array($res))){
			return error_message($Translation['No records found'], 'magazines_view.php', false);
		}
		$urow = $row; /* unsanitized data */
		$hc = new CI_Input();
		$row = $hc->xss_clean($row); /* sanitize data */
		$combo_category->SelectedData = $row['category'];
		$combo_date->DefaultDate = $row['date'];
		$combo_posted->SelectedData = $row['posted'];
	}else{
		$combo_category->SelectedData = $filterer_category;
		$combo_posted->SelectedText = ( $_REQUEST['FilterField'][1]=='9' && $_REQUEST['FilterOperator'][1]=='<=>' ? (get_magic_quotes_gpc() ? stripslashes($_REQUEST['FilterValue'][1]) : $_REQUEST['FilterValue'][1]) : "");
	}
	$combo_category->HTML = '<span id="category-container' . $rnd1 . '"></span><input type="hidden" name="category" id="category' . $rnd1 . '" value="' . html_attr($combo_category->SelectedData) . '">';
	$combo_category->MatchText = '<span id="category-container-readonly' . $rnd1 . '"></span><input type="hidden" name="category" id="category' . $rnd1 . '" value="' . html_attr($combo_category->SelectedData) . '">';
	$combo_posted->Render();

	ob_start();
	?>

	<script>
		// initial lookup values
		AppGini.current_category__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['category'] : $filterer_category); ?>"};

		jQuery(function() {
			setTimeout(function(){
				if(typeof(category_reload__RAND__) == 'function') category_reload__RAND__();
			}, 10); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
		});
		function category_reload__RAND__(){
		<?php if(($AllowUpdate || $AllowInsert) && !$dvprint){ ?>

			$j("#category-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c){
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_category__RAND__.value, t: 'magazines', f: 'category' },
						success: function(resp){
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="category"]').val(resp.results[0].id);
							$j('[id=category-container-readonly__RAND__]').html('<span id="category-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=blog_categories_view_parent]').hide(); }else{ $j('.btn[id=blog_categories_view_parent]').show(); }


							if(typeof(category_update_autofills__RAND__) == 'function') category_update_autofills__RAND__();
						}
					});
				},
				width: '100%',
				formatNoMatches: function(term){ return '<?php echo addslashes($Translation['No matches found!']); ?>'; },
				minimumResultsForSearch: 10,
				loadMorePadding: 200,
				ajax: {
					url: 'ajax_combo.php',
					dataType: 'json',
					cache: true,
					data: function(term, page){ return { s: term, p: page, t: 'magazines', f: 'category' }; },
					results: function(resp, page){ return resp; }
				},
				escapeMarkup: function(str){ return str; }
			}).on('change', function(e){
				AppGini.current_category__RAND__.value = e.added.id;
				AppGini.current_category__RAND__.text = e.added.text;
				$j('[name="category"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=blog_categories_view_parent]').hide(); }else{ $j('.btn[id=blog_categories_view_parent]').show(); }


				if(typeof(category_update_autofills__RAND__) == 'function') category_update_autofills__RAND__();
			});

			if(!$j("#category-container__RAND__").length){
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_category__RAND__.value, t: 'magazines', f: 'category' },
					success: function(resp){
						$j('[name="category"]').val(resp.results[0].id);
						$j('[id=category-container-readonly__RAND__]').html('<span id="category-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=blog_categories_view_parent]').hide(); }else{ $j('.btn[id=blog_categories_view_parent]').show(); }

						if(typeof(category_update_autofills__RAND__) == 'function') category_update_autofills__RAND__();
					}
				});
			}

		<?php }else{ ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_category__RAND__.value, t: 'magazines', f: 'category' },
				success: function(resp){
					$j('[id=category-container__RAND__], [id=category-container-readonly__RAND__]').html('<span id="category-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=blog_categories_view_parent]').hide(); }else{ $j('.btn[id=blog_categories_view_parent]').show(); }

					if(typeof(category_update_autofills__RAND__) == 'function') category_update_autofills__RAND__();
				}
			});
		<?php } ?>

		}
	</script>
	<?php

	$lookups = str_replace('__RAND__', $rnd1, ob_get_contents());
	ob_end_clean();


	// code for template based detail view forms

	// open the detail view template
	if($dvprint){
		$template_file = is_file("./{$TemplateDVP}") ? "./{$TemplateDVP}" : './templates/magazines_templateDVP.html';
		$templateCode = @file_get_contents($template_file);
	}else{
		$template_file = is_file("./{$TemplateDV}") ? "./{$TemplateDV}" : './templates/magazines_templateDV.html';
		$templateCode = @file_get_contents($template_file);
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Blog details', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert){
		if(!$selected_id) $templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return magazines_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return magazines_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
	}else{
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '', $templateCode);
	}

	// 'Back' button action
	if($_REQUEST['Embedded']){
		$backAction = 'AppGini.closeParentModal(); return false;';
	}else{
		$backAction = '$j(\'form\').eq(0).attr(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;';
	}

	if($selected_id){
		if(!$_REQUEST['Embedded']) $templateCode = str_replace('<%%DVPRINT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="dvprint" name="dvprint_x" value="1" onclick="$$(\'form\')[0].writeAttribute(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;" title="' . html_attr($Translation['Print Preview']) . '"><i class="glyphicon glyphicon-print"></i> ' . $Translation['Print Preview'] . '</button>', $templateCode);
		if($AllowUpdate){
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return magazines_validateData();" title="' . html_attr($Translation['Save Changes']) . '"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
		}else{
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		}
		if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '<button type="submit" class="btn btn-danger" id="delete" name="delete_x" value="1" onclick="return confirm(\'' . $Translation['are you sure?'] . '\');" title="' . html_attr($Translation['Delete']) . '"><i class="glyphicon glyphicon-trash"></i> ' . $Translation['Delete'] . '</button>', $templateCode);
		}else{
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		}
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>', $templateCode);
	}else{
		$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', ($ShowCancel ? '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>' : ''), $templateCode);
	}

	// set records to read only if user can't insert new records and can't edit current record
	if(($selected_id && !$AllowUpdate && !$AllowInsert) || (!$selected_id && !$AllowInsert)){
		$jsReadOnly .= "\tjQuery('#title').replaceWith('<div class=\"form-control-static\" id=\"title\">' + (jQuery('#title').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#category').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#category_caption').prop('disabled', true).css({ color: '#555', backgroundColor: 'white' });\n";
		$jsReadOnly .= "\tjQuery('#tags').replaceWith('<div class=\"form-control-static\" id=\"tags\">' + (jQuery('#tags').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#photo').replaceWith('<div class=\"form-control-static\" id=\"photo\">' + (jQuery('#photo').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('input[name=posted]').parent().html('<div class=\"form-control-static\">' + jQuery('input[name=posted]:checked').next().text() + '</div>')\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	}elseif($AllowInsert){
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
			$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos
	$templateCode = str_replace('<%%COMBO(category)%%>', $combo_category->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(category)%%>', $combo_category->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(category)%%>', urlencode($combo_category->MatchText), $templateCode);
	$templateCode = str_replace('<%%COMBO(date)%%>', ($selected_id && !$arrPerm[3] ? '<div class="form-control-static">' . $combo_date->GetHTML(true) . '</div>' : $combo_date->GetHTML()), $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(date)%%>', $combo_date->GetHTML(true), $templateCode);
	$templateCode = str_replace('<%%COMBO(posted)%%>', $combo_posted->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(posted)%%>', $combo_posted->SelectedData, $templateCode);

	/* lookup fields array: 'lookup field name' => array('parent table name', 'lookup field caption') */
	$lookup_fields = array(  'category' => array('blog_categories', 'Category'));
	foreach($lookup_fields as $luf => $ptfc){
		$pt_perm = getTablePermissions($ptfc[0]);

		// process foreign key links
		if($pt_perm['view'] || $pt_perm['edit']){
			$templateCode = str_replace("<%%PLINK({$luf})%%>", '<button type="button" class="btn btn-default view_parent hspacer-md" id="' . $ptfc[0] . '_view_parent" title="' . html_attr($Translation['View'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-eye-open"></i></button>', $templateCode);
		}

		// if user has insert permission to parent table of a lookup field, put an add new button
		if($pt_perm['insert'] && !$_REQUEST['Embedded']){
			$templateCode = str_replace("<%%ADDNEW({$ptfc[0]})%%>", '<button type="button" class="btn btn-success add_new_parent hspacer-md" id="' . $ptfc[0] . '_add_new" title="' . html_attr($Translation['Add New'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-plus-sign"></i></button>', $templateCode);
		}
	}

	// process images
	$templateCode = str_replace('<%%UPLOADFILE(id)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(title)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(category)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(tags)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(content)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(photo)%%>', ($noUploads ? '' : '<input type=hidden name=MAX_FILE_SIZE value=5120000>'.$Translation['upload image'].' <input type="file" name="photo" id="photo">'), $templateCode);
	if($AllowUpdate && $row['photo'] != ''){
		$templateCode = str_replace('<%%REMOVEFILE(photo)%%>', '<br><input type="checkbox" name="photo_remove" id="photo_remove" value="1"> <label for="photo_remove" style="color: red; font-weight: bold;">'.$Translation['remove image'].'</label>', $templateCode);
	}else{
		$templateCode = str_replace('<%%REMOVEFILE(photo)%%>', '', $templateCode);
	}
	$templateCode = str_replace('<%%UPLOADFILE(date)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(author)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(posted)%%>', '', $templateCode);

	// process values
	if($selected_id){
		if( $dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', safe_html($urow['id']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', html_attr($row['id']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode($urow['id']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(title)%%>', safe_html($urow['title']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(title)%%>', html_attr($row['title']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(title)%%>', urlencode($urow['title']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(category)%%>', safe_html($urow['category']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(category)%%>', html_attr($row['category']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(category)%%>', urlencode($urow['category']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(tags)%%>', safe_html($urow['tags']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(tags)%%>', html_attr($row['tags']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(tags)%%>', urlencode($urow['tags']), $templateCode);
		if($AllowUpdate || $AllowInsert){
			$templateCode = str_replace('<%%HTMLAREA(content)%%>', '<textarea name="content" id="content" rows="5">' . html_attr($row['content']) . '</textarea>', $templateCode);
		}else{
			$templateCode = str_replace('<%%HTMLAREA(content)%%>', '<div id="content" class="form-control-static">' . $row['content'] . '</div>', $templateCode);
		}
		$templateCode = str_replace('<%%VALUE(content)%%>', nl2br($row['content']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(content)%%>', urlencode($urow['content']), $templateCode);
		$row['photo'] = ($row['photo'] != '' ? $row['photo'] : 'blank.gif');
		if( $dvprint) $templateCode = str_replace('<%%VALUE(photo)%%>', safe_html($urow['photo']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(photo)%%>', html_attr($row['photo']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(photo)%%>', urlencode($urow['photo']), $templateCode);
		$templateCode = str_replace('<%%VALUE(date)%%>', @date('m/d/Y', @strtotime(html_attr($row['date']))), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(date)%%>', urlencode(@date('m/d/Y', @strtotime(html_attr($urow['date'])))), $templateCode);
		$templateCode = str_replace('<%%VALUE(author)%%>', safe_html($urow['author']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(author)%%>', urlencode($urow['author']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(posted)%%>', safe_html($urow['posted']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(posted)%%>', html_attr($row['posted']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(posted)%%>', urlencode($urow['posted']), $templateCode);
	}else{
		$templateCode = str_replace('<%%VALUE(id)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(title)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(title)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(category)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(category)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(tags)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(tags)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%HTMLAREA(content)%%>', '<textarea name="content" id="content" rows="5"></textarea>', $templateCode);
		$templateCode = str_replace('<%%VALUE(photo)%%>', 'blank.gif', $templateCode);
		$templateCode = str_replace('<%%VALUE(date)%%>', '<%%creationDate%%>', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(date)%%>', urlencode('<%%creationDate%%>'), $templateCode);
		$templateCode = str_replace('<%%VALUE(author)%%>', '<%%creatorUsername%%>', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(author)%%>', urlencode('<%%creatorUsername%%>'), $templateCode);
		$templateCode = str_replace('<%%VALUE(posted)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(posted)%%>', urlencode(''), $templateCode);
	}

	// process translations
	foreach($Translation as $symbol=>$trans){
		$templateCode = str_replace("<%%TRANSLATION($symbol)%%>", $trans, $templateCode);
	}

	// clear scrap
	$templateCode = str_replace('<%%', '<!-- ', $templateCode);
	$templateCode = str_replace('%%>', ' -->', $templateCode);

	// hide links to inaccessible tables
	if($_REQUEST['dvprint_x'] == ''){
		$templateCode .= "\n\n<script>\$j(function(){\n";
		$arrTables = getTableList();
		foreach($arrTables as $name => $caption){
			$templateCode .= "\t\$j('#{$name}_link').removeClass('hidden');\n";
			$templateCode .= "\t\$j('#xs_{$name}_link').removeClass('hidden');\n";
		}

		$templateCode .= $jsReadOnly;
		$templateCode .= $jsEditable;

		if(!$selected_id){
		}

		$templateCode.="\n});</script>\n";
	}

	// ajaxed auto-fill fields
	$templateCode .= '<script>';
	$templateCode .= '$j(function() {';


	$templateCode.="});";
	$templateCode.="</script>";
	$templateCode .= $lookups;

	// handle enforced parent values for read-only lookup fields

	// don't include blank images in lightbox gallery
	$templateCode = preg_replace('/blank.gif" data-lightbox=".*?"/', 'blank.gif"', $templateCode);

	// don't display empty email links
	$templateCode=preg_replace('/<a .*?href="mailto:".*?<\/a>/', '', $templateCode);

	/* default field values */
	$rdata = $jdata = get_defaults('magazines');
	if($selected_id){
		$jdata = get_joined_record('magazines', $selected_id);
		if($jdata === false) $jdata = get_defaults('magazines');
		$rdata = $row;
	}
	$cache_data = array(
		'rdata' => array_map('nl2br', array_map('addslashes', $rdata)),
		'jdata' => array_map('nl2br', array_map('addslashes', $jdata))
	);
	$templateCode .= loadView('magazines-ajax-cache', $cache_data);

	// hook: magazines_dv
	if(function_exists('magazines_dv')){
		$args=array();
		magazines_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}
?>