<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<?php
require_once "koneksi.php";
if(!isset($_SESSION)) {
    session_start();
}

if(!empty($_POST['checkbox'])){
    foreach ($_POST['checkbox'] as $val){
        $pilih[]= mysqli_real_escape_string($con, $val);
    }
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
    <title>Weighted Product | Wisata Indonesia</title>

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
            <h1>Weighted Product</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Weighted Product</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="col_full">
                    <div class="tabs side-tabs responsive-tabs clearfix" id="tab-main">
                        <ul class="tab-nav clearfix">
                            <li><a href="#tabs-1">Prioritas Bobot</a></li>
                            <li><a href="#tabs-2">Tabel Bobot Kriteria</a></li>
                            <li><a href="#tabs-3">Menghitung Vektor S</a></li>
                            <li><a href="#tabs-4">Menghitung Vektor V</a></li>
                            <li><a href="#tabs-5">Hasil Akhir</a></li>

                        </ul>

                        <div class="tab-container">
                            <!-- Tabs 1 -->
                            <div class="tab-content clearfix" id="tabs-1">
                                <div class="col_full">
                                    <h4>Prioritas Bobot</h4>
                                </div>
                                <div class="col_full">
                                    <?php
                                    $no = 0;
                                    $sql_bobot = mysqli_query($con, "SELECT * FROM `bobot`");
                                    $row_bobot = mysqli_num_rows($sql_bobot);
                                    while($rs_bobot = mysqli_fetch_array($sql_bobot)){
                                        $nilai[] = $rs_bobot['bobot'];
                                    }
                                    $total_bobot = array_sum($nilai);
                                    $sql_b = mysqli_query($con, "SELECT * from `bobot`");
                                    while($rs_b = mysqli_fetch_array($sql_b)){
                                        $no++;
                                        $hitung_bobot_tmp = ($rs_b['bobot'])/$total_bobot;
                                        $hitung_bobot = ($rs_b['bobot']*$rs_b['biaya'])/$total_bobot;
                                        $prioritas_bobot[]= $hitung_bobot;
                                    ?>
                                        &emsp;&emsp;&emsp;&emsp;<?php echo $rs_b['bobot']; ?><br>
                                    W<?php echo $no; ?> = &#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472; = <?php echo $hitung_bobot_tmp; ?><br>
                                        &emsp;&emsp;&emsp; <?php echo implode(" + ",$nilai); ?><br><br>
                                    <?php } ?>
                                </div>
                            </div>

                            <!-- Tab 2 -->
                            <div class="tab-content clearfix" id="tabs-2">
                                <div class="col_full">
                                    <h4>Tabel Bobot Kriteria</h4>
                                </div>
                                <div class="col_full">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th rowspan="2">Alternatif</th>
                                            <th colspan="5" style="text-align: center;">Kriteria</th>
                                        </tr>
                                        <tr>
                                            <th>C1</th>
                                            <th>C2</th>
                                            <th>C3</th>
                                            <th>C4</th>
                                            <th>C5</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($pilih as $val) {
                                            $sql_tabel = mysqli_query($con, "SELECT * FROM `tempat` WHERE `id`='$val'");
                                            while($rs_table = mysqli_fetch_array($sql_tabel)){
                                                $nilai_tmp = array($rs_table['transportasi'], $rs_table['tiket'], $rs_table['fasilitas'],$rs_table['kebersihan'],$rs_table['keindahan']);
                                            ?>
                                                <tr>
                                                    <td><?php echo $rs_table['nama']; ?></td>
                                                    <td><?php echo "Rp. ". number_format($rs_table['transportasi'],2,',','.'); ?></td>
                                                    <td><?php echo "Rp. ". number_format($rs_table['tiket'],2,',','.'); ?></td>
                                                    <td><?php echo $rs_table['fasilitas']; ?></td>
                                                    <td><?php echo $rs_table['kebersihan']; ?></td>
                                                    <td><?php echo $rs_table['keindahan']; ?></td>
                                                </tr>
                                        <?php
                                            }
                                            $nilai_dipilih[] = $nilai_tmp;
                                            unset($nilai_tmp);
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col_full">
                                    <strong>Keterangan:</strong>
                                </div>
                                <div class="col_full">
                                    C1 = Biaya Transportasi <br>
                                    C2 = Harga Tiket <br>
                                    C3 = Fasilitas Tersedia <br>
                                    C4 = Kebersihan Tempat Wisata <br>
                                    C5 = Keindahan Tempat Wisata <br>

                                </div>
                            </div>

                            <!-- Tab 3 -->
                            <div class="tab-content clearfix" id="tabs-3">
                                <div class="col_full">
                                    <h4>Menghitung Vektor S</h4>
                                </div>
                                <div class="col_full">
                                    <?php
                                    $no = 0;
                                    foreach ($nilai_dipilih as $key1=>$value1){
                                        foreach ($value1 as $key2=>$val){
                                            $txt_tmp = $val . "<sup>". $prioritas_bobot[$key2]."</sup>";
                                            $txt_tmp2[] = $txt_tmp;

                                            $hitung_vector_s_tmp = pow($val,$prioritas_bobot[$key2]);
                                            $hitung_vector_s_tmp2[]= $hitung_vector_s_tmp;
                                        }
                                        $txt_tmp3[] = $txt_tmp2;
                                        $hitung_vector_s_tmp3[] = $hitung_vector_s_tmp2;
                                        unset($txt_tmp2);
                                        unset($hitung_vector_s_tmp2);
                                    }

                                    // Array produk = kali nilai yang ada pada array vector s, HASIL = $hasil_vector_s
                                    foreach($hitung_vector_s_tmp3 as $val){
                                        $hasil_vector_s[] = array_product($val);
                                    }

                                    foreach ($txt_tmp3 as $key=>$val){
                                        $no++;
                                        echo "S".$no. " = ". implode(" x ",$val) . " = " . $hasil_vector_s[$key] . "<br><br>";
                                    }
                                    ?>
                                </div>
                            </div>

                            <!-- Tab 4 -->
                            <div class="tab-content clearfix" id="tabs-4">
                                <div class="col_full">
                                    <h4>Menghitung Vektor V</h4>
                                </div>
                                <div class="col_full">
                                    <?php
                                    $no = 0;
                                    foreach ($hasil_vector_s as $val){
                                        $hitung_vector_v = $val / array_sum($hasil_vector_s);
                                        $vector_v[] = $hitung_vector_v;
                                        $no ++;
                                        echo "&emsp;&emsp;&emsp;".$val . "<br>";
                                        ?>
                                        V<?php echo $no ?> = &#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472;&#9472; = <?php echo $hitung_vector_v; ?><br>
                                    <?php
                                        echo "&emsp;&emsp;&emsp;".array_sum($hasil_vector_s) . "<br><br><br>";
                                    }

                                    $no=-1;
                                    foreach($pilih as $val_pilih){
                                        $no++;
                                        $akhir[$val_pilih]= $vector_v[$no];
                                    }
                                    ?>
                                </div>
                            </div>

                            <!-- Tabs 5 -->
                            <div class="tab-content clearfix" id="tabs-5">
                                <div id="print-akhir">
                                    <div class="col_full">
                                        <h4>Hasil Rekomendasi Tempat Wisata</h4>
                                    </div>
                                    <div class="col_full">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th width="20%">Rekomendasi</th>
                                                <th>Nama Tempat</th>
                                                <th>Biaya Transportasi</th>
                                                <th>Harga Tiket</th>
                                                <th>Nilai Weighted Product</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $no=0;
                                            $akhir_sort = arsort($akhir);
                                            arsort($akhir);
                                            foreach ($akhir as $key=>$val_akhir){
                                                $no++;
                                                $sql_akhir = mysqli_query($con, "SELECT * FROM `tempat` WHERE `id`='$key'");
                                                $rs_akhir = mysqli_fetch_assoc($sql_akhir);
                                                ?>
                                                <tr>
                                                    <td><?php echo $no; ?></td>
                                                    <td><?php echo $rs_akhir['nama']; ?></td>
                                                    <td><?php echo "Rp. ". number_format($rs_akhir['transportasi'],2,',','.'); ?></td>
                                                    <td><?php echo "Rp. ". number_format($rs_akhir['tiket'],2,',','.'); ?></td>
                                                    <td><?php echo $val_akhir; ?></td>
                                                </tr>
                                            <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <button class="button button-3d button-black nomargin" onclick="PrintElem('print-akhir')">Cetak Rekomendasi</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clear"></div>

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
<script>
    function PrintElem(elem)
    {
        var mywindow = window.open('', 'PRINT', 'height=600,width=800');

        mywindow.document.write('<html><head>');
        mywindow.document.write('<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="style.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="css/responsive.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="css/dark.css" type="text/css" />');


        mywindow.document.write('<title>' + document.title  + '</title>');
        mywindow.document.write('</head><body>');
        mywindow.document.write('<section id="content">');
        mywindow.document.write('<div class="content-wrap">');
        mywindow.document.write('<div class="container clearfix">');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</div>');
        mywindow.document.write('</div>');
        mywindow.document.write('</section>');

        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>

</body>
</html>