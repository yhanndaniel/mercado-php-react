const fetchProducts = async () => {
  const response = await fetch(`http://localhost:8000/api/product`);
  const data = await response.json();

  return data;
};

export default fetchProducts;
