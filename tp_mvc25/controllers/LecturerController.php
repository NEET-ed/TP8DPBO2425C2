<?php
include_once("config.php");
include_once __DIR__ . '/../models/Lecturer.php';
include_once __DIR__ . '/../views/LecturerView.php';


class LecturerController
{
    private $lecturer;

    function __construct()
    {
        $this->lecturer = new Lecturer(
            Config::$db_host,
            Config::$db_user,
            Config::$db_pass,
            Config::$db_name
        );
    }

    // ====================
    // INDEX (READ ALL)
    // ====================
    public function index()
    {
        $this->lecturer->open();

        // ambil semua data dosen
        $this->lecturer->read();

        $data = array();
        while ($row = $this->lecturer->getResult()) {
            array_push($data, $row);
        }

        $this->lecturer->close();

        $view = new LecturerView();
        $view->index($data);
    }

    // ====================
    // ADD NEW DATA
    // ====================
    public function create()
    {
        if (isset($_POST['submit'])) {
            $name       = $_POST['name'];
            $nidn       = $_POST['nidn'];
            $phone      = $_POST['phone'];
            $join_date  = $_POST['join_date'];

            $this->lecturer->open();
            $this->lecturer->create($name, $nidn, $phone, $join_date);
            $this->lecturer->close();

            header("Location: index.php?table=lecturers");
        } else {
            // jika hanya membuka halaman add
            $view = new LecturerView();
            $view->create();
        }
    }

    // ====================
    // EDIT DATA (UPDATE)
    // ====================
    public function update($id)
    {

        // Jika user submit
        if (isset($_POST['submit'])) {
            $name       = $_POST['name'];
            $nidn       = $_POST['nidn'];
            $phone      = $_POST['phone'];
            $join_date  = $_POST['join_date'];

            $this->lecturer->open();
            $this->lecturer->update($id, $name, $nidn, $phone, $join_date);
            $this->lecturer->close();

            header("Location: index.php?table=lecturers");
        } else {
            // Tampilkan data sebelumnya untuk form update
            $this->lecturer->open();
            $this->lecturer->read($id);
            $data = $this->lecturer->getResult();
            $this->lecturer->close();

            $view = new LecturerView();
            $view->update($data);
        
        }
    }

    // ====================
    // DELETE DATA
    // ====================
    public function delete($id)
    {
        $this->lecturer->open();
        $this->lecturer->delete($id);
        $this->lecturer->close();

        header("Location: index.php?table=lecturers");
    }
}
