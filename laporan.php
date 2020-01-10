 <?php            
include "fungsi.php";
?>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>

                    <tr>
                      <th>id</th>
                      <th>Merk</th>
                      <th>Tipe</th>
                      <th>Harga</th>
                      <th>Tenor</th>
                      <th>Bunga</th>
                      <th>Harga Kredit</th>
                      <th>DP</th>
                      <th>Angsuran</th>
                      <th>Sisa Cicilan</th>
                      <th>Nama</th>
                      <th>Alamat</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql = mysqli_query($con,"SELECT * FROM bayar");
                      while ($row_edit=mysqli_fetch_array($sql)){  
                    ?>
                    <tr>
                      <td><?php echo $row_edit['id']?></td>
                      <td><?php echo $row_edit['merk']?></td>
                       <td><?php echo $row_edit['tipe']?></td>
                      <td style="text-align: center;"><?php echo format_money($row_edit['harga']);?></td>
                      <td><?php echo $row_edit['tenor']?></td>
                      <td><?php echo $row_edit['bunga']?></td>
                      <td style="text-align: center;"><?php echo format_money($row_edit['hargakredit']);?></td>
                      <td style="text-align: center;"><?php echo format_money($row_edit['dp']);?></td>
                      <td style="text-align: center;"><?php echo format_money($row_edit['angsuran']);?></td>
                      <td style="text-align: center;"><?php echo format_money($row_edit['sisa']);?></td>
                      <td><?php echo $row_edit['nama']?></td>
                      <td><?php echo $row_edit['alamat']?></td>
                      <td>
                        <a href="?menu=transaksi&delete&id=<?php echo $row_edit['id']?>"onClick="return confirm('Apakah anda yakin akan menghapus ini?')">HAPUS</a>

                        <a href="cetak.php<?php echo '?id='  . $row_edit['id']; ?>" class="btn btn-info" >CETAK</a>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>