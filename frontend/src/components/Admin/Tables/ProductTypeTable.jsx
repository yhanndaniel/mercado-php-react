import React from "react";
import axios from "axios";
import { FaTrash, FaEdit } from "react-icons/fa";
import { toast } from "react-toastify";
import { Table, Thead, Tbody, Tr, Th, Td } from "./styledComponets";
const ProductTypeTable = ({ productTypes, setProductTypes, setOnEdit }) => {
  const handleEdit = (item) => {
    setOnEdit(item);
  };

  const handleDelete = async (id) => {
    await axios
      .delete("http://localhost:8000/api/product-type/" + id)
      .then(({ data }) => {
        const newArray = productTypes.filter((productType) => productType.id !== id);

        setProductTypes(newArray);
        toast.success(data);
      })
      .catch(({ data }) => toast.error(data));

    setOnEdit(null);
  };

  return (
    <Table>
      <Thead>
        <Tr>
          <Th>Nome</Th>
          <Th>Descrição</Th>
          <Th>Imposto</Th>
          <Th></Th>
          <Th></Th>
        </Tr>
      </Thead>
      <Tbody>
        {productTypes.map((item, i) => (
          <Tr key={i}>
            <Td width="30%">{item.name}</Td>
            <Td width="30%">{item.description}</Td>
            <Td width="20%">
              {item.tax}
            </Td>
            <Td aligncenter width="5%">
              <FaEdit onClick={() => handleEdit(item)} />
            </Td>
            <Td aligncenter width="5%">
              <FaTrash onClick={() => handleDelete(item.id)} />
            </Td>
          </Tr>
        ))}
      </Tbody>
    </Table>
  );
};

export default ProductTypeTable;
