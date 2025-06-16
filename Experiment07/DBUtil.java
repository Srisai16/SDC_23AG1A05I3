package Experiment07; // Make sure this matches your folder structure

import java.sql.*;

public class DBUtil {
    public static Connection getConnection() throws SQLException, ClassNotFoundException {
        String url = "jdbc:mysql://localhost:3306/sdc";
        String user = "root";
        String pass = "root";
        Class.forName("com.mysql.cj.jdbc.Driver");
        return DriverManager.getConnection(url, user, pass);
    }

    // Add a main method for testing
    // public static void main(String[] args) {
    //     try {
    //         Connection conn = DBUtil.getConnection();
    //         System.out.println("Database connected successfully!");
    //         conn.close();
    //     } catch (Exception e) {
    //         System.err.println("Error: " + e.getMessage());
    //     }
    // }
}