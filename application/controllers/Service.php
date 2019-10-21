<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 23-11-2017
 * Time: 15:08
 */

require_once (APPPATH.'libraries/ssp.customized.class.php');

class Service extends CI_Controller
{
    var $log_detail;
    var $date;
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Kolkata');
        $this->date = date('Y-m-d H:i:s');

        $this->log_detail = $this->session->userdata("user_detail");

        $this->log_detail = $this->session->userdata('user_detail');

        if(!isset($this->log_detail->u_id))
        {
            redirect('welcome/');
        }
        else
        {
            if($this->log_detail->u_role == 'Engineer')
            {
                redirect("user/");
            }
        }

        $this->load->model("service_model");

    }

    public function index()
    {
        $mes = $this->session->userdata("service");

        if (isset($mes))
        {
            $data = array(
                'title' => 'Service || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->log_detail->u_name,
                'comp_status' => $this->LoadStatus(),
                'engineer_list'=>$this->LoadEnginner()
            );
        }
        else
        {
            $data = array(
                'title' => 'Service || Dashboard',
                'message' => '',
                'name' => $this->log_detail->u_name,
                'comp_status' => $this->LoadStatus(),
                'engineer_list'=>$this->LoadEnginner()

            );
        }

        $this->load->view('compliant_list', $data);
        $this->session->unset_userdata("service");
    }

    public function AllocateServiceEngineer()
    {
        $complient_list=$this->input->post('complient_list_id');
        $enginner_list=$this->input->post('enginner_list');
        $redirect_url=$this->input->post('redirect_url');

        //echo " complist:$complient_list Eng:$enginner_list Redurl : $redirect_url ";

        $this->load->model("service_model");
        $this->service_model->allocateengineer($enginner_list,$complient_list);
        redirect("service/".$redirect_url);
    }

    public function CustomerCompliantUpdate()
    {
        $id = $this->input->post('compliant_id');

        $data = array(
            'reg_date' => $this->date,
            'ser_date' => $this->input->post('ser_date'),
            'complient_title' => $this->input->post('complient_title'),
            'complient_desc' => $this->input->post('complient_desc'),
            'complient_status' => $this->input->post('complient_status'),
            'close_date' => $this->input->post('close_date'),
            'status' => 'active'
        );

        $result = $this->service_model->CompliantUpdate($id,$data);

        if($result == 1)
        {
            $this->session->set_userdata("service","ComplientUpdated");
            if($this->session->userdata('redirect'))
            {
                $url = $this->session->userdata("redirect");
                $result = end(explode('/index.php/', $url));
                redirect($result);
            }
        }
        else
        {
            $this->session->set_userdata("service","ComplientUnUpdated");
            if($this->session->userdata('redirect'))
            {
                $url = $this->session->userdata("redirect");
                $result = end(explode('/index.php/', $url));
                redirect($result);
            }
        }
    }

    public function StatusUpdate()
    {
       $id = $this->input->post('complient_id_h');
       $status = $this->input->post('complient_status_allocate');


        $this->load->model("service_model");
        $this->service_model->status_update($id,$status);

        if($this->session->userdata('redirect'))
        {
            $url = $this->session->userdata("redirect");
            $result = end(explode('/index.php/', $url));
            redirect($result);
        }

    }

    public function AllotmentList()
    {

        $mes = $this->session->userdata("service");

        if (isset($mes))
        {
            $data = array(
                'title' => 'Service || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->log_detail->u_name,
                'comp_status' => $this->LoadStatus(),
                'engineer_list'=>$this->LoadEnginner()
            );
        }
        else
        {
            $data = array(
                'title' => 'Service || Dashboard',
                'message' => '',
                'name' => $this->log_detail->u_name,
                'comp_status' => $this->LoadStatus(),
                'engineer_list'=>$this->LoadEnginner()

            );
        }

        $this->load->view('aleartment_list', $data);
        $this->session->unset_userdata("service");
    }

    public function NextDayList()
    {

        $mes = $this->session->userdata("service");

        if (isset($mes))
        {
            $data = array(
                'title' => 'Service || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->log_detail->u_name,
                'comp_status' => $this->LoadStatus(),
                'engineer_list'=>$this->LoadEnginner()
            );
        }
        else
        {
            $data = array(
                'title' => 'Service || Dashboard',
                'message' => '',
                'name' => $this->log_detail->u_name,
                'comp_status' => $this->LoadStatus(),
                'engineer_list'=>$this->LoadEnginner()

            );
        }

        $this->load->view('nextday_list', $data);
        $this->session->unset_userdata("service");
    }

    public function ScheduledList()
    {

        $mes = $this->session->userdata("service");

        if (isset($mes))
        {
            $data = array(
                'title' => 'Service || Dashboard',
                'message' => $this->Message($mes),
                'name' => $this->log_detail->u_name,
                'comp_status' => $this->LoadStatus(),
                'engineer_list'=>$this->LoadEnginner()
            );
        }
        else
        {
            $data = array(
                'title' => 'Service || Dashboard',
                'message' => '',
                'name' => $this->log_detail->u_name,
                'comp_status' => $this->LoadStatus(),
                'engineer_list'=>$this->LoadEnginner()

            );
        }

        $this->load->view('schedule_list', $data);
        $this->session->unset_userdata("service");
    }

    public function ViewComplient()
    {

        $id = $this->input->post('id');

        $this->load->model('service_model');
        $res=  $this->service_model->getComplinetById($id);
        $val=$res[0];
        echo json_encode($val);

    }

    public function CompliantServerSide()
    {
        // DB table to use
        $table = 'complient';

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes

        $columns = array(
            array( 'db' => '`co`.`id`', 'dt' => 1,'field' => 'id'),

            array( 'db' => '`cu`.`cus_name`',  'dt' => 2,'field' => 'cus_name'  ),
            array( 'db' => '`cu`.`cus_compnay_name`',   'dt' => 3,'field' => 'cus_compnay_name'  ),
            array( 'db' => '`cu`.`cus_mobile1`',     'dt' => 4,'field' => 'cus_mobile1'  ),
            array( 'db' => '`cu`.`cus_place`',     'dt' => 5,'field' => 'cus_place'  ),
            array( 'db' => '`cu`.`cus_city`',     'dt' => 6,'field' => 'cus_city'  ),

            array(
                'db'        => '`co`.`complient_status`',
                'dt'        => 7,
                'field' => 'complient_status',
                'formatter' => function( $d, $row ) {
                    if($d == "Registered")
                    {
                        $color = "#c6c311";
                    }
                    elseif ($d == "Allocated")
                    {
                        $color = "#44c611";
                    }
                    elseif ($d == "Processing")
                    {
                        $color = "#e2950f";
                    }
                    elseif ($d == "Parts Ordered")
                    {
                        $color = "#0ee2be";
                    }
                    elseif ($d == "Closed")
                    {
                        $color = "#0d11e2;color:white";
                    }
                    elseif ($d == "Reopen")
                    {
                        $color = "#e2170c;color:white";
                    }
                    elseif ($d == "Customer Test")
                    {
                        $color = "#e20b8c;color:white";
                    }

                    //return '<button type="button" id="btnstatus" class="btn btn-default btn-xs" style="background-color: '.$color.';border-color: gray;"> '.$d. '</button>';
                    return '<button type="button" id="btnstatus" class="btn btn-warning btn-xs" style="background-color: '.$color.';border-color: gray;"> '.$d. '</button>';

                }
            ),

            array(
                'db'        => '`cu`.`cus_city`',
                'dt'        => 8,
                'field' => 'cus_city',
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i>
                            </button>&nbsp;<button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
                }
            )
        );

        // SQL server connection information
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname
        );


        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.


        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
        );
        */
        /*
                    $joinQuery = "FROM `{$table}` AS `co` LEFT JOIN `customer` AS `cu` ON (`co`.`id` = `cu`.`cus_id`)";
                   // $extraCondition = "`co`.`status`="."'active' AND `co`.`complient_status`='registered' ";
                    $extraCondition = "";*/

            //$joinQuery = "FROM `complient` AS `co` JOIN `customer` AS `cu` ON (`co`.`cus_id` = `cu`.`cus_id`)";

            //echo $joinQuery;exit;

        $joinQuery = "FROM `complient` AS `co` JOIN `customer` AS `cu` ON (`co`.`cus_id` = `cu`.`cus_id`)";
        $extraWhere = "";
        $groupBy = "";
        $having = "";

        echo json_encode(
            SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
        );

    }

    public function AllotmentmentServerSide()
    {
        // DB table to use
        $table = 'complient';

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple
        // indexes

        $columns = array(
                        array( 'db' => '`co`.`id`', 'dt' => 1,'field' => 'id'  ),
                        array( 'db' => '`co`.`reg_date`',     'dt' => 2,'field' => 'reg_date'  ),
                        array( 'db' => '`cu`.`cus_name`',  'dt' => 3,'field' => 'cus_name'  ),
                        array( 'db' => '`cu`.`cus_compnay_name`',   'dt' => 4,'field' => 'cus_compnay_name'  ),
                        array( 'db' => '`cu`.`cus_mobile1`',     'dt' => 5,'field' => 'cus_mobile1'  ),
                        array( 'db' => '`cu`.`cus_place`',     'dt' => 6,'field' => 'cus_place'  ),
                        array( 'db' => '`ser`.`name`',     'dt' => 7,'field' => 'name'  ),

                        array(
                            'db'        => '`co`.`complient_status`',
                            'dt'        => 8,
                            'field' => 'complient_status',
                            'formatter' => function( $d, $row ) {
                                return '<button type="button" id="btnstatus" class="btn btn-success btn-xs" title="Allocated"> '.$d. '</button>';

                            }
                        ),

                        array(
                            'db'        => '`cu`.`cus_city`',
                            'dt'        => 9,
                            'field' => 'cus_city',
                            'formatter' => function( $d, $row ) {
                                return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i>
                                        </button>&nbsp;<button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
                            }
                        )
                    );

            // SQL server connection information
            $sql_details = array(
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db'   => $this->db->database,
                'host' => $this->db->hostname
            );


            $joinQuery = "FROM complient AS  co LEFT JOIN customer AS cu ON (cu.cus_id = co.cus_id)
                            INNER JOIN ser_engineer as ser ON (co.engineer_id = ser.id)";

            $extraWhere = "co.complient_status = 'Allocated'";
            $groupBy = "";
            $having = "";

            echo json_encode(
                SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
            );

    }

    public function NextDayserverside()
    {
            // DB table to use
            $table = 'complient';

            // Table's primary key
            $primaryKey = 'id';

            // Array of database columns which should be read and sent back to DataTables.
            // The `db` parameter represents the column name in the database, while the `dt`
            // parameter represents the DataTables column identifier. In this case simple
            // indexes

        $columns = array(
            array( 'db' => '`co`.`id`', 'dt' => 1,'field' => 'id'  ),
            array( 'db' => '`co`.`reg_date`',  'dt' => 2,'field' => 'reg_date'  ),
            array( 'db' => '`cu`.`cus_name`',  'dt' => 3,'field' => 'cus_name'  ),
            array( 'db' => '`cu`.`cus_compnay_name`',   'dt' => 4,'field' => 'cus_compnay_name'  ),
            array( 'db' => '`cu`.`cus_mobile1`',     'dt' => 5,'field' => 'cus_mobile1'  ),
            array( 'db' => '`cu`.`cus_place`',     'dt' => 6,'field' => 'cus_place'  ),
            array( 'db' => '`ser`.`name`',     'dt' => 7,'field' => 'name'  ),

            array(
                'db'        => '`co`.`complient_status`',
                'dt'        => 8,
                'field' => 'complient_status',
                'formatter' => function( $d, $row ) {
                    if($d == "Registered")
                    {
                        $color = "#c6c311";
                    }
                    elseif ($d == "Allocated")
                    {
                        $color = "#44c611";
                    }
                    elseif ($d == "Processing")
                    {
                        $color = "#e2950f";
                    }
                    elseif ($d == "Parts Ordered")
                    {
                        $color = "#0ee2be";
                    }
                    elseif ($d == "Closed")
                    {
                        $color = "#0d11e2;color:white";
                    }
                    elseif ($d == "Reopen")
                    {
                        $color = "#e2170c;color:white";
                    }
                    elseif ($d == "Customer Test")
                    {
                        $color = "#e20b8c;color:white";
                    }

                    return '<button type="button" id="btnstatus" class="btn btn-default btn-xs" style="background-color: '.$color.';border-color: gray;" title="Registered"> '.$d. '</button>';

                }
            ),

            array(
                'db'        => '`cu`.`cus_city`',
                'dt'        => 9,
                'field' => 'cus_city',
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i>
                            </button>&nbsp;<button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
                }
            )
        );

            // SQL server connection information
            $sql_details = array(
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db'   => $this->db->database,
                'host' => $this->db->hostname
            );


            $joinQuery = "FROM complient AS  co LEFT JOIN customer AS cu ON (cu.cus_id = co.cus_id)
                                LEFT JOIN ser_engineer as ser ON (co.engineer_id = ser.id)";

            $extraWhere = "co.ser_date IN (CURDATE()+ INTERVAL 1 DAY, CURDATE() + INTERVAL 1 DAY)";
            $groupBy = "";
            $having = "";

            echo json_encode(
                SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
            );

    }

    public function SccheduleServerside()
    {
            // DB table to use
            $table = 'complient';

            // Table's primary key
            $primaryKey = 'id';

            // Array of database columns which should be read and sent back to DataTables.
            // The `db` parameter represents the column name in the database, while the `dt`
            // parameter represents the DataTables column identifier. In this case simple
            // indexes

        $columns = array(
            array( 'db' => '`co`.`id`', 'dt' => 1,'field' => 'id'  ),
            array( 'db' => '`co`.`reg_date`',  'dt' => 2,'field' => 'reg_date'  ),
            array( 'db' => '`cu`.`cus_name`',  'dt' => 3,'field' => 'cus_name'  ),
            array( 'db' => '`cu`.`cus_compnay_name`',   'dt' => 4,'field' => 'cus_compnay_name'  ),
            array( 'db' => '`cu`.`cus_mobile1`',     'dt' => 5,'field' => 'cus_mobile1'  ),
            array( 'db' => '`cu`.`cus_place`',     'dt' => 6,'field' => 'cus_place'  ),
            array( 'db' => '`ser`.`name`',     'dt' => 7,'field' => 'name'  ),

            array(
                'db'        => '`co`.`complient_status`',
                'dt'        => 8,
                'field' => 'complient_status',
                'formatter' => function( $d, $row ) {
                    if($d == "Registered")
                    {
                        $color = "#c6c311";
                    }
                    elseif ($d == "Allocated")
                    {
                        $color = "#44c611";
                    }
                    elseif ($d == "Processing")
                    {
                        $color = "#e2950f";
                    }
                    elseif ($d == "Parts Ordered")
                    {
                        $color = "#0ee2be";
                    }
                    elseif ($d == "Closed")
                    {
                        $color = "#0d11e2;color:white";
                    }
                    elseif ($d == "Reopen")
                    {
                        $color = "#e2170c;color:white";
                    }
                    elseif ($d == "Customer Test")
                    {
                        $color = "#e20b8c;color:white";
                    }

                    return '<button type="button" id="btnstatus" class="btn btn-default btn-xs" style="background-color: '.$color.';border-color: gray;" title="Registered"> '.$d. '</button>';

                }
            ),

            array(
                'db'        => '`cu`.`cus_city`',
                'dt'        => 9,
                'field' => 'cus_city',
                'formatter' => function( $d, $row ) {
                    return '<button type="button" id="btnview" class="btn btn-success btn-xs" title="View"><i class="fa fa-eye" aria-hidden="true"></i>
                            </button>&nbsp;<button type="button" id="btnedit" class="btn btn-primary btn-xs" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
                }
            )
        );

            // SQL server connection information
            $sql_details = array(
                'user' => $this->db->username,
                'pass' => $this->db->password,
                'db'   => $this->db->database,
                'host' => $this->db->hostname
            );


            $joinQuery = "FROM complient AS  co LEFT JOIN customer AS cu ON (cu.cus_id = co.cus_id)
                                LEFT JOIN ser_engineer as ser ON (co.engineer_id = ser.id)";

            $extraWhere = "co.ser_date IN (CURDATE(), CURDATE()) AND `co`.`complient_status` = 'Allocated'";
            $groupBy = "";
            $having = "";

            echo json_encode(
                SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having )
            );

    }

    public function LoadStatus()
    {
        $this->load->model("service_model");
        $res=$this->service_model->getStatus();
        return $res;
    }

    public function LoadEnginner()
    {
        $this->load->model('service_model');
        $ret=$this->service_model->loadengineer();
        return $ret;
    }

    private function Message($message)
    {
        if ($message == 'ComplientUpdated')
        {
            $mess = '<div class="alert alert-success"><strong>Success!!!</strong>&nbsp;&nbsp;Customer Compliant Updated Successfully...</div>';
        }
        elseif ($message == 'ComplientUnUpdated')
        {
            $mess = '<div class="alert alert-danger"><strong>Failed!!!</strong>&nbsp;&nbsp;Customer Compliant Does not Updated.. Try again...</div>';
        }

        return $mess;
    }
}