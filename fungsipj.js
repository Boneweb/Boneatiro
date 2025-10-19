function initInfo() {
  // Ambil semua judul dan deskripsi
  const judulList = document.querySelectorAll('.judul');
  const deskripsiList = document.querySelectorAll('.deskripsi');

  // Pastikan semua deskripsi tersembunyi di awal
  deskripsiList.forEach(desc => {
    desc.style.display = "none";
  });

  // Kalau belum ada judul, hentikan (supaya tidak error waktu load halaman lain)
  if (judulList.length === 0) return;

  // Tambahkan event klik pada setiap judul
  judulList.forEach(judul => {
    judul.addEventListener('click', () => {
      const deskripsi = judul.nextElementSibling;

      // Toggle tampil/sembunyi
      if (deskripsi.style.display === "none" || deskripsi.style.display === "") {
        deskripsi.style.display = "block";
      } else {
        deskripsi.style.display = "none";
      }
    });
  });
}
