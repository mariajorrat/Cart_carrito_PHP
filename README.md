# PHP Shopping Cart System

This project is a shopping cart system that uses classes and objects in PHP. The system allows the following operations:

## Classes

### Product Class
The `Product` class has the following properties:
- Product name.
- Product description.
- Product price.
- Quantity available in inventory.

### Cart Class
The `Cart` class allows customers to add and remove products from the shopping cart. The `Cart` class has the following methods:
- `addProduct($product, $quantity)`: This method receives an object of the `Product` class and the desired quantity by the customer. If the product is already in the cart, it should increase the quantity instead of adding a new item.
- `removeProduct($product)`: This method receives an object of the `Product` class and removes it from the cart.
- `calculateTotal()`: This method calculates the total price of all products in the cart, considering the quantity of each one.

## Usage
1. Create instances of the `Product` class to represent various products and add them to inventory.
2. Create an instance of the `Cart` class and allow a customer to add products to the cart, remove them, and calculate the total price.
3. Display the contents of the cart and the total price at checkout.

___

# Sistema de Carrito de Compras en PHP

Este proyecto es un sistema de carrito de compras que utiliza clases y objetos en PHP. El sistema permite las siguientes operaciones:

## Clases

### Clase Producto
La clase `Producto` tiene las siguientes propiedades:
- Nombre del producto.
- Descripción del producto.
- Precio del producto.
- Cantidad disponible en el inventario.

### Clase Carrito
La clase `Carrito` permite a los clientes agregar y quitar productos del carrito de compras. La clase `Carrito` tiene los siguientes métodos:
- `agregarProducto($producto, $cantidad)`: Este método recibe un objeto de la clase `Producto` y la cantidad deseada por el cliente. Si el producto ya está en el carrito, debe aumentar la cantidad en lugar de agregar un nuevo elemento.
- `quitarProducto($producto)`: Este método recibe un objeto de la clase `Producto` y lo elimina del carrito.
- `calcularTotal()`: Este método calcula el precio total de todos los productos en el carrito, considerando la cantidad de cada uno.

## Uso
1. Crea instancias de la clase `Producto` para representar varios productos y agrégalos al inventario.
2. Crea una instancia de la clase `Carrito` y permite que un cliente agregue productos al carrito, los quite y calcule el precio total.
3. Muestra el contenido del carrito y el precio total al finalizar la compra.
