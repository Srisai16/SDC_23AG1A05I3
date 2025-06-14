package Experiment7;

import java.io.IOException;
import java.io.PrintWriter;
import java.sql.*;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;

@WebServlet("/ShoppingCartController")
public class ShoppingCartController extends HttpServlet {

    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException {
        String action = request.getParameter("action");
        if (action == null) {
            response.sendError(HttpServletResponse.SC_BAD_REQUEST, "Action parameter missing");
            return;
        }

        switch (action) {
            case "register": handleRegistration(request, response); break;
            case "login": handleLogin(request, response); break;
            case "addToCart": handleAddToCart(request, response); break;
            default:
                response.sendError(HttpServletResponse.SC_BAD_REQUEST, "Invalid action");
        }
    }

    private void handleRegistration(HttpServletRequest request, HttpServletResponse response) throws IOException {
        String username = request.getParameter("username");
        String password = request.getParameter("password");
        try {
            Connection conn = DBUtil.getConnection();
            PreparedStatement stmt = conn.prepareStatement("INSERT INTO users (username, password) VALUES (?, ?)");
            stmt.setString(1, username);
            stmt.setString(2, password);
            stmt.executeUpdate();

            PrintWriter out = response.getWriter();
            out.println("Registration successful");
        } catch (Exception e) {
            response.sendError(500, "Registration failed: " + e.getMessage());
        }
    }

    private void handleLogin(HttpServletRequest request, HttpServletResponse response) throws IOException {
        String username = request.getParameter("username");
        String password = request.getParameter("password");
        try {
            Connection conn = DBUtil.getConnection();
            PreparedStatement stmt = conn.prepareStatement("SELECT * FROM users WHERE username=? AND password=?");
            stmt.setString(1, username);
            stmt.setString(2, password);
            ResultSet rs = stmt.executeQuery();

            PrintWriter out = response.getWriter();
            if (rs.next()) {
                out.println("Login successful");
            } else {
                out.println("Login failed: Invalid credentials");
            }
        } catch (Exception e) {
            response.sendError(500, "Login failed: " + e.getMessage());
        }
    }

    private void handleAddToCart(HttpServletRequest request, HttpServletResponse response) throws IOException {
        String userId = request.getParameter("userId");
        String productId = request.getParameter("productId");
        try {
            Connection conn = DBUtil.getConnection();
            PreparedStatement stmt = conn.prepareStatement("INSERT INTO cart (user_id, product_id) VALUES (?, ?)");
            stmt.setInt(1, Integer.parseInt(userId));
            stmt.setInt(2, Integer.parseInt(productId));
            stmt.executeUpdate();

            PrintWriter out = response.getWriter();
            out.println("Product added to cart");
        } catch (Exception e) {
            response.sendError(500, "Add to cart failed: " + e.getMessage());
        }
    }
}
