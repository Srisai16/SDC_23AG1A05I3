import React from 'react';

function About() {
  const wrapperStyle = {
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
    justifyContent: 'center',
    minHeight: '60vh',
    fontFamily: 'Segoe UI, sans-serif'
  };

  const cardStyle = {
    width: '100%',
    maxWidth: '600px',
    backgroundColor: '#f9f9fc',
    padding: '30px',
    borderRadius: '12px',
    boxShadow: '0 4px 12px rgba(0, 0, 0, 0.1)',
    textAlign: 'center'
  };

  const headingStyle = {
    marginBottom: '15px',
    color: '#2e3a59',
    fontSize: '1.8rem'
  };

  const textStyle = {
    color: '#555',
    lineHeight: '1.6'
  };

  return (
    <div style={wrapperStyle}>
      <div style={cardStyle}>
        <h2 style={headingStyle}>About Student Management System</h2>
        <p style={textStyle}>
          Our Student Management System is designed to simplify the process of registration, login, and communication
          between students and administrators. We aim to provide a smooth and modern interface inspired by tools like Canva
          to enhance user experience and accessibility.
        </p>
      </div>
    </div>
  );
}

export default About;
