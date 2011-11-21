<?php
/*
  OpenPOM
 
  Copyright 2010, Exosec
  Licensed under GPL Version 2.
  http://www.gnu.org/licenses/
*/

if (!isset($_SESSION['USER'])) die();

/* supported lang are "en" "fr" "de" */

/* ENGLISH */

$LANG['en'] = array (
'acknowledge'        => 'acknowledge',
'downtime'           => 'downtime',
'recheck'            => 'recheck',
'disable'            => 'disable',
'disable_title'      => 'disable notifications',
'reset'              => 'reset state',
'reset0'             => 'reset',
'reset_title'        => 'reset acknowledge, downtime, notification and comments',
'filter'             => 'filter',
'filtering'          => 'filtering',
'help'               => 'help',
'refresh'            => 'refresh',
'mode'               => 'monitor mode',
'mode0'              => 'stop monitor mode',
'level1'             => 'criticals',
'level2'             => 'critical/warning',
'level3'             => 'critical/warning/soft',
'level4'             => 'critical/warning/ack',
'level5'             => 'critical/warning/ack/outage',
'level6'             => 'critical/warning/ack/outage/svc',
'level7'             => 'all',
'exclude'            => 'exclude ack/downtime',
'hide'               => 'hide svc for ack host',
'refreshing'         => 'refresh in',
'refreshing0'        => 'refreshing every',
'flag'               => 'flags',
'track'              => 'Enable tracking',
'istrack'            => 'Tracking is enabled',
'machine'            => 'equipment',
'service'            => 'service',
'group'              => 'groups',
'stinfo'             => 'status information',
'last'               => 'last check',
'duration'           => 'duration',
'comment'            => 'comment',
'comment0'           => 'add comment',
'hour'               => 'hours',
'reload'             => $BACKEND.' is reloading',
'host'               => 'host',
'curstat'            => 'current status',
'curat'              => 'current attempt',
'chktyp'             => 'check type',
'latency'            => 'check latency',
'lastchange'         => 'last state change',
'flapping'           => 'is this service flapping',
'lastup'             => 'last update',
'cancel'             => 'cancel',
'clear'              => 'clear',
'second'             => 'seconds',
'apply'              => 'apply',
'set'                => 'set',
'reverse'            => 'reverse filter',
'option'             => 'options',
'lang'               => 'language',
'column'             => 'displayed columns',
'step'               => 'number of displayed lines',
'level'              => 'default level',
'cols'               => 'check columns to hide',
'maxlen_stinfo'      => 'Max characters: status info',
'maxlen_host'        => 'Max characters: host',
'maxlen_svc'         => 'Max characters: service',
'maxlen_groups'      => 'Max characters: groups',
'frame'              => 'no frame around the page',
'meter'              => 'C: Critical - W: Warning - U: Unknown - D: Downtime - A: Acknowledge - T: Total',
'next'               => 'next page',
'prev'               => 'previous page',
'fontsize'           => 'Font size alert',
'search'             => 'search (keywords are : not something / = something)',
'querytime'          => 'query in',
'end_down'           => 'end time', 
'graph_icon'         => 'show graph',
'fixed'              => 'Fix popup',
'start_time'         => 'start time',
'minutes'            => 'minutes',
'show_log'           => 'Nagios LOG',
'today'              => 'today',
'week'               => 'week',
'month'              => 'month',
'year'               => 'year',
'fix'                => 'fixed',
'durationnow'        => 'duration from now',
'ena_notif'          => 'enable global notifications',
'disa_notif'         => 'disable global notifications',
'ena_popin'          => 'enable status popin',
'disa_popin'         => 'disable status popin', 
'notif_warning'      => 'Warning: global notifications are disabled!'
) ;

/* FRENCH */

