import React from 'react';
import ReactDOM from 'react-dom/client';
import './index.css';
import App from './App';

import "bootstrap/dist/css/bootstrap.min.css";
import { BrowserRouter } from 'react-router-dom';
import GlobalContext from './Context/UserContext';

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <BrowserRouter>
      <GlobalContext>
        <App />
      </GlobalContext>
    </BrowserRouter>
  </React.StrictMode>
);
