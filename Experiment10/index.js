const express = require("express");
const app = express();

// Middleware
app.use(express.json()); // To parse JSON body

// Routes
const studentRoutes = require("./routes/students");
app.use("/api/students", studentRoutes);

// Server
const PORT = 5000;
app.listen(PORT, () => {
  console.log(`✅ Server is running on http://localhost:${PORT}`);
});
