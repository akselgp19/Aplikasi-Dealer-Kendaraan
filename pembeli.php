<?php
include "config/koneksi.php";
if(isset($_POST['simpan'])){
  $sql = mysqli_query($con,"INSERT INTO beli(nik,nama,umur,pekerjaan,alamat) VALUES ('$_POST[nik]','$_POST[nama]','$_POST[umur]','$_POST[pekerjaan]','$_POST[alamat]')");
  echo "<script>alert('Berhasil tersimpan');document.location.href='?menu=pembeli'</script>";

}
 // ini untuk opsi delete hapus
       if(isset($_GET['delete'])){
            $sql = mysqli_query($con,"DELETE FROM beli WHERE nik = '$_GET[nik]'");
            if($sql){
                echo "<script>alert('data berhasil dihapus');document.location.href='?menu=pembeli'</script>";
            }
            else{
                echo "<script>alert('data gagal dihapus');document.location.href='?menu=pembeli'</script>";
            }
        }
        if(isset($_GET['edit'])){
            $sql = mysqli_query($con,"SELECT * FROM beli WHERE nik ='$_GET[nik]'");
            $row_edit = mysqli_fetch_array($sql);
        }else{
            $row_edit=null;
        }
         if(isset($_POST['update'])){
             $sql = mysqli_query($con,"UPDATE beli SET nik = '$_POST[nik]', nama = '$_POST[nama]', umur = '$_POST[umur]', pekerjaan = '$_POST[pekerjaan]', alamat = '$_POST[alamat]' WHERE nik = '$_GET[nik]'");
              if($sql){
                echo "<script>alert('data berhasil diupdate');
                document.location.href= '?menu=pembeli'</script>";
            }
            else{
                echo "<script>alert('data gagal diupdate');
                document.location.href= '?menu=pembeli'</script>";
            }
          }
?>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Pembeli</h6>
            </div>
            <div class="card-body">
            <form method="post">
            <div class="form-group">
                <div class="row">
                  
                    <input type="number" name="nik"  value="<?php echo $row_edit['nik'];?>" class="form-control" placeholder="Nik">
                               
                    <input type="text" name="nama"  value="<?php echo isset($row_edit['nama']) ? $row_edit['nama'] : '';?>" class="form-control" placeholder="Nama">

                    <input type="number" name="umur"  value="<?php echo $row_edit['umur'];?>" class="form-control" placeholder="Umur">

                    <input type="text" name="pekerjaan"  value="<?php echo isset($row_edit['pekerjaan']) ? $row_edit['pekerjaan'] : '';?>" class="form-control" placeholder="Pekerjaan">

                    <input type="text" name="alamat"  value="<?php echo isset($row_edit['alamat']) ? $row_edit['alamat'] : '';?>" class="form-control" placeholder="Alamat">
                    
                </div>
            </div>
                <?php
          if(isset ($_GET['edit'])){
            ?>
            <button type="submit" name="update" class="btn btn-primary" value="update"> Update</button>
            <td><a href="?menu=pembeli">Batal</a></td>
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
                      <th>NIK</th>
                      <th>Nama</th>
                      <th>Umur</th>
                      <th>Pekerjaan</th>
                      <th>Alamat</th>
                      <th><th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql = mysqli_query($con,"SELECT * FROM beli");
                      while ($row_edit=mysqli_fetch_array($sql)){  
                    ?>
                    <tr>
                      <td><?php echo $row_edit['nik']?></td>
                      <td><?php echo $row_edit['nama']?></td>
                      <td><?php echo $row_edit['umur']?></td>
                      <td><?php echo $row_edit['pekerjaan']?></td>
                      <td><?php echo $row_edit['alamat']?></td>
                      <td><a href="?menu=pembeli&delete&nik=<?php echo $row_edit['nik']?>"onClick="return confirm('Apakah anda yakin akan menghapus ini?')">HAPUS</a></td>
                      <td><a href="?menu=pembeli&edit&nik=<?php echo $row_edit['nik']?>">EDIT</a></td>
                    </tr>
                  <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

    