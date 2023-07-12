import React, { useEffect, useState } from 'react';
import NavbarAdmin from '../../components/NavbarAdmin/NavbarAdmin';

import './Admin.css';
import axios from 'axios';
import { toast } from 'react-toastify';
import ProductTable from '../../components/Admin/Tables/ProductTable';
import ProductForm from '../../components/Admin/Forms/ProductForm';

const Product = () => {
  const [products, setProducts] = useState([]);
  const [onEdit, setOnEdit] = useState(null);

  const getProducts = async () => {
    try {
      const res = await axios.get("http://localhost:8000/api/product");
      setProducts(res.data.sort((a, b) => (a.nome > b.nome ? 1 : -1)));
    } catch (error) {
      toast.error(error);
    }
  };

  useEffect(() => {
    getProducts();
  }, [setProducts]);

  return (
    <section className="container dashboard">
      <NavbarAdmin />
      <h2>Produtos</h2>
      <ProductForm onEdit={onEdit} setOnEdit={setOnEdit} getProducts={getProducts} />
      <ProductTable setOnEdit={setOnEdit} products={products} setProducts={setProducts} />
    </section>
  );
};

export default Product;
