<?php

	include_once("../../function/koneksi.php");
	include_once("../../function/helper.php");
	
	$nama_barang = $_POST['nama_barang'];
	$kategori_id = $_POST['kategori_id'];
	$spesifikasi = $_POST['spesifikasi'];
	$status = $_POST['status'];
	$button = $_POST['button'];
	$harga = $_POST['harga'];
	$stok = $_POST['stok'];
	$update_gambar="";
	
	if(!empty($_FILES["file"]["name"])){
		$gambar = $_FILES["file"]["name"];
		move_uploaded_file($_FILES["file"]["tmp_name"], "../../images/barang/".$gambar);
	
		$update_gambar =", gambar='$gambar'";
	}
	
	if($button == "Add"){
		$query = mysqli_query($koneksi, "INSERT INTO barang (nama_barang, kategori_id, spesifikasi, gambar, harga, stok, status) 
											VALUES ('$nama_barang','$kategori_id','$spesifikasi','$gambar','$harga','$stok','$status')");
	}
	else if($button == "Update") {
		
		$barang_id = $_GET['barang_id'];
		mysqli_query($koneksi, "UPDATE barang SET kategori_id='$kategori_id',
												  nama_barang='$nama_barang',
											      spesifikasi='$spesifikasi',
												  harga='$harga',
												  stok='$stok',
												  status ='$status' 
												  $update_gambar WHERE barang_id='$barang_id'");
												  
	}
	
	// if(!$query) {
		// echo mysqli_error($koneksi);
	// }else{
		// echo "Data berhasil disimpan";
	// }
	
	header ("location:".BASE_URL."index.php?page=my_profile&module=barang&action=list");
	
	?>