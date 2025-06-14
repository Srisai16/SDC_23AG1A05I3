import React from 'react';
function Login() {
const wrapperStyle = {
display: 'flex',
flexDirection: 'column',
alignItems: 'center',
justifyContent: 'center',
minHeight: '60vh',
fontFamily: 'Segoe UI, sans-serif'
};
const formStyle = {
display: 'flex',
flexDirection: 'column',
gap: '15px',
width: '100%',
maxWidth: '400px',
backgroundColor: '#f9f9fc',
padding: '30px',
borderRadius: '12px',
boxShadow: '0 4px 12px rgba(0, 0, 0, 0.1)'
};
const inputStyle = {
padding: '12px',
fontSize: '16px',
border: '1px solid #ccc',
borderRadius: '8px',
outline: 'none'
};
const buttonStyle = {
padding: '12px',
fontSize: '16px',
backgroundColor: '#6293d3',
color: '#fff',
border: 'none',
borderRadius: '8px',
cursor: 'pointer',
transition: 'background-color 0.3s ease'
};
const headingStyle = {
marginBottom: '20px',
textAlign: 'center',
color: '#2e3a59'
};
return (
<div style={wrapperStyle}>
<h2 style={headingStyle}>Login</h2>
<form style={formStyle}>
<input type="email" placeholder="Email" style={inputStyle} />
<input type="password" placeholder="Password" style={inputStyle} />
<button type="submit" style={buttonStyle}>Login</button>
</form>
</div>
);
}
export default Login;