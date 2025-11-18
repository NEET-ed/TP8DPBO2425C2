<?php
include_once("config.php");
include_once("models/Course.php");
include_once("models/Lecturer.php"); // untuk dropdown lecturer
include_once("views/CourseView.php");

class CourseController
{
    private $course;
    private $lecturer;

    function __construct()
    {
        $this->course = new Course(
            Config::$db_host,
            Config::$db_user,
            Config::$db_pass,
            Config::$db_name
        );

        // untuk mengambil list lecturer pada form
        $this->lecturer = new Lecturer(
            Config::$db_host,
            Config::$db_user,
            Config::$db_pass,
            Config::$db_name
        );
    }

    // ============================================
    // INDEX - LIST ALL COURSES
    // ============================================
    public function index()
    {
        $this->course->open();
        $this->course->read(); // ambil semua course (dengan join lecturer)
        
        $data = array();
        while ($row = $this->course->getResult()) {
            array_push($data, $row);
        }
        $this->course->close();

        $view = new CourseView();
        $view->index($data);
    }

    // ============================================
    // ADD NEW COURSE
    // ============================================
    public function add()
    {
        if (isset($_POST['submit'])) {
            $course_name = $_POST['course_name'];
            $course_code = $_POST['course_code'];
            $lecturer_id = $_POST['lecturer_id'];
            $credits     = $_POST['credits'];

            $this->course->open();
            $this->course->create($course_name, $course_code, $lecturer_id, $credits);
            $this->course->close();

            header("Location: index.php");
        } 
        else {
            // Ambil daftar lecturer untuk dropdown
            $this->lecturer->open();
            $this->lecturer->read();
            
            $lecturers = array();
            while ($row = $this->lecturer->getResult()) {
                array_push($lecturers, $row);
            }

            $this->lecturer->close();

            // tampilkan form
            $view = new CourseView();
            $view->create($lecturers);
        }
    }

    // ============================================
    // EDIT COURSE
    // ============================================
    public function edit()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Jika user submit perubahan
            if (isset($_POST['submit'])) {
                $course_name = $_POST['course_name'];
                $course_code = $_POST['course_code'];
                $lecturer_id = $_POST['lecturer_id'];
                $credits     = $_POST['credits'];

                $this->course->open();
                $this->course->update($id, $course_name, $course_code, $lecturer_id, $credits);
                $this->course->close();

                header("Location: index.php");
            } 
            else {
                // ===== Ambil data course berdasarkan id =====
                $this->course->open();
                $this->course->read($id);
                $course = $this->course->getResult();
                $this->course->close();

                // ===== Ambil semua lecturer untuk dropdown =====
                $this->lecturer->open();
                $this->lecturer->read();

                $lecturers = array();
                while ($row = $this->lecturer->getResult()) {
                    array_push($lecturers, $row);
                }

                $this->lecturer->close();

                // ===== Tampilkan form edit =====
                $view = new CourseView();
                $view->update($course, $lecturers);
            }
        }
    }

    // ============================================
    // DELETE COURSE
    // ============================================
    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $this->course->open();
            $this->course->delete($id);
            $this->course->close();

            header("Location: index.php");
        }
    }
}
