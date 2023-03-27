  <?php
include "config/koneksi.php";
include "fungsi.php";
if(isset($_POST['simpan'])){
  $sql = mysqli_query($con,"INSERT INTO bayar(plat,merk,tipe,harga,tenor,bunga,hargakredit,dp,angsuran,sisa,nama,nik,alamat) VALUES ('$_POST[plat]','$_POST[merk]','$_POST[tipe]','$_POST[harga]','$_POST[tenor]','$_POST[bunga]','$_POST[hargakredit]','$_POST[dp]','$_POST[angsuran]','$_POST[sisa]','$_POST[nama]','$_POST[nik]','$_POST[alamat]')");
  echo "<script>alert('Berhasil tersimpan');document.location.href='?menu=transaksi'</script>";

}
  // ini untuk opsi delete hapus
       if(isset($_GET['delete'])){
            $sql = mysqli_query($con,"DELETE FROM bayar WHERE id = '$_GET[id]'");
            if($sql){
                echo "<script>alert('data berhasil dihapus');document.location.href='?menu=transaksi'</script>";
            }
            else{
                echo "<script>alert('data gagal dihapus');document.location.href='?menu=transaksi'</script>";
            }
        }
        if(isset($_GET['edit'])){
            $sql = mysqli_query($con,"SELECT * FROM bayar WHERE id ='$_GET[id]'");
            $row_edit = mysqli_fetch_array($sql);
        }else{
            $row_edit=null;
        }
         if(isset($_POST['update'])){
             $sql = mysqli_query($con,"UPDATE bayar SET plat = '$_POST[plat]', merk = '$_POST[merk]', tipe = '$_POST[tipe]', harga = '$_POST[harga]', nama = '$_POST[nama]', nik = '$_POST[nik]', alamat = '$_POST[alamat]',angsuran = '$_POST[angsuran]', tenor = '$_POST[tenor]',bunga = '$_POST[bunga]',hargakredit = '$_POST[hargakredit]',dp = '$_POST[dp]',sisa = '$_POST[sisa]' WHERE id = '$_GET[id]'");
              if($sql){
                echo "<script>alert('data berhasil diupdate');
                document.location.href= '?menu=transaksi'</script>";
            }
            else{
                echo "<script>alert('data gagal diupdate');
                document.location.href= '?menu=transaksi'</script>";
            }
          }
?>

<script type="text/javascript">
    function ten(){
        aa=eval(form.tenor.value);

        if ( aa == 3){
            form.bunga.value = 2;
        }
        else if ( aa == 6){
            form.bunga.value = 4;
        }
         else if ( aa == 9){
            form.bunga.value = 6;
        }
         else if ( aa == 12) {
            form.bunga.value = 8;
        }
        else{
            form.bunga.value = 0;
        }

        hj=eval(form.harga.value);
        bunga=eval(form.bunga.value);
        sc = hj + (bunga/100 * hj);
        form.hargakredit.value = sc;
    }

</script>

<script type="text/javascript">
    function bagi(){
      hb= eval(form.hargakredit.value);
      dp = eval(form.dp.value);
      ten = eval(form.tenor.value);
      sc = hb - dp;
      ang = sc / ten;
      form.sisa.value = sc;
      form.angsuran.value = ang;
    }
