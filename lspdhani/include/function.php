<?php 
include 'koneksi.php';


// kelola gudang
function addgud($nama_gudang,$lokasi){
    global $conn;
    $query = "INSERT INTO gudang (nama_gudang,lokasi) VALUES (?,?)";
    $stmt= $conn->prepare($query);
    $stmt->bind_param('ss',$nama_gudang,$lokasi);
    $stmt->execute();  
}

function updateGudang($nama_gudang, $lokasi, $id_gudang){
    global $conn;
    $query = "UPDATE gudang SET
                nama_gudang=?, lokasi=?
                WHERE id_gudang=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssi', $nama_gudang, $lokasi,$id_gudang );
    $stmt->execute();
}

function getGudangALL() {
    global $conn;
    $query = "SELECT * FROM gudang";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function deletegud($id_gudang) {
    global $conn;
    $query = "DELETE FROM gudang WHERE id_gudang = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i',$id_gudang);
    $stmt->execute();
}

function getGudang($id_gudang){
    global $conn;
    $query = "SELECT * FROM gudang WHERE id_gudang=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_gudang);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

//kelola vendor

function getBarangByvendorName($nama_vendor){
    global $conn;
    $query = "SELECT nama_barang FROM vendor WHERE nama_vendor=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $nama_vendor);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getVendorByName($nama_vendor) {
    global $conn;
    $query = "SELECT * FROM vendor WHERE nama_vendor = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $nama_vendor);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function getVendorByid($id_vendor) {
    global $conn;
    $query = "SELECT * FROM vendor WHERE id_vendor = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_vendor);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
function getBarangByName($nama_barang) {
    global $conn;
    $query = "SELECT * FROM vendor WHERE nama_barang =?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $nama_barang);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function getVendorBybarangByName($nama_barang) {
    global $conn;
    $query = "SELECT nama_vendor FROM vendor WHERE nama_barang = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $nama_barang);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function addVendor($nama_vendor, $nama_barang,  $kontak_vendor) {
    global $conn;
    $query = "INSERT INTO vendor (nama_vendor, nama_barang, kontak_vendor) VALUES ( ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssi', $nama_vendor, $nama_barang,  $kontak_vendor);
    $stmt->execute();
    return true;
} 

function deleteVendor($id_vendor) {
    global $conn;
    $conn->prepare('SET FOREIGN_KEY_CHECKS =0');
    $query = "DELETE FROM vendor WHERE id_vendor = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_vendor);
    $stmt->execute();
    $conn->prepare('SET FOREIGN_KEY_CHECKS = 1');
}

function getVendorALL() {
    global $conn;
    $query = "SELECT * FROM vendor";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function updateVen($nama_vendor, $nama_barang, $kontak_vendor, $id_vendor) {
    global $conn;
    $query = "UPDATE vendor SET 
            nama_vendor = ?,  nama_barang = ?, kontak_vendor = ?
             WHERE id_vendor = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssii',$nama_vendor, $nama_barang,  $kontak_vendor, $id_vendor);
    $stmt->execute();
}


//kelola inventory

function addInv($nama_barang, $jenis_barang, $stok_barang, $lokasi, $barcode, $id_vendor) {
    global $conn;
    $query = "INSERT INTO inventory
    (nama_barang, jenis_barang, stok_barang, lokasi, barcode, id_vendor)
    VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssisii', $nama_barang, $jenis_barang, $stok_barang, $lokasi, $barcode, $id_vendor);
    $stmt->execute();
    return true;
}

function updateinven($id_inventory,$nama_barang,$jenis_barang,$stok_barang,$barcode,$id_vendor,$lokasi){
    global $conn;
    $query = "UPDATE inventory SET 
    nama_barang = ?,jenis_barang = ?, stok_barang = ?, barcode = ?, id_vendor = ?, lokasi= ? 
     WHERE id_inventory  = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssiiisi',$nama_barang,$jenis_barang,$stok_barang,$barcode,$id_vendor,$lokasi,$id_inventory);
    $stmt->execute();
}

function deleteinv($id_inventory){
    global $conn;
    $query = "DELETE FROM inventory WHERE id_inventory=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_inventory);
    $stmt->execute();
}

function getinvenbyid($id_inventory){
    global $conn;
    $query = "SELECT * FROM inventory WHERE id_inventory=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_inventory);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}


function getAllinv(){
    global $conn;
    $query = "SELECT *
    FROM inventory 
    JOIN vendor ON inventory.id_vendor=vendor.id_vendor";
    $stmt=$conn->prepare($query);
    $stmt->execute();   
    $result=$stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>