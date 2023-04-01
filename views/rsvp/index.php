<!-- List Data RSVP -->
<div class="flexColumn">
    <h1 class="title">Data List</h1>
</div>

<div class="flexColumn">
    <table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Post ID</th>
            <th scope="col">Nama</th>
            <th scope="col">Kehadiran</th>
            <th scope="col">Ucapan</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($data_rsvp as $key => $value) { ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $value["post_id"]; ?></td>
                    <td><?= $value["nama"]; ?></td>
                    <td><?= $value["kehadiran"]; ?></td>
                    <td><?= $value["ucapan"]; ?></td>
                    <td><input type="button" value="Hapus" id="deleteRsvp"></td>
                </tr>
            <?php } ?>
    </tbody>
    </table>
</div>