</script>
          
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
            </div>
            <div class="card-body">
            <form method="post" name="form">
            <div class="form-group">
                <div class="row">
                   <select name="plat" class="form-control" class="form-control form-control-md" id="" onchange='changeValueNama(this.value)' required="required">
                      <option value="" disabled="disabled" selected="selected">- pilih plat nomor -</option>
                        <?php
                                $con = mysqli_connect("localhost", "root","", "kreditcbt");
                                $query=mysqli_query($con, "select * from motor order by plat asc");
                                $result = mysqli_query($con, "select * from motor");
                                $jsArrayNama = "var idTipe = new Array();\n";
                                while ($row = mysqli_fetch_array($result)) {
                                echo '<option name="plat"  value="' . $row['plat'] . '">' . $row['plat'] . '</option>';
                                $jsArrayNama.= "idTipe['" . $row['plat'] . "'] = 
                                {
                                merk:'".addslashes($row['merk'])."',
                                tipe:'".addslashes($row['tipe'])."',
                                harga:'".addslashes($row['harga'])."'};\n";
                                }
                            ?>

                    </select>
                    <input type="text" id="merk" name="merk"  value="<?php echo isset($row_edit['merk']) ? $row_edit['merk'] : '';?>" class="form-control" placeholder="Merk">

                    <input type="text" id="tipe" name="tipe"  value="<?php echo isset($row_edit['tipe']) ? $row_edit['tipe'] : '';?>" class="form-control" placeholder="Tipe">

                    <input type="number" id="harga" name="harga"  value="<?php echo $row_edit['harga'];?>" class="form-control" placeholder="Harga">

                    <select name="tenor" class="form-control" onchange="ten()">
                        <option value="">-Pilih Tenor-</option>
                        <option value=3>3 bulan</option>
                        <option value=6>6 bulan</option>
                        <option value=9>9 bulan</option>
                        <option value=12>12 bulan</option>
                    </select>

                    <input type="number" id="bunga" name="bunga" class="form-control" placeholder="Bunga">

                    <input type="number" id="" name="hargakredit"  value="<?php echo $row_edit['hargakredit'];?>" class="form-control" placeholder="Harga Kredit">

                    <input type="number" id="dp" oninput="bagi()" name="dp"  value="<?php echo $row_edit['dp'];?>" class="form-control" placeholder="DP">

                    <input type="number" id="" name="angsuran" class="form-control" placeholder="Angsuran">

                    <input type="number" id="" name="sisa"  value="<?php echo $row_edit['sisa'];?>" class="form-control" placeholder="Sisa Cicilan">

                    <select name="nama" class="form-control" class="form-control form-control-md" id="" onchange='changeValueNamaa(this.value)' required="required">
                      <option value="" disabled="disabled" selected="selected">- pilih nama -</option>
                        <?php
                                $con = mysqli_connect("localhost", "root","", "kreditcbt");
                                $query=mysqli_query($con, "select * from beli order by nama asc");
                                $result = mysqli_query($con, "select * from beli");
                                $jsArrayNamaa = "var idTipee = new Array();\n";
                                while ($row = mysqli_fetch_array($result)) {
                                echo '<option name="nama"  value="' . $row['nama'] . '">' . $row['nama'] . '</option>';
                                $jsArrayNamaa.= "idTipee['" . $row['nama'] . "'] = 
                                {
                                nik:'".addslashes($row['nik'])."',
                                alamat:'".addslashes($row['alamat'])."'};\n";
                                }
                            ?>
                    </select>
                    <input type="number" id="nik" name="nik"  value="<?php echo isset($row_edit['nik']) ? $row_edit['nik'] : '';?>" class="form-control" placeholder="NIK">

                    <input type="text" id="alamat" name="alamat"  value="<?php echo isset($row_edit['alamat']) ? $row_edit['alamat'] : '';?>" class="form-control" placeholder="Alamat">
                  </div>
            </div>
                <?php
          if(isset ($_GET['edit'])){
            ?>
            <button type="submit" name="update" class="btn btn-primary" value="update"> Update</button>
            <td><a href="?menu=transaksi">Batal</a></td>
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
                      <th>id</th>
                      <th>plat</th>
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
                      <th>NIK</th>
                      <th>Alamat</th>
                      <th><th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql = mysqli_query($con,"SELECT * FROM bayar");
                      while ($row_edit = mysqli_fetch_array($sql)){  
                    ?>
                    <tr>
                      <td><?php echo $row_edit['id']?></td>
                      <td><?php echo $row_edit['plat']?></td>
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
                      <td><?php echo $row_edit['nik']?></td>
                      <td><?php echo $row_edit['alamat']?></td>
                      <td><a href="?menu=transaksi&delete&id=<?php echo $row_edit['id']?>"onClick="return confirm('Apakah anda yakin akan menghapus ini?')">HAPUS</a></td>
                      <td><a href="?menu=transaksi&edit&id=<?php echo $row_edit['id']?>">EDIT</a></td>
                      <td><a href="cetak.php?menu=transaksi&cetak&id=<?php echo $row_edit['id']?>">CETAK</a></td>  
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

<script type="text/javascript">
        <?php echo $jsArrayNamaa; ?>
        function changeValueNamaa(nama){
            console.log(nama);
            console.log(idTipee);    
            document.getElementById('alamat').value = idTipee[nama].alamat;
            document.getElementById('nik').value = idTipee[nama].nik;
        }
        </script>

<script type="text/javascript">
        <?php echo $jsArrayNama; ?>
        function changeValueNama(plat){
            console.log(plat);
            console.log(idTipe);   
            document.getElementById('merk').value = idTipe[plat].merk;
            document.getElementById('tipe').value = idTipe[plat].tipe; 
            document.getElementById('harga').value = idTipe[plat].harga;
        }
        </script>
