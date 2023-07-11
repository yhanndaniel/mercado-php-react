import React from 'react';
import CartButton from '../CartButton/CartButton';
import SearchBar from '../SearchBar/SearchBar';
import Navbar from '../Navbar/Navbar';

import './Header.css';

function Header() {
  return (
    <header className="header">
      <div className="container">
        <Navbar />
        <SearchBar />
        <CartButton />
      </div>
    </header>
  );
}

export default Header;
