# Tugas Aplikasi CRUD

**Nama:** Reza Abdul Latif  
**NIM:** 255150719111001  

---

### Screenshot Aplikasi
<img width="622" height="231" alt="Screenshot CRUD" src="https://github.com/user-attachments/assets/b4138449-b896-43da-800f-95a20a1360a9" />

---

### Penjelasan Program
* **Koneksi:** Menggunakan `mysqli_connect()` untuk terhubung ke database `db_mahasiswa`.
* **Read:** Menampilkan seluruh data mahasiswa ke dalam tabel (`SELECT *`).
* **Insert:** Menambahkan data baru jika form disubmit dan ID kosong (`INSERT INTO`).
* **Update:** Memuat data ke form lewat parameter `?edit=id`, lalu memperbarui data (`UPDATE`).
* **Delete:** Menghapus baris data melalui parameter `?del=id` (`DELETE FROM`).
