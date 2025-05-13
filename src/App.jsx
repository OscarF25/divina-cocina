import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Home from'./pages/HomePages';
import Recipes from './pages/RecipesPages';
import Contact from './pages/ContactPages';
import Register from './components/Register';
import Login from './components/Login';
import Navbar from './components/Navbar';

function App() {
  return (
    <Router>
      <Navbar />
      <div className="container mt-4">
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/recetas" element={<Recipes />} />
          <Route path="/contacto" element={<Contact />} />
          <Route path="/registro" element={<Register />} />
          <Route path="/login" element={<Login />} />
        </Routes>
      </div>
    </Router>
  );
}

export default App;
