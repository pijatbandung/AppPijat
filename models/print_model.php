<?php

function select($transaction){
	$query = mysql_query("select a.*, b.table_name, c.*, d.user_name
							  from transactions a
							  left join members c on c.member_id = a.member_id
							  join tables b on b.table_id = a.table_id
							  left join users d on d.user_id = a.user_id
							  where transaction_id = '".$transaction."'");
	return $query;
}
function select_item($transaction){
	$query = mysql_query("select b.*, c.menu_name
							  from transactions a
							  join transaction_details b on b.transaction_id = a.transaction_id
							  join menus c on c.menu_id = b.menu_id
							  where a.transaction_id = '".$transaction."' AND c.menu_price !=0");
	return $query;
}
function selectbydate($start, $end){
	$query = mysql_query("SELECT
								a.*, b.table_name,
								c.member_name, c.member_discount, d.building_name, e.user_login, e.user_name, f.payment_method_name, g.*
							FROM
								transactions a
							LEFT JOIN members c ON c.member_id = a.member_id
							JOIN TABLES b ON b.table_id = a.table_id
							LEFT JOIN buildings d on d.building_id = b.building_id
							left join users e on e.user_id = a.user_id
							LEFT JOIN payment_methods f on f.payment_method_id = a.payment_method_id
							left join banks g on g.bank_id = a.bank_id
							WHERE
								transaction_date BETWEEN '$start'
							AND '$end'");
	return $query;
}
function selectmenubydate($start, $end){
	$query = mysql_query("SELECT date(a.transaction_date) AS date, b.menu_id, sum(b.transaction_detail_qty) AS qty,
												b.transaction_detail_original_price, c.menu_name FROM transactions a
												LEFT JOIN transaction_details b ON b.transaction_id = a.transaction_id
												LEFT JOIN menus c ON c.menu_id = b.menu_id
												WHERE transaction_date BETWEEN '$start'
												AND '$end' GROUP BY date,
												menu_id ORDER BY date");
	return $query;
}
function graph($start, $end){
        $query = mysql_query("SELECT
								a.*, b.table_name,
								c.member_name, c.member_discount, d.building_name, e.user_login, e.user_name
							FROM
								transactions a
							LEFT JOIN members c ON c.member_id = a.member_id
							JOIN TABLES b ON b.table_id = a.table_id
							LEFT JOIN buildings d on d.building_id = b.building_id
							left join users e on e.user_id = a.user_id
							WHERE
								transaction_date BETWEEN '$start'
							AND '$end'");
        return $query;
}

function get_statement($column, $id)
{
	$query = mysql_query("select $column as result from statement WHERE statement_id = '$id'");

	$row = mysql_fetch_array($query);
	$result = $row['result'];
	return $result;
}

function select_member_statement($id){
	$query = mysql_query("SELECT a.*, b.member_name,c.member_email,d.member_phone,e.member_alamat FROM statement a

						 LEFT JOIN members b ON b.member_id = a.member_id
						 LEFT JOIN members c ON c.member_id = a.member_id
						 LEFT JOIN members d ON d.member_id = a.member_id
						 LEFT JOIN members e ON e.member_id = a.member_id
						 ORDER BY statement_id");
	return $query;
}

?>
