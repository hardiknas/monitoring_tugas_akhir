<?php
function UploadDosen($fupload_name){
  $vdir_upload = "../foto_dosen/";
  $vfile_upload = $vdir_upload . $fupload_name;
  //simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

//==============================================================================================================//

function UploadMhs($fupload_name){
  $vdir_upload = "../foto_mhs/";
  $vfile_upload = $vdir_upload . $fupload_name;
  //simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

//==============================================================================================================//

function UploadFile($fupload_name){
  $vdir_upload = "file/";
  $vfile_upload = $vdir_upload . $fupload_name;
  //simpan file
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

?>