<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<?php
require_once "koneksi.php";
if(!isset($_SESSION)) {
    session_start();
}

if (empty($_SESSION['username'])){
    session_destroy();
    header('Location: login.php');
}

?>
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="Adiholick" />

    <!-- Stylesheets
    ============================================= -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link rel="stylesheet" href="css/dark.css" type="text/css" />
    <link rel="stylesheet" href="css/font-icons.css" type="text/css" />
    <link rel="stylesheet" href="css/animate.css" type="text/css" />
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />

    <!-- Bootstrap Data Table Plugin -->
    <link rel="stylesheet" href="css/components/bs-datatable.css" type="text/css" />

    <!-- Select-Boxes CSS -->
    <link rel="stylesheet" href="css/components/select-boxes.css" type="text/css" />

    <link rel="stylesheet" href="css/responsive.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Document Title
    ============================================= -->
    <title>Pilih Tempat Wisata | Wisata Indonesia</title>

</head>

<body class="stretched">

<!-- Document Wrapper
============================================= -->
<div id="wrapper" class="clearfix">

    <!-- Header
    ============================================= -->
    <?php include "header.php"; ?>
    <!-- #header end -->

    <!-- Page Title
    ============================================= -->
    <section id="page-title">

        <div class="container clearfix">
            <h1>Pilih Tempat Wisata</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Pilih Tempat Wisata</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="table-responsive">
                    <form id="form-pilih-tempat" name="form-pilih-tempat" action="weighted-product.php" method="post">
                    <table id="daftar-tempat" name="daftar-tempat" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Pilih</th>
                            <th>No</th>
                            <th>Provinsi</th>
                            <th>Nama Tempat</th>
                            <th>Biaya Transportasi</th>
                            <th>Harga Tiket</th>
                            <th>Fasilitas Tersedia</th>
                            <th>Kebersihan</th>
                            <th>Keindahan</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Pilih</th>
                            <th>No</th>
                            <th>Provinsi</th>
                            <th>Nama Tempat</th>
                            <th>Biaya Transportasi</th>
                            <th>Harga Tiket</th>
                            <th>Fasilitas Tersedia</th>
                            <th>Kebersihan</th>
                            <th>Keindahan</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php
                        $no=0;
                        $sql_tempat = mysqli_query($con, "SELECT a.*, b.provinsi FROM `tempat` AS a LEFT JOIN `provinsi` AS b ON a.provinsi_id=b.provinsi_id");
                        while ($tampil = mysqli_fetch_array($sql_tempat)){
                            $no++;
                            $bintang = "<i class=\"icon icon-line-star small\"></i>";
                            $fasilitas = $tampil['fasilitas'];
                            $kebersihan = $tampil['kebersihan'];
                            $keindahan = $tampil['keindahan'];
                            ?>
                            <tr>
                                <td>
                                    <input id="checkbox" name="checkbox[]" type="checkbox" value="<?php echo $tampil['id']; ?>">
                                </td>
                                <td><?php echo $no; ?></td>
                                <td><a href="tempat.php?lihat=<?php echo $tampil['id']; ?>" target="_blank"><?php echo $tampil['provinsi']; ?></a></td>
                                <td><a href="tempat.php?lihat=<?php echo $tampil['id']; ?>" target="_blank"><?php echo $tampil['nama']; ?></a></td>
                                <td><?php echo "Rp. ". number_format($tampil['transportasi'],2,',','.'); ?></td>
                                <td><?php echo "Rp. ". number_format($tampil['tiket'],2,',','.'); ?></td>
                                <td><?php for($x=0; $x<$fasilitas; $x++){echo $bintang;} ?></td>
                                <td><?php for($x=0; $x<$kebersihan; $x++){echo $bintang;} ?></td>
                                <td><?php for($x=0; $x<$keindahan; $x++){echo $bintang;} ?></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                    </form>
                    <div class="divider divider-center"><i class="icon-cloud"></i></div>
                    <a id="btn-berikutnya" name="btn-berikutnya" class="button button-desc button-dark button-rounded fright"><div>Berikutnya <i class="icon-circle-arrow-right"></i></div><span>Proses Perhitungan WP</span></a>
                </div>

                <!-- MODAL -->

                <div id="konfirmasi-hapus-tempat" name="konfirmasi-hapus-tempat" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-body">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Hapus Tempat Wisata</h4>
                                </div>
                                <div class="modal-body">
                                    <p class="nobottommargin">Ingin Menghapus Tempat Wisata?</p>
                                </div>
                                <div class="modal-footer">

                                    <form id="form-hapus-tempat" name="form-hapus-tempat" action="" method="post">
                                        <input id="id-tempat" name="id-tempat" type="hidden" value="">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->

                <!-- Notifikasi Area -->
                <div id="notifikasi-gagal" data-notify-position="top-right" data-notify-type="error" data-notify-msg="<i class=icon-remove-sign></i> Gagal mengubah!"></div>
                <div id="notifikasi-sukses" data-notify-position="top-right" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Berhasil diubah!"></div>

                <div id="notifikasi-hapus-gagal" data-notify-position="top-right" data-notify-type="error" data-notify-msg="<i class=icon-remove-sign></i> Gagal Menghapus!"></div>
                <div id="notifikasi-hapus-sukses" data-notify-position="top-right" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Berhasil dihapus!"></div>

                <!-- End Notifikasi Area -->

            </div>

        </div>

    </section><!-- #content end -->

    <!-- Footer
    ============================================= -->
    <?php include "footer.php"; ?>
    <!-- #footer end -->

</div><!-- #wrapper end -->

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>

<!-- External JavaScripts
============================================= -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>

<!-- Select-Boxes Plugin -->
<script type="text/javascript" src="js/components/select-boxes.js"></script>

<!-- Bootstrap Data Table Plugin -->
<script type="text/javascript" src="js/components/bs-datatable.js"></script>


<!-- Footer Scripts
============================================= -->
<script type="text/javascript" src="js/functions.js"></script>
<script>

    $(".select-hide").select2({
        minimumResultsForSearch: Infinity
    });
    $(document).ready(function() {
        $("#daftar-tempat").dataTable();
    });


    $("#btn-berikutnya").click(function () {
        $("#form-pilih-tempat").submit();
    });

    /*
    $("#form-pilih-tempat").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "action.php?action=pilih-tempat",
            data: $(this).serialize(),
            success: function (response) {
                /*
                if(response.error == true){
                    SEMICOLON.widget.notifications($("#notifikasi-hapus-gagal"));
                }else{
                    SEMICOLON.widget.notifications($("#notifikasi-hapus-sukses"));
                }
            },
            error: function (error) {
                SEMICOLON.widget.notifications($("#notifikasi-hapus-gagal"));
            }
        });
    });
    */
</script>

</body>
</html>