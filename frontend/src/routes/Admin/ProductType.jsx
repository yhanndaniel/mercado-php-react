import React, { useEffect, useState } from 'react';
import NavbarAdmin from '../../components/NavbarAdmin/NavbarAdmin';

import './Admin.css';
import ProductTypeTable from '../../components/Admin/Tables/ProductTypeTable';
import axios from 'axios';
import { toast } from 'react-toastify';
import ProductTypeForm from '../../components/Admin/Forms/ProductTypeForm';

const ProductType = () => {
  const [productTypes, setProductTypes] = useState([]);
  const [onEdit, setOnEdit] = useState(null);

  const getProductTypes = async () => {
    try {
      const res = await axios.get("http://localhost:8000/api/product-type");
      setProductTypes(res.data.sort((a, b) => (a.nome > b.nome ? 1 : -1)));
    } catch (error) {
      toast.error(error);
    }
  };

  useEffect(() => {
    getProductTypes();
  }, [setProductTypes]);

  return (
    <section className="container dashboard">
      <NavbarAdmin />
      <h2>Tipos de produtos</h2>
      <ProductTypeForm onEdit={onEdit} setOnEdit={setOnEdit} getProductTypes={getProductTypes} />
      <ProductTypeTable setOnEdit={setOnEdit} productTypes={productTypes} setProductTypes={setProductTypes} />
    </section>
  );
};

export default ProductType;
