<?php
// Pastikan folder data dan uploads ada
$dataFile = "data/berita.json";
$uploadDir = "uploads/";
if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
if (!is_dir("data")) mkdir("data", 0777, true);

// Baca data lama dari berita.json
$existingData = [];
if (file_exists($dataFile)) {
  $jsonData = file_get_contents($dataFile);
  $existingData = json_decode($jsonData, true);
  if (!is_array($existingData)) $existingData = [];
}

// Upload gambar jika ada
$imagePath = "";
if (!empty($_FILES['image']['name'])) {
  $fileName = time() . "_" . basename($_FILES['image']['name']);
  $targetFile = $uploadDir . $fileName;

  if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
    $imagePath = $targetFile;
  }
}

// Data berita baru (dengan ID unik)
$newPost = [
  "id" => time(), // ID unik berdasarkan timestamp
  "title" => htmlspecialchars($_POST['title']),
  "description" => htmlspecialchars($_POST['description']),
  "image" => $imagePath,
  "date" => date("Y-m-d H:i:s")
];

// Tambahkan ke daftar berita lama
$existingData[] = $newPost;

// Simpan ke berita.json
if (file_put_contents($dataFile, json_encode($existingData, JSON_PRETTY_PRINT))) {
  echo "✅ Berita berhasil disimpan!";
} else {
  echo "❌ Gagal menyimpan berita!";
}
?>
