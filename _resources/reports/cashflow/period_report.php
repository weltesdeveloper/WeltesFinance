<?php
require_once '../../../_config/DbConfig.php';
$dbconfig = new DbConfig();
$job = $_GET['job']; // selectJob,
$start = $_GET['start']; // StartDate,
$end = $_GET['end']; // EndDate,
$via = $_GET['via']; // via,
$pos = $_GET['pos']; //pos,
$supplier = $_GET['supplier']; // Supplier
$filename = "CashflowReport$job$start$end";
header("Content-type: application/octet-stream");
header('Content-Disposition: attachment;filename=' . "$filename" . '.xls');
header("Pragma: no-cache");
header("Expires: 0");

$conn = $dbconfig->ConnFinance();
$printjob = "";
if ($job == "%") {
    $printjob = "ALL";
} else {
    $printjob = "$job";
}
?>
<table>
    <thead>
        <tr></tr>
        <tr>
            <th colspan="11" style="text-align: center;">REPORT CASH FLOW</th>
        </tr>
        <tr></tr>
        <tr>
            <th></th>
            <th></th>
            <th>JOB</th>
            <th><?php echo "$printjob";?></th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th>PERIODE</th>
            <th><?php echo "$start";?></th>
            <th><?php echo "$end";?></th>
        </tr>
        <tr></tr>
    </thead>
</table>
<table border="1">
    <thead>
        <tr>
            <th>NO</th>
            <th>TANGGAL</th>
            <th>JOB</th>
            <th>SUPPLIER</th>
            <th>POS</th>
            <th>VIA</th>
            <th>TYPE</th>
            <th>KETERANGAN</th>
            <th>CURRENCY</th>
            <th>MASUK</th>
            <th>KELUAR</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $intotal = 0;
        $outtotal = 0;

        $jobSql = "SELECT * "
                . "FROM VW_CFLOW_INFO "
                . "WHERE PROJECT_NO LIKE '$job' "
                . "AND PAY_CATE_ID LIKE '$via' "
                . "AND CFLOW_CATE_ID LIKE '$pos' "
                . "AND SUPP_ID LIKE '$supplier' "
                . "AND CFLOW_DATE BETWEEN TO_DATE('$start', 'MM/DD/YYYY') "
                . "AND TO_DATE('$end', 'MM/DD/YYYY') "
                . "AND CFLOW_CHECK = '1'";
//        echo $jobSql;
        $jobParse = oci_parse($conn, $jobSql);
        oci_execute($jobParse);
        while ($row1 = oci_fetch_array($jobParse)) {
            ?>
            <tr>
                <th colspan="11" style="text-align: left; background-color: skyblue;">
                    <?php echo "$row1[PROJECT_NO]"; ?>
                </th>
            </tr>
            <?php
            $sql = "SELECT * "
                    . "FROM VW_CFLOW_INFO "
                    . "WHERE PROJECT_NO LIKE '$row1[PROJECT_NO]' "
                    . "AND PAY_CATE_ID LIKE '$via' "
                    . "AND CFLOW_CATE_ID LIKE '$pos' "
                    . "AND SUPP_ID LIKE '$supplier' "
                    . "AND CFLOW_DATE BETWEEN TO_DATE('$start', 'MM/DD/YYYY') "
                    . "AND TO_DATE('$end', 'MM/DD/YYYY') "
                    . "AND CFLOW_CHECK = '1'"
                    . "ORDER BY PROJECT_NO ASC, CFLOW_DATE ASC, PAY_CATE_NM ASC";
            $parse = oci_parse($conn, $sql);
            oci_execute($parse);
            $in = 0;
            $out = 0;
            while ($row = oci_fetch_array($parse)) {
                ?>
                <tr>
                    <td>
                        <?php echo $i; ?>
                    </td>
                    <td>
                        <?php echo $row['CFLOW_DATE']; ?>
                    </td>
                    <td>
                        <?php echo $row['PROJECT_NO']; ?>
                    </td>
                    <td>
                        <?php echo $row['SUPP_NM']; ?>
                    </td>
                    <td>
                        <?php echo $row['CFLOW_CATE_NM']; ?>
                    </td>
                    <td style="text-align: right;">
                        <?php echo $row['PAY_CATE_NM']; ?>
                    </td>
                    <td style="text-align: right;">
                        <?php echo $row['CFLOW_TYPE_NAME']; ?>
                    </td>
                    <td style="text-align: right;">
                        <?php echo $row['CFLOW_REM']; ?>
                    </td>
                    <td style="text-align: right;">
                        <?php echo $row['CFLOW_CURR']; ?>
                    </td>
                    <td style="text-align: right;">
                        <?php echo number_format($row['CFLOW_PRICE_IN'], 2); ?>
                    </td>
                    <td style="text-align: right;">
                        <?php echo number_format($row['CFLOW_PRICE_OUT'], 2); ?>
                    </td>
                </tr>
                <?php
                $i++;
                $intotal += $row['CFLOW_PRICE_IN'];
                $outtotal += $row['CFLOW_PRICE_OUT'];
                $in += $row['CFLOW_PRICE_IN'];
                $out += $row['CFLOW_PRICE_OUT'];
            }
            ?>
            <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th style="text-align: right;" colspan="8">SUMMARY</th>
            <th style="text-align: right;">IDR</th>
            <th style="text-align: right;">
                <?php echo number_format($intotal, 2); ?>
            </th>
            <th style="text-align: right;">
                <?php echo number_format($outtotal, 2); ?>
            </th>
        </tr>
    </tfoot>
</table>
<br>
<br>
<br>
<table>
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="text-align: right;border: 1px solid black;">TOTAL MASUK</th>
            <th style="text-align: right;border: 1px solid black;">IDR</th>
            <th style="text-align: right;border: 1px solid black;"><?php echo number_format($intotal, 2); ?></th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="text-align: right;border: 1px solid black;">TOTAL KELUAR</th>
            <th style="text-align: right;border: 1px solid black;">IDR</th>
            <th style="text-align: right;border: 1px solid black;"><?php echo number_format($outtotal, 2); ?></th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th style="text-align: right;text-align: right;border: 1px solid black;">SALDO AKHIR</th>
            <th style="text-align: right;border: 1px solid black;">IDR</th>
            <th style="text-align: right;border: 1px solid black;"><?php echo number_format($intotal - $outtotal, 2); ?></th>
        </tr>
    </thead>
</table>
