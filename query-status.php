<?php
/*
  OpenPOM
 
  Copyright 2010, Exosec
  Licensed under GPL Version 2.
  http://www.gnu.org/licenses/
*/


$QUERY_SVC = "
  SELECT
    TIMEDIFF(NOW(), SS.last_state_change)  AS LASTCHANGEDIFF,
    SS.last_state_change                   AS LASTCHANGE,
    SS.current_state                       AS STATE,
    TIMEDIFF(NOW(), SS.last_check)         AS LASTCHECKTIMEDIFF,
    SS.last_check                          AS LASTCHECKTIME,
    SS.output                              AS OUTPUT,
    SS.current_check_attempt               AS CURATTEMP,
    SS.max_check_attempts                  AS MAXATTEMP,
    SS.check_type                          AS CHKTYPE,
    SS.perfdata                            AS PERFDATA,
    SS.latency                             AS LATENCY,
    SS.execution_time                      AS EXEC_TIME,
    SS.problem_has_been_acknowledged       AS ACK,
    SS.scheduled_downtime_depth          AS DOWNTIME,
    IF (
      SS.no_more_notifications = 0
      AND SS.notifications_enabled = 1,
      SS.last_notification,
      'N/A'
    )                                      AS NOTIF,
    IF (
      SS.flap_detection_enabled = 1,
      is_flapping,
      2
    )                                      AS FLAPPING,
    SS.percent_state_change                AS PERCENT,
    TIMEDIFF(NOW(), SS.status_update_time) AS UPDATETIMEDIFF,
    SS.status_update_time                  AS UPDATETIME,
    H.address                              AS ADDRESS,
    H.display_name                         AS HOSTNAME,
    S.display_name                         AS SERVICE,
    ( SELECT 
      concat_ws(';', author_name, comment_data)
      FROM ".$BACKEND."_commenthistory AS ACO
      WHERE ACO.object_id = SS.service_object_id
      AND entry_type = 4
      AND author_name != '(Nagios Process)'
      AND deletion_time = '000-00-00 00:00:00' 
      ORDER BY ACO.entry_time DESC
      LIMIT 1 )                            AS ACKCOMMENT,
    ( SELECT 
      concat_ws(';', author_name, comment_data, scheduled_end_time)
      FROM ".$BACKEND."_downtimehistory AS DCO
      WHERE DCO.object_id = SS.service_object_id
      AND actual_end_time = '000-00-00 00:00:00' 
      AND scheduled_end_time >= NOW()
      ORDER BY DCO.entry_time DESC
      LIMIT 1 )                            AS DOWNCOMMENT,
    ( SELECT 
      concat_ws(';', author_name, comment_data)
      FROM ".$BACKEND."_commenthistory AS CO
      WHERE CO.object_id = SS.service_object_id
      AND entry_type = 1
      AND author_name != '(Nagios Process)'
      AND deletion_time = '000-00-00 00:00:00'
      AND substring(comment_data, 1, 1) != '!'
      ORDER BY CO.entry_time DESC
      LIMIT 1 )                            AS COMMENT, 
    ( SELECT count(*) > 0
      FROM ".$BACKEND."_commenthistory AS CTR
      WHERE CTR.object_id = SS.service_object_id
      AND CTR.entry_type = 1
      AND CTR.comment_source = 1
      AND CTR.deletion_time = '0000-00-00 00:00:00'
      AND substring(CTR.comment_data, 1, 1) = '!' )
                                           AS TRACKED

  FROM
    ".$BACKEND."_servicestatus AS SS
    INNER JOIN ".$BACKEND."_services AS S      ON S.service_object_id = SS.service_object_id
    INNER JOIN ".$BACKEND."_hosts AS H         ON H.host_object_id = S.host_object_id
  WHERE
    SS.servicestatus_id = define_my_id
" ;

$QUERY_HOST = "
  SELECT
    TIMEDIFF(NOW(), HS.last_state_change)  AS LASTCHANGEDIFF,
    HS.last_state_change                   AS LASTCHANGE,
    ( case HS.current_state
        when 2 then 3
        when 1 then 2
        when 0 then 0
        end )                              AS STATE,
    TIMEDIFF(NOW(), HS.last_check)         AS LASTCHECKTIMEDIFF,
    HS.last_check                          AS LASTCHECKTIME,
    HS.output                              AS OUTPUT,
    HS.current_check_attempt               AS CURATTEMP,
    HS.max_check_attempts                  AS MAXATTEMP,
    HS.check_type                          AS CHKTYPE,
    HS.perfdata                            AS PERFDATA,
    HS.latency                             AS LATENCY,
    HS.execution_time                      AS EXEC_TIME,
    HS.problem_has_been_acknowledged       AS ACK,
    HS.scheduled_downtime_depth            AS DOWNTIME,
    IF (
      HS.no_more_notifications = 0
      AND HS.notifications_enabled = 1,
      HS.last_notification,
      'N/A'
    )                                      AS NOTIF,
    IF (
      HS.flap_detection_enabled = 1,
      is_flapping,
      'N/A'
    )                                      AS FLAPPING,
    HS.percent_state_change                AS PERCENT,
    TIMEDIFF(NOW(), HS.status_update_time) AS UPDATETIMEDIFF,
    HS.status_update_time                  AS UPDATETIME,
    H.address                              AS ADDRESS,
    H.display_name                         AS HOSTNAME,
    ( SELECT 
      concat_ws(';', author_name, comment_data)
      FROM ".$BACKEND."_commenthistory AS ACO
      WHERE ACO.object_id = HS.host_object_id
      AND entry_type = 4
      AND author_name != '(Nagios Process)'
      AND deletion_time = '000-00-00 00:00:00' 
      ORDER BY ACO.entry_time DESC
      LIMIT 1 )                            AS ACKCOMMENT,
    ( SELECT 
      concat_ws(';', author_name, comment_data, scheduled_end_time)
      FROM ".$BACKEND."_downtimehistory AS DCO
      WHERE DCO.object_id = HS.host_object_id
      AND actual_end_time = '000-00-00 00:00:00' 
      AND scheduled_end_time >= NOW()
      ORDER BY DCO.entry_time DESC
      LIMIT 1 )                            AS DOWNCOMMENT,
    ( SELECT 
      concat_ws(';', author_name, comment_data)
      FROM ".$BACKEND."_commenthistory AS CO
      WHERE CO.object_id = HS.host_object_id
      AND entry_type = 1
      AND author_name != '(Nagios Process)'
      AND deletion_time = '000-00-00 00:00:00'
      AND substring(comment_data, 1, 1) != '!'
      ORDER BY CO.entry_time DESC
      LIMIT 1 )                            AS COMMENT, 
    ( SELECT count(*) > 0
      FROM ".$BACKEND."_commenthistory AS CTR
      WHERE CTR.object_id = HS.host_object_id
      AND CTR.entry_type = 1
      AND CTR.comment_source = 1
      AND CTR.deletion_time = '0000-00-00 00:00:00'
      AND substring(CTR.comment_data, 1, 1) = '!' )
                                           AS TRACKED

  FROM
    ".$BACKEND."_hoststatus AS HS
    INNER JOIN ".$BACKEND."_hosts AS H      ON H.host_object_id = HS.host_object_id
  WHERE
    HS.hoststatus_id = define_my_id
" ;

?>
