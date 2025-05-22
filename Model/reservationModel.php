<?php

include('BDD/database.php');

class ReservationModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addReservation($salleId, $clientNom, $clientEmail, $dateReservation, $horaire) {
        try {
            $sql = "INSERT INTO reservations (salle_id, client_nom, client_email, date_reservation, horaire) VALUES (:salle_id, :client_nom, :client_email, :date_reservation, :horaire)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':salle_id', $salleId, PDO::PARAM_INT);
            $stmt->bindParam(':client_nom', $clientNom, PDO::PARAM_STR);
            $stmt->bindParam(':client_email', $clientEmail, PDO::PARAM_STR);
            $stmt->bindParam(':date_reservation', $dateReservation, PDO::PARAM_STR);
            $stmt->bindParam(':horaire', $horaire, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Erreur lors de l'ajout de la réservation : " . $e->getMessage());
            return false;
        }
    }

    public function getReservationsBySalle($salleId) {
        try {
            $sql = "SELECT * FROM reservations WHERE salle_id = :salle_id ORDER BY date_reservation, horaire";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':salle_id', $salleId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erreur lors de la récupération des réservations : " . $e->getMessage());
            return [];
        }
    }

    public function deleteReservation($reservationId) {
        try {
            $sql = "DELETE FROM reservations WHERE id = :reservation_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':reservation_id', $reservationId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Erreur lors de la suppression de la réservation : " . $e->getMessage());
            return false;
        }
    }
}
?>
