<nav>
    <div style="display: flex;justify-content: space-between;padding: 5px 30px;">
        <div>
        </div>
        <div>
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i></a></li>
                <li><a href="keranjang.php"><i class="fas fa-shopping-cart"></i></a></li>
                <li><a href="pesanan.php"><i class="fas fa-receipt"></i></a></li>
                <li><a href="contact_us.php">Contact Us</a></li>
                <?php if (isset($_SESSION['email'])) : ?>
                <li><a href="logout.php" class="btn" style="border-bottom: none;">Logout</a></li>
                <?php else: ?>
                <li><a href="login.php" class="btn" style="border-bottom: none;">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    
</nav>