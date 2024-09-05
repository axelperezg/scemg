<!DOCTYPE html>
<html lang="es">
<?php
$path = 'C:\xampp\htdocs\example-app\storage\app\public\images\secretaria-del-gobierno-de-mexico-logo.png';
$type = pathinfo($path, PATHINFO_EXTENSION);
$data = file_get_contents($path);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

$path2 = 'C:\xampp\htdocs\example-app\storage\app\public\images\marcoSegob.jpg';
$type2 = pathinfo($path2, PATHINFO_EXTENSION);
$data2 = file_get_contents($path2);
$base64_2 = 'data:image/' . $type2 . ';base64,' . base64_encode($data2);
?>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PDF-Normatividad</title>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.1/dist/tailwind.min.css" rel="stylesheet">
<style>
body {
            font-family: Arial, sans-serif;
            background-image: url('<?php echo $base64_2?>'); /* Ruta actualizada a tu imagen de fondo */
            background-size: contain; /* Ajusta la imagen de fondo para que se vea completa */
            background-position: center;
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            margin: .2cm; /* Márgenes de .2 cm en todos los lados */
        }
        .content {
            max-width: 500px;
            margin: 0 auto;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.9); /* Fondo semi-transparente claro */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header-logo {
            text-align: center;
            width: 50%;
            margin: 0 auto; /* Centra la imagen */
        }
        
        .title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            background-color: rgba(255, 255, 255, 0.9); /* Fondo semi-transparente claro */
        }
        .title2 {
            text-align: left;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .text-left-section {
            text-align: right;
            margin-left: 20px;
        }
        .signature {
            margin-top: 50px;
            text-align: left;
        }
         footer {
            font-size: 0.8rem;
            color: #DAA520; /* Naranja cercano al dorado */
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #f5f5f5; /* Gris claro */
            margin-top: 10px;
        }
        .data-table th, .data-table td {
            border: 1px solid #000; /* Borde negro */
            padding: 8px;
            text-align: left;
        }
        .data-table th {
            background-color: #d3d3d3; /* Fondo gris más oscuro para los encabezados */
        }
         .maroon-text {
            color: #800000; /* Color guinda */
        }
        
    </style>
</head>
<body>

<br><br><br><br><br><br>
    <div class="content">

     <div class="header-logo">
        <img src="<?php echo $base64?>" alt="Logo">
     </div>
     <br>
        
       <div class="title">
        Unidad de Normatividad de Medios de Comunicación<br>
            <?php echo $register->area == '1' ? 'Dirección General de Normatividad de Comunicación' : 
            'Dirección General de Radio, Televisión y Cinematografía'; ?>
        </div>
        
        <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-lg" align="center">
        <h1 class="text-2xl font-bold mb-4 maroon-text"> <?php echo $register->code; ?></h1>
        </div>
        
        <ul class="list-disc pl-6">
            <strong><?php echo $register->sector->name; ?></strong><br>
            <strong><?php echo $register->institution->name; ?></strong><br>
            <strong>Campaña:</strong> <?php echo $register->campaign; ?><br>
            <strong>Versión:</strong> <?php echo $register->version; ?>
        </ul>
            
       
       <br><br><br>
        
       <footer class="text-gray-600">

            <p class="mb-4">
            <?php echo $register->area == '1' ? 'Roma No. 41 – 4º. Piso, Colonia Juárez, C.P. 06600, Alcaldía Cuauhtémoc, CDMX.
            Tel. 55 5209-8800 y 55-5728-7300 ext. 15782 www.normatividaddecomunicacion.gob.mx' 
            :           
            'Roma No. 41 – 3er Piso, Colonia Juárez, C.P. 06600, Alcaldía Cuauhtémoc, CDMX.
            Tel. 55 5128-0000 ext. 15722 https://dgrtc.segob.gob.mx/'
            ; ?>
            </p>
        </footer>

    </div>
</body>
</html>
