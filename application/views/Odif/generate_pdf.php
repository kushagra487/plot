<?php

require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();

$html = '
    <table id="datatable-responsive datatable-keytable_wrapper" class="table2 table-bordered nowrap"
    cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>S. No.</th>
        <th>Mega Process</th>
        <th>Process</th>
        <th>Activity</th>
        <th>UOM</th>
        <th>Planned Quantity</th>
        <th>Actual Quantity</th>
        <th>Assigned Person</th>
        <th>Start Date & Time</th>
        <th>Finish Date & Time</th>
        <th class="col-xs-1">Status</th>
        <th class="col-xs-1">Comments</th>
    </tr>
    </thead>
    <tbody>
';

// echo '<pre>';
// print_r($odif);die;

$sl = 0;
foreach ($odif as $value) {


    if ($value['dependent_on'] != '') {

    $sql_dep_status = "SELECT * FROM activity WHERE unique_code='" . $value['dependent_on'] . "' AND project_id='" . $value['project_id'] . "' AND status=0";

    $res_dep_status = $this->db->query($sql_dep_status);
    $result_dep_status = $res_dep_status->row();

    //echo "<br>aaa-->".$result_dep_status->activity_status;

    if ($result_dep_status->activity_status == 0) {
        $disabled_class = "disabled";
        $disabled_class1 = "readonly";
    } else {
        $disabled_class = "";
        $disabled_class1 = '';
    }
    }
    ?>
    <?php
    $pq = $value['planned_quantity'];
    $aq = $value['actually_quantity'];
    $taq = $value['temp_actual_quantity'];
    $job_card_sql = "SELECT * FROM job_card WHERE activity_id='" . $value['activity_id'] . "'";
    $job_card = $this->db->query($job_card_sql)->row();
    if ($job_card) {
    $value['planned_quantity'] = $job_card->planned_quantity;
    $value['actually_quantity'] = $job_card->actually_quantity;
    if ($value['planned_quantity'] <= 0) {
        continue;
    }
    }
    $arr = explode(" ", $value['start_date']);

    $html .= '
        <tr>
            <td>' . $sl . '</td>
            <td>' . $value['mp_name'] . '</td>
            <td>' . $value['process_name'] . '</td>
            <td>' . $value['activity_name'] . '</td>
            <td>' . $value['uom'] . '</td>
            <td>' . $value['planned_quantity'] . '</td>
            <td>' . $value['actually_quantity'] . '</td>
            <td>' . $value['assigned_person'] . '</td>
            <td>' . $value['start_date'] . '</td>
            <td>' . $value['finish_date'] . '</td>
            <td>' . $value['activity_status'] . '</td>
            <td>' . $value['comments'] . '</td>
        </tr>';
    $sl++;
}

$html .= '
        </tbody>
    </table>';
// echo $html;

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$dompdf->stream('Job-card.pdf',['Attachment'=>0]);
?>