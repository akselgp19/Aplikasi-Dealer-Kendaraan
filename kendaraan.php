<?php
include "config/koneksi.php";
if(isset($_POST['simpan'])){
  $sql = mysqli_query($con,"INSERT INTO motor(plat,merk,tipe,harga) VALUES ('$_POST[plat]','$_POST[merk]','$_POST[tipe]','$_POST[harga]')");
  echo "<script>alert('Berhasil tersimpan');document.location.href='?menu=nilai'</script>";
}

 // ini untuk opsi delete hapus
       if(isset($_GET['delete'])){
            $sql = mysqli_query($con,"DELETE FROM motor WHERE plat = '$_GET[plat]'");
            if($sql){
                echo "<script>alert('data berhasil dihapus');document.location.href='?menu=nilai'</script>";
            }
            else{
                echo "<script>alert('data gagal dihapus');document.location.href='?menu=nilai'</script>";
            }
        }
        if(isset($_GET['edit'])){
            $sql = mysqli_query($con,"SELECT * FROM motor WHERE plat ='$_GET[plat]'");
            $row_edit = mysqli_fetch_array($sql);
        }else{
            $row_edit=null;
        }
         if(isset($_POST['update'])){
             $sql = mysqli_query($con,"UPDATE motor SET plat = '$_POST[plat]', merk = '$_POST[merk]',tipe = '$_POST[tipe]', harga = '$_POST[harga]' WHERE plat = '$_GET[plat]'");
              if($sql){
                echo "<script>alert('data berhasil diupdate');
                document.location.href= '?menu=nilai'</script>";
            }
            else{
                echo "<script>alert('data gagal diupdate');
                document.location.href= '?menu=nilai'</script>";
            }
          }
?>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Motor</h6>
            </div>
            <div class="card-body">
            <form method="post">
            <div class="form-group">
                <div class="row">

                    <input type="text" name="plat"  value="<?php echo isset($row_edit['plat']) ? $row_edit['plat'] : '';?>" class="form-control" placeholder="Plat Motor">
                               
                    <input type="text" name="merk"  value="<?php echo isset($row_edit['merk']) ? $row_edit['merk'] : '';?>" class="form-control" placeholder="Merk">

                    <input type="text" name="tipe"  value="<?php echo isset($row_edit['tipe']) ? $row_edit['tipe'] : '';?>" class="form-control" placeholder="Tipe">

                    <input type="number" name="harga"  value="<?php echo $row_edit['harga'];?>" class="form-control" placeholder="Harga">
                    
                </div>
            </div>
                <?php
          if(isset ($_GET['edit'])){
            ?>
            <button type="submit" name="update" class="btn btn-primary" value="update"> Update</button>
            <td><a href="?menu=nilai">Batal</a></td>
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
                      <th>Plat Motor</th>
                      <th>Merk</th>
                      <th>Tipe</th>
                      <th>Harga</th>
                      <th><th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql = mysqli_query($con,"SELECT * FROM motor");
                      while ($r=mysqli_fetch_array($sql)){  
                    ?>
                    <tr>
                      <td><?php echo $r['plat']?></td>
                      <td><?php echo $r['merk']?></td>
                      <td><?php echo $r['tipe']?></td>
                      <td><?php echo $r['harga']?></td>
                      <td><a href="?menu=nilai&delete&plat=<?php echo $r['plat']?>"onClick="return confirm('Apakah anda yakin akan menghapus ini?')">HAPUS</a></td>
                      <td><a href="?menu=nilai&edit&plat=<?php echo $r['plat']?>">EDIT</a></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

    