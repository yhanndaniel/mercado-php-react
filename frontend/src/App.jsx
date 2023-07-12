import React from 'react';
import Header from './components/Header/Header';
import Provider from './context/Provider';
import { Outlet } from 'react-router-dom';
import { ToastContainer, toast } from 'react-toastify';

import 'react-toastify/dist/ReactToastify.css';

function App() {

  return (
    <Provider>
      <Header />
      <Outlet />
      <ToastContainer autoClose={3000} position={toast.POSITION.BOTTOM_LEFT} />
    </Provider>
  );
}

export default App;
