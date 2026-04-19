<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propiedad creada</title>
</head>
<body>
    <h2>Nueva propiedad creada</h2>

    <p><strong>Título:</strong> {{ $property->title }}</p>

    <p><strong>Precio:</strong> 
        ${{ number_format($property->price, 2, ',', '.') }}
    </p>

    <p><strong>Ubicación:</strong> {{ $property->address->street }} {{ $property->address->number }}, {{ $property->address->town->name }}, {{ $property->address->town->province->name }}</p>

    <p><strong>Superficie:</strong> {{ $property->surface }} m²</p>

    <p><strong>Ambientes:</strong> {{ $property->rooms ?? '-' }}</p>

    <p><strong>Tipo:</strong> {{ $property->typeProperty->description }}</p>

    <p><strong>Estado:</strong> {{ $property->statusProperty->description }}</p>

    <p><strong>Usuario que lo creó:</strong> {{ $property->user->name }}</p>
</body>
</html>
