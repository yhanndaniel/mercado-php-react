import React, { useContext } from 'react';
import propTypes from 'prop-types';
import { BsCartDashFill } from 'react-icons/bs';

import './CartItem.css';
import formatCurrency from '../../utils/formatCurrency';
import AppContext from '../../context/AppContext';

function CartItem({ data }) {

  const { cartItems, setCartItems } = useContext(AppContext);
  const { id, image, name, price, taxCalculated, qtd } = data;

  const handleRemoveItem = () => {
    if (qtd === 1) {
      const updatedItems = cartItems.filter((item) => item.id != id);
      setCartItems(updatedItems);
    } else {
      const updatedItems = cartItems.map((item) => item.id === id ? { ...item, qtd: item.qtd - 1 } : item);
      setCartItems(updatedItems);
    }
  };

  return (
    <section className="cart-item">
      <img
        src={image}
        alt="imagem do produto"
        className="cart-item-image"
      />

      <div className="cart-item-content">
        <h4 className="cart-item-name">{name}</h4>
        <h4 className="cart-item-price">{qtd}</h4>
        <h4 className="cart-item-price">{formatCurrency(qtd * price, 'BRL')}</h4>
        <h4 className="cart-item-price">(Imposto) {formatCurrency(qtd * taxCalculated, 'BRL')}</h4>
        <button
          type="button"
          className="button__remove-item"
          onClick={ handleRemoveItem }
        >
          <BsCartDashFill />
        </button>
      </div>
    </section>
  );
}

export default CartItem;

CartItem.propTypes = {
  data: propTypes.object
}.isRequired;
