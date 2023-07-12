import React from "react";
import { Table, Thead, Tbody, Tr, Th, Td } from "./styledComponets";
import formatCurrency from "../../../utils/formatCurrency";
const CartSaleTable = ({ cartSale }) => {
  return (
    <Table>
      <Thead>
        <Tr>
          <Th>#Venda</Th>
          <Th>Produto</Th>
          <Th>Total de Produtos</Th>
          <Th>Total de Imposto</Th>
          <Th>Total</Th>
        </Tr>
      </Thead>
      <Tbody>
        {cartSale.map((item, i) => (
          <Tr key={i}>
            <Td aligncenter width="10%">
              {item.cart_id}
            </Td>
            <Td width="20%">{item.productName}</Td>
            <Td width="30%">{formatCurrency(item.total_amount, 'BRL')}</Td>
            <Td width="20%">
              {formatCurrency(item.total_tax, 'BRL')}
            </Td>
            <Td width="20%">
              {formatCurrency(item.total, 'BRL')}
            </Td>
          </Tr>
        ))}
      </Tbody>
    </Table>
  );
};

export default CartSaleTable;
