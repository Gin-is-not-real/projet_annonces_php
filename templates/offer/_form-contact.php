<section class="container seller-container">
                <header>
                    <h1>Send a message</h1>
                </header>
            <header>
                <h3 class="offer-user">To: <?= $data['username']; ?></h3>
            </header>

            <div class="form-container">

                <form action="index.php?action=mail" method="post" class="form-contact">
                <div class="content">
                    <div>
                        <label for="mail-from">Mail: </label>
                        <input type="email" name="mail-from" required>
                    </div>
                    <div>
                        <label for="mail-message">Message: </label>
                        <textarea name="mail-message" required></textarea>
                    </div>
                    <input type="hidden" name="mail-to" value="<?= $data['usersid']; ?>">
                    <input type="hidden" name="mail-about" value="<?= $data['offerid']; ?>">

                    <input type="submit">
                </div>
                </form>
            </div>

        </section>