<form action="sejours.php" method="get">
    <div class="search-bar">
        <input type="text" name="search" placeholder="🔍 Rechercher une destination, un animal..."
               value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button class="button1" type="submit">🐫 En Route !</button>
    </div>
</form>