$LANG['fr'] = array (
'acknowledge'        => 'acquitter',
'downtime'           => 'arr&ecirc;t pr&eacute;vu',
'recheck'            => 'retester',
'disable'            => 'd&eacute;sactiver',
'disable_title'      => 'd&eacute;sactiver les notifications',
'reset'              => 'R&eacute;initialiser',
'reset0'             => 'R&eacute;initialiser',
'reset_title'        => 'R&eacute;initialiser les acquittements, arr&ecirc;t pr&eacute;vu, notifications et commentaires',
'filter'             => 'filtrer',
'filtering'          => 'filtrage',
'help'               => 'aide',
'refresh'            => 'rafra&icirc;chir',
'mode'               => 'mode moniteur',
'mode0'              => 'quitter le mode moniteur',
'level1'             => 'critique',
'level2'             => 'critique/alerte',
'level3'             => 'critique/alerte/soft',
'level4'             => 'critique/alerte/connu',
'level5'             => 'critique/alerte/connu/parent',
'level6'             => 'critique/alerte/connu/parent/service',
'level7'             => 'tout',
'exclude'            => 'exclu acquitt&eacute;/arr&ecirc;t pr&eacute;vu',
'hide'               => 'masque service pour h&ocirc;te acquitt&eacute;',
'refreshing'         => 'rafra&icirc;chir dans',
'refreshing0'        => 'rafra&icirc;chissement toutes les',
'flag'               => 'statut',
'track'              => 'Activer le suivi',
'istrack'            => 'Le suivi est activ�',
'machine'            => 'equipement',
'service'            => 'service',
'group'              => 'groupes',
'stinfo'             => 'Information',
'last'               => 'dernier test',
'duration'           => 'dur&eacute;e',
'comment'            => 'commentaire',
'comment0'           => 'ajout commentaire',
'hour'               => 'heures',
'reload'             => $BACKEND.' est en cours de red&eacute;marrage',
'host'               => 'h&ocirc;te',
'curstat'            => 'etat actuel',
'curat'              => 'nombre de test',
'chktyp'             => 'type de test',
'latency'            => 'latence',
'lastchange'         => 'dernier changement d\'&eacute;tat',
'flapping'           => 'le service change d\'&eacute;tat trop souvent',
'lastup'             => 'derni&egrave;re mise &agrave; jour',
'cancel'             => 'annuler',
'clear'              => 'effacer',
'second'             => 'secondes',
'apply'              => 'appliquer',
'set'                => 'fixer',
'reverse'            => 'inverser le filtre',
'option'             => 'param&egrave;tres',
'lang'               => 'langue',
'column'             => 'colonne &agrave; afficher',
'step'               => 'nombre de lignes affich&eacute;es',
'level'              => 'niveau par d&eacute;faut affich&eacute;',
'cols'               => 'cocher les colonnes &agrave; masquer',
'maxlen_stinfo'      => 'nb. de carat&egrave;res max: information',
'maxlen_host'        => 'nb. de carat&egrave;res max: &eacute;quipement',
'maxlen_svc'         => 'nb. de carat&egrave;res max: service',
'maxlen_groups'      => 'nb. de carat&egrave;res max: groupes',
'frame'              => 'pas de cadre autour de la page',
'meter'              => 'C: Critique - W: Alerte - U: Inconnu - D: Arr&ecirc;t&eacute; - A: Acquitt&eacute; - T: Total',
'next'               => 'page suivante',
'prev'               => 'page pr&eacute;c&eacute;dente',
'fontsize'           => 'Taille de la police des alertes',
'search'             => 'Recherche (mots cl&eacute;s : not ma_recherche / = ma_recherche)',
'querytime'          => 'requ&ecirc;te en',
'end_down'           => 'fin pr&eacute;vue',
'graph_icon'         => 'affiche les graphes',
'fixed'              => 'Fixer en popup',
'start_time'         => 'd&eacute;but',
'minutes'            => 'minutes',
'show_log'           => 'Nagios LOG',
'today'              => 'aujourd\'hui',
'week'               => 'semaine',
'month'              => 'mois',
'year'               => 'ann&eacute;e',
'fix'                => 'fixe',
'durationnow'        => 'Dur&eacute;e',
'ena_notif'          => 'activer les notifications globales',
'disa_notif'         => 'd&eacute;sactiver les notifications globales',
'ena_popin'          => 'activer la popin de status',
'disa_popin'         => 'd&eacute;sactiver la popin de status', 
'notif_warning'      => 'Attention : les notifications globales sont d&eacute;sactiv&eacute;es !'
) ;

