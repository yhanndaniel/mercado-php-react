import React, { useContext } from 'react';

import './Cart.css';
import CartItem from '../CartItem/CartItem';
import AppContext from '../../context/AppContext';
import formatCurrency from '../../utils/formatCurrency';
import { BsFillBagCheckFill, BsFillBagXFill } from 'react-icons/bs';

function Cart() {
  const { cartItems, isCartVisible, setCartItems } = useContext(AppContext);

  const subTotalPrice = cartItems.reduce((acc, item) => item.qtd*item.price + acc, 0);
  const taxTotalPrice = cartItems.reduce((acc, item) => item.qtd*item.taxCalculated + acc, 0);
  const totalPrice = subTotalPrice + taxTotalPrice;

  const handleCancelCart = () => {
    setCartItems([]);
  }

  const handleBuyCart = () => {
    console.log(cartItems);
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
