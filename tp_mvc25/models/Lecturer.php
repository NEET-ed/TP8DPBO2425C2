<?php
include_once("DB.php");
class Lecturer extends DB
{
    function create($name, $nidn, $phone, $join_date)
    {
        // sanitize (optional, biasanya dilakukan di controller)
        $name = addslashes($name);
        $nidn = addslashes($nidn);
        $phone = addslashes($phone);
        $join_date = addslashes($join_date);

        $query = "INSERT INTO lecturers (name, nidn, phone, join_date)
                  VALUES ('$name', '$nidn', '$phone', '$join_date')";
        return $this->execute($query);
    }
    
    function read($id = null)
    {
        if($id){
            $query = "SELECT * FROM lecturers WHERE id = $id";
        } else {
            $query = "SELECT * FROM lecturers";
        }
        return $this->execute($query);
    }

    function delete($id)
    {
        $id = intval($id);
        if ($id <= 0) return false;
    
        $query = "DELETE FROM lecturers WHERE id = $id";
        return $this->execute($query);
    }
    
    function update($id, $name, $nidn, $phone, $join_date)
    {
        $name = addslashes($name);
        $nidn = addslashes($nidn);
        $phone = addslashes($phone);
        $join_date = addslashes($join_date);

        $query = "UPDATE lecturers
                  SET name = '$name',
                      nidn = '$nidn',
                      phone = '$phone',
                      join_date = '$join_date'
                  WHERE id = $id";

        return $this->execute($query);
    }
}
