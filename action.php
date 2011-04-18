<?php
/*
  OpenPom $Revision$
  $HeadURL$
 
  Copyright 2010, Exosec
  Licensed under GPL Version 2.
  http://www.gnu.org/licenses/
 
  $Date$
*/
  
  if (basename($_SERVER['SCRIPT_NAME']) != "index.php") die() ; 
  if (!isset($_SESSION['USER'])) die(); ?>
  
  
    <table id="top">
      <tr>
        <td colspan="11" id="margintop"></td>
      </tr>
      <tr>
      <td style="padding-left: 4px;">
          <span class="icon-btn icon-refesh"
                title="<?= ucfirst(lang($MYLANG, 'refresh'))?>"
                onclick="window.location.href='<?= $MY_GET ?>';"></span>&#160;
          
          <span title="<?= ucfirst(lang($MYLANG, 'refreshing'))?>" 
                id="refreshspan"></span>&#160;&#160;
      </td>

      <td style="text-align: center;">
          <span class="icon-btn icon-ack"
                onclick="clicked_generic_popin('ack.php');"
                title="<?= ucfirst(lang($MYLANG, 'acknowledge'))?>"></span>&thinsp;
               
          <span class="icon-btn icon-down"
                onclick="clicked_generic_popin('down.php');"
                title="<?= ucfirst(lang($MYLANG, 'downtime'))?>"></span>&thinsp;
               
          <span class="icon-btn icon-recheck"
                onclick="clicked_generic_action('recheck');"
                title="<?= ucfirst(lang($MYLANG, 'recheck'))?>"></span>&thinsp;
               
          <span class="icon-btn icon-disable"
                onclick="clicked_generic_action('disable');"
                title="<?= ucfirst(lang($MYLANG, 'disable_title'))?>"></span>&thinsp;
          
          <span class="icon-btn icon-reset"
                onclick="clicked_generic_action('reset');"
                title="<?= ucfirst(lang($MYLANG, 'reset_title'))?>"></span>&thinsp;
               
          <span class="icon-btn icon-comment"
                onclick="clicked_generic_popin('comment.php');"
                title="<?= ucfirst(lang($MYLANG, 'comment0'))?>"></span>
                
      </td>
      
      <td style="padding-left: 10px; padding-right: 10px;">
      </td>
      
      <td style="text-align: center;">
        <?php
          $popin = $POPIN ? 'disa_popin' : 'ena_popin';
        ?>
        <span class="icon-btn icon-<?= $popin ?>"
              title="<?= ucfirst(lang($MYLANG, $popin))?>"
              onclick="window.location.href='<?= $MY_GET.'&popin='.(($POPIN+1)%2) ?>';"></span>&thinsp;
                
          <span class="icon-btn icon-<?= $global_notif ?>"
                title="<?= ucfirst(lang($MYLANG, $global_notif))?>"
                onclick="window.location.href='<?= $MY_GET.'&'.$global_notif ?>';"></span>&thinsp;
                
          <?php if (isset($LOG)) { ?>
            <span class="icon-btn icon-nagios"
                  title="<?= ucfirst(lang($MYLANG, 'show_log')) ?>"
                  onclick="pop('<?= $LOG; ?>', 'nagios_log', 600, 500);"></span>&thinsp;
          <?php } ?>
          
          <span class="icon-btn icon-monitor"
                title="<?= ucfirst(lang($MYLANG, 'mode'))?>"
                onclick="window.location.href='?monitor';"></span>&thinsp;
               
          <span class="icon-btn icon-options"
                onclick="popin('option.php', { 
                  onOpen: function() { filtering_has_focus = true; }, 
                  onClosed: function() { filtering_has_focus = false; }
                });"
                title="<?= ucfirst(lang($MYLANG, 'option'))?>"></span>
        </td>
        
        <td style="padding-left: 10px; padding-right: 10px;">
        </td>
        
        <td class="filters" style="text-align: center;">
          <form method="get" class="filt" name="filt" action="?filter=1" id="filt">
            
            <span id="metter-wrap">
              <img src="img/metter.png" style="position: absolute; top: 3px; left: 4px;" />
              <select name="level" onChange="this.form.submit();">
                <? for ($sub_level=1; $sub_level <= $MAXLEVEL; $sub_level++) { ?>
                <option value="<?= $sub_level?>" <?= ($sub_level==$LEVEL)?"selected":""?>>
                  &#160;&#160;&#160;&#160;&#160;&#160;
                  <?= $sub_level?> - <?= ucfirst(lang($MYLANG, 'level'.$sub_level))?>
                </option>
                <? } ?>
              </select>
            </span>&thinsp;
            
            <input type="text" 
                   name="filtering" 
                   value="<?= $FILTER?>" 
                   id="filtering" 
                   title="<?= ucfirst(lang($MYLANG, 'search'))?>"/>
                   
            <span class="icon-btn icon-clear"
                  title="<?= ucfirst(lang($MYLANG, 'clear'))?>"
                  onclick="$('#filtering').val(''); $('#filt').submit();"></span>
            
          </form>
        </td>

        <td style="padding-left: 10px; padding-right: 10px;">
        </td>
        
        <td style="text-align: center; cursor: default;" title="<?= lang($MYLANG, 'meter') ?>">
          <span class="count red">C:<b>&thinsp;<?= $hit_critical ?></b></span>
          <span class="count yellow">W:<b>&thinsp;<?= $hit_warning ?></b></span>
          <span class="count orange">U:<b>&thinsp;<?= $hit_unknown ?></b></span>
          <span class="count" style="background-color: #D7E6AD;">D:<b>&thinsp;<?= $hit_down ?></b></span>
          <span class="count" style="background-color: #D7E6AD;">A:<b>&thinsp;<?= $hit_ack ?></b></span>
          <span class="count">T:<b>&thinsp;<?= $hit_any ?></b></span>
        </td>
        
        <td style="padding-left: 10px; padding-right: 10px;">
        </td>

        <td style="text-align: right; padding-right: 4px;">
          <?php if ($FIRST >= $LINE_BY_PAGE) { ?>
            <span class="icon-btn icon-prev"
                  onclick="window.location.href='<?= $MY_GET_NO_NEXT?>&prev=<?= $FIRST-$LINE_BY_PAGE?>';"
                  title="<?= ucfirst(lang($MYLANG, 'prev'))?>"></span>
          <?php } ?>
          
          <span><?= $FIRST."-".($FIRST+$nb_rows)."&thinsp;<b>/".$hit_any."</b>" ?></span>
          
          <?php if ($nb_rows >= $LINE_BY_PAGE) { ?>
            <span class="icon-btn icon-next"
                  onclick="window.location.href='<?= $MY_GET_NO_NEXT?>&next=<?= $FIRST+$LINE_BY_PAGE?>';"
                  title="<?= ucfirst(lang($MYLANG, 'next'))?>"></span>
          <?php } ?>
        </td>       

      </tr>
      <tr>
        <td colspan="11" id="wgrad">
          <div id="white"></div>
          <div id="grad"></div>
        </td>
      </tr>
    </table>
    
