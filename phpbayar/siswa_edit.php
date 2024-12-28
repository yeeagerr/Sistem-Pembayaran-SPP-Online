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

		$sql = mysqli_query($conn, "UPDATE siswa SET nama='$nama', idprodi='$idprodi' WHERE nis='$nis'");

		if ($sql > 0) {
			header('Location: ./admin.php?hlm=master&sub=siswa');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
		$nis = $_REQUEST['nis'];
		$sql = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$nis'");
		list($nis, $nama, $idprodi) = mysqli_fetch_array($sql);
?>
		<h2>Edit Data Siswa</h2>
		<hr>
		<form method="post" action="admin.php?hlm=master&sub=siswa&aksi=edit" class="form-horizontal" role="form">
			<div class="form-group">
				<label for="nis" class="col-sm-2 control-label">NIS</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" id="nis" name="nis" value="<?php echo $nis; ?>" readonly>
				</div>
			</div>
			<div class="form-group">
				<label for="nama" class="col-sm-2 control-label">Nama siswa</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="prodi" class="col-sm-2 control-label">Program Studi</label>
				<div class="col-sm-4">
					<select name="idprodi" class="form-control">
						<?php
						$qprodi = mysqli_query($conn, "SELECT * FROM prodi ORDER BY idprodi");
						while (list($id, $prodi) = mysqli_fetch_array($qprodi)) {
							echo '<option value="' . $id . '"';
							echo ($id == $idprodi) ? 'selected' : '';
							echo '>' . $prodi . '</option>';
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