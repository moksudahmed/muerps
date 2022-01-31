SELECT event_id, schema_name, table_name, relid, session_user_name, 
       action_tstamp_tx, action_tstamp_stm, action_tstamp_clk, transaction_id, 
       application_name, client_addr, client_port, client_query, action, 
       row_data, changed_fields, statement_only
  FROM audit.logged_actions
  WHERE  table_name = 'tbl_u_exammarks' AND action_tstamp_tx between '2021-09-30 00:00:00.218963+06' AND '2021-10-01 12:56:18.218963+06';
