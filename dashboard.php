<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>

    <!-- Menggunakan Bootstrap CDN untuk mendapatkan sumber -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Table CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.0.1/css/scroller.dataTables.min.css">

    <!-- Script Form Pop Up -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <style>
    .button-container {
        margin-bottom: 10px;
    }
    </style>

</head>

</head>

<body>
    <br>
    <h3 style="text-align: center;">PERPUSTAKAAN SDN KIWKIW</h3>

    <br>
    <div class="container">
        <div class="jumbotron" style="background-color: lightblue;">
            <div class="button-container">
                <button data-toggle="modal" data-target="#modaltambah" class="btn btn-danger">Tambah Data Buku</button>
            </div>
            <div class="button-container">
                <button type="button" class="logout-button btn btn-danger"
                    onclick="location.href='logout.php'">Logout</button>
            </div>
            <div class="button-container">
                <button type="button" class="update_password-button btn btn-danger"
                    onclick="location.href='update_password.php'">Update Password</button>
            </div>

            <!-- Modal untuk tambah data buku -->
            <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="proses.php?proses=tambah&id=" method="post">
                                <div class="form-group">
                                    <label>Nama Buku</label>
                                    <input type="text" name="namabuku" class="form-control"
                                        placeholder="Silahkan Masukan Nama Buku">
                                </div>
                                <div class="form-group">
                                    <label>Jenis Buku</label>
                                    <select name="jenisbuku" class="form-control">
                                        <option value="Novel">Novel</option>
                                        <option value="Komik">Komik</option>
                                        <option value="Antologi">Antologi</option>
                                        <option value="Biografi">Biografi</option>
                                        <option value="Dongeng">Dongeng</option>
                                        <option value="Catatan Harian">Catatan Harian</option>
                                        <option value="Karya Ilmiah">Karya Ilmiah</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pengarang</label>
                                    <input type="text" name="pengarang" class="form-control"
                                        placeholder="Silahkan Masukan Nama Pengarang Buku">
                                </div>
                                <div class="form-group">
                                    <label>Tahun Terbit</label>
                                    <input type="year" name="tahunterbit" class="form-control"
                                        placeholder="Silahkan Masukan Tahun Terbit">
                                </div>
                                <div class="form-group">
                                    <label>Penerbit</label>
                                    <input type="text" name="penerbit" class="form-control"
                                        placeholder="Silahkan Masukan Penerbit">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <table class="table table-striped" id="example" style="width:100%">
                <!-- Menggunakan datatable client side -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Buku</th>
                        <th>Pengarang</th>
                        <th>Tahun Terbit</th>
                        <th>Penerbit</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                            include 'config.php';
                            $no=1;
                            $sql = "SELECT * FROM tbuku";
                            $data = $conn->query($sql);
                            foreach($data as $hasil){ ?>
                    <tr>
                        <td><?=$no++; ?></td>
                        <td><?=$hasil['namabuku'];?></td>
                        <td><?=$hasil['pengarang'];?></td>
                        <td><?=$hasil['tahunterbit'];?></td>
                        <td><?=$hasil['penerbit'];?></td>
                        <td>
                            <button data-toggle="modal" data-target="#modaledit<?=$hasil['idbuku']; ?>"
                                class="btn btn-primary">Edit</button>
                            <div class="modal fade" id="modaledit<?=$hasil['idbuku']; ?>">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="proses.php?proses=edit&id=<?=$hasil['idbuku'];?>"
                                                method="post">
                                                <div class="form-group">
                                                    <label>Nama Buku</label>
                                                    <input type="text" name="namabuku" value="<?=$hasil['namabuku'];?>"
                                                        class="form-control" placeholder="Silahkan Masukan Nama Buku">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Buku</label>
                                                    <select name="jenisbuku" class="form-control">
                                                        <option <?= $hasil['jenisbuku'] == 'Novel' ? 'selected' : ''; ?>
                                                            value="Novel">Novel</option>
                                                        <option <?= $hasil['jenisbuku'] == 'Komik' ? 'selected' : ''; ?>
                                                            value="Komik">Komik</option>
                                                        <option
                                                            <?= $hasil['jenisbuku'] == 'Antologi' ? 'selected' : ''; ?>
                                                            value="Antologi">Antologi</option>
                                                        <option
                                                            <?= $hasil['jenisbuku'] == 'Biografi' ? 'selected' : ''; ?>
                                                            value="Biografi">Biografi</option>
                                                        <option
                                                            <?= $hasil['jenisbuku'] == 'Dongeng' ? 'selected' : ''; ?>
                                                            value="Dongeng">Dongeng</option>
                                                        <option
                                                            <?= $hasil['jenisbuku'] == 'Catatan Harian' ? 'selected' : ''; ?>
                                                            value="Catatan Harian">Catatan Harian</option>
                                                        <option
                                                            <?= $hasil['jenisbuku'] == 'Karya Ilmiah' ? 'selected' : ''; ?>
                                                            value="Karya Ilmiah">Karya Ilmiah</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pengarang</label>
                                                    <input type="text" name="pengarang" class="form-control"
                                                        value="<?=$hasil['pengarang'];?>"
                                                        placeholder="Silahkan Masukan Nama Pengarang Buku">
                                                </div>
                                                <div class="form-group">
                                                    <label>Tahun Terbit</label>
                                                    <input type="text" name="tahunterbit" class="form-control"
                                                        value="<?=$hasil['tahunterbit'];?>"
                                                        placeholder="Silahkan Masukan Tahun Terbit">
                                                </div>
                                                <div class="form-group">
                                                    <label>Penerbit</label>
                                                    <input type="text" name="penerbit" class="form-control"
                                                        value="<?=$hasil['penerbit'];?>"
                                                        placeholder="Silahkan Masukan Penerbit">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Simpan
                                                        Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="proses.php?proses=hapus&id=<?=$hasil['idbuku'];?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Memuat jQuery terlebih dahulu -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <!-- Memuat DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/scroller/2.0.1/js/dataTables.scroller.min.js"></script>

    <!-- Inisialisasi DataTables -->
    <script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
    </script>
</body>

</html>