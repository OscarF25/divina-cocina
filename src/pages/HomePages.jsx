import React from 'react';

const HomePage = () => {
  return (
    <div className="container mt-5">
      <h1 className="text-center mb-4">Bienvenido a Divina Cocina</h1>
      <p className="lead text-center">Recetas fáciles, comida casera y recetas rápidas para todos los días.</p>
      <div className="row mt-5">
        <div className="col-md-6 offset-md-3 text-center">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTlFwf4YYlzlSu8kZyJrrpEvpJSKrGc6rWDjg&s://via.placeholder.com/400x200?text=Divina+Cocina " alt="Logo Divina Cocina" className="img-fluid rounded" />
        </div>
      </div>
    </div>
  );
};

export default HomePage;