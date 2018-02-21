<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<?php
require_once "koneksi.php";
if(!isset($_SESSION)) {
    session_start();
}

if(isset($_GET['lihat'])){
    $link = mysqli_real_escape_string($con, $_GET['lihat']);
}else{
    header('Location: index.php');
}

$sql = mysqli_query($con, "SELECT a.*, b.provinsi FROM `tempat` AS a LEFT JOIN `provinsi` AS b ON a.provinsi_id=b.provinsi_id WHERE `id`='$link'");
$count_data = mysqli_num_rows($sql);
if($count_data > 0 ){
    if($tampil = mysqli_fetch_assoc($sql)){

        $id = $tampil['id'];
        $nama = $tampil['nama'];
        $provinsi = $tampil['provinsi'];
        $transportasi = $tampil['transportasi'];
        $tiket = $tampil['tiket'];
        $fasilitas = $tampil['fasilitas'];
        $kebersihan = $tampil['kebersihan'];
        $keindahan = $tampil['keindahan'];
        $deskripsi = $tampil['deskripsi'];
        $bintang = "<i class=\"icon icon-star\"></i>";
    }
}else{
    header('Location: index.php');
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

    <!-- Select-Boxes CSS -->
    <link rel="stylesheet" href="css/components/select-boxes.css" type="text/css" />

    <link rel="stylesheet" href="css/responsive.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Document Title
    ============================================= -->
    <title><?php echo $nama; ?> | Wisata Indonesia </title>

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
            <h1>Wisata - <?php echo $nama; ?></h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Tempat Wisata</a></li>
                <li class="active"><?php echo $nama; ?></li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
		============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="single-product">

                    <div class="product">

                        <div class="col_two_fifth">

                            <!-- Product Single - Gallery
                            ============================================= -->
                            <div class="product-image">
                                <div class="fslider" data-pagi="false" data-arrows="false" data-thumbs="true">
                                    <div class="flexslider">
                                        <div class="slider-wrap" data-lightbox="gallery">
                                            <?php
                                            $sql_foto = mysqli_query($con, "SELECT * FROM `foto` WHERE `id_tempat`='$link'");
                                            while($foto = mysqli_fetch_array($sql_foto)){
                                            ?>
                                            <div class="slide" data-thumb="images/<?php echo $foto['file']; ?>"><a href="images/<?php echo $foto['file']; ?>" data-lightbox="gallery-item"><img src="images/<?php echo $foto['file']; ?>"></a></div>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Product Single - Gallery End -->

                        </div>

                        <div class="col_two_fifth product-desc">

                            <!-- Product Single - Price
                            ============================================= -->
                            <div class="product-price">Tempat Wisata di Provinsi - <?php echo $provinsi; ?></div><!-- Product Single - Price End -->

                            <div class="clear"></div>
                            <div class="line"></div>

                            <!-- Product Single - Short Description
                            ============================================= -->
                            <p><?php echo $deskripsi; ?></p>

                            <!-- Product Single - Meta
                            ============================================= -->
                            <div class="panel panel-default product-meta">
                                <div class="panel-body">
                                    <span itemprop="productID" class="sku_wrapper">Transportasi: <span class="sku"><?php echo "Rp. ". number_format($transportasi,2,',','.'); ?></span></span>
                                    <span class="posted_in">Tiket: <?php echo "Rp. ". number_format($tiket,2,',','.'); ?></span>
                                    <span class="merk_wrapper">Fasilitas : <span class="merk"><?php for($x=0; $x<$fasilitas; $x++){echo $bintang;} ?></span></span>
                                    <span class="merk_wrapper">Kebersihan : <span class="merk"><?php for($x=0; $x<$kebersihan; $x++){echo $bintang;} ?></span></span>
                                    <span class="merk_wrapper">Keindahan : <span class="merk"><?php for($x=0; $x<$keindahan; $x++){echo $bintang;} ?></span></span>

                                </div>
                            </div><!-- Product Single - Meta End -->


                        </div>

                        <div class="col_one_fifth col_last">

                            <div class="divider divider-center"><i class="icon-circle-blank"></i></div>

                            <div class="feature-box fbox-plain fbox-dark fbox-small">
                                <div class="fbox-icon">
                                    <i class="icon-thumbs-up2"></i>
                                </div>
                                <h3>100% Terbaru</h3>
                                <p class="notopmargin">Kami menjamin tempat wisata yang kami rekomendasikan 100% terbaru.</p>
                            </div>

                            <div class="feature-box fbox-plain fbox-dark fbox-small">
                                <div class="fbox-icon">
                                    <i class="icon-credit-cards"></i>
                                </div>
                                <h3>Terbaik & Termurah</h3>
                                <p class="notopmargin">Kami merekomendasikan tempat wisata terbaik & termurah.</p>
                            </div>

                            <div class="feature-box fbox-plain fbox-dark fbox-small">
                                <div class="fbox-icon">
                                    <i class="icon-truck2"></i>
                                </div>
                                <h3>Data Dijamin</h3>
                                <p class="notopmargin">Kami menjamin data yang kami sajikan 100% Valid.</p>
                            </div>


                        </div>

                        <div class="col_full nobottommargin">

                            <div class="tabs clearfix nobottommargin" id="tab-1">

                                <ul class="tab-nav clearfix">
                                    <li><a href="#tabs-1"><i class="icon-align-justify2"></i><span class="hidden-xs"> Description</span></a></li>
                                </ul>

                                <div class="tab-container">

                                    <div class="tab-content clearfix" id="tabs-1">
                                        <p><?php echo $deskripsi; ?></p>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- Notifikasi Area -->
                    <div id="notifikasi-gagal" data-notify-position="top-right" data-notify-type="error" data-notify-msg="<i class=icon-remove-sign></i> Gagal menambahkan!"></div>
                    <div id="notifikasi-sukses" data-notify-position="top-right" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Berhasil ditambahkan!"></div>


                </div>

                <div class="clear"></div><div class="line"></div>


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

<!-- Footer Scripts
============================================= -->
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" language="JavaScript">
    $("#btn-add-cart").click(function (e) {
        e.preventDefault();
        <?php
        if (empty($_SESSION['username'])){
            ?>
        location.replace('login.php');
        <?php
        }
        ?>
        $("#add-cart-modal").modal("show");
    });

    $("#form-add-cart").submit(function (event) {
        event.preventDefault();
        $.ajax({
            type : "POST",
            dataType : "JSON",
            url : "action.php?action=add-cart",
            data: $(this).serialize(),
            success: function (response) {
                $("#add-cart-modal").modal("hide");
                if(response.error == true){
                    SEMICOLON.widget.notifications($("#notifikasi-gagal"));
                }else{
                    SEMICOLON.widget.notifications($("#notifikasi-sukses"));
                    setTimeout(location.reload.bind(location), 3000);
                }
            },
            error: function (error) {

                $("#add-cart-modal").modal("hide");
                SEMICOLON.widget.notifications($("#notifikasi-gagal"));
            }
        });
    });
</script>

</body>
</html>