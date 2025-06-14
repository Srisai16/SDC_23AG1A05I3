import React from 'react';

function Contact() {
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
    maxWidth: '500px',
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
        <h2 style={headingStyle}>Contact Us</h2>
        <p style={textStyle}>📞 Phone: +91 12345 67890</p>
        <p style={textStyle}>✉️ Email: support@studentsys.com</p>
        <p style={textStyle}>🏫 Address: 123 Education Lane, Learning City</p>
      </div>
    </div>
  );
}

export default Contact;
