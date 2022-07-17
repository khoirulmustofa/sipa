<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key: 21f84155b3b634dd01992c59564facfc"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $provinsi = json_decode($response, true);
}
?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Pilih Provinsi</label>
                        <select class="form-control" id="provinsi" name="provinsi">
                            <option value="">-Pilih Provinsi-</option>
                            <?php
                            if ($provinsi['rajaongkir']['status']['code'] == '200') {
                                foreach ($provinsi['rajaongkir']['results'] as $pv) {
                                    echo "<option value = '$pv[province_id]'> $pv[province] </option>";
                                }
                            }

                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Pilih Kota</label>
                        <select class="form-control" id="kota" name="kota">
                            <option>-Pilih Provinsi Dulu-</option>

                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    document.getElementById('provinsi').addEventListener('change', function() {
        fetch("<?= base_url('tu/kerjasama/kota/') ?>" + this.value, {
                method: 'GET',
            }).then((response) => response.text())
            .then((data) => {
                console.log(data)
                document.getElementById('kota').innerHTML = data
            })
    })
</script>