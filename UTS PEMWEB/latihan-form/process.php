<?php

date_default_timezone_set("Asia/Jakarta");


/* Mengecek apakah data berasal dari form */

if ($_SERVER["REQUEST_METHOD"] != "POST") {

    header("Location: index.html");
    exit;

}


/* Mengambil nama pelanggan */

$customer_name = trim($_POST["customer_name"]);


/* Mengambil menu */

$product = $_POST["product"];


/* Mengambil jumlah */

$quantity = (int) $_POST["quantity"];



/* Validasi data */

if (
    empty($customer_name) ||
    empty($product) ||
    $quantity <= 0
) {

    echo "Data pesanan belum lengkap.";
    exit;

}



/* Memisahkan nama produk dan harga */

$product_data = explode("|", $product);


$product_name = $product_data[0];

$price = (int) $product_data[1];



/* Menghitung subtotal */

$subtotal = $price * $quantity;



/* Menghitung diskon */

if ($subtotal >= 100000) {

    $diskon = $subtotal * 10 / 100;

} else {

    $diskon = 0;

}



/* Menghitung total pembayaran */

$total = $subtotal - $diskon;



/* Format angka menjadi Rupiah */

$harga_rupiah = number_format(
    $price,
    0,
    ',',
    '.'
);

$subtotal_rupiah = number_format(
    $subtotal,
    0,
    ',',
    '.'
);

$diskon_rupiah = number_format(
    $diskon,
    0,
    ',',
    '.'
);

$total_rupiah = number_format(
    $total,
    0,
    ',',
    '.'
);

?>



<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Detail Pesanan - Bron Cafe Eatry
    </title>


    <style>

        * {
            box-sizing: border-box;
        }


        body {

            margin: 0;

            font-family: Arial, sans-serif;

            background-color: #f5eee7;

            color: #3b2118;

        }


        .container {

            width: 90%;

            max-width: 600px;

            margin: 70px auto;

        }


        .receipt {

            background-color: white;

            padding: 35px;

            border-radius: 12px;

            box-shadow:
                0 5px 15px rgba(0,0,0,0.15);

        }


        h1 {

            text-align: center;

            color: #5b1f24;

            margin-bottom: 5px;

        }


        .subtitle {

            text-align: center;

            color: #777;

            margin-bottom: 30px;

        }


        .success {

            text-align: center;

            background-color: #f5eee7;

            padding: 15px;

            border-radius: 7px;

            margin-bottom: 20px;

            color: #5b1f24;

            font-weight: bold;

        }


        .row {

            display: flex;

            justify-content: space-between;

            gap: 20px;

            padding: 13px 0;

            border-bottom: 1px solid #eeeeee;

        }


        .discount {

            color: #a52a2a;

            font-weight: bold;

        }


        .total {

            font-size: 22px;

            font-weight: bold;

            color: #5b1f24;

            margin-top: 10px;

        }


        .promo {

            margin-top: 20px;

            padding: 15px;

            background-color: #f5eee7;

            border-radius: 7px;

            text-align: center;

            line-height: 1.5;

        }


        .back {

            display: block;

            text-align: center;

            margin-top: 25px;

            padding: 13px;

            background-color: #5b1f24;

            color: white;

            text-decoration: none;

            border-radius: 5px;

        }


        .back:hover {

            background-color: #7a2b31;

        }

    </style>

</head>



<body>


<div class="container">


    <div class="receipt">


        <h1>
            Bron Cafe Eatry
        </h1>


        <p class="subtitle">
            Detail Pesanan
        </p>



        <div class="success">

            Pesanan berhasil diproses!

        </div>



        <!-- NAMA -->

        <div class="row">

            <span>
                Nama
            </span>

            <strong>

                <?php
                echo htmlspecialchars($customer_name);
                ?>

            </strong>

        </div>



        <!-- MENU -->

        <div class="row">

            <span>
                Menu
            </span>

            <strong>

                <?php
                echo htmlspecialchars($product_name);
                ?>

            </strong>

        </div>



        <!-- HARGA -->

        <div class="row">

            <span>
                Harga
            </span>

            <span>

                Rp<?php
                echo $harga_rupiah;
                ?>

            </span>

        </div>



        <!-- JUMLAH -->

        <div class="row">

            <span>
                Jumlah
            </span>

            <span>

                <?php
                echo $quantity;
                ?>

            </span>

        </div>



        <!-- SUBTOTAL -->

        <div class="row">

            <span>
                Subtotal
            </span>

            <span>

                Rp<?php
                echo $subtotal_rupiah;
                ?>

            </span>

        </div>



        <!-- DISKON -->

        <div class="row discount">

            <span>
                Diskon 10%
            </span>

            <span>

                - Rp<?php
                echo $diskon_rupiah;
                ?>

            </span>

        </div>



        <!-- TOTAL -->

        <div class="row total">

            <span>
                Total Bayar
            </span>

            <span>

                Rp<?php
                echo $total_rupiah;
                ?>

            </span>

        </div>



        <!-- TANGGAL -->

        <div class="row">

            <span>
                Tanggal
            </span>

            <span>

                <?php
                echo date("d-m-Y H:i:s");
                ?>

            </span>

        </div>



        <!-- INFO PROMO -->

        <?php if ($diskon > 0) { ?>

            <div class="promo">

                🎉 <strong>Selamat!</strong>

                <br>

                Kamu mendapatkan diskon
                <strong>10%</strong>
                karena total belanja mencapai
                Rp100.000.

            </div>

        <?php } else { ?>

            <div class="promo">

                Belanja minimal
                <strong>Rp100.000</strong>
                untuk mendapatkan diskon
                <strong>10%</strong>.

            </div>

        <?php } ?>



        <!-- KEMBALI -->

        <a
            href="index.html"
            class="back"
        >

            Kembali ke Menu

        </a>


    </div>

</div>


</body>

</html>