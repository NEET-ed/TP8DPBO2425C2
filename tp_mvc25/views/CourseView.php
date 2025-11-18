<?php

class CourseView
{
    // ======================================
    // INDEX VIEW — LIST COURSES
    // ======================================
    public function index($courses)
    {
        ?>
        <h1>Course List</h1>
        <a href="index.php?act=create" class="btn btn-primary">Add New Course</a>
        <br><br>

        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Course Name</th>
                <th>Course Code</th>
                <th>Lecturer</th>
                <th>Credits</th>
                <th>Action</th>
            </tr>

            <?php foreach ($courses as $course) : ?>
                <tr>
                    <td><?= $course['id'] ?></td>
                    <td><?= $course['course_name'] ?></td>
                    <td><?= $course['course_code'] ?></td>
                    <td><?= $course['lecturer_name'] ?></td>
                    <td><?= $course['credits'] ?></td>
                    <td>
                        <a href="index.php?act=edit&id=<?= $course['id'] ?>">Edit</a> |
                        <a href="index.php?act=delete&id=<?= $course['id'] ?>" 
                           onclick="return confirm('Delete this course?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
        <?php
    }

    // ======================================
    // CREATE FORM
    // ======================================
    public function create($lecturers)
    {
        ?>
        <h1>Add New Course</h1>

        <form action="" method="POST">
            <label>Course Name:</label><br>
            <input type="text" name="course_name" required><br><br>

            <label>Course Code:</label><br>
            <input type="text" name="course_code" required><br><br>

            <label>Lecturer:</label><br>
            <select name="lecturer_id" required>
                <option value="">-- Select Lecturer --</option>
                <?php foreach ($lecturers as $l) : ?>
                    <option value="<?= $l['id'] ?>"><?= $l['name'] ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <label>Credits:</label><br>
            <input type="number" name="credits" value="3" min="1"><br><br>

            <button type="submit" name="submit">Save</button>
            <a href="index.php">Cancel</a>
        </form>
        <?php
    }

    // ======================================
    // EDIT FORM
    // ======================================
    public function update($course, $lecturers)
    {
        ?>
        <h1>Edit Course</h1>

        <form action="" method="POST">
            <label>Course Name:</label><br>
            <input type="text" name="course_name" value="<?= $course['course_name'] ?>" required><br><br>

            <label>Course Code:</label><br>
            <input type="text" name="course_code" value="<?= $course['course_code'] ?>" required><br><br>

            <label>Lecturer:</label><br>
            <select name="lecturer_id" required>
                <?php foreach ($lecturers as $l) : ?>
                    <option value="<?= $l['id'] ?>" 
                        <?= ($l['id'] == $course['lecturer_id']) ? 'selected' : '' ?>>
                        <?= $l['name'] ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <label>Credits:</label><br>
            <input type="number" name="credits" value="<?= $course['credits'] ?>" min="1"><br><br>

            <button type="submit" name="submit">Update</button>
            <a href="index.php">Cancel</a>
        </form>
        <?php
    }
}
