import React, { useContext } from 'react';
import propTypes from 'prop-types';
import { BsFillCartPlusFill } from 'react-icons/bs';

import './ProductCard.css';
import formatCurrency from '../../utils/formatCurrency';
import AppContext from '../../context/AppContext';

function ProductCard({ data }) {
  const { name, image, price, taxCalculated } = data;

  const { cartItems, setCartItems } = useContext(AppContext);

  const handleAddCart = () => {
    let hasItem = cartItems.some((item) => item.id === data.id);
    if (hasItem) {
      const updatedItems = cartItems.map((item) => item.id === data.id ? { ...item, qtd: item.qtd + 1 } : item);
      setCartItems(updatedItems);
    } else {
      data.qtd = 1;
      setCartItems([ ...cartItems, data ])
    }
  };

  return (
    <section className="product-card">
      
      <img
        src={image.replace(/\w\.jpg/gi, 'W.jpg')}
        alt="product"
        className="card__image"
      />

      <div className="card__infos">
        <h2 className="card__price">{formatCurrency(price, 'BRL')}</h2>
        <h2 className="card__title">{name}</h2>
        <h6 className="card__tax">(Imposto) {formatCurrency(taxCalculated, 'BRL')}</h6>
      </div>

      <button
        type="button"
        className="button__add-cart"
        onClick={ handleAddCart }
      >
        <BsFillCartPlusFill />
      </button>
    </section>
  );
}

export default ProductCard;

ProductCard.propTypes = {
  data: propTypes.shape({}),
}.isRequired;
