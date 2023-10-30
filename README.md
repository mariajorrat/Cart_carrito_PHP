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
