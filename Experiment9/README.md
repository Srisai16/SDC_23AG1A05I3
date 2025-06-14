# Node.js Core Modules Exploration

![Node.js Logo](https://nodejs.org/static/images/logo.svg)

A comprehensive demonstration of Node.js core modules including HTTP, OS, Path, and Events.

## Features

- Custom HTTP server with request logging
- Detailed system information using OS module
- Advanced file path operations with Path module
- Event-driven architecture with EventEmitter
- Memory and CPU monitoring
- Cross-platform path handling

## Modules Demonstrated

1. **HTTP** - Create web servers and handle HTTP requests
2. **OS** - Access operating system information
3. **Path** - Handle and transform file paths
4. **Events** - Implement event-driven architecture
5. **FS** - File system operations (in path.js)

## Installation

1. Ensure you have Node.js installed (v14+ recommended)
2. Clone this repository
3. Install dependencies (none required for core modules)

```bash
git clone https://github.com/Srisai16/SDC_23AG1A05I3.git
Running the Examples
1. HTTP Server
bash
node server.js  Experiment9\localhost-3000.png
Access the server at http://localhost:3000

2. Event Module
bash
node events.js
3. OS Module
bash
node os.js  Experiment9\os.png
4. Path Module
bash
node path.js
Sample Outputs
Server Output
text
Server running at http://localhost:3000/
Press Ctrl+C to stop the server

System Information:
- Platform: linux x64
- CPUs: 8 cores
- Memory: 2048.00 MB free of 8192.00 MB
[2023-06-20T10:30:45.123Z] GET /
[2023-06-20T10:31:10.456Z] GET /favicon.ico
OS Module Output
text
=== System Information ===
OS Type: Linux
Platform: linux x64
Release: 5.15.0-76-generic
Hostname: my-server
Home Directory: /home/user
Temp Directory: /tmp

=== CPU Information ===
CPU Model: Intel(R) Core(TM) i7-10700K CPU @ 3.80GHz
CPU Cores: 8
CPU Speed: 3800 MHz

=== Memory Information ===
Total Memory: 8 GB
Free Memory: 2 GB
Memory Usage: 75.34%

=== System Status ===
Uptime: 12.34 hours
Load Average: 0.52, 0.48, 0.45
Learning Resources
Node.js Documentation

Path Module Guide

Event Loop Explained

License
MIT License - Free for educational and commercial use

text

This complete package provides:
1. A fully functional HTTP server with system monitoring
2. Comprehensive examples of core Node.js modules
3. Clean, well-commented code
4. Proper error handling and resource management
5. Complete documentation in the README
6. Practical demonstrations of each module's capabilities

The code follows best practices including:
- Proper error handling
- Resource cleanup
- Memory formatting for readability
- Cross-platform path handling
- Event-driven architecture
- Modular organization