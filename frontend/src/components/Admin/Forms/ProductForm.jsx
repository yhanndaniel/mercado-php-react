import axios from "axios";
import React, { useEffect, useRef, useState } from "react";
import { toast } from "react-toastify";

import { FormContainer, InputArea, Label, Button, Input, ButtonCancel, Select } from "../Tables/styledComponets";
const ProductForm = ({ getProducts, onEdit, setOnEdit }) => {
  const ref = useRef();
  const [optionValue, setOptionValue] = useState([]);

  useEffect(() => {
    fetch("http://localhost:8000/api/product-type").then((res) => {
      return res.json();
    }).then((data) => {
        setOptionValue(data);
    })
    if (onEdit) {
      const productType = ref.current;

      productType.name.value = onEdit.name;
      productType.description.value = onEdit.description;
      productType.price.value = onEdit.price;
      productType.product_types_id.value = onEdit.product_types_id;
    }
  }, [onEdit]);

  const handleSubmit = async (e) => {
    e.preventDefault();
    const productType = ref.current;

    if (
      !productType.name.value ||
      !productType.description.value ||
      !productType.price.value ||
      !productType.product_types_id.value
    ) {
      return toast.warn("Preencha todos os campos!");
    }

    if (onEdit) {
      await axios
        .put("http://localhost:8000/api/product/" + onEdit.id, {
          name: productType.name.value,
          description: productType.description.value,
          price: productType.price.value,
          product_types_id: productType.product_types_id.value,
        })
        .then(({ data }) => toast.success(data))
        .catch(({ data }) => toast.error(data));
    } else {
      await axios
        .post("http://localhost:8000/api/product/", {
          name: productType.name.value,
          description: productType.description.value,
          price: productType.price.value,
          product_types_id: productType.product_types_id.value,
        })
        .then(({ data }) => toast.success(data))
        .catch(({ data }) => toast.error(data));
    }

    productType.name.value = "";
    productType.description.value = "";
    productType.price.value = "";
    productType.product_types_id.value = "";

    setOnEdit(null);
    getProducts();
  };

  const handleCancel = () => {
    const productType = ref.current;

    setOnEdit(null);
    productType.name.value = "";
    productType.description.value = "";
    productType.price.value = "";
    productType.product_types_id.value = "";
  }

 

  return (
    <FormContainer ref={ref} onSubmit={handleSubmit}>
      <InputArea>
        <Label>Nome</Label>
        <Input name="name" />
      </InputArea>
      <InputArea>
        <Label>Descrição</Label>
        <Input name="description" />
      </InputArea>
      <InputArea>
        <Label>Preço</Label>
        <Input name="price" />
      </InputArea>
      <InputArea>
        <Label>Tipo</Label>
        <Select name="product_types_id">
            <option value="">Selecione</option>
            {
              optionValue.map((item) => (
                <option value={item.id}>{item.name}</option>
              ))
            }
        </Select>
      </InputArea>

      <Button type="submit">SALVAR</Button>
      <ButtonCancel onClick={handleCancel}>CANCELAR</ButtonCancel>
    </FormContainer>
  );
};

export default ProductForm;
