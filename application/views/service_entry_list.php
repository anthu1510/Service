<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 11/30/2017
 * Time: 1:14 PM
 */

require_once ('common/html_open.php');

require_once ('common/head_open.php');
require_once ('common/meta.php');
require_once ('common/link_css.php');
require_once ('dashboard/dashboard_common_css.php');
require_once ('plugins/bootstrap_datetimepicker_css.php');
require_once ('plugins/bootstrap_select_css.php');
require_once ('plugins/bootstrap_fileinput_css.php');
require_once ('plugins/datatables_css.php');
require_once ('plugins/datatables_custom_css.php');
require_once ('common/head_close.php');

require_once ('common/body_open.php');

require_once ('dashboard/dashboard_main_container_open.php');
require_once ('dashboard/dashboard_left_side_content.php');
require_once ('dashboard/dashboard_top_navigation.php');

require_once ('dashboard/dashboard_main_content_open.php');
require_once('callcloser/serviceentry/serviceentry_table_list.php');
require_once ('dashboard/dashboard_main_content_close.php');

require_once ('dashboard/dashboard_main_container_close.php');

require_once ('common/link_js.php');
require_once ('dashboard/dashboard_common_js.php');
require_once ('plugins/bootstrap_datetimepicker_js.php');
require_once ('plugins/bootstrap_select_js.php');
require_once ('plugins/bootstrap_fileinput_js.php');
require_once ('plugins/datatables_js.php');
require_once('callcloser/serviceentry/serviceentry_datatable_list_js.php');
require_once ('common/body_close.php');

require_once ('common/html_open.php');
require_once ('service/modal_window.php');
require_once ('callcloser/serviceentry/serviceentry_form_modal.php');
require_once ('customer/customer_add_form_modal.php');
require_once ('engineers/engineer_add_form_modal.php');
?>
