<?php
//cek data pijat
    /*$qck = mysql_fetch_array(mysql_query("SELECT pijat FROM `transactions_tmp` t WHERE t.transaction_id = '$_GET[id]'"));

      //cek kebutuhan pijat yang di perlukan apa saja
        $cekpjt = mysql_query("SELECT SUM(d.`item_qty`) AS total, i.`item_id`, i.`item_name`, i.`item_satuan`
                  FROM `pijat_details` d
                  LEFT JOIN `item` i ON i.`item_id` = d.`item`
                  WHERE d.`pijat` = '$_GET[i_pijat]'
                  GROUP BY d.`item`");
          while($dpjt = mysql_fetch_array($cekpjt)) {

            //cek stok item
            $cekstk = mysql_fetch_array(mysql_query("SELECT SUM(p.`purchase_qty`) AS total, i.`item_id`, i.`item_name`, i.`item_satuan` 
                  FROM `purchases` p
                  LEFT JOIN `item` i ON i.`item_id` = p.`item_id`
                  where p.`item_id` = '$dpjt[item_id]'
                  GROUP BY p.`item_id`"));

              if($cekstk['total'] < $dpjt['total']) {
                //$status = "over";
                //$item = $dpjt['item_name'];
                echo "<script>alert('Stok untuk item $dpjt[item_name] tidak mencukupi, silahkan untuk update stok terlebih dahulu'); 
                location.href='transaction.php';</script>";
                exit();
              }

          }

          // cek item yang di pesan
          $cekitem = mysql_query("SELECT SUM(d.transaction_detail_original_price) AS total, i.`item_id`, i.`item_name`, i.`item_satuan`
                    FROM `transaction_tmp_details` d
                    LEFT JOIN `item` i ON i.`item_id` = d.`transaction_detail_item_qty`
                    WHERE d.`transaction_id` = 6
                    GROUP BY d.transaction_detail_original_price");
                              while ($ditem = mysql_fetch_array($cekitem)) {
                                
                                //cek stok item
                                $cekstk = mysql_fetch_array(mysql_query("SELECT SUM(p.`purchase_qty`) AS total, i.`item_id`, i.`item_name`, i.`item_satuan` 
                                      FROM `purchases` p
                                      LEFT JOIN `item` i ON i.`item_id` = p.`item_id`
                                      where p.`item_id` = '$dpjt[item_id]'
                                      GROUP BY p.`item_id`"));

                                  if($cekstk['total'] < $ditem['total']) {
                                    //$status = "over";
                                    //$item = $ditem['item_name'];
                                    echo "<script>alert('Stok untuk item $ditem[item_name] tidak mencukupi, silahkan untuk update stok terlebih dahulu'); 
                location.href='transaction.php';</script>";
                 exit();
                                  }

                              }*/

                if(isset($_GET['did']) && $_GET['did'] == 1){
                ?>
                <section class="content_new">

                <div class="alert alert-info alert-dismissable">
                <i class="fa fa-check"></i>
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <b>Sukses !</b>
               Simpan Berhasil
                </div>

                </section>
                <?php
                }
                ?><!-- Content Header (Page header) -->
<script>
function add_menu(id)
{
  if(id!=0){
  window.location.href = 'member.php?page=add_menu&menu_id='+id+'&member_id=<?php echo $id ?>';
  }
}
</script>
 <form action="<?= $action?>" method="post" enctype="multipart/form-data" role="form">
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- right column -->
                        <div class="col-md-12">
                            <!-- general form elements disabled -->
                          <div class="title_page"> <?= $title ?></div>
                            <div class="box box-cokelat">
                                <div class="box-body">
                                        <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nama </label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                                    <input required type="text" name="i_name" class="form-control" placeholder="Masukkan nama member..." value="<?= $row->member_name ?>"/>
                                            </div>
                                        <div class="form-group">
                                           <label>Telepon</label>
                                           <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                               <input required min="0" type="number" name="i_phone" class="form-control" placeholder="Masukkan telepon member..." value="<?= $row->member_phone ?>"/>
                                           </div>
                                        </div>
                                         <div class="form-group">
                                            <label>Alamat</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-home"></i>
                                                </div>
                                            <input required type="text" name="i_alamat" class="form-control" placeholder="Masukkan alamat..." value="<?= $row->member_alamat ?>"/>
                                            </div>
                                         </div>   
                                         <div class="form-group">
                                            <label>Email</label>
                                            <input required type="email" name="i_email" class="form-control" placeholder="Masukkan email member..." value="<?= $row->member_email ?>"/>
                                        </div>
                                         <!-- <div class="form-group">
                                          <label>Type</label>
                                           <select name="i_discount_type" size="1" class="form-control"/>
                                             <option value="1"  <?php if($row->member_discount_type == 1){ echo "selected='selected'"; } ?>>Diskon Langsung</option>
                                           <option value="2" <?php if($row->member_discount_type == 2){ echo "selected='selected'"; } ?>>Diskon POIN</option>
                                           </select>
                                      </div> -->

                                     <!-- <div class="form-group">
                                            <label>Diskon (%)</label>
                                            <input required min="0" type="number" name="i_discount" class="form-control" placeholder="Masukkan diskon..." value="<?= $row->member_discount ?>"/>
                                        </div> -->
                                        <?php
                                        if($id){
                    ?>
                                         <!-- <div class="form-group">
                                            <label>Settlement (Rp)</label>
                                            <input required type="text" name="i_settlement" class="form-control" placeholder="Masukkan diskon..." value="<?= $row->member_settlement ?>" readonly="readonly"/>
                                        </div> -->
                                        <?php } ?>
                                        </div>
                                </div><!-- /.box -->
                                        <div style="clear:both;"></div>

                                </div><!-- /.box-body -->

                                  <div class="box-footer">
                                <input class="btn btn-danger" type="submit" value="Save"/>
                                <a href="<?= $close_button?>" class="btn btn-default" >Close</a>

                             </div>


                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->

            

                </section><!-- /.content -->

 </form>
<?php if($id){ include 'form_statement.php';}?>
