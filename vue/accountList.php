<section>
    <h2>Liste d'Utilisateurs</h2>

    <form action="" method="post">
        <input type="submit" name="expand" value="<?= $userListExpanded ? 'Masquer' : 'Voir' ?>">
    </form>
    
    <?php if ($userListExpanded): ?>
        <ul>
            <?php echo $listUsers; ?>
        </ul> 
    <?php endif; ?>
</section>
