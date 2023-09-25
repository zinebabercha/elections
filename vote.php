<?php
require_once("../model/db.php");

if (isset($_POST['vote'])) {
   

    
        if (isset($_POST['vote'])) {
            $candidateId = $_POST['candidate'];
            $userId = 1; // Assuming you have a way to determine the user ID
    
            // Check if the user has already voted for this election
            $electionId = 1; // Assuming you have a way to determine the election ID
            $checkQuery = "SELECT * FROM votes WHERE user_id = :userId AND election_id = :electionId";
            $checkStmt = $ConnectingDB->prepare($checkQuery);
            $checkStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $checkStmt->bindParam(':electionId', $electionId, PDO::PARAM_INT);
            $checkStmt->execute();
            $existingVote = $checkStmt->fetch(PDO::FETCH_ASSOC);
    
            if ($existingVote) {
                // User has already voted
                echo "You have already voted for this election.";
            } else {
                // Insert the vote into the votes table
                $voteQuery = "INSERT INTO votes (user_id, election_id, candidate_id) VALUES (:userId, :electionId, :candidateId)";
                $voteStmt = $conn->prepare($voteQuery);
                $voteStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $voteStmt->bindParam(':electionId', $electionId, PDO::PARAM_INT);
                $voteStmt->bindParam(':candidateId', $candidateId, PDO::PARAM_INT);
                $voteStmt->execute();
    
                echo "Vote submitted successfully.";
            }
        }
        $candidateId = 1; // Replace with the candidate ID you want to calculate the votes for

        $countQuery = "SELECT COUNT(*) AS vote_count
                       FROM votes
                       JOIN candidates ON votes.user_id = candidates.candidate_id
                       WHERE candidates.candidate_id = :candidateId";
        $countStmt = $ConnectingDB->prepare($countQuery);
        $countStmt->bindParam(':candidateId', $candidateId, PDO::PARAM_INT);
        $countStmt->execute();
        $voteCount = $countStmt->fetch(PDO::FETCH_ASSOC)['vote_count'];
    
        echo "Number of votes for Candidate ID $candidateId: $voteCount";
    }   
   
    ?>
    

