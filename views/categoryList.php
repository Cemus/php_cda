<section>
    <h2>Liste des catégories existantes</h2>

    <form action="" method="post">
        <input type="submit" name="expandCategory" value="<?= $categoryListExpanded ? 'Masquer' : 'Voir' ?>">
    </form>
    
    <?php if ($categoryListExpanded): ?>
        <ul>
            <?php echo $listCategory; ?>
        </ul> 
    <?php endif; ?>
</section>
