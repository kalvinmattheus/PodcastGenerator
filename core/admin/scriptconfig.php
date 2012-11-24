<?php
############################################################
# PODCAST GENERATOR
#
# Created by Alberto Betella
# http://podcastgen.sourceforge.net
# 
# This is Free Software released under the GNU/GPL License.
############################################################

########### Security code, avoids cross-site scripting (Register Globals ON)
if (isset($_REQUEST['GLOBALS']) OR isset($_REQUEST['absoluteurl']) OR isset($_REQUEST['amilogged']) OR isset($_REQUEST['theme_path'])) { exit; } 
########### End

// check if user is already logged in
if(isset($amilogged) AND $amilogged =="true") {

	$PG_mainbody .= '<h3>'._("Change Podcast Generator Configuration").'</h3>
		';

	if (isset($_GET['action']) AND $_GET['action']=="change") { // if action is set

		//streaming
		$streaming = $_POST['streaming'];
		if ($streaming != "") {
			$enablestreaming = $streaming;
		}

		//freebox
		$fbox = $_POST['fbox'];
		if ($fbox != "") {
			$freebox = $fbox;
		}

		//categories
		$cats = $_POST['cats'];
		if ($cats != "") {
			$categoriesenabled = $cats;
		}



		//news display
		$newsinadmin = $_POST['newsinadmin'];
		if ($newsinadmin != "") {
			$enablepgnewsinadmin = $newsinadmin;
		}	


		// strict rename
		$strictfilename = $_POST['strictfilename'];
		if ($strictfilename != "") {
			$strictfilenamepolicy = $strictfilename;
		}			

		// recent in home
		$recent = $_POST['recent'];
		if ($recent != "") {
			$max_recent = $recent;
		}

		// recent in FEED
		$recentinfeed = $_POST['recentinfeed'];
		if ($recentinfeed != "") {
			$recent_episode_in_feed = $recentinfeed;
		}				

		// date format
		$selectdateformat = $_POST['selectdateformat'];
		if ($selectdateformat != "") {
			$dateformat = $selectdateformat;
		}


		// script language
		$scriptlanguage = $_POST['scriptlanguage'];
		if ($scriptlanguage != "") {
			$scriptlang = $scriptlanguage;
		}

		include ("$absoluteurl"."core/admin/createconfig.php"); //regenerate config.php

		$PG_mainbody .= '<p><b>'._("The information has been successfully sent.").'</b></p>';

		//REGENERATE FEED ...
		include ("$absoluteurl"."core/admin/feedgenerate.php");
		$PG_mainbody .= '<br /><br />';

	}
	else { // if action not set


		$PG_mainbody .=	'<form name="podcastdetails" method="POST" enctype="multipart/form-data" action="?p=admin&do=config&action=change">';

		##########streaming

		$PG_mainbody .= '<br /><br /><p><label for="streaming"><b>'._("Enable Streaming mp3 Player?").'</b></label></p>
			<span class="admin_hints">'._("Enable flash streaming player for mp3 files on the web pages.").'</span>
			<p>'._("Yes").' <input type="radio" name="streaming" value="yes" ';

		if ($enablestreaming == "yes") {
			$PG_mainbody .= 'checked';
		}

		$PG_mainbody .= '>&nbsp;&nbsp; '._("No").' <input type="radio" name="streaming" value="no" ';

		if ($enablestreaming == "no") {
			$PG_mainbody .= 'checked';
		}

		$PG_mainbody .= '></p>';

		####


		########## freebox

		$PG_mainbody .= '<br /><br /><p><label for="fbox"><b>'._("Enable Freebox?").'</b></label></p>
			<span class="admin_hints">'._("Freebox allows you to write freely what you wish, add links or text through a visual editor in the admin section.").'</span>
			<p>'._("Yes").' <input type="radio" name="fbox" value="yes" ';

		if ($freebox == "yes") {
			$PG_mainbody .= 'checked';
		}

		$PG_mainbody .= '>&nbsp;&nbsp; '._("No").' <input type="radio" name="fbox" value="no" ';

		if ($freebox == "no") {
			$PG_mainbody .= 'checked';
		}

		$PG_mainbody .= '></p>';

		####

		########## categories

		$PG_mainbody .= '<br /><br /><a name="setcategoriesfeature" id="setcategoriesfeature"></a><p><label for="cats"><b>'._("Enable categories?").'</b></label></p>
			<span class="admin_hints">'._("Enable categories feature to make thematic lists of your podcasts.").'</span>
			<p>'._("Yes").' <input type="radio" name="cats" value="yes" ';

		if ($categoriesenabled == "yes") {
			$PG_mainbody .= 'checked';
		}

		$PG_mainbody .= '>&nbsp;&nbsp; '._("No").' <input type="radio" name="cats" value="no" ';

		if ($categoriesenabled == "no") {
			$PG_mainbody .= 'checked';
		}

		$PG_mainbody .= '></p>';

		####

		########## newsinadmin

		$PG_mainbody .= '<br /><br /><p><label for="newsinadmin"><b>'._("Enable news display?").'</b></label></p>
			<span class="admin_hints">'._("Displays Podcast Generator latest news in the main administration page of your podcast.").'</span>
			<p>'._("Yes").' <input type="radio" name="newsinadmin" value="yes" ';

		if ($enablepgnewsinadmin == "yes") {
			$PG_mainbody .= 'checked';
		}

		$PG_mainbody .= '>&nbsp;&nbsp; '._("No").' <input type="radio" name="newsinadmin" value="no" ';

		if ($enablepgnewsinadmin == "no") {
			$PG_mainbody .= 'checked';
		}

		$PG_mainbody .= '></p>';

		####

		########## strictfilename

		$PG_mainbody .= '<br /><br /><p><label for="strictfilename"><b>'._("Enable strict episode renaming policy?").'</b></label></p>
			<span class="admin_hints">'._("If this option is enabled the files you upload will be renamed using just characters from A to Z and numbers. Unless you are using a different set of characters (e.g. Oriental, Arabic, etc...), YES is the suggested value.").'</span>
			<p>'._("Yes").' <input type="radio" name="strictfilename" value="yes" ';

		if ($strictfilenamepolicy == "yes") {
			$PG_mainbody .= 'checked';
		}

		$PG_mainbody .= '>&nbsp;&nbsp; '._("No").' <input type="radio" name="strictfilename" value="no" ';

		if ($strictfilenamepolicy == "no") {
			$PG_mainbody .= 'checked';
		}

		$PG_mainbody .= '></p>';

		####

		########## recent in home

		$PG_mainbody .= '<br /><br /><p><label for="recent"><b>'._("How many recent podcasts in the home page?").'</b></label></p>

			<select name="recent" id="recent">

			<option value=\'1\'';
		if ($max_recent == 1) { $PG_mainbody .= ' selected'; }
		$PG_mainbody .= '>1</option>

			<option value=\'3\'';
		if ($max_recent == 3) { $PG_mainbody .= ' selected'; }
		$PG_mainbody .= '>3</option>  

			<option value=\'5\'';
		if ($max_recent == 5) { $PG_mainbody .= ' selected'; }
		$PG_mainbody .= '>5</option>

			<option value=\'10\'';
		if ($max_recent == 10) { $PG_mainbody .= ' selected'; }
		$PG_mainbody .= '>10</option>

			<option value=\'15\'';
		if ($max_recent == 15) { $PG_mainbody .= ' selected'; }
		$PG_mainbody .= '>15</option>

			<option value=\'20\'';
		if ($max_recent == 20) { $PG_mainbody .= ' selected'; }
		$PG_mainbody .= '>20</option>
			</select>
			';

		####


		########## recent in feed

		$PG_mainbody .= '<br /><br /><br /><p><label for="recentinfeed"><b>'._("How many episodes indexed in the podcast feeds?").'</b></label></p>

			<select name="recentinfeed" id="recentinfeed">

			<option value=\'5\'';
		if ($recent_episode_in_feed == "5") { $PG_mainbody .= ' selected'; }
		$PG_mainbody .= '>5</option>

			<option value=\'10\'';
		if ($recent_episode_in_feed == "10") { $PG_mainbody .= ' selected'; }
		$PG_mainbody .= '>10</option>

			<option value=\'15\'';
		if ($recent_episode_in_feed == "15") { $PG_mainbody .= ' selected'; }
		$PG_mainbody .= '>15</option>

			<option value=\'20\'';
		if ($recent_episode_in_feed == "20") { $PG_mainbody .= ' selected'; }
		$PG_mainbody .= '>20</option>


			<option value=\'All\'';
		if ($recent_episode_in_feed == "All") { $PG_mainbody .= ' selected'; }
		$PG_mainbody .= '>'._("All").'</option>  

			</select>
			';

		####



		########## date format

		$PG_mainbody .= '<br /><br /><br /><p><label for="selectdateformat"><b>'._("Select date format").'</b></label></p>

			<select name="selectdateformat" id="selectdateformat">

			<option value=\'d-m-Y\'';
		if ($dateformat == "d-m-Y") { $PG_mainbody .= ' selected'; }
		$PG_mainbody .= '>'._("Day").' / '._("Month").' / '._("Year").'</option>

			<option value=\'m-d-Y\'';
		if ($dateformat == "m-d-Y") { $PG_mainbody .= ' selected'; }
		$PG_mainbody .= '>'._("Month").' / '._("Day").' / '._("Year").'</option>

			<option value=\'Y-m-d\'';
		if ($dateformat == "Y-m-d") { $PG_mainbody .= ' selected'; }
		$PG_mainbody .= '>'._("Year").' / '._("Month").' / '._("Day").'</option>

			</select>
			';

		####



		##### SCRIPT LANGUAGE

		include ("$absoluteurl"."components/xmlparser/loadparser.php");
		include ("$absoluteurl"."core/admin/readscriptlanguages.php");


		// define variables
		$arr = NULL;
		$arrid = NULL;
		$n = 0;

		foreach($parser->document->language as $singlelanguage)
		{
			//echo $singlelanguage->id[0]->tagData."<br>";
			//echo $singlelanguage->description[0]->tagData;

			$arr[] .= $singlelanguage->description[0]->tagData;
			$arrid[] .= $singlelanguage->id[0]->tagData;
			$n++;
		}


		## SCRIPT LANGUAGES LIST

		$PG_mainbody .= '<br /><br /><br /><p><label for="scriptlanguage"><b>'._("Podcast Generator Language").'</b></label></p>
			<p><span class="admin_hints">'._("Choose among available languages *").'</span></p>
			';
		$PG_mainbody .= '<select name="scriptlanguage">';


		natcasesort($arr); // Natcasesort orders more naturally and is different from "sort", which is case sensitive

		foreach ($arr as $key => $val) {



			$PG_mainbody .= '
				<option value="' . $arrid[$key] . '"';

			if ($scriptlang == $arrid[$key]) {
				$PG_mainbody .= ' selected';
			}

			$PG_mainbody .= '>' . $val . '</option>
				';	



		}
		$PG_mainbody .= '</select>';	



		$PG_mainbody .= '<p><span class="admin_hints"><a href="http://podcastgen.sourceforge.net/helptotranslate.php?ref=local-admin" target="_blank">'._("* Volunteer to translate Podcast Generator into your native language").'</a></span></p><br /><br /><p>
		<input type="submit" name="'._("Send").'" value="'._("Send").'" onClick="showNotify(\''._("Setting...").'\');"></p><br />';
	}

}

?>