<?php
class Producto
{
    public $nombre;
    public $descripcion;
    public $precio;
    public $cantidad;

    function __construct($nombre, $descripcion, $precio, $cantidad)
    {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }
}

class Carrito
{
    public $productos = array();

    function agregarProducto($producto, $cantidad)
    {
        if ($producto->cantidad >= $cantidad) {
            if (array_key_exists($producto->nombre, $this->productos)) {
                $this->productos[$producto->nombre]['cantidad'] += $cantidad;
            } else {
                $this->productos[$producto->nombre] = array('producto' => $producto, 'cantidad' => $cantidad);
            }
            // Reducir el stock del producto
            $producto->cantidad -= $cantidad;
        } else {
            echo "No hay suficiente stock del producto.";
        }
    }

    function restarProducto($producto)
    {
        if (array_key_exists($producto->nombre, $this->productos)) {
            if ($this->productos[$producto->nombre]['cantidad'] > 1) {
                // Si hay más de uno, disminuir la cantidad
                --$this->productos[$producto->nombre]['cantidad'];
                // Aumentar el stock del producto
                ++$producto->cantidad;
            } else {
                // Si solo queda uno, eliminar el producto del carrito
                unset($this->productos[$producto->nombre]);
                // Aumentar el stock del producto
                ++$producto->cantidad;
            }
        }
    }

    function eliminarProducto($producto)
    {
        if (array_key_exists($producto->nombre, $this->productos)) {
            // Aumentar el stock del producto
            $producto->cantidad += $this->productos[$producto->nombre]['cantidad'];
            unset($this->productos[$producto->nombre]);
        }
    }

    function vaciarCarrito()
    {
        // Aumentar el stock de todos los productos en el carrito
        foreach ($this->productos as &$item) {
            $item['producto']->cantidad += $item['cantidad'];
        }
        // Vaciar el carrito
        $this->productos = array();
    }

    function calcularTotal()
    {
        $total = 0;
        foreach ($this->productos as &$producto) {
            $total += $producto['producto']->precio * $producto['cantidad'];
        }
        return number_format($total, 2);
    }
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Crear nueva instancia de Carrito
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = new Carrito();
}
$carrito = $_SESSION['carrito'];

// Lista de productos
if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = array(
        new Producto("Manzana", "Manzanas rojas", 50, 100),
        new Producto("Pera", "Peras verdes", 60, 50),
        new Producto("Banana", "Bananas/Platanos", 100, 200),
        new Producto("Naranja", "Naranjes dulces", 40, 150),
        new Producto("Sandía", "Sandias enteras", 1000, 10),
        new Producto("Melón", "Melon de agua", 500, 20),
        new Producto("Kiwi", "Kiwi freso", 90, 100),
        new Producto("Durazno", "Duraznos blancos", 80, 100),
    );
}
$productos = $_SESSION['productos'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Agregar productos al carrito
    if (!empty($_POST['producto']) && !empty($_POST['cantidad'])) {
        // Inicializar producto_obj como null
        $producto_obj = null;

        foreach ($productos as &$prod) {
            if ($prod->nombre === $_POST['producto']) {
                $producto_obj = &$prod;
                break;
            }
        }

        if ($producto_obj !== null) {
            $carrito->agregarProducto($producto_obj, $_POST['cantidad']);
        } else {
            echo "El producto no se encontró en el inventario.";
        }
    }

    // Restar unidades de un producto
    if (!empty($_POST['restar'])) {
        $producto_obj = null;

        foreach ($productos as &$prod) {
            if ($prod->nombre === $_POST['restar'] && array_key_exists($prod->nombre, $carrito->productos)) {
                $producto_obj = &$prod;
                break;
            }
        }

        if ($producto_obj !== null) {
            $carrito->restarProducto($producto_obj);
        } else {
            echo "El producto no se encontró en el carrito.";
        }
    }

    // Eliminar productos del carrito
    if (!empty($_POST['eliminar'])) {
        $producto_obj = null;

        foreach ($productos as &$prod) {
            if ($prod->nombre === $_POST['eliminar'] && array_key_exists($prod->nombre, $carrito->productos)) {
                $producto_obj = &$prod;
                break;
            }
        }

        if ($producto_obj !== null) {
            $carrito->eliminarProducto($producto_obj);
        } else {
            echo "El producto no se encontró en el carrito.";
        }
    }

    // Vaciar el carrito 
    if (isset($_POST['vaciar'])) {
        // Vaciar el carrito
        $carrito->vaciarCarrito();
    }

    // Calcular total y almacenarlo en la sesión
    $_SESSION['total'] = $carrito->calcularTotal();
}
?>