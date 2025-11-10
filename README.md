# Laporan Praktikum 7: PHP Dasar

1. Buatlah **_repository_** baru dengan nama **Lab7Web**.

2. Kerjakan semua latihan yang diberikan sesuai urutannya.

3. Screenshot setiap perubahannya.

4. Buatlah file **README.md** dan tuliskan penjelasan dari setiap langkah praktikum beserta screenshotnya.

5. **Commit** hasilnya pada **_repository_** masing-masing.

6. Kirim **URL repository** pada **_e-learning_** ecampus

## Pertanyaan dan Tugas

Buatlah program PHP sederhana dengan menggunakan form input yang menampilkan nama, tanggal lahir dan pekerjaan. Kemudian tampilkan outputnya dengan menghitung umur berdasarkan inputan tanggal lahir. Dan pilihan pekerjaan dengan gaji yang berbeda beda sesuai pilihan pekerjaan.

1. Tampilan Web

<img width="957" height="525" alt="image" src="https://github.com/user-attachments/assets/9d548540-3d26-41e0-81c2-8a6ab3f4964c" />

<img width="958" height="735" alt="image" src="https://github.com/user-attachments/assets/90e2c75e-b3aa-45b2-a603-4e590ff85d3c" />

<img width="957" height="691" alt="image" src="https://github.com/user-attachments/assets/a05f2d21-9183-4d87-8239-a04ce6d82cd3" />

2. Membuat Form Input

Form itu ibarat meja resepsionis di hotel: semua data masuk lewat dia.
Di sini, kita punya tiga tamu utama: **nama, tanggal lahir, dan pekerjaan**.

        <form method="post">
      <input type="text" name="name">
      <input type="date" name="dob">
      <select name="job">
        <option>Content Creator</option>
        <option>Barista</option>
        ...
      </select>
    </form>

Begitu tombol submit diklik, PHP berdiri di belakang layar, nyatet semua yang dikirim pengguna lewat $_POST.
Kalau form ini punya nyawa, mungkin dia akan ngomong:

“Masukkan datamu dengan jujur, ya. Aku nggak bisa menghitung umur kalau kamu lahir minggu depan.”

Form input inilah pintu masuk semua logika, dan tanpa dia, program ini cuma halaman kosong yang kesepian.

3. Operator

Setelah data masuk, PHP mulai bekerja dengan operator—alat kecil tapi berbahaya.
Contohnya waktu menghitung umur:

    $birth = new DateTime($dob);
    $today = new DateTime();
    $age = $birth->diff($today)->y;

Di sini, operator -> dipakai untuk memanggil fungsi dalam objek (kayak diff() dan y).
Sementara operator perbandingan > dipakai buat ngecek tanggal lahir yang lebih besar dari hari ini—kalau iya, berarti kamu dari masa depan, dan program langsung bilang error.

Operator di PHP itu kayak sendok dan garpu waktu makan: kecil, tapi kalau salah pakai, bisa berantakan semua.

4. Kondisi if

if adalah penguasa logika.
Dia kayak penjaga pintu yang nentuin siapa boleh lewat dan siapa nggak.

    if ($age < 20) {
        $comment = "Masih muda banget!";
    } elseif ($age < 30) {
        $comment = "Masa produktif nih!";
    } else {
        $comment = "Udah cukup bijak buat nggak begadang tiap malam.";
    }

Di sini, PHP bertindak seperti temanmu yang jujur tapi kadang nyelekit.
Kalau umurmu di bawah 20, dia bilang “Masih muda banget!”.
Kalau di atas 30, dia langsung kasih wejangan kehidupan.

if ini yang bikin program terasa hidup, karena tanpa kondisi, semua orang akan dianggap sama.
Dan kalau hidupmu tanpa kondisi, ya itu namanya pasrah, bukan logika.
