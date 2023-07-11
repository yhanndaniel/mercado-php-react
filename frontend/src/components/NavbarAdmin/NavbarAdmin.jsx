import React from 'react';
import { Link } from 'react-router-dom';

import './NavbarAdmin.css';
const NavbarAdmin = () => {
  return (
    <nav>
      <Link to="/admin">Tipo de Produtos</Link>
      <Link to="/admin/produtos">Produtos</Link>
      <Link to="/admin/vendas">Vendas</Link>
    </nav>
  );
};

export default NavbarAdmin;
