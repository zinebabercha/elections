<?php
$DSN = 'mysql:host=localhost;dbname=politico';
try {
    $conn = new PDO($DSN, 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $program = $_GET['program'] ?? '';
    
    $query = "SELECT * FROM candidates
              WHERE election_id = :program";    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':program', $program, PDO::PARAM_STR);
    
    $stmt->execute();
    
    $programs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($programs)) {
        /*echo '<table>
                <thead>
                    <tr>
                        <th>Candidate Name</th>
                    </tr>
                </thead>
                <tbody>';*/
        
        foreach ($programs as $program) {
            echo $program['candidate_name'] ;
        }
        
        /*echo '</tbody>
            </table>';*/
    } else {
        echo '<p>No candidates found for the selected office.</p>';
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
