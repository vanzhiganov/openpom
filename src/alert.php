<?php 
/*
  OpenPOM
 
  Copyright 2010, Exosec
  Licensed under GPL Version 2.
  http://www.gnu.org/licenses/
*/

if (basename($_SERVER['SCRIPT_NAME']) != "index.php") die(); 
if (!isset($_SESSION['USER'])) die();
  
define('HAS_COMMENT', 0x1);
define('HAS_TRACK',   0x2);
?>



    <style type="text/css">
    table#alert * {
      font-size: <?php echo $_SESSION['FONTSIZE'] ?>px;
    }
    </style>
    
    
    
    
    <table width="100%" id="alert">
      <tr>
        <?php 
        /* column checkbox is not present on monitor mode */
        foreach($COLS AS $key => $val) {
          if ($key == 'checkbox') {
        ?>
        
        <th class="<?php echo $key ?>">
          <span class="checkbox" onclick="selectall(this);">
            <span></span>
          </span>
        </th>
        
        <?php
          }
          else {
        ?>
            
        
        <th class="<?php echo $key ?>">
          <?php if ( ($SORTFIELD == $val) && ($SORTORDERFIELD == "ASC") ) { ?>
          <a class="col_sort_up" href="<?php echo $MY_GET_NO_SORT?>&sort=<?php echo $key?>&order=1">
          <?php } else if ($SORTFIELD == $val) { ?>
          <a class="col_sort_down" href="<?php echo $MY_GET_NO_SORT?>&sort=<?php echo $key?>&order=0">
          <?php } else { ?>
          <a class="col_no_sort" href="<?php echo $MY_GET_NO_SORT?>&sort=<?php echo $key?>&order=0">
          <?php } ?>
            <?php echo ucfirst(lang($MYLANG, $key))?>
          </a>
          <?php if ($key == 'machine') { ?><span class="sub">(h)</span><?php }
           else if ($key == 'service') { ?><span class="sub">(s)</span><?php }
           else if ($key == 'IP') { ?><span class="sub">(i)</span><?php }
           else if ($key == 'stinfo') { ?><span class="sub">(o)</span><?php }
           else if ($key == 'group') { ?><span class="sub">(g)</span><?php } ?>
        </th>
        
        <?php 
          }
        }
        ?>
      </tr>


      <?php
      /* warning message for monitor mode if global notification
       * are disabled */
      if (isset($_GET['monitor']) && $global_notif == 'ena_notif') {
      ?>
          
      <tr>
          <td id="notif_warning" colspan="<?php echo count($COLS) ?>">
            <div>
              <?php echo lang($MYLANG, 'notif_warning'); ?>
            </div>
            <script type="text/javascript">
            var warning = $('td#notif_warning > div');
            if (warning.length) {
              blink_button(warning);
            }
            </script>
          </td>
        </tr>
        
      <?php
      } /* warning global notif disabled */
      ?>


      <?php
      /* loop on each reasult from the query */
      while ($data = mysql_fetch_array($rep, MYSQL_ASSOC)) {

        switch ($data['STATUS']) {
          case 0:
              $COLOR = $OK; 
              break; 
          case 1:
              $COLOR = $WARNING; 
              break;
          case 2:
              $COLOR = $CRITICAL; 
              break;
          case 3:
              $COLOR = $UNKNOWN; 
              break;
        }

        if ($data['COMMENT'] & HAS_TRACK) {
          if ($data['STATUS'] > 0) {
            $COLOR = $TRACK_ERROR;
          } else {
            $COLOR = $TRACK_OK;
          }
        }
        
        if ($data['SVCST'] == 0) { 
          $COLOR .= " soft"; 
        }
        
        $ACTION_TARGET = 'nagios;'.$data['MACHINE_NAME'].';'.$data['SERVICES'];
        $GET_DATA = "get_data('nagios', '".$data['TYPE']."', '".$data['SVCID']."');";
      ?>


      <tr class="alert-item <?php echo $COLOR?>" id="<?php echo $data['SVCID']?>"
        <?php if ($POPIN) { ?>
        onmouseover="to = setTimeout(function() { <?php echo $GET_DATA ?> }, 500);" 
        onmouseout="clearTimeout(to);"
        <?php } ?>
        onclick="selectline(this, event);">

        <?php
        /* loop on columns to display */
        foreach($COLS AS $key => $val) {
          $toprint = '';
          
          if ($key == 'checkbox') {
            $toprint = '
              <span class="checkbox">
                <input type="hidden" 
                       class="data"
                       name="target[]" 
                       value="'.$ACTION_TARGET.'" />
                <span></span>
              </span>';
          }
          
          else if ($key == 'flag') {
            
            if ($data['TYPE'] == "svc") {
              $toprint = '
                <a target="_blank" 
                   href="'.$LINK.'?type=2&host='.$data["MACHINE_NAME"].'&service='.$data['SERVICES'].'"
                  ><img src="img/flag_svc.png" border="0" alt="S" title="'.ucfirst(lang($MYLANG, 'service')).'"
                /></a>'; 
                
            } else if ($data['TYPE'] == "host") {
              $toprint = '
                <a target="_blank" 
                   href="'.$LINK.'?type=1&host='.$data["MACHINE_NAME"].'"
                 ><img src="img/flag_host.png" border="0" alt="H" title="'.ucfirst(lang($MYLANG, 'host')).'" 
                /></a>'; 
            }
            
            $g = get_graph('popup', $data['MACHINE_NAME'], $data['SERVICES']);
            if (!empty($g)) {
              
              $toprint .= '<a href="#" ' 
                . 'onClick="return pop(\''.$g.'\', \''.$data['SVCID'].'\', ' 
                . $GRAPH_POPUP_WIDTH . ', ' 
                . $GRAPH_POPUP_HEIGHT . ');">' 
                . '<img src="img/flag_graph.png" 
                        alt="G" 
                        border="0" 
                        title="'.ucfirst(lang($MYLANG, 'graph_icon')).'" 
                   /></a>';
            }

            if ($data['ACK'] == "1") 
              $toprint = $toprint.'<img src="img/flag_ack.gif" alt="A" title="'.ucfirst(lang($MYLANG, 'acknowledge')).'" />';

            if ($data['NOTIF'] == "0")
              $toprint = $toprint.'<img src="img/flag_notify.png" alt="N" title="'.ucfirst(lang($MYLANG, 'disable_title')).'" />';

            if ($data['DOWNTIME'] > 0)
              $toprint = $toprint.'<img src="img/flag_downtime.png" alt="D" title="'.ucfirst(lang($MYLANG, 'downtime')).'" />';

            if ($data['COMMENT'] & HAS_COMMENT)
              $toprint = $toprint.'<img src="img/flag_comment.gif" alt="C" title="'.ucfirst(lang($MYLANG, 'comment')).'" />';

            if ( ($data['DISABLECHECK'] == "0") && ($data['CHECKTYPE'] == "0") )
              $toprint = $toprint.'<img src="img/flag_disablecheck.png" alt="C" title="'.ucfirst(lang($MYLANG, 'disablecheck')).'" />';

          }
          
          else if ($key == 'duration' || $key == 'last') { 
            $toprint = printtime($data[$val]);
          }
          
          else if ($key == 'machine') {
            if ($QUICKSEARCH == 0) {
              $toprint = '<a href="#"
                onclick="if ( $(\'#filtering\').val() == \'\' ) $(\'#filtering\').val(\'h:'.$data[$val].'\')
                         else if ( $(\'#filtering\').val().substr(0,2) == \'h:\' ) 
                              $(\'#filtering\').val($(\'#filtering\').val()+\' | h:'.$data[$val].'\')
                         else $(\'#filtering\').val($(\'#filtering\').val()+\' & h:'.$data[$val].'\')
                          ">' ;
            }
            else {
              $toprint = '<a href="'.$MY_GET_NO_FILT.'&filtering=h:'.$data[$val].'">';
            }
            if (strlen($data[$val]) > $MAXLEN_HOST) {
              $toprint .= htmlspecialchars(substr($data[$val], 0, $MAXLEN_HOST));
              $toprint .= '</a>...';
            } else {
              $toprint .= htmlspecialchars($data[$val]);
              $toprint .= '</a>';
            }
          }
          
          else if ($key == 'IP') {
            if (empty($data[$val])) {
              $toprint = '&mdash;';
            } else {
              if ($QUICKSEARCH == 0) {
                $toprint = '<a href="#"
                  onclick="if ( $(\'#filtering\').val() == \'\' ) $(\'#filtering\').val(\'i:'.$data[$val].'\')
                           else if ( $(\'#filtering\').val().substr(0,2) == \'i:\' ) 
                                $(\'#filtering\').val($(\'#filtering\').val()+\' | i:'.$data[$val].'\')
                           else $(\'#filtering\').val($(\'#filtering\').val()+\' & i:'.$data[$val].'\')
                            ">' ;
              }
              else {
                $toprint  = '<a href="'.$MY_GET_NO_FILT.'&filtering=i:'.htmlspecialchars($data[$val]).'">';
              }
              $toprint .= htmlspecialchars($data[$val]) ;
              $toprint .= '</a>' ;
            }
          }
          
          else if ($key == 'service') {
            if ($QUICKSEARCH == 0) {
              $toprint = '<a href="#"
                onclick="if ( $(\'#filtering\').val() == \'\' ) $(\'#filtering\').val(\'s:'.$data[$val].'\')
                         else if ( $(\'#filtering\').val().substr(0,2) == \'s:\' ) 
                              $(\'#filtering\').val($(\'#filtering\').val()+\' | s:'.$data[$val].'\')
                         else $(\'#filtering\').val($(\'#filtering\').val()+\' & s:'.$data[$val].'\')
                          ">' ;
            }
            else {
              $toprint = '<a href="'.$MY_GET_NO_FILT.'&filtering=s:'.$data[$val].'">';
            }
            if (strlen($data[$val]) > $MAXLEN_SVC) {
              $toprint .= htmlspecialchars(substr($data[$val], 0, $MAXLEN_SVC));
              $toprint .= '</a>...';
            } else {
              $toprint .= htmlspecialchars($data[$val]);
              $toprint .= '</a>';
            }
          }
          
          else if ($key == 'stinfo') {
            if (empty($data[$val])) {
              $toprint = '&mdash;';
              
            } else {
              $toprint = strlen($data[$val]) > $MAXLEN_STINFO
                ? htmlspecialchars(substr($data[$val], 0, $MAXLEN_STINFO)) . '...'
                : htmlspecialchars($data[$val]);
            }
          }
          
          else if ($key == 'group') {
            if (empty($data[$val])) {
              $toprint = '&mdash;';
              
            } else {
              $size = $MAXLEN_GROUPS;
              $groups = explode(', ', $data[$val]);
              $truncated = false;
              
              while ($size > 0 && ($g = current($groups))) {
                next($groups);
                $l = strlen($g);
                
                if ($l > $size) {
                  $l = $size;
                  $truncated = true;
                }
                
                $size -= $l;
                if ($QUICKSEARCH == 0) {
                  $toprint .= (empty($toprint) ? '' : ', ')
                           .  '<a href="#"
                    onclick="if ( $(\'#filtering\').val() == \'\' ) $(\'#filtering\').val(\'g:'.$g.'\')
                             else if ( $(\'#filtering\').val().substr(0,2) == \'g:\' ) 
                                  $(\'#filtering\').val($(\'#filtering\').val()+\' | g:'.$g.'\')
                             else $(\'#filtering\').val($(\'#filtering\').val()+\' & g:'.$g.'\')
                              ">' 
                            . htmlspecialchars(substr($g, 0, $l))
                            . '</a>';
                }
                else {
                  $toprint .= (empty($toprint) ? '' : ', ')
                            .'<a href="'.$MY_GET_NO_FILT.'&filtering=g:'.$g.'">' 
                            .  htmlspecialchars(substr($g, 0, $l)) 
                            .  '</a>';
                }
              }
              
              if ($truncated) {
                $toprint .= '...';
              }
              
              unset($l, $size, $groups, $g, $truncated);
            }
          }
          
          else {
            $toprint = htmlspecialchars($data[$val]);
          }
        ?>

        
        <td class="<?php echo $COLOR ?> <?php echo $key ?>">
          <?php
            /* wrap cell value around a span, except for the checkbox column */
            if ($key != 'checkbox') {
              $toprint = '<span>'.$toprint.'</span>';
            }
            echo $toprint;
          ?>
        </td>

        
        <?php
          } /* end foreach col */
        ?>

      </tr>

      <?php
          $line++;  
        } /* end while data */
      ?>
    </table>


<?php /*
if ($nb_rows > 0) {
mysql_data_seek($rep, 0);
while($data = mysql_fetch_array($rep, MYSQL_ASSOC)) { 
  echo "<pre>";
  print_r($data);
  echo "</pre>";
}
} */
?>