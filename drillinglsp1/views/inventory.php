<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location: http://localhost/drillinglsp1/login.php');
    exit();
}
include '../include/function.php';
include '../include/koneksi.php';
include '../part/header.php';

$search =  isset($_GET['search']) ? $_GET['search'] : '';
$data_inv = getallinv($search);

if(isset($_GET['delete'])) {
    $id_inv = $_GET['delete'];
    deleteinv($id_inv);
}
?>

<main class="container-fluid">
<div class="col-9 me-auto ms-auto d-flex flex-column justify-content-center">
    <div class="col-12 mb-5">
        <?php 
            $show_alert = false;
            foreach($data_inv as $inv): 
                if($inv['stok_barang'] == 0 && !$show_alert): ?>
                    <div class="alert alert-danger">
                        <h6 class="text-center">Stok Habiss !!!</h6>
                    </div>
                    <?php  $show_alert = true; 
                endif; 
            endforeach; ?>
        <form action="pembukuan.php">
            <div class="d-flex">
                <div class="col-10 card">
                    <input type="text" class="form-control" id="search" name="search" placeholder="search...">
                </div>
                <div class="col-2 card">
                    <button type="submit" class="btn btn-primary">search</button>
                </div>
            </div>
        </form>
    </div>
    <div class="my-2 d-flex justify-content-between col-2">
            <a href="http://localhost/drillinglsp1/views/addinv.php" class="btn btn-primary">Tambah
            </a>
            <a href="http://localhost/drillinglsp1/views/inventory.php" class="btn btn-primary">Refresh</a>
    </div>
    <table class="table table-bordered table-striped table-light">
        <tr>
            <th>NO.</th>
            <th>Nama Barang</th>
            <th>Stok Barang</th>
            <th>Jenis Barang</th>
            <th>Harga</th>
            <th>Lokasi</th>
            <th>Barcode</th>
            <th>Nama Vendor</th>
            <th>Aksi</th>
        </tr>
        <?php if(!empty($data_inv)): ?>
            <?php $i = 1;
                  foreach ($data_inv as $inv): ?>
                <tr class="<?= $inv['stok_barang'] == 0 ? 'table-danger' : '' ?>">
                    <td><?= $i++ ?></td>
                    <td><?= $inv['nama_barang'] ?></td>
                    <td><?= $inv['stok_barang'] ?></td>
                    <td><?= $inv['jenis_barang'] ?></td>
                    <td><?= $inv['harga'] ?></td>
                    <td><?= $inv['nama_gudang'] ?></td>
                    <td><?= $inv['barcode'] ?></td>
                    <td><?= $inv['nama_vendor'] ?></td>
                    <td>
                        <a href="editInv.php?updateInv=<?= $inv['id_inv'] ?>" class="btn btn-warning">Edit</a>
                        <a href="inventory.php?delete=<?= $inv['id_inv'] ?>" onclick="return confirm('Yakin kah cuy?')" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="9">Data Tidak Ditemukan</td>
            </tr>
        <?php endif; ?>
        
    </table>
</div>
    
</main>

<?php include '../part/footer.php'?>