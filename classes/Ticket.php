<?php
// This class handles all ticket operations like getting, adding, updating and deleting tickets
class Ticket {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllTickets() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM tickets");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function addTicket($type, $price, $help, $limitations, $remaining, $expiryDate) {
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO tickets (type, price, help, limitations, remaining, expiry_date) 
                VALUES (?, ?, ?, ?, ?, ?)"
            );
            return $stmt->execute([$type, $price, $help, $limitations, $remaining, $expiryDate]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateTicket($id, $type, $price, $help, $limitations, $remaining, $expiryDate) {
        try {
            $stmt = $this->db->prepare(
                "UPDATE tickets 
                SET type = ?, price = ?, help = ?, limitations = ?, remaining = ?, expiry_date = ? 
                WHERE id = ?"
            );
            return $stmt->execute([$type, $price, $help, $limitations, $remaining, $expiryDate, $id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteTicket($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM tickets WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getTicketById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM tickets WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
} 