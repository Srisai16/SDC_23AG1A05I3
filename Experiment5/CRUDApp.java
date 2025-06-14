import java.sql.*;
import java.util.Scanner;

public class CRUDApp {
    // JDBC driver & database URL
    static final String JDBC_URL = "jdbc:mysql://localhost:3306/sdc";
    static final String DB_USER = "root";
    static final String DB_PASS = "root"; // Replace with your MySQL password

    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        try (Connection conn = DriverManager.getConnection(JDBC_URL, DB_USER, DB_PASS)) {
            System.out.println("Connected to MySQL successfully!");

            while (true) {
                System.out.println("\n--- CRUD MENU ---");
                System.out.println("1. Insert");
                System.out.println("2. Read");
                System.out.println("3. Update");
                System.out.println("4. Delete");
                System.out.println("5. Exit");
                System.out.print("Choose an option: ");
                int choice = sc.nextInt();
                sc.nextLine(); // consume newline

                switch (choice) {
                    case 1: insertUser(conn, sc); break;
                    case 2: readUsers(conn); break;
                    case 3: updateUser(conn, sc); break;
                    case 4: deleteUser(conn, sc); break;
                    case 5: System.exit(0);
                    default: System.out.println("Invalid choice!");
                }
            }
        } catch (SQLException e) {
            System.out.println("Connection failed: " + e.getMessage());
        }
    }

    static void insertUser(Connection conn, Scanner sc) throws SQLException {
        System.out.print("Enter name: ");
        String name = sc.nextLine();
        System.out.print("Enter email: ");
        String email = sc.nextLine();
        System.out.print("Enter country: ");
        String country = sc.nextLine();

        String sql = "INSERT INTO users (name, email, country) VALUES (?, ?, ?)";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setString(1, name);
            stmt.setString(2, email);
            stmt.setString(3, country);
            stmt.executeUpdate();
            System.out.println("User inserted successfully.");
        }
    }

    static void readUsers(Connection conn) throws SQLException {
        String sql = "SELECT * FROM users";
        try (Statement stmt = conn.createStatement(); ResultSet rs = stmt.executeQuery(sql)) {
            System.out.println("\n--- User Records ---");
            while (rs.next()) {
                System.out.printf("ID: %d | Name: %s | Email: %s | Country: %s%n",
                        rs.getInt("id"), rs.getString("name"),
                        rs.getString("email"), rs.getString("country"));
            }
        }
    }

    static void updateUser(Connection conn, Scanner sc) throws SQLException {
        System.out.print("Enter user ID to update: ");
        int id = sc.nextInt(); sc.nextLine();
        System.out.print("Enter new name: ");
        String name = sc.nextLine();
        System.out.print("Enter new email: ");
        String email = sc.nextLine();
        System.out.print("Enter new country: ");
        String country = sc.nextLine();

        String sql = "UPDATE users SET name=?, email=?, country=? WHERE id=?";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setString(1, name);
            stmt.setString(2, email);
            stmt.setString(3, country);
            stmt.setInt(4, id);
            int rows = stmt.executeUpdate();
            System.out.println(rows > 0 ? "User updated." : "User not found.");
        }
    }

    static void deleteUser(Connection conn, Scanner sc) throws SQLException {
        System.out.print("Enter user ID to delete: ");
        int id = sc.nextInt();

        String sql = "DELETE FROM users WHERE id=?";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setInt(1, id);
            int rows = stmt.executeUpdate();
            System.out.println(rows > 0 ? "User deleted." : "User not found.");
        }
    }
}
