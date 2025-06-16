const EventEmitter = require('events');

class MyEmitter extends EventEmitter {}

// Create custom emitter
const myEmitter = new MyEmitter();

// Set up event listeners
myEmitter.on('start', () => {
    console.log('Server initialization started');
});

myEmitter.on('ready', (port) => {
    console.log(`Server is ready on port ${port}`);
});

myEmitter.on('error', (err) => {
    console.error('Error occurred:', err.message);
});

// Emit events with different priorities
myEmitter.emit('start');
myEmitter.emit('ready', 3000);

// Simulate error
setTimeout(() => {
    myEmitter.emit('error', new Error('Connection timeout'));
}, 1000);

// One-time event
myEmitter.once('firstRequest', () => {
    console.log('Handling first request');
});

// Emit first request event
myEmitter.emit('firstRequest');
myEmitter.emit('firstRequest'); // Won't trigger again