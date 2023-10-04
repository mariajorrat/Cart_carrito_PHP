<?php
include 'clases.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Carrito de compras</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <h1>Compras</h1>
    <hr>
    <div class="row">
    <div class="col-md-6">
    <h2>Frutas</h2>
    <?php
    echo "<table style='border: 1px solid black; border-collapse: collapse; width: 80%;'>";
    echo "<tr style='background-color: #f2f2f2;'><th style='border: 1px solid black; padding: 15px;'>Nombre</th><th style='border: 1px solid black; padding: 15px;'>Descripción</th><th style='border: 1px solid black; padding: 15px;'>Precio</th><th style='border: 1px solid black; padding: 15px;'>Cantidad</th></tr>";
    foreach ($productos as $producto) {
        echo "<tr>";
        echo "<td style='border: 1px solid black; padding: 15px;'>" . $producto->nombre . "</td>";
        echo "<td style='border: 1px solid black; padding: 15px;'>" . $producto->descripcion . "</td>";
        echo "<td style='border: 1px solid black; padding: 15px;'>" . $producto->precio . "</td>";
        echo "<td style='border: 1px solid black; padding: 15px;'>" . $producto->cantidad . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>    
    </div>
    <div class="col-md-6">


    <form action="index.php" method="post">
        <label for="producto">Producto:</label><br>
        <select id="producto" name="producto">
            <?php foreach ($productos as $producto): ?>
                <option value="<?php echo htmlspecialchars($producto->nombre); ?>">
                    <?php echo htmlspecialchars($producto->nombre . ' - ' . number_format($producto->precio, 2) . ' - Stock: ' . number_format($producto->cantidad, 0)); ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <label for="cantidad">Cantidad:</label><br>
        <input type="number" id="cantidad" name="cantidad" min="1">
        <br><br>
        <input type="submit" value="Agregar al carrito">
    </form>
<hr>
    <?php if (!empty($carrito->productos)): ?>
        <table>
            <h2>Carrito de compras</h2>
            <thead>
                <tr>
                    <th>Nombre del producto---</th>
                    <th>Cantidad---</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($carrito->productos as $item): ?>
                    <tr>
                        <td>
                            <?php echo htmlspecialchars($item['producto']->nombre); ?>
                        </td>
                        <td>
                            <?php echo htmlspecialchars($item['cantidad']); ?>
                        </td>
                        <td>
                            <!-- Formulario para restar unidades del producto -->
                            <form action="index.php" method="post">
                                <!-- Campo oculto para indicar qué producto se va a restar -->
                                <input type="hidden" name="restar"
                                    value="<?php echo htmlspecialchars($item['producto']->nombre); ?>">
                                <!-- Botón para enviar el formulario -->
                                <input type="submit" value="Restar unidad">
                            </form>
                            <!-- Formulario para eliminar el producto -->
                            <form action="index.php" method="post">
                                <!-- Campo oculto para indicar qué producto se va a eliminar -->
                                <input type="hidden" name="eliminar"
                                    value="<?php echo htmlspecialchars($item['producto']->nombre); ?>">
                                <!-- Botón para enviar el formulario -->
                                <input type="submit" value="Eliminar producto">
                                <hr>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <form action="index.php" method="post">
            <input type="submit" name="vaciar" value="Vaciar carrito">
        </form>
<br>
        <?php if (!empty($_SESSION['total'])): ?>
            <h3>Total:
                <?php echo $_SESSION['total']; ?>
            </h3>
        <?php endif; ?>
    <?php endif; ?>
    
    </div>
    </div>
</body>

</html>