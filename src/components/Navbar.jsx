import React from 'react';
import { Link } from 'react-router-dom';

const Navbar = () => {
  return (
    <nav className="navbar navbar-expand-lg navbar-light bg-light mb-4">
      <div className="container-fluid">
        <Link className="navbar-brand" to="/">Divina Cocina</Link>
        <div className="ms-auto">
          <Link className="btn btn-outline-primary me-2" to="/login">Iniciar Sesión</Link>
          <Link className="btn btn-success" to="/registro">Registrarse</Link>
        </div>
      </div>
    </nav>
  )
};

export default Navbar;