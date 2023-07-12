import React, { useContext } from 'react';

import './Cart.css';
import CartItem from '../CartItem/CartItem';
import AppContext from '../../context/AppContext';
import formatCurrency from '../../utils/formatCurrency';
import { BsFillBagCheckFill, BsFillBagXFill } from 'react-icons/bs';
import axios from 'axios';
import { toast } from 'react-toastify';

function Cart() {
  const { cartItems, isCartVisible, setCartItems } = useContext(AppContext);

  const subTotalPrice = cartItems.reduce((acc, item) => item.qtd*item.price + acc, 0);
  const taxTotalPrice = cartItems.reduce((acc, item) => item.qtd*item.taxCalculated + acc, 0);
  const totalPrice = subTotalPrice + taxTotalPrice;

  const handleCancelCart = () => {
    setCartItems([]);
  }

  const handleBuyCart = async () => {
    await axios
        .post("http://localhost:8000/api/sale/", {
          total_amount: subTotalPrice,
          total_tax: taxTotalPrice,
          total: totalPrice,
          saled: 1,
        })
        .then(({ data }) => {
          cartItems.forEach(async element => {
              console.log(element);
              await axios.post("http://localhost:8000/api/cart-product/", {
                products_id: element.id,
                cart_id: data.id,
                quantity: element.qtd,
                total_amount: element.qtd*element.price,
                total_tax: element.qtd*element.taxCalculated,
                total: element.qtd*element.price + element.qtd*element.taxCalculated,
              }).then(({ data }) => {
                toast.success("Compra realizada!!!");
                setCartItems([]);
              }).catch(({ data }) => {
                toast.error(data)
                setCartItems([]);
              });
          });
        })
        .catch(({ data }) => toast.error(data));
  }

  return (
    <section className={`cart ${isCartVisible ? 'cart--active' : ''}`}>
      <div className="cart-items">
        { cartItems.map((cartItem) => <CartItem key={cartItem.id} data={cartItem} />) }
      </div>

      <div className="cart-resume">SubTotal {formatCurrency(subTotalPrice, 'BRL')}</div>
      <div className="cart-resume">Imposto {formatCurrency(taxTotalPrice, 'BRL')}</div>
      <div className="cart-resume">Total {formatCurrency(totalPrice, 'BRL')}</div>
      <div className="cart-resume">
      <button
            type="button"
            className="button__buy-cart"
            onClick={ () => handleBuyCart() }
          >
            <BsFillBagCheckFill />
            Comprar
          </button>
        <button
            type="button"
            className="button__cancel-cart"
            onClick={ () => handleCancelCart() }
          >
            <BsFillBagXFill />
            Cancelar
          </button>
      </div>
      
    </section>
  );
}

export default Cart;
