<?php
session_start();
if(!isset($_SESSION['admin'])) {
    header('location: http://localhost/lspdhani/login.php');
    exit();
}
include '../include/function.php';
include '../include/koneksi.php';
include '../part/header.php';

if(isset($_POST['update'])) {
    $id_inv = $_POST['id_inventory'];
    $nama_barang = $_POST['nama_barang'];
    $jenis_barang = $_POST['jenis_barang'];
    $stok_barang = $_POST['stok_barang'];
    $barcode = $_POST['barcode'];
    $id_vendor = $_POST['id_vendor'];
    $lokasi = $_POST['lokasi'];
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    updateinven($id_inv,$nama_barang,$jenis_barang,$stok_barang,$barcode,$id_vendor,$lokasi);
    header('location: http://localhost/lspdhani/views/inventory.php');
     exit();
}

if(isset($_GET['updateinv'])) {
    $id_inv = $_GET['updateinv'];
    $inventory = getinvenbyid($id_inv);
    $lokasi = $inventory['lokasi'];
    $id_vendor= $inventory['id_vendor'];
}

$vendors = getVendorAll();
$gudang = getGudangAll();
$vendors = array_column($vendors, null, 'id_vendor');
?>
<main class="card col-9 me-auto ms-auto d-block p-5">
    <h2 class="text-center mb-3">Kelola Inventory</h2>
        <form action="editinv.php" method="post" class="p-3">
        <input type="hidden" name="id_vendor" value="<?= $inventory['id_vendor']?>">
        <input type="hidden" name="lokasi" value="<?= $inventory['lokasi']?>">
        <input type="hidden" name="id_inventory" value="<?= $inventory['id_inventory']?>">
        <div class="mb-3">
            <label for="nama_vendor" class="form-label">Nama Vendor</label>
            <input type="text" name="nama_vendor" class="form-control" placeholder="Nama Vendor" 
            value="<?= isset($vendors[$inventory['id_vendor']]) ? $vendors[$inventory['id_vendor']]['nama_vendor'] : 'vendor tidak ditemukan' ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang" value="<?= $inventory['nama_barang']?>" readonly>
        </div>
        <div class="mb-3">
            <label for="stok_barang" class="form-label">Stok Barang</label>
            <input type="text" name="stok_barang" class="form-control" placeholder="Stok Barang" value="<?= $inventory['stok_barang']?>">
        </div>
        <div class="mb-3">
            <label for="jenis_barang" class="form-label">Jenis Barang</label>
            <input type="text" name="jenis_barang" class="form-control" placeholder="jenis_barang" value="<?= $inventory['jenis_barang']?>">
        </div>
        <div class="mb-3">
            <label for="barcode" class="form-label">Barcode</label>
            <input type="text" name="barcode" class="form-control" placeholder="barcode" value="<?= $inventory['barcode']?>" readonly>
        </div>
        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi Gudang</label>
            <input type="text" name="lokasi" class="form-control" placeholder="lokasi" value="<?= $inventory['lokasi']?>" readonly>
        </div>
    
        <button type="submit" name="update" class="btn btn-primary">Ubah data inventory</button>
        <a href="http://localhost/lspdhani/views/inventory.php" class="btn btn-danger text-white">cancel</a>
    </form>



<?php include '../part/footer.php'?>