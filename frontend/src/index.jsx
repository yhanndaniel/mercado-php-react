import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';

import './index.css';

import { createBrowserRouter, RouterProvider } from 'react-router-dom';

import Home from './routes/Home';
import ProductType from './routes/Admin/ProductType';
import ErrorPage from './routes/ErrorPage';
import Product from './routes/Admin/Product';
import Sales from './routes/Admin/Sales';

const router = createBrowserRouter([
  {
    path : '/',
    element: <App />,
    errorElement: <ErrorPage />,
    children: [
      {
        path: '/',
        element: <Home />
      },
      {
        path: 'admin',
        element: <ProductType />
      },
      {
        path: 'admin/produtos',
        element: <Product />
      },
      {
        path: 'admin/vendas',
        element: <Sales />
      }
    ]
  }
]);

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <RouterProvider router={router} />
  </React.StrictMode>
);
