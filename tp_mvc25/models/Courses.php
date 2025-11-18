<?php
include_once("DB.php");
// Asumsi Class DB sudah didefinisikan dan memiliki metode execute($query)
// Class ini mengasumsikan tabel 'lecturers' sudah ada karena adanya Foreign Key.

class Course extends DB
{
    /**
     * Membuat data mata kuliah baru (Create)
     */
    function create($course_name, $course_code, $lecturer_id, $credits = 3)
    {
        // Sanitize input (opsional, disarankan menggunakan prepared statements)
        $course_name = addslashes($course_name);
        $course_code = addslashes($course_code);
        $lecturer_id = (int)$lecturer_id; // Pastikan ini integer
        $credits = (int)$credits; // Pastikan ini integer

        $query = "INSERT INTO courses (course_name, course_code, lecturer_id, credits)
                  VALUES ('$course_name', '$course_code', $lecturer_id, $credits)";
                  
        return $this->execute($query);
    }
    
    /**
     * Membaca data mata kuliah (Read)
     */
    function read($id = null)
    {
        if ($id) {
            $id = (int)$id; // Pastikan ini integer
            $query = "SELECT * FROM courses WHERE id = $id";
        } else {
            $query = "SELECT * FROM courses";
        }
        
        return $this->execute($query);
    }

    /**
     * Memperbarui data mata kuliah (Update)
     */
    function update($id, $course_name, $course_code, $lecturer_id, $credits)
    {
        // Sanitize input
        $id = (int)$id;
        $course_name = addslashes($course_name);
        $course_code = addslashes($course_code);
        $lecturer_id = (int)$lecturer_id;
        $credits = (int)$credits;

        $query = "UPDATE courses
                  SET course_name = '$course_name',
                      course_code = '$course_code',
                      lecturer_id = $lecturer_id,
                      credits = $credits
                  WHERE id = $id";

        return $this->execute($query);
    }

    /**
     * Menghapus data mata kuliah (Delete)
     */
    function delete($id)
    {
        $id = (int)$id; // Pastikan ini integer
        $query = "DELETE FROM courses WHERE id = $id";
        return $this->execute($query);
    }
}