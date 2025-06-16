const os = require('os');

function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(decimals)) + ' ' + sizes[i];
}

console.log('=== System Information ===');
console.log(`OS Type: ${os.type()}`);
console.log(`Platform: ${os.platform()} ${os.arch()}`);
console.log(`Release: ${os.release()}`);
console.log(`Hostname: ${os.hostname()}`);
console.log(`Home Directory: ${os.homedir()}`);
console.log(`Temp Directory: ${os.tmpdir()}`);

console.log('\n=== CPU Information ===');
console.log(`CPU Model: ${os.cpus()[0].model}`);
console.log(`CPU Cores: ${os.cpus().length}`);
console.log(`CPU Speed: ${os.cpus()[0].speed} MHz`);

console.log('\n=== Memory Information ===');
console.log(`Total Memory: ${formatBytes(os.totalmem())}`);
console.log(`Free Memory: ${formatBytes(os.freemem())}`);
console.log(`Memory Usage: ${((1 - os.freemem() / os.totalmem()) * 100).toFixed(2)}%`);

console.log('\n=== System Status ===');
console.log(`Uptime: ${(os.uptime() / 3600).toFixed(2)} hours`);
console.log(`Load Average: ${os.loadavg().join(', ')}`);
console.log(`Network Interfaces:`, os.networkInterfaces());