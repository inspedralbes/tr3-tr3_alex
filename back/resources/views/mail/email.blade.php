<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Compra</title>
</head>
<body>
    <h2>¡Gracias por tu compra!</h2>
    <p>Aquí están los detalles de tu entrada:</p>
    <ul>
       
        
        @foreach ($data['Butaca'] as $butaca)
            <li><strong>Butaca:</strong> {{ $butaca['butaca'] }} 
        </li>
        @endforeach
    
    </ul>
    
    <p>¡Disfruta de la película!</p>
</body>
</html>