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
        // Check if $votersName is a valid string before calling the like() method
        if ($votersName !== null && is_string($votersName)) {
            // Convert the search term to lowercase
            $votersName = strtolower($votersName);
            // Use the Query Builder to perform a partial, case-insensitive search using LIKE with wildcards
                $query = $this->table('gulod') // Replace 'gulod' with your actual table name
                ->like('LOWER(voters_name)', $votersName, 'both')
                ->get();

            // Return the results as an array of objects
            return $query->getResult();
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