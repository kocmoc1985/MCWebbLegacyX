create table  ajax_browser_combined_link (
pseudo_link varchar(100) character set utf8,
browser_link varchar(100) character set utf8
);

create table  ajax_browser_home_folder (
pseudo_link varchar(100) character set utf8,
link_to_folder varchar(100) character set utf8
);


insert into ajax_browser_combined_link values ('_upload_public','_upload_main_ajax');
insert into ajax_browser_combined_link values ('_upload','_upload_main_ajax');
insert into ajax_browser_combined_link values ('_exchange','_upload_main_ajax');
insert into ajax_browser_combined_link values ('_upload_rus','_upload_main_ajax');
insert into ajax_browser_combined_link values ('_upload_concord_u_f_1','_upload_main_ajax');
insert into ajax_browser_combined_link values ('_siemens','_upload_main_ajax');
insert into ajax_browser_combined_link values ('_sm_control','_upload_main_ajax');
insert into ajax_browser_combined_link values ('_continental_tyres_001','_upload_main_ajax');
insert into ajax_browser_combined_link values ('_cezare_3g','_upload_main_ajax');
insert into ajax_browser_combined_link values ('_upload_MC_HF','_upload_main_ajax');
insert into ajax_browser_combined_link values ('_upload_MC_CORDIANT','_upload_main_ajax');
insert into ajax_browser_combined_link values ('_safonov_file_manager','_upload_main_ajax');
insert into ajax_browser_combined_link values ('_upload_test','_upload_main_ajax_test');



insert into ajax_browser_home_folder values ('_upload_public','_upload_public');
insert into ajax_browser_home_folder values ('_upload','_upload');
insert into ajax_browser_home_folder values ('_exchange','_exchange');
insert into ajax_browser_home_folder values ('_upload_rus','_a_cherepanin_u_f_2');
insert into ajax_browser_home_folder values ('_upload_concord_u_f_1','_concord_u_f_1');
insert into ajax_browser_home_folder values ('_siemens','_siemens_opc');
insert into ajax_browser_home_folder values ('_sm_control','_sm_control');
insert into ajax_browser_home_folder values ('_wh','_wh_opc');
insert into ajax_browser_home_folder values ('_continental_tyres_001','conti_tyres');
insert into ajax_browser_home_folder values ('_cezare_3g','cezare_3g');
insert into ajax_browser_home_folder values ('_upload_MC_HF','_upload_MC_HF');
insert into ajax_browser_home_folder values ('_upload_MC_CORDIANT','_upload_MC_CORDIANT');
insert into ajax_browser_home_folder values ('_safonov_file_manager','_upload_ls');
insert into ajax_browser_home_folder values ('_upload_test','_upload_test');



