<?php
include '../include/function.php';
include '../include/koneksi.php';
include '../part/header.php';

if (isset($_POST['updateGudang'])) {
    $id_gudang = $_POST['id_gudang'];
    $nama_gudang = $_POST['nama_gudang'];
    $lokasi = $_POST['lokasi'];
    
    updateGudang($nama_gudang, $lokasi, $id_gudang);
        header('location: http://localhost/lspdhani/views/gudang.php');
        exit();
    
}

if(isset($_GET['updategud'])){
    $id_gudang = $_GET['updategud'];
    $gudang = getGudang($id_gudang);
}
?>

<div class="card col-9 me-auto ms-auto d-block p-5 mt-5 shadow-lg">
<h2 class="text-center mb-3">Kelola Gudang</h2>
        <?php if(isset($data_berhasil)): ?>
            <div class="alert alert-success">
                <?= $data_berhasil ?>
            </div>
        <?php endif; ?>
       
        <form action="editgud.php" method="post" class="p-3">
        <input type="hidden" name="id_gudang" value="<?= $gudang['id_gudang']?>">
        <div class="mb-3">
            <label for="nama_gudang" class="form-label">Nama Gudang</label>
            <input type="text" name="nama_gudang" class="form-control" placeholder="Nama Gudang" value="<?= $gudang['nama_gudang']?>">
        </div>
        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi Barang</label>
            <input type="text" name="lokasi" class="form-control" placeholder="lokasi" value="<?= $gudang['lokasi']?>">
        </div>
        <button type="submit" name="updateGudang" class="btn btn-primary">Ubah data gudang</button>
        <a href="gudang.php" class="btn btn-danger text-white">cancel</a>
    </form>
    </div>



<?php include '../part/footer.php'?>