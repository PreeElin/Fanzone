<?php

include "../config.php";

$email = $_GET['e'];
$oid = $_GET['oid'];

$getNewOrders = "

  SELECT * FROM orders where email like \"%$email%\" and id like \"%$oid%\"

";

$result = $mysqli->query($getNewOrders);

if (mysqli_num_rows($result) == 0) {
  echo "<tr>No matches found!</tr>";
} else {
  // echo $getNewOrders;
  $orders = "";
  while($obj = $result->fetch_object()) {
    $orders .= '<tr>';
    $orders .= '<td class="border-0 align-middle">'.$obj->id.'</td>';
    $orders .= '<td class="border-0 align-middle">'.$obj->date.'</td>';
    $orders .= '<td class="border-0 align-middle">'.$obj->email.'</td>';
    $orders .= '<td class="border-0 align-middle">'.$obj->product_name.'</td>';
    $orders .= '<td class="border-0 align-middle">'.$currency.$obj->price.'</td>';
    $orders .= '<td class="border-0 align-middle">'.$obj->units.'</td>';
    $orders .= '<td class="border-0 align-middle">'.$currency.$obj->total.'</td>';
    $orders .= '<td class="border-0 align-middle">'.(($obj->paid == 1) ? "<div style=\"text-align: center;\" class=\"bg-success m-15 p-20 rounded\">PAID</div>" :  "<div  style=\"text-align: center;\" class=\"bg-danger p-20\">NOT PAID</div>").'</td>';
    $orders .= '<td class="border-0 align-middle text-uppercase font-italic">
          <select class="form-control" onchange="if (confirm(\'Are you sure you want to change the status ?\')) {changeStatus(this.value, this.closest(\'tr\').children[0].textContent)}" name="prod_category" style="width:200px;" required>
                <option value="requested" '. (($obj->status == 'requested') ? "selected" : "") .'>REQUESTED</option>
                <option value="on the way" '. (($obj->status == 'on the way') ? "selected" : "") .'>ON THE WAY</option>
                <option value="delivered" '. (($obj->status == 'delivered') ? "selected" : "") .'>DELIVERED</option>
                <option value="cancelled" '. (($obj->status == 'cancelled') ? "selected" : "") .'>CANCELLED</option>
          </select>
    </td>';
    // $orders .= '<td class="border-0 align-middle">'.$obj->paid.'</td>';
  }
    $orders .= '</tr>';
    echo $orders;
}


?>  