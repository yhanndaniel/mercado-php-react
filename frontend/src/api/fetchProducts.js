const fetchProducts = async () => {
  const response = await fetch(`http://localhost:8000/api/product`);
  const data = await response.json();

  console.log(data);
  return data;
};

export default fetchProducts;
