<?php

namespace App\Models;

use CodeIgniter\Model;

class VoterModel extends Model
{
    protected $table = 'gulod'; // Replace 'gulod_table' with your actual table name
    protected $primaryKey = 'id'; // Replace 'id' with the primary key column of your table
    protected $allowedFields = ['voters_name', 'address', 'precinct_no', 'clustered_precinct'];
    protected $useTimestamps = true; // Enable automatic timestamps

    // Define the format of the timestamps (optional)
    protected $dateFormat = 'datetime';

    // If you want to use a different format for the timestamps, set it accordingly.
    // For example, if you want to use UNIX timestamps, you can set:
    // protected $dateFormat = 'int';

    // You can also set the timezone for the timestamps (optional)
    protected $timezone = 'UTC';

    // ...

    // Rest of your model code
    public function getVotersByVotersName($votersName)
    {
        // Check if $votersName is a valid string before proceeding
        if ($votersName !== null && is_string($votersName)) {
            // Convert the search term to lowercase
            $votersName = strtolower($votersName);
            // Remove any commas from the search term
            $votersName = str_replace(',', '', $votersName);
    
            // Explode the search term into an array of words
            $nameParts = explode(' ', $votersName);
    
            // Create a variable to store the query results
            $results = [];
    
            // Use the Query Builder to perform a partial, case-insensitive search using LIKE with wildcards
            $query = $this->db->table('gulod'); // Replace 'gulod' with your actual table name
    
            // Iterate through each row in the table
            foreach ($query->get()->getResult() as $row) {
                // Count the number of matching words in the full name
                $matchingWords = 0;
                foreach ($nameParts as $part) {
                    if (strlen($part) < 3) {
                        // Skip empty or short words
                        continue;
                    }
                    // Check if the part exists in the full name (case-insensitive)
                    if (stripos($row->voters_name, $part) !== false) {
                        $matchingWords++;
                    }
                }
    
                // If at least two words match, add the row to the results
                if ($matchingWords >= 2) {
                    $results[] = $row;
                }
            }
    
            // Return the results as an array of objects
            return $results;
        } else {
            // If $votersName is not a valid string, set it to an empty string to avoid null
            return [];
        }
    }
    

    public function getVotersByPrecinct($precinctNo)
    {
        return $this->where('precinct_no', $precinctNo)->findAll();
    }

    public function getVotersByClusteredPrecinct($clusteredPrecinct)
    {
        return $this->where('clustered_precinct', $clusteredPrecinct)->findAll();
    }

    public function updateVoter($voterId, $data)
    {
        return $this->update($voterId, $data);
    }

    public function deleteVoter($voterId)
    {
        return $this->delete($voterId);
    }

    public function countAllVoters()
    {
        return $this->countAll();
    }

    public function countVotersByPrecinct($precinctNo)
    {
        return $this->where('precinct_no', $precinctNo)->countAllResults();
    }

    public function countVotersByClusteredPrecinct($clusteredPrecinct)
    {
        return $this->where('clustered_precinct', $clusteredPrecinct)->countAllResults();
    }
}