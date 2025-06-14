import React from 'react';
import { BrowserRouter as Router, Routes, Route, Link } from 'react-router-dom';
import Register from './pages/Register';
import Login from './pages/Login';
import Contact from './pages/Contact';
import About from './pages/About';

function App() {
  const navStyle = {
    display: 'flex',
    justifyContent: 'center',
    gap: '20px',
    padding: '15px 0',
    backgroundColor: '#f0f4f8',
    borderBottom: '2px solid rgb(98, 147, 211)',
    marginBottom: '30px',
    fontFamily: 'Segoe UI, sans-serif',
    fontSize: '18px'
  };

  const navLinkStyle = {
    textDecoration: 'none',
    color: '#3a3a3a',
    backgroundColor: '#e6f0fa',
    padding: '10px 16px',
    borderRadius: '30px',
    transition: 'all 0.3s ease',
    boxShadow: '0 2px 6px rgba(0,0,0,0.1)'
  };

  const navLinkHoverStyle = {
    backgroundColor: '#6293d3',
    color: '#ffffff'
  };

  const containerStyle = {
    maxWidth: '900px',
    margin: '40px auto',
    padding: '30px',
    background: 'linear-gradient(to bottom right, #ffffff, #f6f9fc)',
    boxShadow: '0 4px 12px rgba(0, 0, 0, 0.08)',
    borderRadius: '16px',
    fontFamily: 'Segoe UI, sans-serif'
  };

  const headingStyle = {
    textAlign: 'center',
    color: '#2e3a59',
    fontSize: '2.2rem',
    marginBottom: '10px'
  };

  // State for hover animation (optional)
  const [hoveredLink, setHoveredLink] = React.useState(null);

  const renderLink = (to, label, index) => (
    <Link
      key={index}
      to={to}
      style={hoveredLink === index ? { ...navLinkStyle, ...navLinkHoverStyle } : navLinkStyle}
      onMouseEnter={() => setHoveredLink(index)}
      onMouseLeave={() => setHoveredLink(null)}
    >
      {label}
    </Link>
  );

  return (
    <Router>
      <div style={containerStyle}>
        <h1 style={headingStyle}>🎓 Student Management System</h1>
        <nav style={navStyle}>
          {renderLink("/", "Register", 0)}
          {renderLink("/login", "Login", 1)}
          {renderLink("/contact", "Contact", 2)}
          {renderLink("/about", "About", 3)}
        </nav>
        <Routes>
          <Route path="/" element={<Register />} />
          <Route path="/login" element={<Login />} />
          <Route path="/contact" element={<Contact />} />
          <Route path="/about" element={<About />} />
        </Routes>
      </div>
    </Router>
  );
}

export default App;
