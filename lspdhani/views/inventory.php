<?php 
session_start();
if(!isset($_SESSION['admin'])) {
    header('location: http://localhost/lspdhani/login.php');
    exit();
}
include '../include/function.php';
include '../include/koneksi.php';
include '../part/header.php';


$inven = getallinv();

if (isset($_GET['deleteinv'])) {
    $id_inv = $_GET['deleteinv'];
    deleteinv($id_inv);
    header('location: inventory.php');
    exit();
}
?>

<style>

</style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-4">Inventory List</h1>
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Inventory List</h5>
                        <a href="addinv.php" class="btn btn-primary float-right">Add inventory</a>
                    </div>
                <!-- <div class="d-flex my-4 mx-4">
            <input type="text" class="form-control" name="search" id="search" placeholder="Cari barang...">
            <button type="submit" class="btn btn-primary mx-4 col-3">Cari</button>
        </div> -->
                <div class="card-body">
                
                    
                    <table class="table table-bordered table-light table-striped">
                        <tr>
                            <th>no</th>
                            <th>nama vendor</th>
                            <th>nama barang</th>
                            <th>Jenis barang</th>
                            <th>stok barang </th>
                            <th>barcode</th>
                            <th>lokasi gudang</th>
                            <th>action </th>
                        </tr>
                        <?php 
                        $no = 1; 
                        foreach($inven as $i): ?>
                            <tr class="<?= $i['stok_barang'] == 0 ? 'table-danger' : '' ?>">
                                <td><?= $no++ ?></td>
                                <td><?= $i['nama_vendor'] ?></td>
                                <td><?= $i['nama_barang'] ?></td>
                                <td><?= $i['jenis_barang'] ?></td>
                                <td><?= $i['stok_barang'] ?></td>
                                <td><?= $i['barcode'] ?></td>
                                <td><?= $i['lokasi'] ?></td>
                                <td>
                                    <a class="btn btn-warning" href="editinv.php?updateinv=<?= $i['id_inventory'] ?>">Edit</a>
                                    <a class="btn btn-danger" href="inventory.php?deleteinv=<?= $i['id_inventory'] ?>" onclick="return confirm('Apakah anda yakin mau delete')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../part/footer.php'?> 