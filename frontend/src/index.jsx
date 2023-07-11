import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';

import './index.css';

import { createBrowserRouter, RouterProvider } from 'react-router-dom';

import Home from './routes/Home';
import Admin from './routes/Admin';
import ErrorPage from './routes/ErrorPage';

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
        element: <Admin />
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
