<?php
if (empty($_SESSION['iduser'])) {
	//session_destroy();
	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {
	if (isset($_REQUEST['submit'])) {
		$nis = $_REQUEST['nis'];
		$nama = $_REQUEST['nama'];
		$idprodi = $_REQUEST['idprodi'];

		$sql = mysqli_query($conn, "INSERT INTO siswa VALUES('$nis','$nama','$idprodi')");

		if ($sql > 0) {
			header('Location: ./admin.php?hlm=master&sub=siswa');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
?>
		<h2>Tambah Siswa</h2>
		<hr>
		<form method="post" action="admin.php?hlm=master&sub=siswa&aksi=baru" class="form-horizontal" role="form">
			<div class="form-group">
				<label for="nis" class="col-sm-2 control-label">NIM</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" id="nis" name="nis" placeholder="Nomor Induk Siswa" required autofocus>
				</div>
			</div>
			<div class="form-group">
				<label for="nama" class="col-sm-2 control-label">Nama Mahasiswa</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
				</div>
			</div>
			<div class="form-group">
				<label for="prodi" class="col-sm-2 control-label">Program Studi</label>
				<div class="col-sm-4">
					<select name="idprodi" class="form-control">
						<?php
						$qprodi = mysqli_query($conn, "SELECT * FROM prodi ORDER BY idprodi");
						while (list($idprodi, $prodi) = mysqli_fetch_array($qprodi)) {
							echo '<option value="' . $idprodi . '">' . $prodi . '</option>';
						}
						?>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" name="submit" class="btn btn-default">Simpan</button>
					<a href="./admin.php?hlm=master&sub=siswa" class="btn btn-link">Batal</a>
				</div>
			</div>
		</form>
<?php
	}
}
?>