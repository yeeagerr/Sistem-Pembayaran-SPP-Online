<?php
if (empty($_SESSION['iduser'])) {
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if (isset($_REQUEST['aksi'])) {
		$aksi = $_REQUEST['aksi'];
		switch ($aksi) {
			case 'baru':
				include 'siswa_baru.php';
				break;
			case 'edit':
				include 'siswa_edit.php';
				break;
			case 'hapus':
				include 'siswa_hapus.php';
				break;
		}
	} else {
		$sql = mysqli_query($conn, "SELECT * FROM siswa ORDER BY nis");
		echo '<h2>Daftar Mahasiswa</h2><hr>';
		echo '<div class="row">';
		echo '<div class="col-md-9"><table class="table table-bordered">';
		echo '<tr class="info"><th>#</th><th width="100">NIM</th><th>Nama Lengkap</th><th>Prodi</th>';
		echo '<th width="200"><a href="./admin.php?hlm=master&sub=siswa&aksi=baru" class="btn btn-default btn-xs">Tambah Data</a></th></tr>';

		if (mysqli_num_rows($sql) > 0) {
			$no = 1;
			while (list($nis, $nama, $idprodi) = mysqli_fetch_array($sql)) {
				echo '<tr><td>' . $no . '</td>';
				echo '<td>' . $nis . '</td>';
				echo '<td>' . $nama . '</td>';
				$qprodi = mysqli_query($conn, "SELECT prodi FROM prodi WHERE idprodi='$idprodi'");
				list($prodi) = mysqli_fetch_array($qprodi);
				echo '<td>' . $prodi . '</td>';
				echo '<td><a href="./admin.php?hlm=master&sub=siswa&aksi=edit&nis=' . $nis . '" class="btn btn-success btn-xs">Edit</a> ';
				echo '<a href="./admin.php?hlm=master&sub=siswa&aksi=hapus&nis=' . $nis . '" class="btn btn-danger btn-xs">Hapus</a></td>';
				echo '</tr>';
				$no++;
			}
		} else {
			echo '<tr><td colspan="5"><em>Belum ada data</em></td></tr>';
		}

		echo '</table></div></div>';
	}
}
