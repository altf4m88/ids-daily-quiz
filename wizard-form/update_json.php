<?php
// Mendapatkan data JSON yang dikirimkan dari permintaan AJAX
$jsonData = $_POST['json'];

// Menyimpan data JSON ke file dengan format yang rapi
$file = '../questions/usereal-daily.json';
file_put_contents($file, json_encode(json_decode($jsonData), JSON_PRETTY_PRINT));

// Mengirimkan respon berhasil ke klien
$response = ['message' => 'File JSON berhasil diperbarui.'];
echo json_encode($response);
?>