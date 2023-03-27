 <?php            
include "fungsi.php";
?>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>

                    <tr>
                      <th>Nama</th>
                      <th>NIM</th>
                      <th>Tugas</th>
                      <th>UTS</th>
                      <th>UAS</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql = mysqli_query($con,"SELECT * FROM bayar");
                      while ($row_edit=mysqli_fetch_array($sql)){  
                    ?>
                    <tr>
                      <td><?php echo $row_edit['nama']?></td>
                      <td><?php echo $row_edit['nim']?></td>
                      <td><?php echo $row_edit['tugas']?></td>
                      <td><?php echo $row_edit['uts']?></td>
                      <td><?php echo $row_edit['uas']?></td>
                      <td>
                      <a href="?menu=transaksi&delete&nim=<?php echo $row_edit['nim']?>"onClick="return confirm('Apakah anda yakin akan menghapus ini?')">HAPUS</a>
                      </td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>