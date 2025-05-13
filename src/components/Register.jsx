import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

const Register = () => {
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError('');

    // Validar campos vacíos
    if (!name || !email || !password) {
      setError('Todos los campos son obligatorios');
      return;
    }

    try {
      const response = await axios.post(
'http://localhost/divina-cocina-sql/register.php',
        { name, email, password },
        { withCredentials: true }
      );

      if (response.data.success) {
        alert('Registro exitoso. Redirigiendo...');
        navigate('/login');
      }
    } catch (err) {
  if (err.response?.data?.message) {
    setError(err.response.data.message); // Muestra mensajes del backend
  } else {
    setError("Error de conexión con el servidor");
  }
}
  };

  return (
    <div className="container mt-5">
      <h2>Registrarse</h2>
      {error && <div className="alert alert-danger">{error}</div>}

      <form onSubmit={handleSubmit}>
        <div className="mb-3">
          <label htmlFor="name" className="form-label">Nombre</label>
          <input 
            type="text" 
            className="form-control" 
            id="name" 
            value={name} 
            onChange={(e) => setName(e.target.value)} 
            required 
          />
        </div>
        <div className="mb-3">
          <label htmlFor="email" className="form-label">Email</label>
          <input 
            type="email" 
            className="form-control" 
            id="email" 
            value={email} 
            onChange={(e) => setEmail(e.target.value)} 
            required 
          />
        </div>
        <div className="mb-3">
          <label htmlFor="password" className="form-label">Contraseña</label>
          <input 
            type="password" 
            className="form-control" 
            id="password" 
            value={password} 
            onChange={(e) => setPassword(e.target.value)} 
            required 
          />
        </div>
        <button type="submit" className="btn btn-success w-100">Registrar</button>
      </form>
    </div>
  );
};

export default Register;