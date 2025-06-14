const jwt = require('jsonwebtoken');

const login = (req, res) => {
    const { email, password } = req.body;

    // Dummy credentials
    if (email === 'test@example.com' && password === '123456') {
        const token = jwt.sign({ email }, process.env.JWT_SECRET, { expiresIn: '1h' });
        return res.json({ token });
    } else {
        return res.status(401).json({ message: 'Invalid credentials' });
    }
};

const getProfile = (req, res) => {
    res.json({
        message: 'Welcome to your profile',
        user: req.user
    });
};

module.exports = { login, getProfile };
