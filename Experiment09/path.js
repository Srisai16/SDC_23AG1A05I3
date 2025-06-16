const path = require('path');
const fs = require('fs');

// Create sample directory structure
const sampleDir = path.join(__dirname, 'sample');
const filePath = path.join(sampleDir, 'test.txt');

// Create directory if it doesn't exist
if (!fs.existsSync(sampleDir)) {
    fs.mkdirSync(sampleDir);
    console.log(`Created directory: ${sampleDir}`);
}

// Create a test file
fs.writeFileSync(filePath, 'This is a test file.');
console.log(`Created file: ${filePath}`);

// Path demonstrations
console.log('\n=== Path Module Examples ===');
console.log(`Current Directory: ${__dirname}`);
console.log(`File Name: ${path.basename(filePath)}`);
console.log(`File Extension: ${path.extname(filePath)}`);
console.log(`File Name without Extension: ${path.basename(filePath, path.extname(filePath))}`);
console.log(`Relative Path: ${path.relative(__dirname, filePath)}`);
console.log(`Resolved Path: ${path.resolve('./sample/test.txt')}`);
console.log(`Path Parsed:`, path.parse(filePath));
console.log(`Path Formatted: ${path.format(path.parse(filePath))}`);

// Clean up
fs.unlinkSync(filePath);
fs.rmdirSync(sampleDir);
console.log('\nCleaned up test files and directory');