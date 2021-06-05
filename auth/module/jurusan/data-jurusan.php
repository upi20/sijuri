<?php
$error = '';
$status_error = 'danger';
// cek apakah ada data yang akan dihapus
if (isset($_GET['delete'])) {
    $kode_jurusan = $_GET['delete'];
    $query = "DELETE FROM `jurusan` WHERE `jurusan`.`kode_jurusan` = '$kode_jurusan'";
    $result = mysqli_query($connect, $query);

    // cek apakah ada baris di database yang berubah
    if (mysqli_affected_rows($connect) > 0) {
        $title_error = '</i> Success!</strong> Berhasil menghapus Data';
        $status_error = 'success';
    } else {
        $title_error = '</i> Warning!</strong> Gagal menghapus Data';
    }
    // masukan title error jika ada
    $error =  $title_error ? '<div class="alert alert-' . $status_error . ' alert-dismissible" role="alert">
    				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    				<strong><i class="fa fa-times-circle">' . $title_error . '
    		  </div>' : '';
}

?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="panel panel-success" style="box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);">
                <div class="unwaha-padding panel-heading" style="color:#fff;background-color: #158873;border-color: #158873;"> <?= $icon . " " . $title; ?></div>
                <div class="panel-body">
                    <?= $error; ?>
                    <a href="media.php?action=tambah-jurusan" class="btn btn-md btn-success" style="margin-bottom:10px"><i class="fa fa-plus"></i> Tambah Data</a>
                    <table id="data-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Jurusan</th>
                                <th>Nama Jurusan</th>
                                <th>Fakultas</th>
                                <th>Akreditasi</th>
                                <th>Aktif</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //query select where kode_fakultas
                            $query = "SELECT jurusan.*,fakultas.nama_fakultas  FROM jurusan left join fakultas on jurusan.kode_fakultas = fakultas.kode_fakultas ORDER BY fakultas.kode_fakultas ASC";
                            $result =  mysqli_query($connect, $query);
                            $no = 1;
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row['kode_jurusan'] ?></td>
                                    <td><?php echo $row['nama_jurusan'] ?></td>
                                    <td><?php echo ($row['nama_fakultas'] != NULL) ? $row['nama_fakultas'] : "Tidak ada" ?></td>
                                    <td><?php echo $row['akreditasi'] ?></td>
                                    <td><?php echo ($row['Aktif'] == "Y") ? "Aktif" : "Tidak Aktif" ?></td>
                                    <td class="text-center">
                                        <a href="media.php?action=edit-jurusan&kode_jurusan=<?php echo $row['kode_jurusan'] ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="media.php?action=jurusan&delete=<?php echo $row['kode_jurusan'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data Jurusan ?')"><i class="fa fa-trash"></i> Delete</a>
                                    </td>
                                </tr>

                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>