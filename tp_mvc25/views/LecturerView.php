<?php

class LecturerView
{
    // ====== INDEX VIEW ======
    public function index($lecturers)
    {
        ?>
        <h1>Lecturer List</h1>
        <a href="index.php?table=lecturers&action=create" class="btn btn-primary">Add New Lecturer</a>
        <br><br>

        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>NIDN</th>
                <th>Phone</th>
                <th>Join Date</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($lecturers as $lec) { ?>
                <tr>
                    <td><?= $lec['id'] ?></td>
                    <td><?= $lec['name'] ?></td>
                    <td><?= $lec['nidn'] ?></td>
                    <td><?= $lec['phone'] ?></td>
                    <td><?= $lec['join_date'] ?></td>
                    <td>
                        <a href="index.php?table=lecturers&action=update&id=<?= $lec['id'] ?>">Edit</a> | 
                        <a href="index.php?table=lecturers&action=delete&id=<?= $lec['id'] ?>"
                           onclick="return confirm('Delete this lecturer?');">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <?php
    }

    // ====== CREATE FORM ======
    public function create()
    {
        ?>
        <h1>Add Lecturer</h1>
        <form action="index.php?table=lecturers&action=create" method="POST">

            <label>Name:</label><br>
            <input type="text" name="name" required><br><br>

            <label>NIDN:</label><br>
            <input type="text" name="nidn" required><br><br>

            <label>Phone:</label><br>
            <input type="text" name="phone" required><br><br>

            <label>Join Date:</label><br>
            <input type="date" name="join_date" required><br><br>

            <button type="submit" name="submit">Save</button>

            <a href="index.php?table=lecturers">Cancel</a>
        </form>
        <?php
    }

    // ====== UPDATE FORM ======
    public function update($lecturer)
    {
        ?>
        <h1>Edit Lecturer</h1>
        <form action="index.php?table=lecturers&action=update&id=<?= $lecturer['id'] ?>" method="POST">

            <input type="hidden" name="id" value="<?= $lecturer['id'] ?>">

            <label>Name:</label><br>
            <input type="text" name="name" value="<?= $lecturer['name'] ?>" required><br><br>

            <label>NIDN:</label><br>
            <input type="text" name="nidn" value="<?= $lecturer['nidn'] ?>" required><br><br>

            <label>Phone:</label><br>
            <input type="text" name="phone" value="<?= $lecturer['phone'] ?>" required><br><br>

            <label>Join Date:</label><br>
            <input type="date" name="join_date" value="<?= $lecturer['join_date'] ?>" required><br><br>

            <button type="submit" name="submit">Update</button>

            <a href="index.php?table=lecturers">Cancel</a>
        </form>
        <?php
    }

    public function delete($id)
    {
        ?>
        <h1>Delete Lecturer</h1>
        <a href="index.php?table=lecturers&action=delete&id=<?= $id ?>"
            onclick="return confirm('Delete this lecturer?');"> Delete
        </a>

        <?php
    }
}
