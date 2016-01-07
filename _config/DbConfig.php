<?php

class DbConfig {

    private $LogisticConn ;//= null;
    private $FinanceConn ;//= null;
    private $WeltesConn ;//= null;
    private $returnArray = array();
    
    public function __construct() {
        $this->LogisticConn = null;
        $this->FinanceConn = null;
        $this->WeltesConn = null;
    }

    public function ConnFinance() {
//        define("ORA_CON_UN", "WELTESFINANCEADMIN");
//        define("ORA_CON_PW", "weltespass");
//        define("ORA_CON_DB", "192.168.100.71/WENFINANCE");

        $this->FinanceConn = oci_pconnect("WELTESFINANCEADMIN", "weltespass", "192.168.100.71/WENFINANCE");
        return $this->FinanceConn;
    }

    public function ConnWenloginv() {
//        define("ORA_CON_UN", "WELTESADMIN");
//        define("ORA_CON_PW", "weltespass");
//        define("ORA_CON_DB", "192.168.100.68/WENLOGIN");

        $LogisticConn = oci_pconnect("WELTESADMIN", "weltespass", "192.168.100.68/WENLOGINV");
        $this->LogisticConn = $LogisticConn;
        return $this->LogisticConn;
    }

    public function ConnWeltes() {

        $koneksi = oci_pconnect("WELTESADMIN", "weltespass", "192.168.100.70/WELTES");
        $this->WeltesConn = $koneksi;
        return $this->WeltesConn;
    }

    public function DeleteRecord($sql, $conn) {
        $status_del = false;
        $parse = oci_parse($sql, $conn);
        $execute = oci_execute($parse);
        if ($execute) {
            oci_commit($conn);
            $status_del = true;
        } else {
            oci_rollback($conn);
            $status_del = false . oci_error();
        }
        return $status_del;
    }

    public function UpdateRecord($sql, $conn) {
        $status_update = false;
        $parse = oci_parse($sql, $conn);
        $execute = oci_execute($parse);
        if ($execute) {
            oci_commit($conn);
            $status_update = true;
        } else {
            oci_rollback($conn);
            $status_update = false . oci_error();
        }
        return $status_update;
    }

    public function SelectRecord($sql, $conn) {
        $parse = oci_parse($sql, $conn);
        oci_execute($parse);
        while ($row = oci_fetch_array($parse)) {
            array_push($this->returnArray, $row);
        }
        return json_encode($this->returnArray);
    }
    

}
