<?php 
if(isset($_GET['id']) && $_GET['id'] != "") {

$qtrans = mysql_fetch_array(mysql_query("SELECT t.*, p.*, m.*, k.*, p.pijat_id as pijat, t.transaction_detail_pemijat as pemijat
FROM `transactions_tmp` t
LEFT JOIN pijat p ON p.`pijat_id` = t.`pijat`
LEFT JOIN members m ON m.`member_id` = t.`member_id`
LEFT JOIN `transaction_kursi` k ON k.`transcaction_id` = t.`transaction_id`
WHERE  t.transaction_id = '$_GET[id]'"));

$quser = mysql_fetch_array(mysql_query("select * from users where user_id = '".$_SESSION['user_id']."'")); //$_SESSION['user_id']

//tabel `transactions`
$strans = mysql_query("INSERT INTO `transactions`
            (`transaction_id`,
             `branch_id`,
             `member_id`,
             `pijat_id`,
             `pemijat_id`,
             `transaction_date`,
             `transaction_total`,
             `transaction_discount`,
             `disc_member`,
             `transaction_grand_total`,
             `transaction_payment`,
             `transaction_change`,
             `transaction_disc_nominal`,
             `payment_method_id`,
             `bank_id`,
             `user_id`,
             `bank_account_number`,
             `transaction_code`,
             `flag_code`,
             `ket`)
VALUES ('$qtrans[transaction_id]',
        '$qtrans[branch_id]',
        '$qtrans[member_id]',
        '$qtrans[pijat]',
        '$qtrans[transaction_detail_pemijat]', 
        '$qtrans[datebook]', 
        '$qtrans[pijat_price]',
        '$_POST[i_discount]',
        '$_POST[i_disk2]',
        '$_POST[i_total]',
        '$_POST[i_grand_total]',
        '$_POST[i_change]',
        '0',
        '$_POST[i_payment_method]',
        '$_POST[i_bank_id]',
        '$quser[user_id]',
        '$_POST[i_bank_account]',
        '$qtrans[transaction_code]',
        '0',
        '$qtrans[ket]')");

//tabel `transaction_details`

$qdet = mysql_query("SELECT * FROM `transaction_tmp_details` WHERE transaction_id = '$_GET[id]'");

while($ddet = mysql_fetch_array($qdet)) {
    $sdet = mysql_query("INSERT INTO `transaction_details`
                (`transaction_id`,
                 `menu_id`,
                 `transaction_detail_original_price`,
                 `transaction_detail_margin_price`,
                 `transaction_detail_price`,
                 `transaction_detail_price_discount`,
                 `transaction_detail_grand_price`,
                 `transaction_detail_qty`,
                 `transaction_detail_total`)
    VALUES ('$ddet[transaction_id]',
            '$ddet[transaction_detail_item_qty]',
            '$ddet[transaction_detail_original_price]',
            '$ddet[transaction_detail_margin_price]',
            '$ddet[transaction_detail_price]',
            '$ddet[transaction_detail_price_discount]',
            '$ddet[transaction_detail_grand_price]',
            '$ddet[transaction_detail_qty]',
            '$ddet[transaction_detail_total]')");
}

//tabel `journals`
$sjrn = mysql_query("INSERT INTO `journals`
            (`journal_type_id`,
             `data_id`,
             `data_url`,
             `journal_debit`,
             `journal_credit`,
             `journal_piutang`,
             `journal_hutang`,
             `journal_date`,
             `journal_desc`,
             `bank_id`,
             `user_id`,
             `branch_id`)
VALUES ('1',
        '$qtrans[transaction_code]',
        'order.php?page=form&id=',
        '$_POST[i_grand_total]',
        '0',
        '0',
        '0',
        '$qtrans[datebook]',
        '0',
        '$_POST[i_bank_id]',
        '$quser[user_id]',
        '$_GET[branch_id]')");

//hapus tabel temp
mysql_query("DELETE FROM `transactions_tmp` WHERE `transaction_id` = '$qtrans[transaction_id]'");

mysql_query("DELETE FROM `transaction_tmp_details` WHERE `transaction_id` = '$qtrans[transaction_id]'");

mysql_query("UPDATE `transaction_kursi` SET `status_kursi` = '1' WHERE `transcaction_id` = '$qtrans[transaction_id]'");


//echo "<script>location.href='order.php?page=list&member=$_GET[member]&id=$_GET[id]&branch_id=$_GET[branch_id]&ruangan_id=$_GET[ruangan_id]&t=$_GET[t]'; </script>";

//echo "<script>location.href='c-order.php?page=print_bill&branch_id=$_GET[branch_id]&ruangan_id=$_GET[ruangan_id]&ruangan_infrastruktur_id=$qtrans[ruangan_infrastruktur_id]&id=$_GET[id]&t=$_GET[t]'; </script>";

}
?>