import React from 'react';
import logo from './logo.svg';
import './App.css';
import './Custom.css';
import SaveUsers from './Pages/SaveUsers';
import ListUsers from './Pages/ListUsers';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'



function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<SaveUsers/>}/>
        <Route path="/ListUsers" element={<ListUsers/>}/>
      </Routes>
    </Router>
  );
}

export default App;
