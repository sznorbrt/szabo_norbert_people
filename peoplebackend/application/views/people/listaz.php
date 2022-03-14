<div>
    <h1>Emberek listája</h1>
    <?php if (isset($people)): ?>
        <?php if (!empty($people)): ?>
            <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($people as $people): ?>
                    <tr>
                        <td><?php echo $people['id'] ?></td>
                        <td><?php echo $people['name'] ?></td>
                        <td><?php echo $people['email'] ?></td>
                        <td><?php echo $people['age'] ?></td>
                        <td>
                            <button><a href="<?php echo base_url(); ?>people/torol/<?php echo $auto['id'] ?>">Töröl</a></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>            
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Műveletek</th>
                </tr>
            </tfoot>
            </table>
        <?php else: ?>
            <h4>Nincs még ember az adatbázisban</h4>
        <?php endif; ?>
    <?php else: ?>
        <h4>Ismeretlen hiba történt</h4>
    <?php endif; ?>
</div>