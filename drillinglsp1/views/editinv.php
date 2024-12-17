<?php 
session_start();
if(!isset($_SESSION['admin'])) {
    header('location: http://localhost/drillinglsp1//login.php');
    exit();
}
include '../include/function.php';
include '../part/header.php';


if(isset($_POST['update'])) {
    $id_inv = $_POST['id_inv'];
    $nama_barang = $_POST['nama_barang'];
    $stok_barang = $_POST['stok_barang'];
    $jenis_barang = $_POST['jenis_barang'];
    $harga = $_POST['harga'];
    $id_gudang = $_POST['id_gudang'];
    $barcode = $_POST['barcode'];
    $id_vendor = $_POST['id_vendor'];
    updateInv($id_inv , $nama_barang, $jenis_barang, $stok_barang, $barcode, $harga, $id_vendor, $id_gudang);
    header('location: http://localhost/drillinglsp1/views/inventory.php');
    exit();
}

if(isset($_GET['updateInv'])) {
    $id_inv = $_GET['updateInv'];
    $inv = getinvenbyid($id_inv);
    $id_gudang = $inv['id_gudang'];
}
    $vendors = getVendorAll();
    $vendors = array_column($vendors, null, 'id_vendor');
    $gudang = getGudangAll();
    $gudang = array_column($gudang, null, 'id_gudang');
?>

<main class="card col-9 me-auto ms-auto d-block p-5">
<h1>update Data</h1>
            <form action="editInv.php" method="post">
            <input type="hidden" name="id_inv" value="<?= $inv['id_inv']; ?>">
            <input type="hidden" name="id_gudang" value="<?= $inv['id_gudang']; ?>">
            <input type="hidden" name="id_vendor" value="<?= $inv['id_vendor']; ?>">
            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $inv['nama_barang']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_vendor" class="form-label">Nama Vendor</label>zz
                <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" 
                    value="<?= $vendors[$inv['id_vendor']]['nama_vendor']?>" 
                    readonly>
                <input type="hidden" name="id_vendor" value="<?= $inv['id_vendor']; ?>">
            </div>
                <div class="mb-3">
                    <label for="jenis_barang" class="form-label">Jenis Barang</label>
                    <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" value="<?= $inv['jenis_barang']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="stok_barang" class="form-label">stok Barang</label>
                    <input type="text" class="form-control" id="stok_barang" name="stok_barang" value="<?= $inv['stok_barang']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" value="<?= $inv['harga']; ?>" name="harga" required>
                </div>
                <div class="mb-3">
                    <label for="barcode" class="form-label">Barcode</label>
                    <input type="text" class="form-control" id="barcode" name="barcode" value="<?= $inv['barcode']; ?>" required >
                </div>
                <div class="mb-3">
                    <label for="id_gudang" class="form-label">Gudang</label>
                    <input type="text" name="nama_gudang" class="form-control" 
                    value="<?= isset($gudang[$inv['id_gudang']]) ? $gudang[$inv['id_gudang']]['nama_gudang'] : 'gudang tidak di temukan' ?>" readonly>
                </div>
                <button name="update" class="btn btn-primary">update inventory</button>
            </form>
</main>

<?php include '../part/footer.php'?>