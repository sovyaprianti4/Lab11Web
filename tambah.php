<?php
$db = new Database();
$form = new Form("", "Simpan Artikel");

if ($_POST) {
    $data = [
        "judul" => $_POST['judul'],
        "konten" => $_POST['konten']
    ];

    $db->insert("artikel", $data);

    echo "<p style='color:green;'>Artikel berhasil disimpan!</p>";
}

echo "<h3>Tambah Artikel</h3>";

$form->addField("judul", "Judul Artikel");
$form->addField("konten", "Konten Artikel", "textarea");

$form->displayForm();
?>