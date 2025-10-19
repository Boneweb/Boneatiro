<?php
// Lokasi file data
$dataFile = "data/berita.json";

// Cek apakah file berita.json ada
if (!file_exists($dataFile)) {
  echo "❌ File data tidak ditemukan.";
  exit;
}

// Ambil ID dari form atau AJAX (POST)
$id = isset($_POST['id']) ? trim($_POST['id']) : '';
if ($id === '') {
  echo "❌ ID berita tidak valid.";
  exit;
}

// Baca data lama
$jsonData = file_get_contents($dataFile);
$posts = json_decode($jsonData, true);

// Jika file kosong atau rusak
if (!is_array($posts)) {
  echo "❌ Data berita tidak valid.";
  exit;
}

// Cari dan hapus berita berdasarkan ID
$found = false;
foreach ($posts as $index => $post) {
  if (isset($post['id']) && $post['id'] == $id) {
    // Hapus gambar jika ada
    if (!empty($post['image']) && file_exists($post['image'])) {
      unlink($post['image']);
    }

    // Hapus data dari array
    unset($posts[$index]);
    $found = true;
    break;
  }
}

// Simpan ulang data ke berita.json
if ($found) {
  // Re-index array agar urut lagi
  file_put_contents($dataFile, json_encode(array_values($posts), JSON_PRETTY_PRINT));
  echo "✅ Berita berhasil dihapus.";
} else {
  echo "❌ Berita tidak ditemukan.";
}
?>
