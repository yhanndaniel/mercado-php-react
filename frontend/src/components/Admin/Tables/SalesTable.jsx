import React, { useState } from "react";
import axios from "axios";
import { FaCartArrowDown } from "react-icons/fa";
import { toast } from "react-toastify";
import { Table, Thead, Tbody, Tr, Th, Td } from "./styledComponets";
import formatCurrency from "../../../utils/formatCurrency";
import CartSaleTable from "./CartSaleTable";
const SalesTable = ({ sales, setSales, setOnEdit }) => {
    const [cartSale, setCartSale] = useState([]);

  const handleEdit = async(item) => {
    try {
        const res = await axios.get("http://localhost:8000/api/cart-product/"+item.id);
        setCartSale(res.data.sort((a, b) => (a.id > b.id ? 1 : -1)));
      } catch (error) {
        toast.error(error);
      }
  };

  return (
    <>
    <Table>
      <Thead>
        <Tr>
          <Th>Id</Th>
          <Th>Total de Produtos</Th>
          <Th>Total de Imposto</Th>
          <Th>Total</Th>
          <Th></Th>
          <Th></Th>
        </Tr>
      </Thead>
      <Tbody>
        {sales.map((item, i) => (
          <Tr key={i}>
            <Td width="20%">{item.id}</Td>
            <Td width="30%">{formatCurrency(item.total_amount, 'BRL')}</Td>
            <Td width="20%">
              {formatCurrency(item.total_tax, 'BRL')}
            </Td>
            <Td width="20%">
              {formatCurrency(item.total, 'BRL')}
            </Td>
            <Td aligncenter width="10%">
              <FaCartArrowDown onClick={() => handleEdit(item)} />
            </Td>
          </Tr>
        ))}
      </Tbody>
    </Table>
    <CartSaleTable cartSale={cartSale} />
    </>
  );
};

export default SalesTable;
