<?php
include "config/koneksi.php";
if(isset($_POST['simpan'])){
  $sql = mysqli_query($con,"INSERT INTO angsuran(nama,id,cicilan) VALUES ('$_POST[nama]','$_POST[id]','$_POST[cicilan]')");

  $eksekusi = mysqli_query($con, $sql);
  echo "<script>alert('Berhasil tersimpan');document.location.href='?menu=angsuran'</script>";

}
 // ini untuk opsi delete hapus
       if(isset($_GET['delete'])){
            $sql = mysqli_query($con,"DELETE FROM angsuran WHERE nama = '$_GET[nama]'");
            if($sql){
                echo "<script>alert('data berhasil dihapus');document.location.href='?menu=angsuran'</script>";
            }
            else{
                echo "<script>alert('data gagal dihapus');document.location.href='?menu=angsuran'</script>";
            }
        }
        if(isset($_GET['edit'])){
            $sql = mysqli_query($con,"SELECT * FROM angsuran WHERE nama ='$_GET[nama]'");
            $row_edit = mysqli_fetch_array($sql);
        }else{
            $row_edit=null;
        }
         if(isset($_POST['update'])){
             $sql = mysqli_query($con,"UPDATE angsuran SET nama = '$_POST[nama]', cicilan = '$_POST[cicilan]' WHERE nama = '$_GET[nanam]'");
              if($sql){
                echo "<script>alert('data berhasil diupdate');
                document.location.href= '?menu=angsuran'</script>";
            }
            else{
                echo "<script>alert('data gagal diupdate');
                document.location.href= '?menu=angsuran'</script>";
            }
          }
?>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Angsuran</h6>
            </div>
            <div class="card-body">
            <form method="post">
            <div class="form-group">
                <div class="row">

                  

                    <select name="nama" class="form-control" class="form-control form-control-md" id="" onchange='changeValueNama(this.value)' required="required">
                      <option value="" disabled="disabled" selected="selected">- pilih nama -</option>
                        <?php
                                $con = mysqli_connect("localhost", "root","", "kreditcbt");
                                $query=mysqli_query($con, "select * from bayar order by id asc");
                                $result = mysqli_query($con, "select * from bayar");
                                $jsArrayNama = "var idTipe = new Array();\n";
                                while ($row = mysqli_fetch_array($result)) {
                                echo '<option name="nama"  value="' . $row['nama'] . '">' . $row['nama'] . '</option>';
                                $jsArrayNama .= "idTipe['" . $row['nama'] . "'] = 
                                {
                                  id:'". addslashes($row['id'])."',
                                angsuran:'".addslashes($row['angsuran'])."'};\n";
                                }
                            ?>
                    </select>

                    <input type="number" id="id" name="id"  value="<?php echo $row_edit['id'];?>" class="form-control" placeholder="id">
                               
                    <input type="number" id="cicilan" name="cicilan"  value="<?php echo $row_edit['cicilan'];?>" class="form-control" placeholder="Cicilan">
                </div>
            </div>
                <?php
          if(isset ($_GET['edit'])){
            ?>
            <button type="submit" name="update" class="btn btn-primary" value="update"> Update</button>
            <td><a href="?menu=angsuran">Batal</a></td>
            <?php
          }else{
            ?>
            <td><input type="submit" name="simpan" value="simpan"></td>
            <?php
          }
        ?>
            </form>
            <br><br>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>

                    <tr>
                      <th>Nama</th>
                      <th>Cicilan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql = mysqli_query($con,"SELECT * FROM angsuran");
                      while ($row_edit=mysqli_fetch_array($sql)){  
                    ?>
                    <tr>
                      <td><?php echo $row_edit['nama']?></td>
                      <td><?php echo $row_edit['cicilan']?></td>
                      <td><a href="?menu=angsuran&delete&nama=<?php echo $row_edit['nama']?>"onClick="return confirm('Apakah anda yakin akan menghapus ini?')">HAPUS</a></td>
                      <td><a href="?menu=angsuran&edit&nama=<?php echo $row_edit['nama']?>">EDIT</a></td>
                    </tr>
                  <?php } ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>

    <script type="text/javascript">
        <?php echo $jsArrayNama; ?>
        function changeValueNama(nama){
            console.log(nama);
            console.log(idTipe);
            document.getElementById('id').value = idTipe[nama].id;    
            document.getElementById('cicilan').value = idTipe[nama].angsuran;
        }
        </script>