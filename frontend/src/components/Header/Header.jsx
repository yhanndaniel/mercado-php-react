import React from 'react';
import CartButton from '../CartButton/CartButton';
import Navbar from '../Navbar/Navbar';

import './Header.css';

function Header() {
  return (
    <header className="header">
      <div className="container">
        <Navbar />
        <CartButton />
      </div>
    </header>
  );
}

export default Header;
