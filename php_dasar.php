<?php
date_default_timezone_set('Asia/Jakarta');

$jobs = [
    "Pelajar" => 0,
    "Karyawan" => 4000000,
    "Content Creator" => 8000000,
    "Software Engineer" => 12000000,
    "UI/UX Designer" => 10000000,
    "Data Analyst" => 11000000,
    "Digital Marketer" => 9000000,
    "Esports Player" => 15000000,
    "AI Prompt Engineer" => 18000000,
    "Pengangguran" => 0
];

$errors = [];
$result = null;
$comment = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name'] ?? '');
    $dob = trim($_POST['dob'] ?? '');
    $job = trim($_POST['job'] ?? '');

    if ($name === '') $errors[] = "Nama wajib diisi.";
    if ($dob === '') $errors[] = "Tanggal lahir wajib diisi.";
    if ($job === '' || !array_key_exists($job, $jobs)) $errors[] = "Pilih pekerjaan yang valid.";

    if (empty($errors)) {
        $birth = new DateTime($dob);
        $today = new DateTime();
        $age = $birth->diff($today)->y;
        $salary = $jobs[$job];
        $salaryFormatted = 'Rp ' . number_format($salary, 0, ',', '.');

        if ($age < 20) {
            $comment = "🎒 Masih muda banget! Dunia masih luas, jangan takut gagal.";
        } elseif ($age < 30) {
            $comment = "🔥 Masa produktif nih! Semangat, tapi jangan lupa tidur cukup.";
        } elseif ($age < 40) {
            $comment = "💼 Umur matang! Waktunya investasi, bukan cuma top-up game.";
        } else {
            $comment = "☕ Bijak banget, mungkin sekarang udah ngerti kenapa kopi bisa nyelametin hari.";
        }

        $result = [
            'name' => htmlspecialchars($name),
            'age' => $age,
            'job' => $job,
            'salary' => $salaryFormatted
        ];
    }
}
?>

<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Form Umur & Gaji — PHP Lucu</title>
<style>
body{font-family:'Segoe UI',Roboto,Arial,sans-serif;background:#fafafa;color:#222;padding:24px;}
.card{background:#fff;border-radius:16px;padding:24px;max-width:700px;margin:0 auto;box-shadow:0 6px 18px rgba(0,0,0,0.08);}
h1{margin-top:0;text-align:center;}
label{display:block;margin-top:12px;font-weight:600;}
input,select,button{width:100%;padding:10px;margin-top:6px;border-radius:8px;border:1px solid #d9d9d9;box-sizing:border-box;}
button{background:#3b82f6;color:#fff;font-weight:600;cursor:pointer;}
button:hover{background:#2563eb;}
.errors{background:#fff6f6;color:#8b1d1d;border:1px solid #fca5a5;border-radius:8px;padding:12px;margin-top:12px;}
.result{background:#f0fdf4;border:1px solid #bbf7d0;color:#065f46;border-radius:8px;padding:16px;margin-top:16px;}
.meta{text-align:center;color:#6b7280;font-size:13px;}
.emoji{font-size:32px;text-align:center;}
</style>
</head>
<body>
<div class="card">
    <div class="emoji">💸</div>
    <h1>Cek Umur & Gaji Kamu</h1>
    <p class="meta">Karena kadang yang bikin deg-degan bukan cinta, tapi slip gaji.</p>

    <?php if($errors): ?>
    <div class="errors">
        <ul><?php foreach($errors as $e) echo "<li>".htmlspecialchars($e)."</li>"; ?></ul>
    </div>
    <?php endif; ?>

    <form method="post">
        <label for="name">Nama</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($name ?? '') ?>" autofocus required>

        <label for="dob">Tanggal Lahir</label>
        <input type="date" id="dob" name="dob" value="<?= htmlspecialchars($dob ?? '') ?>" required>

        <label for="job">Pekerjaan</label>
        <select id="job" name="job" required>
            <option value="">-- Pilih pekerjaan --</option>
            <?php foreach($jobs as $k=>$v): ?>
                <option value="<?= htmlspecialchars($k) ?>" <?= ($job ?? '')===$k?'selected':''; ?>>
                    <?= htmlspecialchars($k) ?> (<?= 'Rp '.number_format($v,0,',','.') ?>/bln)
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Hitung Umur & Gaji</button>
    </form>

    <?php if($result): ?>
    <div class="result">
        <p>Halo, <strong><?= $result['name']; ?></strong>! 🎂 Kamu berumur <strong><?= $result['age']; ?> tahun</strong>.
           Sebagai <strong><?= htmlspecialchars($result['job']); ?></strong>, perkiraan gajimu sekitar <strong><?= $result['salary']; ?></strong> per bulan.</p>
        <p><?= $comment; ?></p>
    </div>
    <?php endif; ?>
</div>
</body>
</html>
