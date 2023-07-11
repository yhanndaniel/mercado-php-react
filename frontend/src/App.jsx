import React from 'react';
import Header from './components/Header/Header';
import Provider from './context/Provider';
import { Outlet } from 'react-router-dom';

function App() {

  return (
    <Provider>
      <Header />
      <Outlet />
    </Provider>
  );
}

export default App;
