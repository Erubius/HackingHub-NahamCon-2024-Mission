#!/usr/bin/env python3

import http.server as SimpleHTTPServer
import socketserver as SocketServer
import logging

# Ensure request headers are printed
class GetHandler(SimpleHTTPServer.SimpleHTTPRequestHandler):
    def do_GET(self):
        logging.error(self.headers)
        SimpleHTTPServer.SimpleHTTPRequestHandler.do_GET(self)

# ===== MAIN =====

PORT = 8000
Handler = GetHandler
httpd = SocketServer.TCPServer(("", PORT), Handler)

print("===============================================")
print(f"Python HTTP Proxy available on: 127.0.0.1:{PORT}")
print("===============================================")
httpd.serve_forever()
