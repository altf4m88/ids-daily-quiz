<?php
// Mendapatkan data JSON yang dikirimkan dari permintaan AJAX
$jsonData = $_POST['json'];
$thisFile = $_POST['thisFile'];

// Menyimpan data JSON ke file dengan format yang rapi
$file = '../questions/'.$thisFile;
file_put_contents($file, json_encode(json_decode($jsonData, true), JSON_PRETTY_PRINT));

// Mengirimkan respon berhasil ke klien
$response = ['message' => 'File JSON berhasil diperbarui.', 'file' => $file, json_decode($jsonData, true)];
echo json_encode($response);
?>