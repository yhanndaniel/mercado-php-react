import axios from "axios";
import React, { useEffect, useRef } from "react";
import { toast } from "react-toastify";

import { FormContainer, InputArea, Label, Button, Input, ButtonCancel } from "../Tables/styledComponets";
const ProductTypeForm = ({ getUsers, onEdit, setOnEdit }) => {
  const ref = useRef();

  useEffect(() => {
    if (onEdit) {
      const productType = ref.current;

      productType.name.value = onEdit.name;
      productType.description.value = onEdit.description;
      productType.tax.value = onEdit.tax;
    }
  }, [onEdit]);

  const handleSubmit = async (e) => {
    e.preventDefault();

    const productType = ref.current;

    if (
      !productType.name.value ||
      !productType.description.value ||
      !productType.tax.value 
    ) {
      return toast.warn("Preencha todos os campos!");
    }

    if (onEdit) {
      await axios
        .put("http://localhost:8000/api/product-type/" + onEdit.id, {
          name: productType.name.value,
          description: productType.description.value,
          tax: productType.tax.value,
        })
        .then(({ data }) => toast.success(data))
        .catch(({ data }) => toast.error(data));
    } else {
      await axios
        .post("http://localhost:8000/api/product-type/", {
          name: productType.name.value,
          description: productType.description.value,
          tax: productType.tax.value,
        })
        .then(({ data }) => toast.success(data))
        .catch(({ data }) => toast.error(data));
    }

    productType.name.value = "";
    productType.description.value = "";
    productType.tax.value = "";

    setOnEdit(null);
    getUsers();
  };

  const handleCancel = () => {
    const productType = ref.current;

    setOnEdit(null);
    productType.name.value = "";
    productType.description.value = "";
    productType.tax.value = "";
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
        <Label>Imposto</Label>
        <Input name="tax" />
      </InputArea>

      <Button type="submit">SALVAR</Button>
      <ButtonCancel onClick={handleCancel}>CANCELAR</ButtonCancel>
    </FormContainer>
  );
};

export default ProductTypeForm;
