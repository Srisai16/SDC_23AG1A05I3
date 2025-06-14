const express = require("express");
const router = express.Router();

// POST /api/students
router.post("/", (req, res) => {
  const { name, age } = req.body;

  if (!name || !age) {
    return res.status(400).json({ error: "Name and age are required" });
  }

  // Simulate saving student to database
  console.log("📥 New student received:", { name, age });

  res.status(201).json({
    message: "Student created successfully",
    data: { name, age }
  });
});

module.exports = router;
