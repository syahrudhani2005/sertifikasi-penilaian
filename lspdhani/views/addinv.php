<?php 
session_start();
if(!isset($_SESSION['admin'])) {
    header('location: http://localhost/drill2/login.php');
    exit();
}
include '../include/function.php';
include '../include/koneksi.php';
include '../part/header.php';

$nama_vendor = '';
$nama_barang = '';
$lokasi = '';

if (isset($_POST['addInv'])) {
    $nama_vendor = $_POST['nama_vendor'];
    $nama_barang = $_POST['nama_barang'];
    $jenis_barang = $_POST['jenis_barang'];
    $stok_barang = $_POST['stok_barang'];
    $barcode = $_POST['barcode'];
    $lokasi = $_POST['lokasi'];
    $vendor = getVendorByName($nama_vendor);
    if ($vendor) {
        $id_vendor = $vendor['id_vendor'];
        if (addInv($nama_barang, $jenis_barang, $stok_barang, $lokasi, $barcode, $id_vendor) == true) {
            $data_berhasil = "data berhasil di tambahkan";
        }
    }
    
}
$inven= getallinv();
$vendor= getVendorAll();
$gudang= getGudangAll();

$unique_vendor=[];
foreach ($vendor  as $v) {
    $unique_vendor[$v['nama_vendor']]=$v;
}

$vendor_barang= [];
if (isset($_POST['nama_vendor'])) {
    $nama_vendor = $_POST['nama_vendor'];
    $vendor_barang = getBarangByvendorName($nama_vendor);
}

?>

<main class="card col-9 me-auto ms-auto d-block p-5 mt-5 mb-vendor_barang5 shadow-lg">
    <h2 class="text-center mb-3">Kelola Inventory</h2>
    <?php if(isset($data_berhasil)): ?>
            <div class="alert alert-success">
                <?= $data_berhasil ?>
            </div>
        <?php endif; ?>
    <form action="addinv.php" method="post" class="d-flex flex-column p-3">
    <div class="mb-3">
            <label for="nama_vendor" class="form-label">Nama Vendor</label>
            <select name="nama_vendor" id="nama_vendor" class="form-select" onchange="this.form.submit();">
                <?php foreach ($unique_vendor as $b) { ?>
                    <option value="<?= $b['nama_vendor']; ?>" <?= $nama_vendor == $b['nama_vendor'] ? 'selected':''?> >
                        <?= $b['nama_vendor'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <select name="nama_barang" id="nama_barang" class="form-select" >
                <?php foreach ($vendor_barang as $v) { ?>
                    <option value="<?= $v['nama_barang']; ?> "<?= $nama_barang == $v['nama_barang']? 'selected':''?> >
                        <?= $v['nama_barang'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    <div class="mb-3">
        <label for="jenis_barang" class="form-label">Jenis Barang</label>
        <input type="text" name="jenis_barang" class="form-control">
    </div>
    <div class="mb-3">
        <label for="stok_barang" class="form-label">Stok Barang</label>
        <input type="text" name="stok_barang" class="form-control">
    </div>
    <div class="mb-3">
        <label for="barcode" class="form-label">Barcode</label>
        <input type="text" name="barcode" class="form-control">
    </div>
    <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <select name="lokasi" id="lokasi" class="form-select" >
                <?php foreach ($gudang as $g) { ?>
                    <option value="<?= $g['lokasi']; ?> "<?= $lokasi == $g['lokasi']? 'selected':''?> >
                        <?= $g['lokasi'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    <button type="submit" name="addInv" class="btn btn-primary">Tambah Inventory</button>
</form>
    
</main>


<?php include '../part/footer.php'?>