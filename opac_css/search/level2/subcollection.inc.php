<?php
// +-------------------------------------------------+
// � 2002-2004 PMB Services / www.sigb.net pmb@sigb.net et contributeurs (voir www.sigb.net)
// +-------------------------------------------------+
// $Id: subcollection.inc.php,v 1.20 2009-12-05 14:10:19 kantin Exp $

if (stristr($_SERVER['REQUEST_URI'], ".inc.php")) die("no access");

// second niveau de recherche OPAC sur sous-collections

print "	<div id=\"resultatrech\"><h3>$msg[resultat_recherche]</h3>\n
		<div id=\"resultatrech_container\">
		<div id=\"resultatrech_see\">
";
// requ�te de recherche sur les sous-collections
print pmb_bidi("	<h3><span>$count $msg[subcolls_found] <b>'".htmlentities(stripslashes($user_query),ENT_QUOTES,$charset)."'");
if ($opac_search_other_function) {
	require_once($include_path."/".$opac_search_other_function);
	print pmb_bidi(" ".search_other_function_human_query($_SESSION["last_query"]));
}
print "</b>";
print activation_surlignage();
print "</h3></span>\n";

print "	</div>\n
		<div id=\"resultatrech_liste\"><ul>";

$found = mysql_query("select sub_coll_id, ".$pert.",sub_coll_name from sub_collections $clause group by sub_coll_id $tri $limiter", $dbh);

while($mesSousCollections = mysql_fetch_object($found)) {
	print pmb_bidi("<li class='categ_colonne'><font class='notice_fort'><a href=index.php?lvl=subcoll_see&id=".$mesSousCollections->sub_coll_id.">".$mesSousCollections->sub_coll_name."</a></font></li>\n");
}
print "</ul></div>";
print " </div>
		</div>";

//Enregistrement des stats
if($pmb_logs_activate){
	global $nb_results_tab;
	$nb_results_tab['subcollections'] = $count;
}