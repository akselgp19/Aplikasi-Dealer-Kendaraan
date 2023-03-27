<?php
include "config/koneksi.php";
if(isset($_POST['simpan'])){
  $sql = mysqli_query($con,"INSERT INTO angsuran(nama,nik,plat,merk,tipe,tenor,angsuran) VALUES ('$_POST[nama]','$_POST[nik]','$_POST[plat]','$_POST[merk]','$_POST[tipe]','$_POST[tenor]','$_POST[angsuran]')");
  echo "<script>alert('Berhasil tersimpan');document.location.href='?menu=angsuran'</script>";

}
 // ini untuk opsi delete hapus
       if(isset($_GET['delete'])){
            $sql = mysqli_query($con,"DELETE FROM angsuran WHERE nik = '$_GET[nik]'");
            if($sql){
                echo "<script>alert('data berhasil dihapus');document.location.href='?menu=angsuran'</script>";
            }
            else{
                echo "<script>alert('data gagal dihapus');document.location.href='?menu=angsuran'</script>";
            }
        }
        if(isset($_GET['edit'])){
            $sql = mysqli_query($con,"SELECT * FROM angsuran WHERE nik ='$_GET[nik]'");
            $row_edit = mysqli_fetch_array($sql);
        }else{
            $row_edit=null;
        }
         if(isset($_POST['update'])){
             $sql = mysqli_query($con,"UPDATE angsuran SET nama = '$_POST[nama]', nik = '$_POST[nik]', plat = '$_POST[plat]', merk = '$_POST[merk]', tipe = '$_POST[tipe]', tenor = '$_POST[tenor]', angsuran = '$_POST[angsuran]' WHERE id = '$_GET[id]'");
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
                                $query=mysqli_query($con, "select * from bayar order by nama asc");
                                $result = mysqli_query($con, "select * from bayar");
                                $jsArrayNama = "var idTipe = new Array();\n";
                                while ($row = mysqli_fetch_array($result)) {
                                echo '<option name="nama"  value="' . $row['nama'] . '">' . $row['nama'] . '</option>';
                                $jsArrayNama .= "idTipe['" . $row['nama'] . "'] = 
                                {
                                nik:'". addslashes($row['nik'])."',
                                plat:'". addslashes($row['plat'])."',
                                merk:'". addslashes($row['merk'])."',
                                tipe:'". addslashes($row['tipe'])."',
                                tenor:'". addslashes($row['tenor'])."',
                                angsuran:'".addslashes($row['angsuran'])."'};\n";
                                }
                            ?>
                    </select>

                    <input type="number" id="nik" name="nik"  value="<?php echo $row_edit['nik'];?>" class="form-control" placeholder="NIK">

                    <input type="text" id="plat" name="plat"  value="<?php echo isset($row_edit['plat']) ? $row_edit['plat'] : '';?>" class="form-control" placeholder="Plat Nomor Kendaraan">

                    <input type="text" id="merk" name="merk"  value="<?php echo isset($row_edit['merk']) ? $row_edit['merk'] : '';?>" class="form-control" placeholder="Merk">

                    <input type="text" id="tipe" name="tipe"  value="<?php echo isset($row_edit['tipe']) ? $row_edit['tipe'] : '';?>" class="form-control" placeholder="Tipe">
                    
                    <input type="number" id="tenor" name="tenor"  value="<?php echo $row_edit['tenor'];?>" class="form-control" placeholder="Tenor">

                    <input type="number" id="angsuran" name="angsuran"  value="<?php echo $row_edit['angsuran'];?>" class="form-control" placeholder="Angsuran">

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
                      <th>NIK</th>
                      <th>Plat Nomor</th>
                      <th>Merk</th>
                      <th>Tipe</th>
                      <th>Tenor</th>
                      <th>Angsuran</th>
                      <th><th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql = mysqli_query($con,"SELECT * FROM angsuran");
                      while ($row_edit=mysqli_fetch_array($sql)){  
                    ?>
                    <tr>
                    <td><?php echo $row_edit['nama']?></td>
                      <td><?php echo $row_edit['nik']?></td>
                      <td><?php echo $row_edit['plat']?></td>
                      <td><?php echo $row_edit['merk']?></td>
                      <td><?php echo $row_edit['tipe']?></td>
                      <td><?php echo $row_edit['tenor']?></td>
                      <td><?php echo $row_edit['angsuran']?></td>
                      <td><a href="?menu=angsuran&delete&nik=<?php echo $row_edit['nik']?>"onClick="return confirm('Apakah anda yakin akan menghapus ini?')">HAPUS</a></td>
                      <td><a href="?menu=angsuran&edit&nik=<?php echo $row_edit['nik']?>">EDIT</a></td>
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
            document.getElementById('nik').value = idTipe[nama].nik;    
            document.getElementById('plat').value = idTipe[nama].plat;  
            document.getElementById('merk').value = idTipe[nama].merk;  
            document.getElementById('tipe').value = idTipe[nama].tipe;
            document.getElementById('tenor').value = idTipe[nama].tenor;    
            document.getElementById('angsuran').value = idTipe[nama].angsuran;
        }
        </script>