$LANG['de'] = array (
'acknowledge'        => 'best&auml;tigen',
'downtime'           => 'Ausfallzeit',
'recheck'            => 'erneut pr&uuml;fen',
'disable'            => 'deaktivieren',
'disable_title'      => 'Benachrichtigung deaktivieren',
'reset'              => 'Status zur&uuml;cksetzen',
'reset0'             => 'zur&uuml;cksetzen',
'reset_title'        => 'Best&auml;tigt, Ausfallzeit, Benachrichtigung und Kommentare zur&uuml;cksetzen',
'filter'             => 'Filter',
'filtering'          => 'filtern',
'help'               => 'Hilfe',
'refresh'            => 'aktualisieren',
'mode'               => 'monitor mode',
'mode0'              => 'ausfahrt monitor mode',
'level1'             => 'kritische',
'level2'             => 'Kritische/Warnungen',
'level3'             => 'Kritische/Warnungen/Weich',
'level4'             => 'Kritische/Warnungen/Best&auml;tigt',
'level5'             => 'Kritische/Warnungen/Best&auml;tigt/Ausfall',
'level6'             => 'Kritische/Warnungen/Best&auml;tigt/Ausfall/svc',
'level7'             => 'Alle',
'exclude'            => 'Best&auml;tigt & Ausfall ausschliessen',
'hide'               => 'Verstecke Dienste von best&auml;tigten Hosts',
'refreshing'         => 'aktualisieren in',
'refreshing0'        => 'aktualisiere alle',
'flag'               => 'markieren',
'track'              => 'Aktivieren Tracking',
'istrack'            => 'Tracking aktiviert ist',
'machine'            => 'Ger&auml;te',
'service'            => 'Dienste',
'group'              => 'Gruppen',
'stinfo'             => 'status-informationen',
'last'               => 'letzter Check',
'duration'           => 'Dauer',
'comment'            => 'Kommentare',
'comment0'           => 'Kommentar hinzuf&uuml;gen',
'hour'               => 'stunden',
'reload'             => $BACKEND.' l&auml;d neu',
'host'               => 'Host',
'curstat'            => 'aktueller Status',
'curat'              => 'aktueller Versuch',
'chktyp'             => 'pr&uuml;fe Typ',
'latency'            => 'pr&uuml;fe Latenz',
'lastchange'         => 'letzte Status&auml;nderung',
'flapping'           => 'dieser Dienst "flattert"',
'lastup'             => 'letztes Aenderung',
'cancel'             => 'abbrechen',
'clear'              => 'leeren',
'second'             => 'Sekunden',
'apply'              => 'anwenden',
'set'                => 'setzen',
'reverse'            => 'reverse filter',
'option'             => 'Optionen',
'lang'               => 'Sprache',
'column'             => 'angezeigte Spalten',
'step'               => 'Anzahl angezeigte Zeilen',
'level'              => 'Standard Level',
'cols'               => 'Ausgew&auml;hlte Spalten ausblenden',
'maxlen_stinfo'      => 'Maximale Anzahl Zeichen: Informationen',
'maxlen_host'        => 'Maximale Anzahl Zeichen: Ger&auml;te',
'maxlen_svc'         => 'Maximale Anzahl Zeichen: Dienste',
'maxlen_groups'      => 'Maximale Anzahl Zeichen: Gruppen',
'frame'              => 'Frameumrandung ausblenden',
'meter'              => 'C: Kritisch - W: Warnung - U: Unbekannt - D: Ausfall - A: Best&auml;tigt - T: Gesamt',
'next'               => 'n&auml;chste Seite',
'prev'               => 'vorherige Seite',
'fontsize'           => 'Schriftgr&ouml;sse Alarm',
'search'             => 'Suche (keywords are : not something / = something)',
'querytime'          => 'Suche in',
'end_down'           => 'endet',
'graph_icon'         => 'zeige Grafik',
'fixed'              => 'Fix popup',
'start_time'         => 'startzeit',
'minutes'            => 'minutes',
'show_log'           => 'Nagios LOG',
'today'              => 'heute',
'week'               => 'woche',
'month'              => 'monat',
'year'               => 'jahr',
'fix'                => 'fixiert',
'durationnow'        => 'Dauer von jetzt',
'ena_notif'          => 'Benachrichtigung aktivieren (globale)',
'disa_notif'         => 'Benachrichtigung deaktivieren (globale)',
'ena_popin'          => 'Status popin aktivieren',
'disa_popin'         => 'Status popin deaktivieren', 
'notif_warning'      => 'Warnung: Globale Benachrichtigungen sind deaktiviert!'
) ;

/* GET/SET LANG */
if ( (isset($_GET['lang'])) && (isset($LANG[substr($_GET['lang'],0,2)])) ) {
  $MYLANG = substr($_GET['lang'],0,2) ;
  $_SESSION['LANG'] = $MYLANG ;
}
else if (isset($_SESSION['LANG'])) 
  $MYLANG = $_SESSION['LANG'] ;
else
  $_SESSION['LANG'] = $MYLANG ;

function lang($lang, $key) {
  global $LANG;
  if ( (empty($key)) || (empty($lang)) )
    return sprintf("lang error");
  if (strlen($key) > 100)
    return sprintf("lang error");
  if (isset($LANG[$lang][$key])) 
    return sprintf("%s", $LANG[$lang][$key]);
  return sprintf("%s", $key);
}

?>
