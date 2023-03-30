<?php

// SDK de Mercado Pago
require '../../vendor/autoload.php';
// Agrega credenciales
MercadoPago\SDK::setAccessToken('TEST-2146525193346993-033003-535aa38b949446a9f6d34b6fa6820bf0-83722175');
// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

$preference->back_urls = array(
    "success" => "https://turnero-integra.com.ar/pagar.php",
    "failure" => "https://turnero-integra.com.ar/fallo.php"
);

$preference->auto_return = "approved";


# Crea ítems en la preferencia
$item0 = new MercadoPago\Item;
$item0->title = "Consulta";
$item0->quantity = 1;
$item0->unit_price = 7500;
$preference->items = array($item0);
# Guardar y postear la preferencia
$preference->save();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGOS</title>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>

<body>
    <div class="cho-container btn btn-lg btn-primary" style="background-color: #009ee3; border:2px solid #f2dc23;color: black"></div>
    <script>
        const mp = new MercadoPago('TEST-eca47de5-3ca3-445e-8ded-9c0bae41a2d8', {
            locale: 'es-AR'
        });

        mp.checkout({
            preference: {
                id: '<?php echo $preference->id; ?>'
            },
            render: {
                container: '.cho-container',
                label: 'Abonar consulta 50%',
            }
        });
    </script>
</body>

</html>