const http = require('http');
const os = require('os');
const path = require('path');
const EventEmitter = require('events');

// Create event emitter and HTTP server
const eventEmitter = new EventEmitter();
const server = http.createServer((req, res) => {
    // Emit event on request
    eventEmitter.emit('requestReceived', {
        method: req.method,
        url: req.url,
        time: new Date().toISOString()
    });
    
    // Send HTML response with system info
    res.writeHead(200, { 'Content-Type': 'text/html' });
    res.write('<h1>Welcome to My Custom Server</h1>');
    
    // Display system information
    const systemInfo = `
        <h2>System Information</h2>
        <p>OS Architecture: ${os.arch()}</p>
        <p>Platform: ${os.platform()}</p>
        <p>CPU Cores: ${os.cpus().length}</p>
        <p>Total Memory: ${(os.totalmem()/1024/1024).toFixed(2)} MB</p>
        <p>Free Memory: ${(os.freemem()/1024/1024).toFixed(2)} MB</p>
        <p>Uptime: ${(os.uptime()/60/60).toFixed(2)} hours</p>
        <p>Server file path: ${path.join(__dirname, 'server.js')}</p>
        <h2>Request Information</h2>
        <p>You accessed: ${req.url}</p>
        <p>HTTP Method: ${req.method}</p>
    `;
    
    res.write(systemInfo);
    res.end();
});

// Event listener for requests
eventEmitter.on('requestReceived', (requestData) => {
    console.log(`[${requestData.time}] ${requestData.method} ${requestData.url}`);
});

// Start server
const PORT = 3000;
server.listen(PORT, () => {
    console.log(`Server running at http://localhost:${PORT}/`);
    console.log('Press Ctrl+C to stop the server');
    console.log('\nSystem Information:');
    console.log(`- Platform: ${os.platform()} ${os.arch()}`);
    console.log(`- CPUs: ${os.cpus().length} cores`);
    console.log(`- Memory: ${(os.freemem()/1024/1024).toFixed(2)} MB free of ${(os.totalmem()/1024/1024).toFixed(2)} MB`);
});