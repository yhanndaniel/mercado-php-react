import React, { useEffect, useState } from 'react';
import NavbarAdmin from '../../components/NavbarAdmin/NavbarAdmin';

import './Admin.css';
import axios from 'axios';
import { toast } from 'react-toastify';
import SalesTable from '../../components/Admin/Tables/SalesTable';

const Sales = () => {
  const [sales, setSales] = useState([]);
  const [onEdit, setOnEdit] = useState(null);

  const getProducts = async () => {
    try {
      const res = await axios.get("http://localhost:8000/api/sale");
      setSales(res.data.sort((a, b) => (a.id > b.id ? 1 : -1)));
    } catch (error) {
      toast.error(error);
    }
  };

  useEffect(() => {
    getProducts();
  }, [setSales]);

  return (
    <section className="container dashboard">
      <NavbarAdmin />
      <h2>Vendas</h2>
      <SalesTable setOnEdit={setOnEdit} sales={sales} setSales={setSales} />
    </section>
  );
};

export default Sales;
