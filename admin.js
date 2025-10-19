function loadBerita() {
  fetch("data/berita.json?" + new Date().getTime()) // tambahkan timestamp biar gak cache
    .then(res => res.json())
    .then(posts => {
      let container = document.getElementById("posts");
      container.innerHTML = "";

      if (!posts.length) {
        container.innerHTML = "<p>Belum ada berita.</p>";
        return;
      }

      posts.reverse().forEach(post => {
        let div = document.createElement("div");
        div.classList.add("post");
        div.innerHTML = `
          <h3>${post.title}</h3>
          <p>${post.desc}</p>
          ${post.image ? `<img src="${post.image}" alt="gambar">` : ""}
          <div class="date">🗓 ${post.date}</div>
        `;
        container.appendChild(div);
      });
    })
    .catch(() => {
      document.getElementById("posts").innerHTML = "<p>Gagal memuat berita.</p>";
    });
}
